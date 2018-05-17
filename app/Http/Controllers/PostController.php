<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Post as Post;
use App\Like as Like;
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


	public function postLikePost(Request $req){
		$post_id = $req['post_id'];
		$is_like = $req['is_like'] === 'true'? true: false;

		$update_operation=  false;

		$post = Post::find($post_id);
		if (!$post){
			return null;
		}

		$user = Auth::user();
		$like_record = $user->likes()->where('post_id', $post_id)->first();

		if ($like_record){
			$existing_like_value = $like_record->like;
			$update_operation = true;

			if ($existing_like_value == $is_like){
				$like_record->delete();
				return null;
			}
		} else {
			$like_record = new Like();
		}

		$like_record->like = $is_like;
		$like_record->user_id = $user->id;
		$like_record->post_id = $post_id;

		if ($update_operation){
			$like_record->udpate();
		} else{
			$like_record->save();
		}

		return null;
	}











}
