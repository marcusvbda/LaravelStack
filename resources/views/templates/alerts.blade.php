@if(session('quick.alerts'))
	@foreach(session('quick.alerts') as $alert)
		<div class="alert alert-{{ $alert->type }} alert-dismissible fade show" role="alert">
			@if($alert->closeable)
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			@endif
			<div class="d-flex align-items-center flex-row">
				<span class="el-icon-{{$alert->type}} mr-2"></span>
				{!! $alert->message !!}
			</div>
		</div>
	@endforeach
	<?php Session(["quick"=>null]); ?>
@endif

<template v-if="$root.alerts">
	<div v-for="alert in $root.alerts" :class="`alert alert-${alert.data._type} alert-dismissible fade show`"  role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<div class="d-flex align-items-center flex-row">
			<span class="el-icon-warning mr-2" v-if="alert.data._type=='warning'"></span>
			<span class="el-icon-success mr-2" v-if="alert.data._type=='success'"></span>
			<span class="el-icon-danger mr-2" v-if="alert.data._type=='error'"></span>
			<span class="el-icon-info mr-2" v-if="alert.data._type=='info'"></span>
			<span v-html="alert.data.message"></span>
		</div>
	</div>
</template>