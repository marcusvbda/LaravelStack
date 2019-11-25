<?php
    $data=[
        "perpage"   => @$_GET["per_page"] ? $_GET["per_page"] : 10,
        "hasFilter" => ResourcesHelpers::hasFilter(request()->query(),$resource->filters),
        "route"     => $resource->route,
        "query"     => request()->query(),
        "filters"   => $resource->filters
    ];
?>
<resource-filter :data="{{json_encode($data)}}"></resource-filter>