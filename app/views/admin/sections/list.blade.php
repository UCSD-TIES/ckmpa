@extends('admin/base')

@section('title')View All Sections @stop

@section('content')
	<div class="span12">
		<h1>Sections</h1>
		<table class="table table-hover">
			<tr>
				<th>Name</th>
				<th>Location</th>
				<th></th>
			<tr>
			@foreach($sections as $section)
			<td>
				{{ $section->name }}
			</td>
			<td>
				{{ $section->location->name }}
			</td>
			<td>
				<a class='btn btn-default' href="{{ URL::route('admin.sections.edit', $section->id) }}"><i
					class="glyphicon glyphicon-edit"></i> Edit</a>
					<a class='btn btn-danger' href="{{ URL::route('admin.sections.destroy', $section->id) }}"><i
						class="glyphicon glyphicon-trash"></i> Delete</a>
					</td>
				</tr>
			@endforeach
		</table>

	</div>
@stop
