@extends('admin/base')

@section('title')Edit Location @stop

@section('content')
	<div span="12">
		<h1>Edit</h1>

		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Editing location  {{ $location->name }}
		</div>
		{{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.locations.update', $location->id) )) }}
		<input type="hidden" name="datasheet_id" value="{{ $location->datasheet->id }}">

		<div class="control-group">
			<label for="name" class="control-label">New name:</label>

			<div class="controls">
				<input type="text" name="name" id="name" value="{{ $location->name }}">
				@if($errors->has('location_name'))
					<span class="help-inline">{{ $errors->first('location_name') }}</span>
				@endif
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<a href="{{ URL::route('admin.locations.index') }}" class="btn">Cancel</a>
		</div>
		</form>
	</div>
@stop

