@extends('admin/base')

@section('title')Volunteers @stop

@section('content')
	<div class="span12">
		<h1>Volunteers</h1>
		<a class="btn btn-primary" href="{{ URL::route('admin.volunteers.create') }}">Create new Volunteer</a>
		<a class="btn btn-primary" href="{{ URL::route('permissions') }}">Manage Permissions</a>
		<br>
<!--		Search for First or Last name only-->
<!--		<form name="search" action="{{URL::action('VolunteersController@search') }}" method="GET">-->
<!--			<input type="text" name="search_string">-->
<!--			<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i></button>-->
<!--		</form>-->
		<br>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#main" data-toggle="tab">Volunteers</a></li>
			<li><a href="#unconfirmed" data-toggle="tab">Unconfirmed Volunteers</a></li>
		</ul>
		<br>
		@if($volunteers)
		<div class="tab-content">
			<div class="tab-pane active" id="main">
			<table class="table table-bordered" id = "VolunteerTable">
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
						<td>
                          {{ $volunteer->roles->first()->name or "No Role"}}
                        </td>
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
			</div>
			<div class="tab-pane" id="unconfirmed">
				<table class="table table-bordered" id = "UnconfirmedTable">
					<thead>
					<tr>
						<th>Name</th>
						<th></th>
						<th></th>
					</tr>
					</thead>

					<tbody>
					@foreach($unconfirmed as $volunteer)
					<tr>
						<td>
							<a href="{{ URL::route('admin.volunteers.show', $volunteer->id) }}">
							{{ $volunteer->last_name }}, {{ $volunteer->first_name }}
							</a>
						</td>

						<td>

							<form method="POST" action="/admin/confirm-user" class="form-inline">
								<input type="hidden" name="id" value="{{$volunteer->id}}">
								<input type="hidden" name="confirmed" value="1">
								<button type="submit" class="btn btn-success btn-small">
									<i class="glyphicon glyphicon-ok"></i> Confirm
								</button>
							</form>
						</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.volunteers.destroy', $volunteer->id) )) }}
							<input type="hidden" name="id" value="{{$volunteer->id}}">
								<button type='submit' class="btn btn-small btn-danger">
									<i class="glyphicon glyphicon-trash"></i>Delete</button>
							{{ Form::close() }}

						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		@else
			There are no volunteers available. <a href="{{ URL::route('admin.volunteers.create') }}">Create a new one?</a>
		@endif
	</div>
@stop