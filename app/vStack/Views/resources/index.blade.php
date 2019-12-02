@extends("templates.admin")
@section('title',$resource->label())
@section('content')
@include("templates.alerts")
<div class="row">
    <div class="col-12">
        @include("templates.alerts")
        <nav aria-label="breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}" class="link">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$resource->label()}}</li>
                </ol>
            </nav>
        </nav>

        <div class="d-flex flex-row align-items-center mb-2">
            <h4 class="mb-1">{!! @$resource->indexLabel() !!}</h4>
            <div class="d-flex flex-row">
                @if($resource->canCreate())
                    <a class="btn btn-outline-primary btn-sm-block btn-sm cursor-pointer ml-3" href="{{route('resource.create',['resource'=>$resource->id])}}">
                        {!! $resource->storeButtonLabel() !!}
                    </a>
                @endif
                @if($resource->canCreate())
                    <a class="btn btn-outline-primary btn-sm-block btn-sm cursor-pointer ml-2" href="{{route('resource.create',['resource'=>$resource->id])}}">
                        {!! $resource->importButtonlabel() !!}
                    </a>
                @endif
                @if($resource->model->count()>0)
                    <a class="btn btn-outline-primary btn-sm-block btn-sm cursor-pointer ml-2" href="{{route('resource.create',['resource'=>$resource->id])}}">
                        {!! $resource->exportButtonlabel() !!}
                    </a>
                @endif
            </div>
            <div class="col-md-3 col-sm-12 pl-0 ml-auto">
                <?php 
                    $globalFilterData = [
                        "filter_route" => request()->url(),
                        "query" => request()->query(),
                        "value" => @$_GET["_"] ? $_GET["_"] : ""
                    ];
                ?>
                @if($resource->model->count()>0)
                    @if($resource->search())
                        <resource-filter-global :data="{{json_encode($globalFilterData)}}"></resource-filter-global>
                    @endif
                @endif
            </div>
        </div>
        @if($resource->model->count()>0)
            <div class="filter d-flex flex-row justify-content-between">
                @include("vStack::resources.partials._filter")
            </div>

            <div class="row">
                <div class="col-12">
                    @if($resource->lens())
                        @include("vStack::resources.partials._lens")
                    @endif
                    @if($data->total()>0)
                        @include("vStack::resources.partials._table")
                    @else 
                        <h4 class="text-center my-4">{{ $resource->noResultsFoundText() }}</h4>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($data->total()>0)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mt-3">{!! $resource->resultsFoundLabel() !!} {{ $data->total() }}</div>
                            <div class="float-right">
                                {{$data->appends(request()->query())->links()}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="d-flex flex-column align-items-center justify-items-center">
                <div class="col-md-6 col-sm-12 text-center">
                    <h4 class="text-center mt-5">
                        <h1 style="opacity: .3;font-size: 250px;">{!!$resource->icon()!!}</h1>
                        <div>{!! $resource->nothingStoredText() !!}</div>
                    </h4>
                    @if($resource->canCreate())
                        <a class="btn btn-primary btn-sm-block cursor-pointer mb-3 mt-2" href="{{route('resource.create',['resource'=>$resource->id])}}">
                            {!! $resource->storeButtonLabel() !!}
                        </a>
                    @endif
                </div>
            </div>
        @endif    
    </div>
</div>
@endsection