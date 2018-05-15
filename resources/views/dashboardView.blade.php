@extends('layouts.master')

@section('div_content')

	<link href="{{ asset('css/cust.css') }}" rel="stylesheet" type="text/css" >

	@include('includes/message-block')

	<div class='col-md-6 col-md-offset-3'>
		<h3 class='text-center'> Say Something </h3>
		<form action="{{ route('createPostRoute') }}" method='post'>
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
				<p> {{ $post->body }} </p>
				<div class='mt24'>
					<a href='#'> Like</a> | 
					<a href='#'> Dislike</a> 
					@if(Auth::user() == $post->user)
						| <a href='#'> Edit</a> | 
						<a href='{{ route('deletePostRoute', ['post_id' => $post->id]) }}'> Delete</a>
					@endif 
				</div>
			</div>
		@endforeach
		
	</div>
@endsection