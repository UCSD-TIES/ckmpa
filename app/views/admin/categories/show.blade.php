@extends('admin/base')

@section('title')Select a field @stop

@section('content')
<h1>{{ $datasheet->name }} - {{ $category->name }}</h1>
<div style="position: relative">
  <a class="btn btn-primary"
     href="{{ URL::route('admin.subs.create', array( 'category_id'=>$category->id)) }} "
     class="btn"><i class="glyphicon glyphicon-plus"></i> Create New Subcategory
  </a>

  <a class="btn btn-primary" href="{{ URL::route('admin.fields.create', array('datasheet_id'=>$datasheet->id, 'category_id'=>$category->id)) }} ">
    <i class="glyphicon glyphicon-plus"></i> Create New Field
  </a>
</div>
<br>

@if(!$subcategories->isEmpty())
	<table class="table table-hover">
		<tr>
			<th>Name</th>
			<th></th>
		</tr>
		@foreach($subcategories as $sub)
		<tr>
			<td>{{ $sub->name }}</td>
			<td>
				<a class="btn btn-default" href="{{ URL::route('admin.subs.edit', $sub->id) }}">
					<i class="glyphicon glyphicon-edit"> Edit</i></a>
              <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#{{$sub->id}}">
						<i class="glyphicon glyphicon-trash"></i> Delete
					</button>
			</td>

		</tr>
      <div class="modal fade" id="{{$sub->id}}">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Delete {{ $sub->name }}?</h4>
      </div>
      <div class="modal-body">
        <p>All the data will be gone forever!</p>
      </div>
      <div class="modal-footer">
        {{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.subs.destroy', $sub->id) )) }}
        <button type="submit" class="btn btn-small btn-danger">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
		@endforeach
	</table>
@else
<h3>{{ $category->name }} has no subcategories.</h3>
<br>
@endif
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
			<a class="btn btn-default" href="{{ URL::route('admin.fields.edit', $field->id) }}">
				<i class="glyphicon glyphicon-edit"> Edit</i></a>
          <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#{{$field->id}}">
					<i class="glyphicon glyphicon-trash"></i> Delete
				</button>
		</td>
	</tr>

<div class="modal fade" id="{{$field->id}}">
<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Delete {{ $field->name }}?</h4>
    </div>
    <div class="modal-body">
      <p>All the data will be gone forever!</p>
    </div>
    <div class="modal-footer">
      {{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.fields.destroy', $field->id) )) }}
      <button type="submit" class="btn btn-small btn-danger">Delete</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      {{ Form::close() }}
    </div>
  </div>
</div>
</div>
	@endforeach

</table>
@endif
@stop
