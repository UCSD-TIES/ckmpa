@extends('admin/base')

@section('title')View All Transects @stop

@section('content')
	<div class="span12">
		<h1>Transects</h1>
		<table class="table table-hover">
			<tr>
				<th>Name</th>
				<th>MPA</th>
				<th></th>
			<tr>
			@foreach($transects as $transect)
			<td>
				{{ $transect->name }}
			</td>
			<td>
				{{ $transect->mpa->name }}
			</td>
			<td>
				<a class='btn btn-default' href="{{ URL::route('admin.transects.edit', $transect->id) }}"><i
					class="glyphicon glyphicon-edit"></i> Edit</a>
              <a class='btn btn-danger' data-toggle="modal" data-target="#{{$transect->id}}">
                <i class="glyphicon glyphicon-trash"></i> Delete</a>
					</td>
				</tr>
          <div class="modal fade" id="{{$transect->id}}">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Delete {{ $transect->name }}?</h4>
                </div>
                <div class="modal-body">
                  <p>All the data will be gone forever!</p>
                </div>
                <div class="modal-footer">
                  {{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.transects.destroy', $transect->mpa->id) )) }}
                  <input type="hidden" name="transect_id" value="{{ $transect->id }}">
                  <button type="submit" class="btn btn-small btn-danger">Delete</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
			@endforeach
		</table>

	</div>
@stop
