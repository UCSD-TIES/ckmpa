@extends('admin/base')

@section('content')
<div class="page-header">
	<h1>Set Your New Password</h1>
</div>

{{ Form::open(array('class'=> 'form-horizontal')) }}
<input type="hidden" name="token" value="{{ $token }}">

<div class="form-group">
	{{ Form::label('email', 'Email Address:', array('class' => 'control-label col-sm-2')) }}
	<div class="col-sm-8">
		{{ Form::email('email', null, array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('password', 'Password:', array('class' => 'control-label col-sm-2')) }}
	<div class="col-sm-8">
	{{ Form::password('password', array('class' => 'form-control')) }}
	</div>
</div class="form-group">

<div class="form-group">
	{{ Form::label('password_confirmation', 'Password Confirmation:', array('class' => 'control-label col-sm-2')) }}
	<div class="col-sm-8">
	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Submit', array('class'=> 'btn btn-large btn-primary')) }}
	</div>
</div>
</form>

@if (Session::has('error'))
<p style="color: red;">{{ Session::get('error') }}</p>
@endif
@stop