@extends("mobile.base")

@section('title')Patrol Finished @stop

@section('header')Patrol Finished @stop

@section('content')
	<h4 class="center-text"> Want to patrol more sections?</h4>
	<a class="ui-btn" href="{{ URL::route('select-section', $location->id) }}"> Yes</a>
	<a class="ui-btn" href="{{ URL::to('users/logout') }}"> Done</a>

	<a class="ui-btn" href="{{ URL::route('select-location')}}"> Change Location</a>
@stop

@section('footer %} @overwrite
