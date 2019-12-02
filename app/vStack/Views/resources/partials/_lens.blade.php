<div class="d-flex flex-row mb-2" style="font-size:14px;">
    <?php $current_len = @$_GET["current_len"] ? @$_GET["current_len"] : "all"; ?>
    @if($current_len=="all")   
        <b>Todos</b>
    @else 
        <a href="{{$resource->route()}}">Todos</a>
    @endif
    @foreach($resource->lens() as $len_key=>$len_value)
        <div class="mx-2" style="opacity:.5;">|</div>
        @if($current_len==$len_key)  
        <b>{!! $len_key !!}</b>
        @else
            <a href="{{$resource->route().'?'.$len_value['field'].'='.$len_value['value'].'&current_len='.$len_key}}">{!! $len_key !!}</a>
        @endif
    @endforeach
</div>