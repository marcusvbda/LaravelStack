<?php $metrics = $resource->metrics(); ?>
@if($metrics)
    <div class="row d-flex flex-row flex-wrap mb-5">
        @foreach($metrics as $metric)
            <resource-metric :view="{{json_encode($metric->view)}}"></resource-metric>
        @endforeach
    </div>
@endif