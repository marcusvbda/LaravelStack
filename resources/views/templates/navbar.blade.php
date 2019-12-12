<?php $user = Auth::user(); ?>
<template-navbar 
    :user="{{json_encode($user)}}" 
    routeglobalsearch="{{route('resource.globalsearch')}}"
    routeprofile="{{route('admin.account.profile')}}"
    routelogout="{{route('auth.login.index')}}"
>
<template slot="breadcrumb">
    @yield("breadcrumb")
</template>
</template-navbar>