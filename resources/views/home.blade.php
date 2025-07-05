@extends('root.root')
@section('title', __('Home'))
@section('content')
    <div style="text-align: center">{{__('home.phone')}} {{app()->getLocale()}}</div>
    <div style="text-align: center">{{__('Home')}} {{app()->getLocale()}}</div>

@endsection
@push('body_js')
    <script>
        // console.log('URA');
    </script>
@endpush
