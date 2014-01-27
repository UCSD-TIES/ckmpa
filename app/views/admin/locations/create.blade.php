@extends('admin/base')

@section('title')Create new Location @stop

@section('content')
	<div span="12">
		<h1>Create a New Location</h1>

		<form class="form-horizontal" action="{{ URL::route('admin.locations.store') }}" method="POST">
			<div class="control-group">
				<label for="location_name" class="control-label">Name</label>

				<div class="controls">
					<input type="text" name="name" id="location_name" value="{{ Input::old( 'location_name' ) }}">
					@if($errors->has('location_name'))
						<span class="help-inline">{{ $errors->first('location_name') }}</span>
					@endif
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="datasheet">Datasheet:</label>

				<div class="controls">
					<select name="datasheet_id" id="datasheet">
						<option value="" selected>Select a datasheet</option>
						@foreach($datasheets as $datasheet)
							<option value="{{ $datasheet->id }}">{{ $datasheet->name }}</option>
						@endforeach
					</select>
					@if($errors->has('datasheet'))
						<span class="help-inline">{{ $errors->first('datasheet') }}</span>
					@endif
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create location</button>
				<a class="btn btn-default" href="{{ URL::route('admin.locations.index') }}" class="btn">Cancel</a>
			</div>
		</form>
	</div>
@stop

