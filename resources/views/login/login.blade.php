@extends('login.master-login')

@section('content')	
	<!-- BEGIN LOGIN FORM -->
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<input class="form-control input-underline-creamy" type="email" autocomplete="off" placeholder="Email" name="email"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control input-underline-creamy" type="password" autocomplete="off" placeholder="Password" name="password"/>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn button-salmon-creamy btn-block uppercase">Login</button>
		</div>
		<div class="form-actions">
			<div class="pull-left">
				<label class="rememberme check">
				<input type="checkbox" name="remember" />Remember me </label>
			</div>
			<div class="pull-right forget-password-block">
				<a href="{{ route('test.showForgotPassword') }}" id="forget-password" class="forget-password" >Forgot Password?</a>
			</div>
		</div>
		<div class="create-account">
			<p>
				<a href="{{ route('test.showRegistration') }}" id="register-btn">Create an account</a>
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
@stop