@php
    use App\Models\MyConfig;
    $site_icon = MyConfig::where('group_key', 'site')->where('key', 'icon')->first();
@endphp
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon"
          href="{!! ($site_icon->value1 ?? null) ? asset('storage/' . $site_icon->value1) : asset('favicon.png') !!}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/web/css/style/main.css')}}"/>
    <!-- Font awesome for icons -->
    <link href="{{asset('assets/web/fontawesome/css/all.css')}}" rel="stylesheet"/>
    <!-- Language switcher icons link -->
    <link rel="stylesheet" href="{{asset('assets/web/css/flag-icons.min.css')}}"/>

    <script src=""></script>
    @stack('css')
    @stack('head_js')

</head>
<body class="home page-template-default page page-id-2 is-tablet-up is-desktop">
<div class="container">
    @include('root.header')
    @yield('content')
    @include('root.footer')
</div>
<script src="{{asset('assets/web/js/script.js')}}"></script>
@stack('body_js')
</body>
</html>

