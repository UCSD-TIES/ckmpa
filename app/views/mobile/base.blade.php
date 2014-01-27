<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css"/>
	<link href="{{ URL::asset('css/jquery-bootstrap.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/mobile.css') }}" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
	<script src="{{ URL::asset('js/main.js') }}"></script>
</head>

<body>
<div data-role="page" {{ $url or '' }}>
	<div data-role="header" data-theme="b">
		<h1>MPA Watch</h1>
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

	<div data-role="footer" data-position="fixed" data-theme="b">
		@section('footer')
			@if(Auth::check())
				<div data-role="navbar">
					<ul>
						<li><a class="ui-btn ui-btn-b" href="{{ URL::to('users/logout') }}">Logout</a></li>
					</ul>
				</div>
			@endif 
		@show
	</div>
</div>
</body>

</html>
