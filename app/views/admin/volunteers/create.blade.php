@extends('admin/base')

@section('title')Create Volunteer @stop

@section('content')
	<div class="span12">
		<h1>Create New Volunteer</h1>

		<form class="form-horizontal" action="{{ URL::route('admin.volunteers.store') }}" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="first_name">First Name</label>

				<div class="col-sm-10 @if($errors->has('first_name'))has-error@endif">
					<input type="text" class="form-control" id="first_name" name="first_name"
					       value="{{ Input::old('first_name') }}">
					@if($errors->has('first_name'))
						<span class="help-block">{{ $errors->first('first_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="last_name">Last Name</label>

				<div class="col-sm-10 @if($errors->has('last_name'))has-error@endif">
					<input type="text" class="form-control" id="last_name" name="last_name"
					       value="{{ Input::old('last_name') }}">
					@if($errors->has('last_name'))
						<span class="help-block">{{ $errors->first('last_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="username">Login Name</label>

				<div class="col-sm-10 @if($errors->has('username'))has-error@endif">
					<input type="text" class="form-control" id="username" name="username"
					       value="{{ Input::old('username') }}">
					@if($errors->has('username'))
						<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="email">Email</label>

				<div class="col-sm-10 @if($errors->has('email'))has-error@endif">
					<input type="text" class="form-control" id="email" name="email" value="{{ Input::old('email') }}">
					@if($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="password">Password:</label>

				<div class="col-sm-10 @if($errors->has('password'))has-error@endif">
					<input type="password" class="form-control" id="password" name="password">
					@if($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="new_password_b">Renter Password:</label>

				<div class="col-sm-10 @if($errors->has('password_confirmation'))has-error@endif">
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
					@if($errors->has('password_confirmation'))
						<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="role">Role:</label>

				<div class="col-sm-10">
					<select class="form-control" name="role">
						@foreach($roles as $role)
							<option value="{{ $role->id }}" @if($role->name == 'Volunteer') selected="selected"@endif>
								{{ $role->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary">Save Changes</button>
			<a class="btn btn-warning" href="{{ URL::route('admin.volunteers.index') }}">Cancel</a>
		</div>
	</div>
	</form>
@stop
