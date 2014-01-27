@extends('admin/base')

@section('title')Volunteers @stop

@section('content')
	<div class="span12">
		<h1>Volunteers</h1>
		<a class="btn btn-primary" href="{{ URL::route('admin.volunteers.create') }}">Create new Volunteer</a>
		<a class="btn btn-primary" href="{{ URL::route('permissions') }}">Manage Permissions</a>
		<br><br>
		Search for First or Last name only
		<form name="search" action="{{ URL::route('admin.volunteers.index') }}" method="POST">
			<input type="text" name="search_string">
			<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</form>
		<br><br>
		@if($volunteers)
			<table class="table table-bordered">
				<thead>
				<tr>
					<th>Name</th>
					<th>Role</th>
					<th>Controls</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<td colspan="2"><span class="is_admin">Administrators</span> are in bold.</td>
				</tr>
				</tfoot>
				<tbody>
				@foreach($volunteers as $volunteer)
					<tr>
						<td>
							<a @if($volunteer->hasRole("Admin")) class="is_admin" @endif
							   href="{{ URL::route('admin.volunteers.show', $volunteer->id) }}">
								{{ $volunteer->last_name }}, {{ $volunteer->first_name }}
							</a>

						</td>
						<td>{{ $volunteer->roles->first()->name }}</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.volunteers.destroy', $volunteer->id) )) }}
							<a class="btn btn-default btn-small"
							   href="{{ URL::route('admin.volunteers.show', $volunteer->id) }}">
								<i class="glyphicon glyphicon-eye-open"></i> View</a>
							<a class="btn btn-default btn-small"
							   href="{{ URL::route('admin.volunteers.edit', $volunteer->id) }}">
								<i class="glyphicon glyphicon-pencil"></i> Edit</a>
							<button type='submit' class="btn btn-small btn-danger">
								<i class="glyphicon glyphicon-trash"></i>Delete
							</button>
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			There are no volunteers available. <a href="{{ URL::route('admin.volunteers.create') }}">Create a new one?</a>
		@endif
	</div>
@stop