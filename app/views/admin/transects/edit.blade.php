@extends('admin/base')

@section('title')Edit Transect @stop

@section('content')
	<div span="12">
		<h1>Edit</h1>

		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Editing Transect <b>{{ $transect->name }}</b> of MPA <b>{{ $mpa->name }}</b>
		</div>
		{{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.transects.update', $mpa->id) )) }}
		<input type="hidden" name="transect_id" value="{{ $transect->id }}">

		<div class="control-group">
			<label for="transect_name" class="control-label">New name:</label>

			<div class="controls">
				<input type="text" name="name" id="transect_name" value="{{ $transect->name }}">
				@if($errors->has('transect_name'))
					<span class="help-inline">{{ $errors->first('transect_name') }}</span>
				@endif
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn btn-default" href="{{ URL::route('admin.mpas.show', $mpa->id) }}" class="btn">Cancel</a>
		</div>
		</form>
	</div>
@stop

