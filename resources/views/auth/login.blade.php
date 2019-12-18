@extends("templates.default")
@section('title',"Login")
@section('body')
<div class="login-page">
    <div class="row h-100">
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center left-side">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end d-none d-lg-block">Copyright © {{date("Y")}}  Todos os direitos reservados.</p>
        </div>
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center right-side">
            <div class="row d-flex justify-content-center w-100">   
                <?php
                    $login_social = [
                        "facebook" => config("services.facebook"),
                        "google"   => config("services.google"),
                    ];
                ?>
                <form-login :sociallogin="{{json_encode($login_social)}}">
                    <template slot="alerts">@include("templates.alerts")</template>
                </form-login>
            </div>
        </div>
    </div>
</div>
@endsection