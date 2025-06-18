@extends('admin_root.admin_root')
@section('title', 'Dashboard')
@section('content')
    <div style="width: 1280px;margin: 0 auto;">
        <h1 style="text-align: center">Pages</h1>
        <table style="width: 100%" class="my_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Enabled</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Images</th>
                    <th>Big Title</th>
                    <th>Medium Title</th>
                    <th>Small Title</th>
                    <th>Content</th>
                    <th>Slug</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->enabled ? 'Yes' : 'No'}}</td>
                <td>{{$item->type}}</td>
                <td>
                    @if($item->image)
                        <img alt="image" src="{{asset('storage/'.$item->image)}}" style="width: 100px;">
                    @endif
                </td>
                <td>
                    @foreach($item->images as $image)
                        <img alt="image" src="{{asset('storage/' . $image)}}" style="width: 50px;">
                    @endforeach
                </td>
                <td>
                    @foreach($item->big_title as $local => $big_title)
                    <div style="display: flex;">
                        <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                        <div style="flex: 1;border: 1px solid #ddd;">{{$big_title}}</div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->medium_title as $local => $medium_title)
                        <div style="display: flex;">
                            <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                            <div style="flex: 1;border: 1px solid #ddd;">{{$medium_title}}</div>
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->small_title as $local => $small_title)
                        <div style="display: flex;">
                            <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                            <div style="flex: 1;border: 1px solid #ddd;">{{$small_title}}</div>
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->content as $local => $content)
                        <div style="display: flex;">
                            <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                            <div style="flex: 1;border: 1px solid #ddd;white-space: pre-wrap">{{$content}}</div>
                        </div>
                    @endforeach
                </td>
                <td>{{$item->slug}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td>
                    <form action="{{ route('admin.pages.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    <div><a href="{{route('admin.pages.update', $item->id)}}">Edit</a></div>
                    <div><a href="{{route('admin.pages.show', $item->id)}}">Show</a></div>
                    <div><a href="{{route('page', ['slug' => $item->slug])}}" target="_blank">Open Page</a></div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $items->appends(request()->query())->links('pagination.my_default') }}</div>

        <div style="margin: 25px 0;"><a href="{{route('admin.pages.create')}}">Create Page</a></div>
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
