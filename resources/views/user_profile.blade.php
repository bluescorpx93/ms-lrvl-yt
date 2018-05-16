@extends('layouts.master')

@section('title')
{{ $user->first_name }} Profile
@endsection

@section('div_content')

<div class='col-md-6'>
	<h3> {{ $user->first_name }}</h3>

	@if(Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
	<div class='col-md-12'>
		<img src="{{ route('profileImageRoute', ['filename' => $user->first_name . '-' . $user->id . '.jpg' ]) }}" class='img-responsive'>
	</div>
	@endif
</div>

@if(Auth::user() == $user)
<div class='col-md-6'>
	<h3> Update Profile Information</h3>
	<form action=" {{ route('updateProfileRoute') }}" method='post' enctype='multipart/form-data'>
		<input type='hidden' name='_token' value='{{ Session::token() }}'>
		<div class='form-group'>
			<label for = 'first_name'> First Name</label>
			<input type='text' name='first_name' class='form-control' value='{{ $user->first_name }}'>
		</div>
		<div class='form-group'>
			<label for='profile_image'> Image</label>
			<input type='file' name='profile_image' id='profile_image'>
		</div>
		<div class='form-group'>
			<button type='submit' class='btn btn-primary'>Update</button>
		</div>
	</form>
</div>
@endif
@endsection