<?php $user = Auth::user(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between align-items-center">
    <a class="navbar-brand" href="{{route('admin.home')}}">
        <img src="{{asset('assets/images/logo.svg')}}">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" onclick="$('#sidebar').toggleClass('active')">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center flex-row" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b class="mr-2">{{$user->email}}</b>
                    @if($user->avatar)
                        <img  class="img-profile" src="{{$user->avatar}}" />
                    @else
                        <span class="text img-profile d-flex align-items-center text-center justify-content-center color">
                            {{strtoupper(substr($user->name,0,2))}}
                        </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{route('admin.account.profile')}}"><span class="el-icon-user mr-2 text-primary font-weight-bolder"></span>Minha Conta</a>
                    <a class="dropdown-item" href="{{route('auth.login.index')}}"><span class="el-icon-close mr-2 text-primary font-weight-bolder"></span>Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>