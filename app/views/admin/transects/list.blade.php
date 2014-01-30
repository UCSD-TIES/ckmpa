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
					<a class='btn btn-danger' href="{{ URL::route('admin.transects.destroy', $transect->id) }}"><i
						class="glyphicon glyphicon-trash"></i> Delete</a>
					</td>
				</tr>
			@endforeach
		</table>

	</div>
@stop
