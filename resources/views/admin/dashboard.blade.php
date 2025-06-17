@extends('admin_root.admin_root')
@section('title', 'Dashboard')
@section('content')
    <div style="width: 512px;margin: 0 auto;">
        <div style="text-align: center">Dashboard Page <a href="{{route('admin.logout')}}">Logout</a></div>
        <div><a>Create Menu</a></div>
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
