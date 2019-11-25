@extends("templates.admin")
@section('title',"Profile")
@section('content')
@include("templates.alerts")
<form-profile :user="{{json_encode($user)}}"></form-profile>
@endsection