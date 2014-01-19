@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Select a Location @stop

@section('header')Select a Location @stop

@section('content')

@if($locations)
<form action="{{ URL::to('mobile/select-location') }}" method="POST" id="primary-location-form" data-ajax="false">
	<label for="primary-location" class="ui-hidden-accessible">Location:</label>
	<select name="primary-location" id="primary-location" style="font-size:30px">
		<option value="" selected>Choose A Location</option>
		@foreach( $locations as $location )
		<option value="{{ $location->id }}">{{ $location->name }}</option>
		@endforeach
	</select>
	<input type="submit" value="Continue" class="submit">
</form>
@else
There are currently no locations to choose from.
@endif
@stop