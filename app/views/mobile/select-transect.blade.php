@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Select A Transect @stop

@section('header')Select A Transect in<br> {{ $mpa->name }}@stop

@section('content')

	@if($transects)
		<ul data-role="listview">
			@foreach($transects as $transect)
				<li><a href="{{ URL::route('get-data-collection', $transect->id ) }}">{{ $transect->name }}</a></li>
			@endforeach
		</ul>

	@else
		No transects available for selection.
	@endif

@stop