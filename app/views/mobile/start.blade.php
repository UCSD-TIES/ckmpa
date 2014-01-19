@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Patrol a Section @stop

@section('header'){{ $section->name }} Patrol @stop

@section('content')

<form class="time-entry" action="{{ URL::route('start', $section->id) }}" method="POST" data-ajax="false">
	<div class="container">
		<label for="start-time" class="ui-hidden-accessible">Start Time:</label>
		<input type="time" name="start-time" id="start-time" class="time-input" value="" step="1">
		<a data-role="button" class="fill-time-btn">Start</a>
	</div>
	<input type="submit" id="start-time-submit" value="Continue">
</form>
@stop
