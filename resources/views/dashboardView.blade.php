@extends('layouts.master')

@section('title') Home @endsection

@section('div_content')
<script src='{{ asset('bootstrap/jquery.min.js')}}'> </script>
<script src='{{ asset('bootstrap/bootstrap.min.js')}}'> </script>
<link href="{{ asset('css/cust.css') }}" rel="stylesheet" type="text/css" >

@include('includes/message-block')

<div class='col-md-6 col-md-offset-3'>
	<h3 class='text-center' id='main-heading'> Say Something </h3>

	<form action="{{ route('createPostRoute') }}" method='post' id='createPostForm'>
		<input type='hidden' name='_token' value="{{ Session::token() }}" >
		<div class='form-group'>
			<textarea name='post_body' id='new_post_textarea' rows="5" placeholder="Your Post" class='form-control'>
			</textarea>
		</div>
		<div class='form-group'>
			<button type='submit' class='btn btn-primary'> Submit</button>
		</div>
	</form>

</div>

<div class='col-md-6 col-md-offset-3'>
	<h3 class='text-center'> What People are saying </h3>
	@foreach($posts as $post)
	<div class='well'>
		<h4> <strong> {{ $post->user->first_name }}</strong> </h4>
		<p> {{ $post->created_at }} </p>
		<p id='post_id_{{ $post->id }}'> {{ $post->body }} </p>
		<div class='mt24'>
			<a href='#' class='like_action' data-post_id="{{ $post->id }}" > {{ Auth::user()->likes->where('post_id', $post->id)->first() ? Auth::user()->likes->where('post_id', $post->id)->first()->like == 1 ? "Liked Already": "Like"  : 'Like' }}</a> |
			<a href='#' class='like_action' data-post_id="{{ $post->id }}" > {{ Auth::user()->likes->where('post_id', $post->id)->first() ? Auth::user()->likes->where('post_id', $post->id)->first()->like == 0 ? "Disliked Already": "Dislike"  : 'Dislike' }}</a>
			@if(Auth::user() == $post->user)
			| <a href='#' data-id="{{ $post->id }}" class='editAncTag'> Edit</a> |
			{{-- | <a href='#' data-id="{{ $post->id }}" class='editAncTag' data-toggle="modal" data-target="#editModal" > Edit</a> |  --}}
			<a href='{{ route('deletePostRoute', ['post_id' => $post->id]) }}'> Delete</a>
			@endif
		</div>
	</div>
	@endforeach

	<div class="modal fade" tabindex="-1" role="dialog" id='editModal'>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id='modalHeading'> </h4>
				</div>
				<div class="modal-body">
					<input type='hidden' id='edit_post_csrf' value='{{ Session::token() }}'>
					<textarea class='form-control' id='modalBodyTextArea' name='edit_post_body' rows='5' placeholder='Edit Post'></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id='save_modal'>Save</button>
				</div>
			</div>
		</div>
	</div>

</div>

<script src='{{ asset('js/editpost.js')}}'></script>
<script src='{{ asset('js/likepost.js')}}'></script>
@endsection
