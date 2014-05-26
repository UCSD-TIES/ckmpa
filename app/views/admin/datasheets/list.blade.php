@extends('admin/base')

@section('title')Select a datasheet @stop

@section('content')

		<h1>Datasheets</h1>
<div>
  <a class='btn btn-primary' href="{{ URL::route('admin.datasheets.create') }} " class="btn">
    <i class="glyphicon glyphicon-plus"></i> Create new Datasheet
  </a>
</div>
<br>
		@if($datasheets)
			<table class="table table-hover" id="DataSheetTable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>
				@foreach($datasheets as $datasheet)
					<tr>
						<td>
							<a href="{{ URL::route( 'admin.datasheets.show', $datasheet->id) }}">
								{{ $datasheet->name }}
							</a>
						</td>
						<td>

                  <a class="btn btn-dmall btn-default"
							   href="{{ URL::route('admin.datasheets.edit', array('datasheet_id'=>$datasheet->id)) }}"><i
										class="glyphicon glyphicon-edit"></i> Edit</a>
                          <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#{{$datasheet->id}}">
                            <i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>

						</td>
					</tr>
                  <div class="modal fade" id="{{$datasheet->id}}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Delete {{ $datasheet->name }}?</h4>
                        </div>
                        <div class="modal-body">
                          <p>All the data will be gone forever!</p>
                        </div>
                        <div class="modal-footer">
                          {{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> ['admin.datasheets.destroy', $datasheet->id] )) }}
                          <button type="submit" class="btn btn-small btn-danger">Delete</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          {{ Form::close() }}
                        </div>
                      </div>
                    </div>
                  </div>
				@endforeach
			</tbody>
			</table>


		@endif
@stop
