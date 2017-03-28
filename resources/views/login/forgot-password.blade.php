@extends('login.master-login')

@section('content')

	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="form" action="index.html" method="post">
		<div class="form-title">
			<span class="form-title" style="color: yellow !important">Forget Password ?</span>
			<span class="form-subtitle" style="color: white !important">Enter your e-mail to reset it.</span>
		</div>
		<div class="form-group">
			<input class="form-control input-underline-creamy" type="text" autocomplete="off" placeholder="Email" name="email"/>
		</div>
		<div class="form-actions" style="background: transparent;">
			
			<a href="{{ url('/login') }}" class="btn button-orange-creamy"> Back </a>
			<button type="submit" class="btn button-salmon-creamy uppercase pull-right">Submit</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->

@stop

@section('scripts')
	@include('errors.validation-errors')
@stop