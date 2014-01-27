@extends('admin/base')

@section('title') Edit category @stop

@section('content')
	<div span="12">
		<h1>Edit</h1>

		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Editing category  {{ $category->name }}
		</div>
		{{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.categories.update', $category->id) )) }}
		<input type="hidden" name="datasheet_id" value="{{ $datasheet->id }}">

		<div class="control-group @if($errors->has('category_name')) error @endif">
			<label for="category_name" class="control-label">New name:</label>

			<div class="controls">
				<input type="text" name="name" id="category_name" value="{{ $category->name }}">
				@if($errors->has('category_name'))
					<span class="help-inline">{{ $errors->first('category_name') }}</span>
				@endif
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<a href="{{ URL::route('admin.categories.index', array('datasheet_id'=>$datasheet->id)) }}" class="btn btn-default">Cancel</a>
		</div>
		</form>
	</div>
@stop

