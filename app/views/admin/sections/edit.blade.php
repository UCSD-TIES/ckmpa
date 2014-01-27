@extends('admin/base')

@section('title')Edit Section @stop

@section('content')
	<div span="12">
		<h1>Edit</h1>

		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Editing section <b>{{ $section->name }}</b> of location <b>{{ $location->name }}</b>
		</div>
		{{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.sections.update', $location->id) )) }}
		<input type="hidden" name="section_id" value="{{ $section->id }}">

		<div class="control-group">
			<label for="section_name" class="control-label">New name:</label>

			<div class="controls">
				<input type="text" name="name" id="section_name" value="{{ $section->name }}">
				@if($errors->has('section_name'))
					<span class="help-inline">{{ $errors->first('section_name') }}</span>
				@endif
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn btn-default" href="{{ URL::route('admin.locations.show', $location->id) }}" class="btn">Cancel</a>
		</div>
		</form>
	</div>
@stop

