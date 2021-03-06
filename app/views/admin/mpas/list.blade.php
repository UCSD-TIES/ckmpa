@extends('admin/base')

@section('title')Select a MPA @stop

@section('content')
		<h1>Select a MPA</h1>
<table>
  <tr>
    <td>
      <a href="{{ URL::route('admin.mpas.create') }}" class="btn btn-primary">
        <i class="glyphicon glyphicon-plus"></i> Create new MPA</a>
      <a href="{{ URL::route('admin.transects.index') }}" class="btn btn-primary">
        <i class="glyphicon glyphicon-eye-open"></i> View All Transects</a>
    </td>
  </tr>
</table>
<br>
		@if($mpas)
			<table class="table table-hover"  id = "MPATable" >
			<thead>
				<tr>
					<th>MPA</th>
					<th>Datasheet</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($mpas as $mpa)
					<tr>
						<td><a href="{{ URL::route('admin.mpas.show', $mpa->id) }}"> {{ $mpa->name }}</a></td>
						<td>{{ $mpa->datasheet->name }}</td>
						<td>
							<a class='btn btn-small btn-default'
							   href="{{ URL::route('admin.mpas.edit', $mpa->id) }}"><i
										class="glyphicon glyphicon-edit"></i> Edit</a>
                            <a class='btn btn-small btn-default' href="{{ URL::route('export-data', array('id'=> $mpa->id)) }}">
                              <i class="glyphicon glyphicon-download"></i>
                              Export
                            </a>
                          <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#{{$mpa->id}}">
                            <i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>
						</td>
					</tr>
              <div class="modal fade" id="{{$mpa->id}}">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Delete {{ $mpa->name }}?</h4>
                    </div>
                    <div class="modal-body">
                      <p>All the data will be gone forever!</p>
                    </div>
                    <div class="modal-footer">
                      {{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.mpas.destroy', $mpa->id) )) }}
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
