@extends("templates.default")
@section('title',"Forget my password")
@section('body')
    <div class="container">
        <div class="d-flex justify-content-center h-100 pt-5">
            <div class="col-md-5 col-sm-12">
                <div>Go back to <a href="{{route('auth.login.index')}}">Login</a></div>
                <div class="card">
                    <div class="card-header">Forget my password</div>
                    <div class="card-body">
                        @include("templates.alerts")
                        <form class="needs-validation" novalidate method="POST" action="{{route('auth.forgot_my_password.reset')}}" onsubmit='$(".overlay-loader").show()'>
                            @csrf
                            <div class="form-group">
                                <input class="form-control @if($errors->has('email')) is-invalid @endif" value="{{old('email')}}" placeholder="E-mail" name="email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit">Reset my password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection