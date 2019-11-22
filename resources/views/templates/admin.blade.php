@extends("templates.default")
@section('title',"Dashboard")
@section('body')
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b>{{Auth::user()->email}}</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route('auth.login.index')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
        @include("templates.sidebar")
        <div class="main-panel w-100">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                        <span class="mr-2">Copyright © {{date("Y")}}</span>  Todos os direitos reservados.
                    </span>
                </div>
            </footer>
        </div>
    </div>
@endsection