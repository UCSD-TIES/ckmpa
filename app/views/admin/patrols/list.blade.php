@extends('admin/base')

@section('title')Patrols @stop

@section('content')
	<div class="span12">
		<h2> Patrols in {{ $patrols->first()->location->name }}</h2>
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

						<td><a href="{{ URL::route('patrol-entries-list', array('patrol_id'=>$patrol->id)) }}">{{ $patrol->date }}</td>

						<td>
							@if($patrol->location)
								<a href="{{ URL::route('patrols-entries-locations-list', array('location_id'=>$patrol->location->id)) }}">
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
							<button type="submit" class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>
		@endif

	</div>
@stop