<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script>
			window.laravel = {
				csrf_token : '{{ csrf_token() }}',
				root_url : '{{ url('') }}',
				pusher_key : '{{config("broadcasting.connections.pusher.key")}}',
				pusher_cluster : '{{config("broadcasting.connections.pusher.options.cluster")}}',
				@if(Auth::check())
					<?php $user =  Auth::user(); ?>
					user : {
						id : {{$user->id}},
						code : '{{$user->code}}',
					},
				@else
				user : false
				@endif
			}
		</script>
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