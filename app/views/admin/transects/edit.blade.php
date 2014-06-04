@extends('admin/base') @section('title')Edit Transect @stop @section('content')
<h1>Edit</h1>

<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Editing Transect <b>{{ $transect->name }}</b> of MPA <b>{{ $mpa->name }}</b>
</div>
{{ Form::open(array('method'=> 'PATCH', 'route'=> array('admin.transects.update', $mpa->id), 'files'=>true  )) }}
<input type="hidden" name="transect_id" value="{{ $transect->id }}">

<div class="form-group">
  <label for="transect_name" class="control-label">New name:</label>

  <input type="text" class='form-control' name="name" id="transect_name" value="{{ $transect->name }}">@if($errors->has('transect_name'))
  <span class="help-inline">{{ $errors->first('transect_name') }}</span>
  @endif
</div>

<div class="form-group">
  <label for="patrolPDF">Patrol Instructions PDF</label>
  <input type="file" id="patrolPDF" name='patrolPDF'>
</div>

<button type="submit" class="btn btn-primary">Save</button>
<a class="btn btn-default" href="{{ URL::route('admin.mpas.show', $mpa->id) }}" class="btn">Cancel</a>
{{ Form::close() }}
@stop

