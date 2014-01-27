@extends('admin/base')

@section('title')View Location's Sections @stop

@section('content')
	<div class="span12">
		<h1>{{ $location->name }}</h1>

		<table class="table table-hover">
			@foreach($sections as $section)
				<tr>
					<td>{{ $section->name }}</td>
					<td>
						{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.sections.destroy', $location->id) )) }}
						<a class="btn btn-default btn-small"
						   href="{{ URL::route('export-data', array('lid'=> $location->id, 'sid'=> $section->id)) }}"><i
									class="glyphicon glyphicon-download"></i> Export</a>
						<a class="btn btn-default btn-small"
						   href="{{ URL::route('admin.sections.edit', $section->id) }}"><i
									class="glyphicon glyphicon-edit"></i> Edit</a>
						<input type="hidden" name="section_id" value="{{ $section->id }}">
						<button type='submit' class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i>
							Delete
						</button>
						{{ Form::close() }}
					</td>
				</tr>
			@endforeach
		</table>

		<table>
			<tr>
				<td>
					<a href="{{ URL::route('admin.sections.create', array('id'=> $location->id)) }}" class="btn btn-default"><i
								class="glyphicon glyphicon-plus"></i> Add new section</a>
					<a href="{{ URL::route('patrols-entries-locations-list', array('location_id'=> $location->id)) }}"
					   class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View Patrols </a>
					<a href="{{ URL::route('export-data', array('id'=> $location->id)) }}" class="btn btn-default"><i
								class="glyphicon glyphicon-download"></i> Export Data</a>
				</td>
			</tr>
		</table>

	</div>
@stop
