@extends('admin/base')

@section('title')Volunteers @stop

@section('content')
	<div class="span12">
		<h1>Volunteers</h1>
		<a class="btn btn-primary" href="{{ URL::route('admin.volunteers.create') }}">
          <i class="glyphicon glyphicon-plus"></i>
          Create new Volunteer</a>
		<br>
		<br>

		<ul class="nav nav-tabs">
			<li class="active"><a href="#main" data-toggle="tab">Volunteers</a></li>
			<li><a href="#unconfirmed" data-toggle="tab">Unconfirmed Volunteers</a></li>
		</ul>
		<br>
		@if($volunteers)
		<div class="tab-content">
			<div class="tab-pane active" id="main">
			<table class="table table-hover" id="VolunteerTable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Role</th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                      <td><strong>Administrators</strong> are in bold.</td>
					</tr>
				</tfoot>
				<tbody>
				@foreach($volunteers as $volunteer)
					<tr>
						<td>
							<a href="{{ URL::route('admin.volunteers.show', $volunteer->id) }}">
                              @if($volunteer->hasRole("Admin"))
                                <strong>{{ $volunteer->last_name }}, {{ $volunteer->first_name }}</strong>
                              @else
                                {{ $volunteer->last_name }}, {{ $volunteer->first_name }}
                              @endif
							</a>
						</td>
						<td>
                          {{ $volunteer->roles->first()->name or "No Role"}}
                        </td>
						<td>
						  <a class="btn btn-default btn-small"
                             href="{{ URL::route('admin.volunteers.edit', $volunteer->id) }}">
                              <i class="glyphicon glyphicon-edit"></i> Edit
                          </a>
                          <button user-id="{{$volunteer->id}}" class="btn btn-small btn-danger delete-btn">
                            <i class="glyphicon glyphicon-trash"></i> Delete
                          </button>

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
                          <button user-id="{{$volunteer->id}}" class="btn btn-success btn-small confirm-btn">
                            <i class="glyphicon glyphicon-ok"></i> Confirm
                          </button>
                          <button user-id="{{$volunteer->id}}" class="btn btn-small btn-danger delete-btn">
                            <i class="glyphicon glyphicon-trash"></i> Delete
                          </button>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		@else
			There are no volunteers available. <a href="{{ URL::route('admin.volunteers.create') }}">Create a new one?</a>
		@endif
	</div>
  @section('scripts')
  @parent

  <script>
  $('.confirm-btn').click(function(){
    var data = {
      id: $(this).attr('user-id')
    };
    $.ajax({
      url: '/admin/confirm-user',
      async: false,
      type: 'POST',
      data: data
    }).done(function(){
      location.reload();
    });
  });
  $('.delete-btn').click(function(){
    var id = $(this).attr('user-id')

    $.ajax({
      url: '/admin/volunteers/'+id,
      async: false,
      type: 'DELETE'
    }).done(function(){
      location.reload();
    });
  });
  </script>
  @stop
@stop
