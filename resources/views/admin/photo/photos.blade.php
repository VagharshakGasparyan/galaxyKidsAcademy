@extends('admin_root.admin_root')
@section('title', 'Photos')
@section('content')
    <div style="max-width: 1280px;">
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Photos</h1>
        </div>
        <table class="my_table">
            <thead>
                <tr>
                    <th class="action-td">ID</th>
                    <th>Enabled</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="action-td">Created</th>
                    <th class="action-td">Updated</th>
                    <th class="action-td">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($photos as $item)
            <tr>
                <td class="action-td">{{$item->id}}</td>
                <td>{{$item->enabled ? 'Yes' : 'No'}}</td>
                <td>
                    @if($item->image)
                        <img alt="image" src="{{asset('storage/'.$item->image)}}" style="max-width: 100px;border-radius: 5px;">
                    @endif
                </td>
                <td>
                    @foreach($item->title as $local => $title)
                    <div style="display: flex;">
                        <div style="padding: 5px;display: flex;align-items: center;background-color: var(--c);color: var(--bg1);">{{$local}}</div>
                        <div style="flex: 1;border: 1px solid var(--c);padding: 0 5px;white-space: pre-wrap">{{$title}}</div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->description as $local => $description)
                        <div style="display: flex;">
                            <div style="padding: 5px;display: flex;align-items: center;background-color: var(--c);color: var(--bg1);">{{$local}}</div>
                            <div style="flex: 1;border: 1px solid var(--c);padding: 0 5px;white-space: pre-wrap">{{$description}}</div>
                        </div>
                    @endforeach
                </td>
                <td class="action-td">{{$item->created_at}}</td>
                <td class="action-td">{{$item->updated_at}}</td>
                <td class="action-td">
                    <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.photos.update', $item->id)}}">Edit</a>
                    <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.photos.show', $item->id)}}">Show</a>
                    <form class="d-inline-block" action="{{ route('admin.photos.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-light" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $photos->appends(request()->query())->links('pagination.my_default') }}</div>

        <div class="mt-5"><a class="btn btn-primary" href="{{route('admin.photos.create')}}">Create Photo</a></div>
    </div>

@endsection
@push('css')
    <style>

    </style>
@endpush
@push('body_js')
    <script>

    </script>
@endpush
