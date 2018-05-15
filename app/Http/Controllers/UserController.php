<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\User as User;
use Illuminate\Support\Facades\Auth as Auth;

class UserController extends Controller{

	public function getUserById($user_id){
		$user = User::find($user_id);
		return view('user_profile', ['user' => $user]);
	}

	public function postSignUp(Request $req){

		$this->validate($req, [
			'email' =>	'required | email | unique:users',
			'first_name' => 'required | max:120',
			'password' => 'required | min:6'
		]);

		$email = $req['email'];
		$first_name = $req['first_name'];
		$password = bcrypt($req['password']);

		$user = new User();
		$user->email = $email;
		$user->first_name = $first_name;
		$user->password = $password;

		$user->save();

		Auth::login($user);

		return redirect()->route('dashboardRoute');
	}


	public function postSignIn(Request $req){

		$this->validate($req, [
			'email' =>	'required ',
			'password' => 'required '
		]);

		$auth_result = Auth::attempt([ 
			'email' => $req['email'],	
			'password' => $req['password']
		]);

		$message = 'Invalid Credentials';

		if ($auth_result) {
			return redirect()->route('dashboardRoute');
		}

		return redirect()->back()->with(['message' => $message]);
	}

	public function getLogout(Request $req){
		Auth::logout();
		return redirect()->route('welcomeRoute');
	}
}