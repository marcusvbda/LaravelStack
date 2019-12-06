<?php $metrics = $resource->metrics(); ?>
@if($metrics)
    <div class="row d-flex flex-row flex-wrap mb-5">
        @foreach($metrics as $metric)
            <resource-metric :time="{{$metric->updateTime()}}" :ranges="{{json_encode($metric->ranges())}}" 
                calculate_route="{{$resource->route()."/metric-calculate/".$metric->uriKey()}}" 
                :view="{{json_encode($metric->view)}}">
            </resource-metric>
        @endforeach
    </div>
@endif