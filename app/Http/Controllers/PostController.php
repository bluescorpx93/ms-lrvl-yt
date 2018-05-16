<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Post as Post;
use Illuminate\Support\Facades\Auth as Auth;

class PostController extends Controller{

	public function getDashboard(){
		// $posts = Post::all();
		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('dashboardView', ['posts'=> $posts ]);
	}
	
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

	public function getDeletePost($post_id){
		// $post = Post::where('id', $post_id)->first();
		$post = Post::find($post_id);

		if (Auth::user() != $post->user){
			return redirect()->back();
		}

		$post->delete();

		return redirect()->route('dashboardRoute')->with(['message' => "Post Deleted"]);
	}


	public function editPostById(Request $req){
		$this->validate($req, ['post_body' => 'required', 'post_id'=> 'required']);

		$post = Post::find($req['post_id']);
		$post->body = $req['post_body'];
		$post->update();

		return response()->json(['message' => 'Post Updated', 'updated' => true ], 200);
	}
}
