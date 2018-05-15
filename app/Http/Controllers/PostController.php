<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Post as Post;

class PostController extends Controller{
	
	public function postCreatePost(Request $req){
		$post = new Post();
		$post->body  = $req['post_body'];

		$req->user()->posts()->save($post);
		return redirect()->route('dashboardRoute');
	}
}
