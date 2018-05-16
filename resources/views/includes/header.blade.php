<header>


	{{-- <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        
      </ul>
    </div>
  </nav> --}}

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      
	      @if(Auth::check())
	      	<a class="navbar-brand" href="/dashboard">LaravelApp</a>
	      @else
		      <a class="navbar-brand" href="/">LaravelApp</a>
	      @endif

	      
	    </div>

	    <div class="collapse navbar-collapse" id="">
	      <ul class="nav navbar-nav navbar-right">
	        @if(Auth::check())
	        	<li> <a href="{{ route('getUserRoute', ['user_id' => Auth::user()->id ]) }}"> {{ Auth::user()->first_name }} </a> </li>
	         	<li><a href=" {{ route('logoutRoute')}}">Logout</a></li>
	        @endif
	      </ul>
	    </div>
	  </div>
	</nav>



</header>