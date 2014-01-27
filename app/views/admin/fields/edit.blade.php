@extends('admin/base')

@section('title') Edit field @stop

@section('content')
	<div span="12">
		<h1>Edit</h1>

		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Editing field named {{ $field->name }}
		</div>
		{{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.fields.update', $field->id) )) }}
		<div class="control-group">
			<input type="hidden" name="category_id" value="{{ $category->id }}">
			<label for="field_name" class="control-label">New name:</label>

			<div class="controls">
				<input type="text" name="name" id="field_name" value="{{ $field->name }}">
				@if($errors->has('field_name'))
					<span class="help-inline">{{ $errors->first('field_name') }}</span>
				@endif
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn btn-default" href="{{ URL::route('admin.categories.show', $category->id) }}" class="btn">Cancel</a>
		</div>
		</form>
	</div>
@stop

