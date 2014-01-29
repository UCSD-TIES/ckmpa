@extends('admin/base')

@section('title')Patrols @stop

@section('content')
	<div class="span12">
		<h2> Patrols</h2>
		@if($patrols)
			<table class="table table-hover">
				<tr>
					<th>Date</th>
					<th>Location</th>
					<th>Volunteer</th>
					<th>Completed</th>
					<th></th>
				</tr>

				@foreach($patrols as $patrol)
					<tr>

						<td>{{ $patrol->date }}</td>

						<td>
							@if($patrol->location)
								<a href="{{ URL::route('patrol-list', array('location'=>$patrol->location->id)) }}">
									{{ $patrol->location->name }}
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
						<td>@if($patrol->is_finished)<i class="glyphicon glyphicon-ok"></i>@endif</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.patrols.destroy', $patrol->id) )) }}
							<div class='form-group'>
								<button type="submit" class="btn btn-small btn-danger">
								<i class="glyphicon glyphicon-trash"></i>
									Delete
								</button>
							</div>
							<div class='form-group'>
								<a class="btn btn-default" data-toggle="modal" data-target="#{{$patrol->id}}">
								  Details
								</a>
							</div>
							</form>
							
						</td>
					</tr>
					<div class="modal fade" id="{{$patrol->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">
					        	Details for Patrol on {{ $patrol->date }} by {{ $patrol->user->first_name }}
					        </h4>
					      </div>
					      <div class="modal-body">
					      	<ul>
					      	@foreach($tallies as $tally)
					      		<li>{{ $tally->field->name }} {{ $tally->tally }}</li>
					      	@endforeach
					      	</ul>
					        Comments here
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
				@endforeach
			</table>

		@endif

	</div>
@stop