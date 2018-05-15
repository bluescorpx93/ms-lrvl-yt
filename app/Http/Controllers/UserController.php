<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller{

	public function getDashboard(){
		return view('dashboardView');
	}

	public function postSignUp(Request $req){
		$email = $req['email'];
		$first_name = $req['first_name'];
		$password = bcrypt($req['password']);

		$user = new User();
		$user->email = $email;
		$user->first_name = $first_name;
		$user->password = $password;

		$user->save();

		return redirect()->route('dashboardRoute');
	}


	public function postSignIn(Request $req){

	}
}