@extends('admin/base')

@section('title') Create new category @stop

@section('content')
	<div span="12">
		<h1>Create a new category</h1>

		<form class="form-horizontal" action="{{ URL::route('admin.categories.store', array('datasheet_id'=> $datasheet_id)) }}" method="POST">
			<div class="control-group @if($errors->has('category_name')) error @endif">
				<label for="category_name" class="control-label">Name</label>

				<div class="controls">
					<input type="hidden" name="datasheet_id" value="{{ $datasheet_id }}">
					<input type="text" name="name" id="category_name" value="{{ Input::old( 'category_name' ) }}">
					@if($errors->has('category_name'))
						<span class="help-inline">{{ $errors->first('category_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create category</button>
				<a href="{{ URL::route('admin.categories.index', array('datasheet_id'=>$datasheet_id)) }}" class="btn">Cancel</a>
			</div>
		</form>
	</div>
@stop

