@extends("mobile.base")

@section('title')SD Coastkeeper Volunteer Login
@stop

@section('header')Volunteer Login @stop

@section('content')
<form action="/users/signin" method="POST" data-ajax="false">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<label for="username" class="ui-hidden-accessible">Username:</label>
	<input type="text" name="username" id="username" value="" placeholder="Username">
	<label for="password" class="ui-hidden-accessible">Password:</label>
	<input type="password" name="password" id="password" value="" placeholder="Password">
	<input type="submit" value="Login" class="submit" data-role="button" >
</form>
<a data-role="button" href="{{ URL::to('users/register') }}" data-ajax="false">Register</a>
<img src="{{ URL::asset('img/lobster.png') }}" alt="Logo" class="footer-logo">
@stop