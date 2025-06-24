@extends('admin_root.admin_root')
@section('title', 'Login')
@section('content')
    <h2 style="text-align: center">Login</h2>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column" method="post" action="{{route('admin.logging')}}">
    @csrf
        <div class="mb-3">
            <label for="admin-email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="admin-email" placeholder="Email" value="admin@mail.com">
            @error('email')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="admin-password" class="form-label">Password</label>
            <div class="position-relative">
                <input type="password" name="password" class="form-control" id="admin-password" placeholder="Password" value="12345678">
                <i class="fa fa-eye input-eye"></i>
            </div>
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
