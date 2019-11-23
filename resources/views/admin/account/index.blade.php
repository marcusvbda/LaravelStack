@extends("templates.admin")
@section('title',"Home")
@section('content')
@include("templates.alerts")
<h1>ACCOUNT {{$user->name}}</h1>
@endsection