@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Select a MPA @stop

@section('header')Select a MPA @stop

@section('content')

	@if($mpas)
		<ul data-role="listview">
			@foreach($mpas as $mpa)
				<li><a data-ajax='false' href="{{ URL::route('select-transect', $mpa->id ) }}">{{ $mpa->name }}</a></li>
			@endforeach
		</ul>
	@else
		There are currently no MPAs to choose from.
	@endif
@stop