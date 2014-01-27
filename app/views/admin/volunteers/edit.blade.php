@extends('admin/base')

@section('title')Edit Volunteer @stop

@section('content')
	<div class="span12">
		<h1>Edit Volunteer</h1>
		@if($volunteer)
			{{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.volunteers.update', $volunteer->id) )) }}
			<div class="form-group">
				<label class="col-sm-2 control-label" for="first_name">First Name</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" id="first_name" name="first_name"
					       value="{{ $volunteer->first_name }}">
					@if($errors->has('first_name'))
						<span class="help-inline">{{ $errors->first('first_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="last_name">Last Name</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" id="last_name" name="last_name"
					       value="{{ $volunteer->last_name }}">
					@if($errors->has('last_name'))
						<span class="help-inline">{{ $errors->first('last_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="username">Login Name</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" id="username" name="username" value="{{ $volunteer->username }}">
					@if($errors->has('username'))
						<span class="help-inline">{{ $errors->first('username') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="email">Email</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" id="email" name="email" value="{{ $volunteer->email }}">
					@if($errors->has('email'))
						<span class="help-inline">{{ $errors->first('email') }}</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="role">Role:</label>

				<div class="col-sm-10">
					<select multiple class="form-control" name="role">
						@foreach($roles as $role)
							<option value="{{ $role->id }}" @if($volunteer->hasRole($role->name)) selected="selected"@endif>
								{{ $role->name }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Save Changes</button>
				<a class="btn btn-default" href="{{ URL::route('admin.volunteers.show', $volunteer->id) }}">Cancel</a>
			</div>
			</form>
		@else
			Volunteer doesn't exist.
		@endif
	</div>
@stop