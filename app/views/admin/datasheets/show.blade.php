@extends('admin/base')

@section('title')Select a category @stop

@section('content')

		<h1>Categories for {{ $datasheet->name }}</h1>
      <div>
        <a class='btn btn-primary' href="{{ URL::route('admin.categories.create', array('datasheet_id'=> $datasheet->id)) }} "
           class="btn">
          <i class="glyphicon glyphicon-plus"></i>
          Create New Category</a>
      </div>
      <br>
		@if($categories)
			<table class="table table-hover">
				@foreach($categories as $category)
					<tr>
						<td>
							<a href="{{ URL::route( 'admin.categories.show', $category->id) }}">
								{{ $category->name }}
							</a>
						</td>
						<td>

							<a class="btn btn-small btn-default" href="{{ URL::route('admin.categories.edit', $category->id) }}">
                              <i class="glyphicon glyphicon-edit"></i> Edit</a>
                          <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#{{$category->id}}">
                              <i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>

              <div class="modal fade" id="{{$category->id}}">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Delete {{ $category->name }}?</h4>
                    </div>
                    <div class="modal-body">
                      <p>All the data will be gone forever!</p>
                    </div>
                    <div class="modal-footer">
                      {{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.categories.destroy', $category->id) )) }}
                      <input type="hidden" name="datasheet_id" value="{{ $datasheet->id }}">
                      <button type="submit" class="btn btn-small btn-danger">Delete</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
              </div>
						</td>
					</tr>
				@endforeach
			</table>
		@endif
@stop
