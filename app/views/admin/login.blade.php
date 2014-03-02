@extends('admin/base')
@section('content')
	{{ Form::open(array('url'=> 'admin/login', 'class'=> 'form-signin')) }}
	<h2>Please Login</h2>

	{{ Form::text('username', null, array('class'=> 'form-control', 'placeholder'=> 'User Name')) }}
	{{ Form::password('password', array('class'=> 'form-control', 'placeholder'=> 'Password')) }}

	{{ Form::submit('Login', array('class'=> 'btn btn-large btn-primary btn-block')) }}

	<br><a href="/password/remind">Forgot Username or Password?</a>
	{{ Form::close() }}

@stop