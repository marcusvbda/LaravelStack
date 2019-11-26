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
                        <i class="el-icon-s-grid mr-2"></i> Resources 
                        <i class="ml-auto menu-arrow">
                            <span class="el-icon-arrow-down"></i>
                        </i>
                    </span>
                </a>
                <ul class="nav flex-column sub-menu">
                    @foreach($resources as $resource)
                        @if($resource->canView())
                            <li class="nav-item @if(Menu::ResourceIsActive($resource->id)) active @endif">
                                <a class="nav-link my-0" href="{{$resource->route()}}">{!! $resource->icon() !!} {{$resource->singularLabel()}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>
</nav>