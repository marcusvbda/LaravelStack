@extends("templates.default")
@section('title',"Cadastro de Usuário")
@section('body')
<div class="login-page">
    <div class="row h-100">
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center left-side signup">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end d-none d-lg-block">Copyright © {{date("Y")}}  Todos os direitos reservados.</p>
        </div>
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center right-side pr-0">
            <form-signup>
                    <template slot="alerts">@include("templates.alerts")</template>
            </form-signup>
        </div>
    </div>
</div>
@endsection