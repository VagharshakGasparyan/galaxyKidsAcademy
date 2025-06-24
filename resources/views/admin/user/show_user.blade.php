@extends('admin_root.admin_root')
@section('title', 'Show User')
@section('content')

    <div style="max-width: 768px;">
        <div class="admin-content-title">
            <a href="{{route('admin.users')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Users</a>
            <h1 class="text-center">Show User</h1>
        </div>
        <table class="my_table">
            <thead></thead>
            <tbody>
            <tr>
                <th class="action-td">ID</th>
                <td>{{$user->id}}</td>
            </tr>
            <tr>
                <th class="action-td">Name</th>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <th class="action-td">Email</th>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <th class="action-td">Role</th>
                <td>{{$user->role}}</td>
            </tr>
            <tr>
                <th class="action-td">Photo</th>
                <td>
                    @if($user->photo)
                        <img src="{{asset('storage/' . $user->photo)}}" alt="photo" style="max-width: 100%; border-radius: 5px;">
                    @endif
                </td>
            </tr>
            <tr>
                <th class="action-td">Created</th>
                <td>{{$user->created_at}}</td>
            </tr>
            <tr>
                <th class="action-td">Updated</th>
                <td>{{$user->updated_at}}</td>
            </tr>

            </tbody>
        </table>

        <div class="mt-5">
            <a href="{{route('admin.users.update', $user->id)}}" class="btn btn-secondary">Edit</a>
        </div>
    </div>

@endsection
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{

        });
    </script>
@endpush
