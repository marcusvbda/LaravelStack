@extends("templates.default")
@section('title',"Change your password")
@section('body')
    <div class="container">
        <div class="d-flex justify-content-center h-100 pt-5">
            <div class="col-md-5 col-sm-12">
                <div>Go back to <a href="{{route('auth.login.index')}}">Login</a></div>
                <div class="card">
                    <div class="card-header">Change your password</div>
                    <div class="card-body">
                        @include("templates.alerts")
                        <form class="needs-validation" novalidate method="POST" action="{{route('auth.forget_my_password.set',['token'=>$token])}}" onsubmit='$(".overlay-loader").show()'>
                            @csrf
                            <div class="form-group">
                                <input class="form-control @if($errors->has('password')) is-invalid @endif"  placeholder="Password" name="password" type="password" >
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" placeholder="Confirm Password" name="password_confirmation" type="password" >
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit">Set new password</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection