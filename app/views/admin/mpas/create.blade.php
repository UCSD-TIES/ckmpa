@extends('admin/base')

@section('title')Create New MPA @stop

@section('content')
	<div span="12">
		<h1>Create a New MPA</h1>

		<form class="form-horizontal" action="{{ URL::route('admin.mpas.store') }}" method="POST">
			<div class="control-group">
				<label for="mpa_name" class="control-label">Name</label>

				<div class="controls">
					<input type="text" name="name" id="mpa_name" value="{{ Input::old( 'mpa_name' ) }}">
					@if($errors->has('mpa_name'))
						<span class="help-inline">{{ $errors->first('mpa_name') }}</span>
					@endif
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="datasheet">Datasheet:</label>

				<div class="controls">
					<select name="datasheet_id" id="datasheet">
						<option value="" selected>Select a datasheet</option>
						@foreach($datasheets as $datasheet)
							<option value="{{ $datasheet->id }}">{{ $datasheet->name }}</option>
						@endforeach
					</select>
					@if($errors->has('datasheet'))
						<span class="help-inline">{{ $errors->first('datasheet') }}</span>
					@endif
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create MPA</button>
				<a class="btn btn-default" href="{{ URL::route('admin.mpas.index') }}" class="btn">Cancel</a>
			</div>
		</form>
	</div>
@stop

