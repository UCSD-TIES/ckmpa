@extends('admin/base')

@section('title') Edit field @stop

@section('content')
	<div span="col-sm-12">
		<h1>Edit</h1>

		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Editing field named {{ $field->name }}
		</div>
		{{ Form::open(array('method'=> 'PATCH', 'route'=> array('admin.fields.update', $field->id) )) }}
		<div class="form-group">
			<input type="hidden" name="category_id" value="{{ $category->id }}">
			<label for="field_name" class="control-label">New name:</label>

				<input class='form-control 'type="text" name="name" id="field_name" value="{{ $field->name }}">
				@if($errors->has('field_name'))
					<span class="help-inline">{{ $errors->first('field_name') }}</span>
				@endif
		</div>
		<div class="form-group">
			<label for='type'>Type</label>
			<select name='type' multiple class="form-control">
				@foreach($types as $type)
					<option value='{{$type->type}}' @if($type->type == $field->type) selected='selected' @endif>
				{{$type->type}}</option>
				@endforeach
			</select>
		</div>
			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn btn-default" href="{{ URL::route('admin.categories.show', $category->id) }}">Cancel</a>
		</form>
		@if($field->type == 'radio')
			    <h3>Present Options</h3>
				  <ul class="list-group">
				  	@foreach($options as $option)
				  		<li class="list-group-item">
				  		<a href='{{URL::action('FieldsController@deleteOption', array('id'=>$option->id)) }}'>
				  		<span class='glyphicon glyphicon-trash'></span></a>
				  		{{ $option->name }}</li>
				  	@endforeach
				  </ul>
				  <form action='{{URL::action('FieldsController@addOption', array('id'=>$field->id)) }}'>
					  <div class='form-group'>
					  	<label for='option'>Add Option</label>
					  	<input class='form-control' name='option'>
					  </div>
					  <button type="submit" class="btn btn-primary">Add</button>
				  </form>
		@endif
	</div>
@stop

