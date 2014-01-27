@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Select a Location @stop

@section('header')Select a Location @stop

@section('content')

	@if($locations)
		<ul data-role="listview">
			@foreach($locations as $location)
				<li><a href="{{ URL::route('select-section', $location->id ) }}">{{ $location->name }}</a></li>
			@endforeach
		</ul>
	@else
		There are currently no locations to choose from.
	@endif
@stop