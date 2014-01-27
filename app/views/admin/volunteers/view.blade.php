@extends('admin/base')

@section('title')Volunteer Administration @stop

@section('content')
	<div class="span12">
		@if($volunteer)
			<h2>{{ $volunteer->last_name }}, {{ $volunteer->first_name }}@if($volunteer->hasRole('Admin'))
					<span class="label label-primary">Administrator</span>@endif</h2>
			<p>
				Login Name: {{ $volunteer->username }}
			</p>
			<p>
				{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.volunteers.destroy', $volunteer->id) )) }}
				<a class="btn btn-default btn-small" href="{{ URL::route('admin.volunteers.edit', $volunteer->id) }}">
					<i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<button type="submit" class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete
				</button>
				</form>
			</p>
			@if($volunteer->patrols)
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>Patrols</th>
						<th>Location</th>
					</tr>
					</thead>
					<tbody>
					@foreach($patrols as $patrol)
						<tr>
							<td>
								<a href="{{ URL::route('admin.patrols.index') }}">
									Patrol on {{ $patrol->date }}
									@if(!$patrol->is_finished)
										<small class="uncompleted">(incomplete)</small>
									@endif</a>
							</td>
							<td>
								{{ $patrol->location->name }}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@endif

		@else
			Volunteer not found.
		@endif
	</div>
@stop
