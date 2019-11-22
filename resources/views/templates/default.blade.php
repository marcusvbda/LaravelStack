<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="root-url" content="{{ url('') }}">
		<link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
		<title>@yield("title")</title>
	</head>
	<body>
		<div id="app">
			{{-- @include("templates.loader") --}}
			@yield("body")
		</div>
		<script src="{{ mix('/assets/js/manifest.js')}}"></script>
		<script src="{{ mix('/assets/js/vendor.js')}}"></script>
		<script src="{{ mix('/assets/js/app.js') }}"></script>
	</body>
</html>