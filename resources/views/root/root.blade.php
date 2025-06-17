<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{!! asset('favicon.png') !!}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src=""></script>
    @stack('css')
    @stack('head_js')

</head>
<body>
@include('root.header')
@yield('content')
@include('root.footer')

@stack('body_js')
</body>
</html>

