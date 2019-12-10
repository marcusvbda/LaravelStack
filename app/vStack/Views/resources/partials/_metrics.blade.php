@if($resource->canCustomizeMetrics())
<div class="row">
    <div class="col-12 d-flex justify-content-end">
        <a href="{{$resource->route().'/custom-cards'}}" class="float-right mb-1">{!! $resource->customMetricsButtonText() !!}</a>
    </div>
</div>
@endif
<?php $metrics = $resource->metrics(); ?>
@if($metrics)
    <div class="row d-flex flex-row flex-wrap">
        @foreach($metrics as $metric)
            <resource-metric :time="{{$metric->updateTime()}}" :ranges="{{json_encode($metric->ranges())}}" 
                calculate_route="{{$resource->route()."/metric-calculate/".$metric->uriKey()}}" 
                :view="{{json_encode($metric->view)}}">
            </resource-metric>
        @endforeach
        @foreach(\App\vStack\Models\CustomResourceCard::where("resource_id",$resource->id)->get() as $metric)
            <custom-resource-metric :metric="{{json_encode($metric)}}"></custom-resource-metric>
        @endforeach
    </div>
@endif