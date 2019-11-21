@extends("laravelstack::templates.default")
@section('title',"Login")
@section('body')
    <div class="container">
        <div class="d-flex justify-content-center h-100 pt-5">
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-header">Sign in</div>
                    <div class="card-body">
                        @include("laravelstack::templates.alerts")
                        <form class="needs-validation" novalidate method="POST" action="{{route('laravelstack.signin')}}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control @if($errors->has('email')) is-invalid @endif" value="{{old('email')}}" placeholder="E-mail" name="email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control @if($errors->has('password')) is-invalid @endif" value="{{old('password')}}"  placeholder="Password" name="password" type="password">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label><input @if(old("remember")) checked @endif name="remember" type="checkbox" value="Remember Me"> Remember Me</label>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                        </form>
                        <div class="text-center">Don't have an account ? <a href="{{route('laravelstack.signup')}}">Create your account</a></div>
                        <div class="text-center"><a href="{{route('laravelstack.forgetMyPassword')}}">Forget my password</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection