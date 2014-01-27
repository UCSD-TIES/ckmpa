@extends("mobile.base")

@section('title')SD Coastkeeper Volunteer Login@stop

@section('header')Volunteer Login @stop

@section('content')
	<form action="/users/login" method="POST">
		{{ Form::token() }}
		<label for="username" class="ui-hidden-accessible">Username:</label>
		<input type="text" name="username" id="username" placeholder="Username">
		<label for="password" class="ui-hidden-accessible">Password:</label>
		<input type="password" name="password" id="password" placeholder="Password">
		<button type="submit" class="ui-btn">Login</button>
	</form>
	<a class="ui-btn" href="{{ URL::to('users/register') }}" data-ajax="false">Register</a>
	<img src="{{ URL::asset('img/lobster.png') }}" alt="Logo" class="footer-logo">
@stop