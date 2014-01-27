@extends('admin/base')

@section('title')Manage Roles and Permissions @stop

@section('content')
	<h2>Manage Roles and Permissions</h2>
	{{ Form::open(array('method'=> 'POST', 'route'=> array('permissions') )) }}
	<table class="table table-bordered">
		<tr>
			<th>Roles</th>
			<th>Permissions</th>
		</tr>
		@foreach($roles as $role)
			<tr>
				<td>{{ $role->name }}</td>
				<td>
					@foreach($permissions as $permission)
						<div class="checkbox">
							<label>
								<input type="checkbox" value="{{ $permission->id }}" name="{{ $role->name }}-{{ $permission->name }}"
								       @if($permission->roles->contains($role->id))checked @endif>
								{{ $permission->display_name }}
							</label>
						</div>
					@endforeach
				</td>
			</tr>
		@endforeach
	</table>
	<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@stop
