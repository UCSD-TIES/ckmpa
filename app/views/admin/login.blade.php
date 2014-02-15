@extends('admin/base')
@section('content')
	{{ Form::open(array('url'=> 'admin/login', 'class'=> 'form-signin')) }}
	<h2>Please Login</h2>

	{{ Form::text('username', null, array('class'=> 'form-control', 'placeholder'=> 'User Name')) }}
	{{ Form::password('password', array('class'=> 'form-control', 'placeholder'=> 'Password')) }}

	{{ Form::submit('Login', array('class'=> 'btn btn-large btn-primary btn-block')) }}
	{{ Form::close() }}
{{ Form::open(array('url'=> '/forget', 'class'=> 'form-signin')) }}


    <input type="email" name="email">
    <button type="submit" class="btn btn-primary"></button>
</form>
@stop