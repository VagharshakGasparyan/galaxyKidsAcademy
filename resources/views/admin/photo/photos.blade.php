@extends('admin_root.admin_root')
@section('title', 'Photos')
@section('content')
    <div style="width: 1280px;margin: 0 auto;">
        <h1 style="text-align: center">Photos</h1>
        <table style="width: 100%" class="my_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Enabled</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($photos as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->enabled ? 'Yes' : 'No'}}</td>
                <td>
                    @if($item->image)
                        <img alt="image" src="{{asset('storage/'.$item->image)}}" style="width: 100px;">
                    @endif
                </td>
                <td>
                    @foreach($item->title as $local => $title)
                    <div style="display: flex;">
                        <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                        <div style="flex: 1;border: 1px solid #ddd;">{{$title}}</div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->description as $local => $description)
                        <div style="display: flex;">
                            <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                            <div style="flex: 1;border: 1px solid #ddd;white-space: pre-wrap">{{$description}}</div>
                        </div>
                    @endforeach
                </td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td>
                    <form action="{{ route('admin.photos.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    <div><a href="{{route('admin.photos.update', $item->id)}}">Edit</a></div>
                    <div><a href="{{route('admin.photos.show', $item->id)}}">Show</a></div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $photos->appends(request()->query())->links('pagination.my_default') }}</div>

        <div style="margin: 25px 0;"><a href="{{route('admin.photos.create')}}">Create Photo</a></div>
    </div>

@endsection
@push('css')
    <style>
        .my_table{
            border-collapse: collapse;
        }
        .my_table td, .my_table th{
            border: 2px solid #aaa;
        }
    </style>
@endpush
@push('body_js')
    <script>

    </script>
@endpush
