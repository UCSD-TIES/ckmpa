@extends('admin/base')

@section('title')Select a category @stop

@section('content')

		<h1>Categories for {{ $datasheet->name }}</h1>
      <div>
        <a class='btn btn-primary' href="{{ URL::route('admin.categories.create', array('datasheet_id'=> $datasheet->id)) }} "
           class="btn">
          <i class="glyphicon glyphicon-plus"></i>
          Create New Category</a>
      </div>
      <br>
		@if($categories)
			<table class="table table-hover">
				@foreach($categories as $category)
					<tr>
						<td>
							<a href="{{ URL::route( 'admin.categories.show', $category->id) }}">
								{{ $category->name }}
							</a>
						</td>
						<td>
							{{ Form::open(array('method'=> 'DELETE', 'class'=> 'form-inline', 'route'=> array('admin.categories.destroy', $category->id) )) }}
							<a class="btn btn-small btn-default"
							   href="{{ URL::route('admin.categories.edit', $category->id) }}"><i
										class="glyphicon glyphicon-edit"></i> Edit</a>
							<input type="hidden" name="datasheet_id" value="{{ $datasheet->id }}">
							<button type="submit" class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i>
								Delete
							</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>
		@endif
@stop
