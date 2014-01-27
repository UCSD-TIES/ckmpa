@extends('admin/base')

@section('title')Select a location @stop

@section('content')
	<div class="span12">
		<h1>Select a location</h1>
		@if($locations)
			<table class="table table-hover">
				<tr>
					<th>Location</th>
					<th>Datasheet</th>
					<th>Actions</th>
				</tr>
				@foreach($locations as $location)
					<tr>
						<td><a href="{{ URL::route('admin.locations.show', $location->id) }}"> {{ $location->name }}</a></td>
						<td>{{ $location->datasheet->name }}</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.locations.destroy', $location->id) )) }}
							<a class='btn btn-small btn-default'
							   href="{{ URL::route('admin.locations.show', $location->id) }}"><i
										class="glyphicon glyphicon-eye-open"></i> View</a>
							<a class='btn btn-small btn-default' href="{{ URL::route('export-data', array('id'=> $location->id)) }}"><i
										class="glyphicon glyphicon-download"></i> Export</a>
							<a class='btn btn-small btn-default'
							   href="{{ URL::route('admin.locations.edit', $location->id) }}"><i
										class="glyphicon glyphicon-edit"></i> Edit</a>
							<button type='submit' class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
			</table>
		@endif

		<table>
			<tr>
				<td>
					<a href="{{ URL::route('admin.locations.create') }}" class="btn btn-default"><i
								class="glyphicon glyphicon-plus"></i> Create new location</a>
					<a href="{{ URL::route('admin.sections.index') }}" class="btn btn-default"><i
								class="glyphicon glyphicon-eye-open"></i> View all sections</a>
				</td>
			</tr>
		</table>


	</div>
@stop
