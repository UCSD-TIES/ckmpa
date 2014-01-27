@extends("mobile.base")

@section('content')
	<h2>Please Register</h2>
	{{ Form::open(array('url'=> 'users')) }}

	{{ Form::text('first_name', null, array('placeholder'=> 'First Name')) }}
	{{ Form::text('last_name', null, array('placeholder'=> 'Last Name')) }}
	{{ Form::text('username', null, array('placeholder'=> 'User Name')) }}
	{{ Form::text('email', null, array('placeholder'=> 'Email')) }}
	{{ Form::password('password', array('placeholder'=> 'Password')) }}
	{{ Form::password('password_confirmation', array('placeholder'=> 'Confirm Password')) }}

	{{ Form::submit('Register') }}
	{{ Form::close() }}
@stop