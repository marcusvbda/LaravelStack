<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item @if(Menu::isActive('admin.home')) active @endif">
            <a class="nav-link" href="{{route('admin.home')}}">
                <span class="menu-title"><i class="el-icon-s-home mr-2"></i> Dashboard</span>
            </a>
        </li>
        <?php $resource_groups = ResourcesHelpers::all(); ?>
        @foreach($resource_groups as $group=>$resources)
            <li class="nav-item">
                <?php $_aux = uniqid(); ?>
                <a class="nav-link" data-toggle="collapse" href="#ui-advanced_{{$_aux}}" aria-expanded="false" aria-controls="ui-advanced_{{$_aux}}">
                    <span class="menu-title d-flex align-items-center">
                        {!! $group !!}
                        <i class="ml-auto menu-arrow">
                            <span class="icon @if(strpos(Route::current()->getName(),"resource")===0) el-icon-arrow-up @else el-icon-arrow-down  @endif "></i>
                        </i>
                    </span>
                </a>
                <div class="collapse" id="ui-advanced_{{$_aux}}" >
                    <ul class="nav flex-column sub-menu">
                        @foreach($resources as $resource)
                            @if($resource->canViewList())
                                <li class="nav-item @if(Menu::ResourceIsActive($resource->id)) active @endif">
                                    <a class="nav-link my-0" href="{{$resource->route()}}">
                                        <div class="d-flex flex-row flex-wrap align-items-center">{!! $resource->icon() !!} {{$resource->label()}}</div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </li>
        @endforeach
    </ul>
</nav>

@section("scripts")
<script>
$('[data-toggle=collapse]').click(function(){
    let icon = $(this).find(".icon")
    if($(icon).hasClass("el-icon-arrow-down")) {
        $(icon).removeClass("el-icon-arrow-down")
        return $(icon).addClass("el-icon-arrow-up")
    }
    $(icon).removeClass("el-icon-arrow-up")
    return $(icon).addClass("el-icon-arrow-down")
})
$(".nav-item.active").parent().parent().toggleClass("show")
</script>
@endsection