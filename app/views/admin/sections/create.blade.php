@extends('admin/base')

@section('title')Create new section @stop

@section('content')
	<div span="12">
		<h1>Add a new section</h1>

		<form class="form-horizontal" action="{{ URL::route('admin.sections.store') }}" method="POST">
			<input type="hidden" name='location_id' value="{{ $location->id }}">

			<div class="control-group">
				<label for="section_name" class="control-label">Name</label>

				<div class="controls">
					<input type="text" name="name" id="section_name" value="{{ Input::old( 'section_name' ) }}">
					@if($errors->has('section_name'))
						<span class="help-inline">{{ $errors->first('section_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create section</button>
				<a class="btn btn-default" href="{{ URL::route('admin.locations.show', $location->id) }}">Cancel</a>
			</div>
		</form>
	</div>
@stop

