<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	@section('head')
	<title>@yield("title")</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script src="{{ URL::asset('js/main.js') }}"></script>
	@show
</head>

<body>
<div data-role="page">
	<header data-role="header" class="theme-ck">
		<h1>
			MPA Watch
		</h1>
	</header>
	<div data-role="content" class="wrapper content">
		<h1 class="center-text">
	        @yield("header")
		</h1>
		@if(Session::has('message'))
		<div class="alert">{{ Session::get('message') }}</div>
		@endif
		@if( $errors )
		@foreach($errors as $error)
		{{ $error }}<br>
		@endforeach
		@endif
		@yield("content")

	</div>
	<div class="push"></div>
	<footer data-role="footer" class="footer theme-ck">
		@section('footer')
		<p>
			@if(Auth::check())
			<a href="{{ URL::to('users/logout') }}" data-role="button" data-ajax="false">Logout</a>
			@endif
		</p>
		@show
	</footer>
</div>
</body>
</html>
