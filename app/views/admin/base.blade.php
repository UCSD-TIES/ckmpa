<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ URL::asset('css/admin.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/datepicker3.css') }}" rel="stylesheet">

	<title>@yield('title', 'Volunteer Administration')</title>
</head>

<body>
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="{{ URL::route('index') }}" class="navbar-brand">Coastkeeper</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			@if(Auth::user())
			<ul class="nav navbar-nav">
				<li @if($view == 'volunteers')class='active'@endif><a href="{{ URL::route('admin.volunteers.index') }}">Volunteers</a></li>
				<li @if($view == 'mpas')class='active'@endif><a href="{{ URL::route('admin.mpas.index') }}">MPAs</a></li>
				<li @if($view == 'patrols')class='active'@endif><a href="{{ URL::route('admin.patrols.index') }}">Patrols</a></li>
				<li @if($view == 'graphs')class='active'@endif><a href="{{ URL::route('graphs') }}">Graphs</a></li>
				<li @if($view == 'datasheets')class='active'@endif><a href="{{ URL::route('admin.datasheets.index') }}">Datasheets</a></li>
			</ul>
			<ul class='nav navbar-nav navbar-right'>
				<li><a href="{{ URL::route('logout') }}">Logout</a></li>
			</ul>
			@endif
		</div>
	</div>
</div>
<div class="container">
	@include('layouts.notifications')

	@yield('content')
</div>
@section('scripts')
	<script src="//code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
@show
</body>
</html>