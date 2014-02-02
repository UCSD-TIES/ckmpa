<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css"/>
	<?= stylesheet_link_tag('mobile/application') ?>
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
	<?= javascript_include_tag('mobile/application') ?>
</head>

<body>
<div data-role="page" {{ $url or '' }}>
	<div data-role="header" data-theme="b" data-position="fixed" style="margin-left: -1px">
		<h1>MPA Watch</h1>
		@section('logoutBtn')
		@if(Confide::user())
			<a href="#popupDialog" data-rel="popup" data-position-to="window"
			class="ui-btn-right ui-btn-inline">Logout</a>
		@endif
		@show
	</div>
	<div data-role="content">
		<h1 class="center-text">
			@yield('header')
		</h1>
		@if(Session::has('message'))
			<div class="center-text">{{ Session::get('message') }}</div>
		@endif
		@if($errors)
			@foreach($errors as $error)
				{{ $error }}<br>
			@endforeach
		@endif
		@yield('content')
	</div>

	<div data-role="popup" id="popupDialog" data-dismissible="false" style="max-width:400px;">
	    <div data-role="header" data-theme="b">
	    <h1>Are You sure?</h1>
	    </div>
	    <div role="main" class="ui-content">
	        <h3 class="ui-title">Are you sure you want to log out?</h3>
	        <a href="{{ URL::to('users/logout') }}" class="ui-btn ui-btn-inline ui-btn-c">Yes</a>
	        <a href="#" class="ui-btn ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
	    </div>
	</div>

</div>
</body>

</html>
