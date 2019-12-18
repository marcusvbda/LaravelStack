@extends("templates.default")
@section('title',"Dashboard")
@section('body')
    <div class="container-fluid page-body-wrapper">
        @include("templates.sidebar")
        <div class="main-panel w-100" >
            @include('templates.navbar')
            <div class="content-wrapper">
                @include("templates.alerts")
                @yield('content')
            </div>
        </div>
    </div>
@endsection

@section("scripts")
<script type="text/javascript">
    if (window.location.hash === "#_=_"){
    if (history.replaceState) {
        var cleanHref = window.location.href.split("#")[0];
        history.replaceState(null, null, cleanHref);
    } else {
        window.location.hash = "";
    }
}
</script>
@endsection

