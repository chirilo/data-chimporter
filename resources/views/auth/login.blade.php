@extends('app')

@section('content')

<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="login or sign up" aria-hidden="true" role="dialog">
  <div class="row">
    <div class="large-6 columns auth-plain">
      <p class="welcome"> Welcome to this awesome app!</p>
      <div class="signup-panel left-solid">
        <p class="welcome">Registered Users</p>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        <form data-abide="" novalidate="novalidate" id="login_form" class="form-horizontal" role="form" method="POST" action="/auth/login">
        <!-- <form role="form" method="POST" action="/auth/login"> -->
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row collapse">
            <div class="small-2  columns">
              <span class="prefix"><i class="fi-torso-female"></i></span>
            </div>
            <div class="small-10  columns">
              <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="email/username">
            </div>
          </div>
          <div class="row collapse">
            <div class="small-2 columns ">
              <span class="prefix"><i class="fi-lock"></i></span>
            </div>
            <div class="small-10 columns ">
              <input type="password" class="form-control" name="password" required placeholder="pass">
            </div>
            <div class="small-12 medium-6 columns">
					            <input type="checkbox" name="remember"> Remember Me
					        </div>
            <div class="row">
		        <div class="small-12 medium-6 medium-centered columns">
		            <button type="submit" class="medium button green">Login</button>
		            <a href="/password/email">Forgot Your Password?</a>
		        </div>
		    </div>
          </div>
        </form>
        <!-- <a href="#" class="button ">Log In </a> -->
      </div>
    </div>
    <div class="row">
    <div class="large-6 columns">
      <div class="signup-panel">
        <p class="welcome"> Or Sign Up</p>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        <form data-abide="" novalidate="novalidate" id="register_form" class="form-horizontal" role="form" method="POST" action="/auth/register">
        <!-- <form class="form-horizontal" role="form" method="POST" action="/auth/register"> -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row collapse">
            <div class="small-2  columns">
              <span class="prefix"><i class="fi-torso-female"></i></span>
            </div>
            <div class="small-10  columns">
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="name" />
            </div>
             <small class="error"> Oops! you forgot to put your name.</small>
          </div>
          <div class="row collapse">
            <div class="small-2 columns">
              <span class="prefix"><i class="fi-mail"></i></span>
            </div>
            <div class="small-10  columns">
              <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="email" />
            </div>
             <small class="error"> Oops! Something's wrong.</small>
          </div>
          <div class="row collapse">
            <div class="small-2 columns ">
              <span class="prefix"><i class="fi-lock"></i></span>
            </div>
            <div class="small-10 columns ">
              <input type="password" class="form-control" name="password" required placeholder="password" />
            </div>
            <small class="error"> Oops! is that your password?.</small>
          </div>
          <div class="row collapse">
            <div class="small-2 columns ">
              <span class="prefix"><i class="fi-lock"></i></span>
            </div>
            <div class="small-10 columns ">
              <input type="password" class="form-control" name="password_confirmation" required placeholder="confirm password" />
            </div>
            <small class="error"> Oops! They're not the same, try again.</small>
          </div>
          <div class="row collapse">
            <button type="submit" class="btn btn-primary">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
   </div>
   </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div style="display: none;" class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="row">
					        <div class="small-12 medium-6 columns">
								<label>Email</label>
					            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
					        </div>
					        <div class="small-12 medium-6 columns">
								<label>Password</label>
					            <input type="password" class="form-control" name="password">
					        </div>
					        <div class="small-12 medium-6 columns">
					            <input type="checkbox" name="remember"> Remember Me
					        </div>
					    </div>
					    <div class="row">
					        <div class="small-12 medium-6 medium-centered columns">
					            <button type="submit" class="button expand">Login</button>
					            <a href="/password/email">Forgot Your Password?</a>
					        </div>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
