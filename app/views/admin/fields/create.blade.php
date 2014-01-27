@extends('admin/base')

@section('title') Create new field @stop

@section('content')
	<div span="12">
		<h1>Create a new field</h1>

		<form class="form-horizontal"
		      action="{{ URL::route('admin.fields.store', array('datasheet_id'=> $datasheet_id, 'category_id'=> $category_id)) }}"
		      method="POST">
			<input type="hidden" name="coastkeeper_datasheet_category_id" value="{{ $category_id }}">

			<div class="control-group">
				<label for="field_name" class="control-label">Name</label>

				<div class="controls">
					<input type="text" name="name" id="field_name" value="{{ Input::old( 'field_name' ) }}">
					@if($errors->has('field_name'))
						<span class="help-inline">{{ $errors->first('field_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create field</button>
				<a href="{{ URL::route('admin.categories.show', array('category_id'=>$category_id)) }}"
				   class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
@stop

