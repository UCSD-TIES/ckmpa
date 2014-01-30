@extends('admin/base')

@section('title')Create New Transect @stop

@section('content')
	<div span="12">
		<h1>Add a New Transect</h1>

		<form class="form-horizontal" action="{{ URL::route('admin.transects.store') }}" method="POST">
			<input type="hidden" name='mpa_id' value="{{ $mpa->id }}">

			<div class="control-group">
				<label for="transect_name" class="control-label">Name</label>

				<div class="controls">
					<input type="text" name="name" id="transect_name" value="{{ Input::old( 'transect_name' ) }}">
					@if($errors->has('transect_name'))
						<span class="help-inline">{{ $errors->first('transect_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create Transect</button>
				<a class="btn btn-default" href="{{ URL::route('admin.mpas.show', $mpa->id) }}">Cancel</a>
			</div>
		</form>
	</div>
@stop

