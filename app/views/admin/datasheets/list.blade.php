@extends('admin/base')

@section('title')Select a datasheet @stop

@section('content')
	<div class="span12">
		<h1>Datasheets</h1>
		@if($datasheets)
			<table class="table table-hover">
				<tr>
					<th>Name</th>
					<th>Actions</th>
				</tr>
				@foreach($datasheets as $datasheet)
					<tr>
						<td>
							<a href="{{ URL::route( 'admin.datasheets.show', $datasheet->id) }}">
								{{ $datasheet->name }}
							</a>
						</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> ['admin.datasheets.destroy', $datasheet->id] )) }}
							<a class="btn btn-dmall btn-default"
							   href="{{ URL::route('admin.datasheets.edit', array('datasheet_id'=>$datasheet->id)) }}"><i
										class="glyphicon glyphicon-edit"></i> Edit</a>
							<button type="submit" class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>
		@endif
		<div>
			<a class='btn btn-default' href="{{ URL::route('admin.datasheets.create') }} " class="btn"><i
						class="glyphicon glyphicon-plus"></i> Create new datasheet</a>
		</div>
	</div>
@stop
