@extends("templates.default")
@section('title',"Dashboard")
@section('body')
    @include('templates.navbar')
    <div class="container-fluid page-body-wrapper">
        @include("templates.sidebar")
        <div class="main-panel w-100">
            <div class="content-wrapper pt-3">
                @include("templates.alerts")
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

