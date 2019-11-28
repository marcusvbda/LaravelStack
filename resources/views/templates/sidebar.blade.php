<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item @if(Menu::isActive('admin.home')) active @endif">
            <a class="nav-link" href="{{route('admin.home')}}">
                <span class="menu-title"><i class="el-icon-s-home mr-2"></i> Dashboard</span>
            </a>
        </li>
        <?php $resources = ResourcesHelpers::all(); ?>
        @if(Count($resources)>0)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                    <span class="menu-title d-flex align-items-center">
                        <i class="el-icon-s-grid mr-2"></i> Recursos
                        <i class="ml-auto menu-arrow">
                            <span class="icon @if(strpos(Route::current()->getName(),"resource")===0) el-icon-arrow-up @else el-icon-arrow-down  @endif "></i>
                        </i>
                    </span>
                </a>
                <div class="collapse @if(strpos(Route::current()->getName(),"resource")===0) show @endif" id="ui-advanced" style="">
                    <ul class="nav flex-column sub-menu">
                        @foreach($resources as $resource)
                            @foreach(array_keys($resource) as $key)
                                @if($resource[$key]->canViewList())
                                    <li class="nav-item @if(Menu::ResourceIsActive($resource[$key]->id)) active @endif">
                                        <a class="nav-link my-0" href="{{$resource[$key]->route()}}">
                                            <div class="d-flex flex-row flex-wrap align-items-center">{!! $resource[$key]->icon() !!} {{$resource[$key]->singularLabel()}}</div>
                                        </a>
                                    </li>
                                <?php break; ?>
                                @endif
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
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
});
</script>
@endsection