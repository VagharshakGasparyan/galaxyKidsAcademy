@extends('root.root')
@section('title', __('Home'))
@section('content')
    <div>{{$page->big_title[app()->getLocale()]}}</div>

@endsection
@push('body_js')
    <script>
        // console.log('URA');
    </script>
@endpush
