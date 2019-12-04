@if(session('quick.alerts'))
	@foreach(session('quick.alerts') as $alert)
		<div class="alert alert-{{ $alert->type }} alert-dismissible fade show" role="alert">
			@if($alert->closeable)
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			@endif
			{!! $alert->message !!}
		</div>
	@endforeach
	<?php Session(["quick"=>null]); ?>
@endif