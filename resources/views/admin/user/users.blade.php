@extends('admin_root.admin_root')
@section('title', 'Users')
@section('content')

    <div style="max-width: 1280px;">
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Users</h1>
        </div>
        @error('user')
        <div class="text-danger">{{$message}}</div>
        @enderror

        <table class="my_table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Role</th>
                <th>Email</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-td">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="action-td">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        @if($user->photo)
                            <img alt="photo" src="{{asset('storage/' . $user->photo)}}" style="width: 100px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td class="action-td">
                        <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.users.show', $user->id)}}">Show</a>
                        <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.users.update', $user->id)}}">Edit</a>
                        <form class="d-inline-block" action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $users->appends(request()->query())->links('pagination.my_default') }}</div>

        <div class="mt-5"><a class="btn btn-primary" href="{{route('admin.users.create')}}">Create User</a></div>
    </div>


@endsection
@push('css')
    <style>

    </style>
@endpush
@push('head_js')

@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{

        });

    </script>
@endpush
