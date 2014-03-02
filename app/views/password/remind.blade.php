@extends('admin/base')
@section('content')
<div class="page-header">
	<h1>Can't Login In?</h1>
</div>
<div class="row">
	<div class="col-sm-6">
		{{ Form::open(array('action'=> 'RemindersController@postForgetUsername', 'class'=> 'form-horizontal')) }}
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>

			<div class="col-sm-10">
				<input type="email" name="email" class="form-control" placeholder="Email">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">Email My Username To Me</button>
			</div>
		</div>
		</fieldset>
		{{ Form::close() }}
	</div>
	<div class="col-sm-6">
		{{ Form::open(array('action'=> 'RemindersController@postRemind', 'class'=> 'form-horizontal')) }}
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>

			<div class="col-sm-10">
				<input type="email" name="email" class="form-control" placeholder="Email">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">Email Me a Password Reset Form</button>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop