@extends('admin_root.admin_root')
@section('title', 'Login')
@section('content')
    <div style="text-align: center">Login Page</div>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column" method="post" action="{{route('admin.logging')}}">
    @csrf
        <input type="text" name="email" placeholder="Email" value="admin@mail.com">
        <input type="password" name="password" placeholder="Password" value="12345678">
        <button type="submit">Login</button>
    </form>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
