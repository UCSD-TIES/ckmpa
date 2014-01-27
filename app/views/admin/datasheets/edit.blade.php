@extends('admin/base')

@section('title') Edit Datasheet @stop

@section('content')
	<div span="12">
		<h1>Edit</h1>

		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Editing datasheet  {{ $datasheet->name }}
		</div>
		{{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.datasheets.update', $datasheet->id) )) }}
		<div class="control-group {% if errors->datasheet_name is defined %} error {% endif %}">
			<label for="datasheet_name" class="control-label">New name:</label>

			<div class="controls">
				<input type="text" name="name" id="datasheet_name" value="{{ $datasheet->name }}">
				@if($errors->first('datasheet_name'))
					<span class="help-inline">{{ $errors->datasheet_name }}</span>
				@endif
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<a href="{{ URL::route('admin.datasheets.index') }}" class="btn">Cancel</a>
		</div>
		</form>
	</div>
@stop

