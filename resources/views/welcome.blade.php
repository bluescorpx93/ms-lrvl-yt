@extends('layouts.master')

@section('title')
Welcome
@endsection

@section('div_content')
	<div class='row'>

		@if(count($errors) > 0)
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<ul>
						@foreach( $errors->all() as $error)
							<li> {{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
		
		<div class='col-md-6'>
			<h3> Sign Up</h3>
			<form action="{{ route('signupRoute') }}" method="post">
				<input type='hidden' name='_token' value='{{ Session::token() }}'>
				<div class='form-group {{ $errors->has('email') ? 'has-error': ''}} '>
					<label for="email"> Email</label>
					<input type='text' class='form-control ' name='email' id='email' value={{ Request::old('email')}}>
				</div>
				<div class='form-group {{ $errors->has('first_name') ? 'has-error': ''}}'>
					<label for="first_name"> First Name</label>
					<input type='text' class='form-control' name='first_name' id='first_name' value={{ Request::old('first_name')}}>
				</div>
				<div class='form-group {{ $errors->has('password') ? 'has-error': ''}}'>
					<label for="password"> Password</label>
					<input type='password' class='form-control' name='password' id='password' value={{ Request::old('password') }}>
				</div>
				<div class='form-group'>
					<button type='submit' class='btn btn-primary'>Submit</button>
				</div>
			</form>
		</div>

		<div class='col-md-6'>
			<h3> Sign In</h3>
			<form action=" {{ route('signinRoute')}}" method="post">
				<input type='hidden' name='_token' value='{{ Session::token() }}'>
				<div class='form-group {{ $errors->has('email') ? 'has-error': ''}} '>
					<label for="email"> Email</label>
					<input type='text' class='form-control' name='email' id='email' value={{ Request::old('email')}}>
				</div>
				<div class='form-group {{ $errors->has('password') ? 'has-error': ''}}'>
					<label for="password"> Password</label>
					<input type='password' class='form-control' name='password' id='password' value={{ Request::old('password')}}>
				</div>
				<div class='form-group'>
					<button type='submit' class='btn btn-primary'>Submit</button>
				</div>
			</form>
		</div>
	</div>

@endsection