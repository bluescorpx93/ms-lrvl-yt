<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;
use App\User as User;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\File as File;
use Illuminate\Support\Facades\Storage as Storage;

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

		if ($auth_result) {
			return redirect()->route('dashboardRoute');
		}

		$message = 'Invalid Credentials';

		return redirect()->back()->with(['message' => $message]);
	}

	public function editProfile(Request $req){
		$this->validate($req, ['first_name' => 'required | max:50 | min:3']);

		$user = Auth::user();
		$user->first_name = $req['first_name'];
		$user->update();

		if ($req->file('profile_image')){
			$file = $req->file('profile_image');
			$filename = $req['first_name'] . '-' . $user->id . '.jpg';
		
			$foldername = $req['first_name'] . "/";
			Storage::disk('local')->put("$foldername".$filename, File::get($file)); 
		}

		return redirect()->route('getUserRoute', ['user_id' => Auth::user()->id ]);
	}

	public function getLogout(Request $req){
		Auth::logout();
		return redirect()->route('welcomeRoute');
	}

	public function getUserImage(Response $res, $foldername, $filename){

		// $file_in_path = $req['first_name'] . "/" . $filename;
		// $file = Storage::disk('local')->get($file_in_path);

		$file_in_path = $foldername . "/" . $filename;
		$file = Storage::disk('local')->get($file_in_path);
		return new response($file, 200);
	}


}