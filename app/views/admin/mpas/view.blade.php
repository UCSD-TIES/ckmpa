@extends('admin/base')

@section('title')Transects in {{ $mpa->name }} @stop

@section('content')
		<h1>Transects in {{ $mpa->name }}</h1>
<table>
  <tr>
    <td>
      <a href="{{ URL::route('admin.transects.create', array('id'=> $mpa->id)) }}" class="btn btn-primary">
        <i class="glyphicon glyphicon-plus"></i> Add new Transect</a>
      <a href="{{ URL::route('patrol-list', array('mpa'=> $mpa->id)) }}"
         class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> View Patrols </a>
      <a href="{{ URL::route('export-data', array('id'=> $mpa->id)) }}" class="btn btn-primary">
        <i class="glyphicon glyphicon-download"></i> Export Data</a>
    </td>
  </tr>
</table>
<br>
		<table class="table table-hover">
            <tr>
              <th>Name</th>
              <th></th>
            </tr>
			@foreach($transects as $transect)
				<tr>
                  <td>
                    <a href="{{ URL::route('patrol-list',
                             ['transect'=>$transect->id, 'mpa' => $mpa->id]) }}">
                      {{ $transect->name }}
                    </a>
                  </td>
					<td>
						{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.transects.destroy', $mpa->id) )) }}
						<a class="btn btn-default btn-small"
						   href="{{ URL::route('export-data', array('lid'=> $mpa->id, 'sid'=> $transect->id)) }}"><i
									class="glyphicon glyphicon-download"></i> Export</a>
						<a class="btn btn-default btn-small"
						   href="{{ URL::route('admin.transects.edit', $transect->id) }}"><i
									class="glyphicon glyphicon-edit"></i> Edit</a>
						<input type="hidden" name="transect_id" value="{{ $transect->id }}">
						<button type='submit' class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i>
							Delete
						</button>
						{{ Form::close() }}
					</td>
				</tr>
			@endforeach
		</table>

@stop
