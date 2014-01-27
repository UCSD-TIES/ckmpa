@extends('admin/base')

@section('title') Create new datasheet @stop

@section('content')
	<div span="12">
		<h1>Create a New Datasheet</h1>

		<form class="form-horizontal" action="{{ URL::route('admin.datasheets.store') }}" method="POST">
			<div class="control-group @if($errors->has('datasheet_name')) error @endif">
				<label for="datasheet_name" class="control-label">Name</label>

				<div class="controls">
					<input type="text" name="name" id="datasheet_name" value="{{ Input::old('name') }}">
					@if($errors->has('datasheet_name'))
						<span class="help-inline">{{ $errors->first('datasheet_name') }}</span>
					@endif
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create datasheet</button>
				<a href="{{ URL::route('admin.datasheets.index') }}" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
@stop

