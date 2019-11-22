@extends("templates.default")
@section('title',"Login")
@section('body')
<div class="login-page">
    <div class="d-flex h-100">
        <div class="col-md-6 col-sm-12 left-side"></div>
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center right-side">
            <form-login></form-login>
        </div>
    </div>
</div>
@endsection