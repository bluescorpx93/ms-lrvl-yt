@if(count($errors) > 0)
<div class='row'>
	<script src='{{ asset('bootstrap/jquery.min.js')}}'></script>
	<script src='{{ asset('bootstrap/bootstrap.min.js')}}'></script>
	<div class='col-md-6 col-md-offset-3'>
		<div class='alert alert-danger alert-dismissible'>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			@foreach( $errors->all() as $error)
				<p> {{ $error }}</p>
			@endforeach
		</div>
	</div>
</div>
@endif

@if(Session::has('message'))
<div class='row'>
	<script src='{{ asset('bootstrap/jquery.min.js')}}'></script>
	<script src='{{ asset('bootstrap/bootstrap.min.js')}}'></script>
	<div class='col-md-6 col-md-offset-3'>
		<div class='alert alert-success alert-dismissible'>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<p> {{ Session::get('message')}} </p>
		</div>
	</div>
</div>
@endif