@extends('admin/base')

@section('title')Select a field @stop

@section('content')
	<div class="span12">
		<h1>{{ $datasheet->name }} - {{ $category->name }}</h1>
		@if($fields)
			<table class="table table-hover">
				<tr>
				<th>Field</th>
				<th>Type</th>
				<th></th>
				</tr>
				@foreach($fields as $field)
					<tr>
						<td>{{ $field->name }}</td>
						<td>{{ $field->type }}</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.fields.destroy', $field->id) )) }}
							<a class="btn btn-default" href="{{ URL::route('admin.fields.edit', $field->id) }}">
								<i	class="glyphicon glyphicon-edit"> Edit</i></a>
							<button type="submit" class="btn btn-small btn-danger">
								<i class="glyphicon glyphicon-trash"></i> Delete
							</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>
		@endif

		<div>
			<a class="btn btn-default"
			   href="{{ URL::route('admin.fields.create', array('datasheet_id'=>$datasheet->id, 'category_id'=>$category->id)) }} "
			   class="btn"><i class="glyphicon glyphicon-plus"></i> Create new field</a>
			<a class="btn btn-default" href="{{ URL::route('admin.datasheets.show', array('datasheet_id'=> $datasheet->id)) }} ">Back to datasheet '{{ $datasheet->name }}'</a>
		</div>

	</div>
@stop
