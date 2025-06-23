<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{!! asset('favicon.png') !!}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.2.3/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">

    <script src="{{asset('assets/bootstrap-5.2.3/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap-5.2.3/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/admin.js')}}"></script>
    @stack('css')
    @stack('head_js')

</head>
<body>
@auth
    @include('admin_root.admin_header')
@endauth
<div class="admin-main">
    @auth
        @include('admin_root.admin_sidebar')
    @endauth
    <div class="admin-content">
        @yield('content')
    </div>
</div>
@include('admin_root.admin_footer')

@stack('body_js')
</body>
</html>

