<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<?= stylesheet_link_tag('admin/application') ?>
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
			@if(Entrust::hasRole('Admin'))
			<ul class="nav navbar-nav">
				<li @if(isset($view) && $view == 'volunteers')class='active'@endif><a href="{{ URL::route('admin.volunteers.index') }}">Volunteers</a></li>
				<li @if(isset($view) && $view == 'mpas')class='active'@endif><a href="{{ URL::route('admin.mpas.index') }}">MPAs</a></li>
				<li @if(isset($view) && $view == 'patrols')class='active'@endif><a href="{{ URL::route('admin.patrols.index') }}">Patrols</a></li>
				<li @if(isset($view) && $view == 'graphs')class='active'@endif><a href="{{ URL::route('graphs') }}">Graphs</a></li>
				<li @if(isset($view) && $view == 'datasheets')class='active'@endif><a href="{{ URL::route('admin.datasheets.index') }}">Datasheets</a></li>
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
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<?= javascript_include_tag('admin/application') ?>
@show
</body>
</html>