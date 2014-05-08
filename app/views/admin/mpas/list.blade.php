@extends('admin/base')

@section('title')Select a MPA @stop

@section('content')
		<h1>Select a MPA</h1>
<table>
  <tr>
    <td>
      <a href="{{ URL::route('admin.mpas.create') }}" class="btn btn-primary">
        <i class="glyphicon glyphicon-plus"></i> Create new MPA</a>
      <a href="{{ URL::route('admin.transects.index') }}" class="btn btn-primary">
        <i class="glyphicon glyphicon-eye-open"></i> View All Transects</a>
    </td>
  </tr>
</table>
<br>
		@if($mpas)
			<table class="table table-hover"  id = "MPATable" >
			<thead>
				<tr>
					<th>MPA</th>
					<th>Datasheet</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($mpas as $mpa)
					<tr>
						<td><a href="{{ URL::route('admin.mpas.show', $mpa->id) }}"> {{ $mpa->name }}</a></td>
						<td>{{ $mpa->datasheet->name }}</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.mpas.destroy', $mpa->id) )) }}
							<a class='btn btn-small btn-default'
							   href="{{ URL::route('admin.mpas.edit', $mpa->id) }}"><i
										class="glyphicon glyphicon-edit"></i> Edit</a>
                            <a class='btn btn-small btn-default' href="{{ URL::route('export-data', array('id'=> $mpa->id)) }}">
                              <i class="glyphicon glyphicon-download"></i>
                              Export
                            </a>
							<button type='submit' class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
			</tbody>
			</table>
		@endif
@stop
