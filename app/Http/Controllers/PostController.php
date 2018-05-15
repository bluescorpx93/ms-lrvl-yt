<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Post as Post;

class PostController extends Controller{
	
	public function postCreatePost(Request $req){

		$this->validate($req, ['post_body' => 'required | min:10| max: 1000']);

		$message = 'There was an error';

		$post = new Post();
		$post->body  = $req['post_body'];

		if ($req->user()->posts()->save($post)){
			$message = "Post Created";
		}

		return redirect()->route('dashboardRoute')->with(['message' => $message]);
	}
}
