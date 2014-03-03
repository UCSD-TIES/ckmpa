@extends('admin/base')

@section('title')Select a field @stop

@section('content')
<h1>{{ $datasheet->name }} - {{ $category->name }}</h1>
@if($fields)
	<table class="table table-hover">
		<tr>
			<th>Name</th>
			<th></th>
		</tr>
		@foreach($subcategories as $sub)
		<tr>
			<td>{{ $sub->name }}</td>
			<td>
				<!-- DOESN'T WORK YET -->
				{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.subs.destroy', $sub->id) )) }}
				<a class="btn btn-default" href="{{ URL::route('admin.subs.edit', $sub->id) }}">
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
<div style="padding-bottom: 10px;">
<a class="btn btn-default"
   href="{{ URL::route('admin.subs.create', array( 'category_id'=>$category->id)) }} "
   class="btn"><i class="glyphicon glyphicon-plus"></i> Create new subcategory</a>
</div>
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
	class="btn"><i class="glyphicon glyphicon-plus"></i> Create New Field</a>
	<a class="btn btn-default" href="{{ URL::route('admin.datasheets.show', array('datasheet_id'=> $datasheet->id)) }} "><i class="glyphicon glyphicon-arrow-left"></i> Back to Datasheet '{{ $datasheet->name }}'</a>
</div>
@stop
