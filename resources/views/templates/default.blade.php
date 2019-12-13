<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script> window.laravel = {!! $javascript_globals !!}</script>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{ mix('assets/backend/css/app.css') }}">
		<link rel="icon" type="image/png" href="{{ URL::asset('/assets/images/small_logo.png') }}" />
		<title>{{config("app.name")}} - @yield("title")</title>
	</head>
	<body>
		<div id="vue_app">
			@yield("body")
		</div>
		<script src="{{ mix('/assets/backend/js/manifest.js')}}"></script>
		<script src="{{ mix('/assets/backend/js/vendor.js')}}"></script>
		<script src="{{ mix('/assets/backend/js/app.js') }}"></script>
		@yield("scripts")
	</body>
</html>