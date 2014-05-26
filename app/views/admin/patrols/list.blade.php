@extends('admin/base')

@section('title')Patrols @stop

@section('content')
	<div class="span12">
		<h2> Patrols</h2>
		@if($patrols)
			<table class="table table-hover" id="PatrolTable">
				
				<thead>
				<tr>
					<th>Date</th>
					<th>Transect</th>
					<th>Volunteer</th>
					<th></th>
				</tr>
				</thead>

				<tbody>
				@foreach($patrols as $patrol)
						<tr>

						<td>{{ $patrol->start_time->toDateString() }}</td>	
	
							<td>
								@if($patrol->transect)
                              <a href="{{ URL::route('patrol-list',
                                       ['transect'=>$patrol->transect->id, 'mpa' => $patrol->transect->mpa->id]) }}">
									{{ $patrol->transect->name }}
									</a>
								@endif
							</td>
							<td>
								@if($patrol->user)
									<a href="{{ URL::route('admin.volunteers.show', $patrol->user->id ) }}">
										{{ $patrol->user->first_name }} {{ $patrol->user->last_name }}
									</a>
								@endif
							</td>

							<td>

                              <div class='form-group'>
                                <a class="btn btn-default" href="/admin/patrol-tallies/{{$patrol->id}}"
                                   data-toggle="modal" data-target="#{{$patrol->id}}">
                                  <i class="glyphicon glyphicon-stats"></i>
                                  Details
                                </a>
                              </div>
								<div class='form-group'>
                                  <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#delete{{$patrol->id}}">
									<i class="glyphicon glyphicon-trash"></i>
										Delete
									</button>
								</div>
							</td>
						</tr>
					<div class="modal fade" id="{{$patrol->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
					    <div class="modal-content">
					    </div>
					  </div>
					</div>
<div class="modal fade" id="delete{{$patrol->id}}">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Delete Patrol on {{ $patrol->start_time->toDateString() }} by {{ $patrol->user->first_name }}?</h4>
      </div>
      <div class="modal-body">
        <p>All the data will be gone forever!</p>
      </div>
      <div class="modal-footer">
        {{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.patrols.destroy', $patrol->id) )) }}
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

	</div>
@stop
