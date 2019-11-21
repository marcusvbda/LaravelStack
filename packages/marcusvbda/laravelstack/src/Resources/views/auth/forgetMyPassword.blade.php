@extends("laravelstack::templates.default")
@section('title',"Login")
@section('body')
    <div class="container">
        <div class="d-flex justify-content-center h-100 pt-5">
            <div class="col-md-5 col-sm-12">
                <div>Go back to <a href="{{route('laravelstack.login')}}">Login</a></div>
                <div class="card">
                    <div class="card-header">Forget my password</div>
                    <div class="card-body">
                        @include("laravelstack::templates.alerts")
                        <form class="needs-validation" novalidate method="POST" action="{{route('laravelstack.resetPassword')}}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control @if($errors->has('email')) is-invalid @endif" value="{{old('email')}}" placeholder="E-mail" name="email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Reset my password">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection