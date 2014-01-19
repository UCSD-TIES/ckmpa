@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Patrol @stop

@section('header')Data Collection @stop

@section('content')
<form id="data-entry-form" name="data-entry-form" action="{{ URL::route('data-collection') }}" method="POST" data-ajax="false">
	@foreach($datasheet->categories as $category)
	<div data-role="collapsible" data-content-theme="c">
		<h3>{{ $category->name }}</h3>
		@foreach($category->entries as $entry)
		<div class="entry-container">
			<label for="entry-{{ $entry->id }}">
				{{ $entry->name }}
			</label>
			<div data-role="controlgroup" data-type="horizontal" class="btn-container">
				<a data-role="button" data-icon="minus" data-inline="true" data-iconpos="notext" data-theme="c" data-ajax="false">-1</a>
				<a data-role="button" data-icon="plus" data-inline="true" data-iconpos="notext" data-theme="c" data-ajax="false">+1</a>
				<input type="number" name="entry-{{ $entry->id }}" id="{{ $entry->id }}" value="0" class="number-box" data-inline="true">
			</div>
		</div>
		@endforeach
	</div>
	@endforeach
	<input type="submit" class="submit" value="Go on to Next Page">
</form>
@stop
