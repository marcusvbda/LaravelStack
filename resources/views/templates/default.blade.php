<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="{{asset('laravelstack/bootstrap/css/bootstrap.min.css')}}">
		<title>@yield("title")</title>
	</head>
	<body>
		@include("templates.loader")
		@yield("body")
		<script src="{{asset('laravelstack/bootstrap/js/jquery-3.3.1.slim.min.js')}}" ></script>
		<script src="{{asset('laravelstack/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{asset('laravelstack/bootstrap/js/bootstrap.min.js')}}"></script>
	</body>
</html>