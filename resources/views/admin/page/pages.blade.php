@extends('admin_root.admin_root')
@section('title', 'Pages')
@section('content')
    <div>
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Pages</h1>
        </div>
        <table class="my_table">
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
                            <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd">{{$local}}</div>
                            <div style="flex: 1;border: 1px solid #ddd;white-space: pre-wrap; text-overflow: ellipsis; overflow: hidden;display: -webkit-box; -webkit-line-clamp: 5;-webkit-box-orient: vertical;">{{$content}}</div>
                        </div>
                    @endforeach
                </td>
                <td>{{$item->slug}}</td>
                <td style="white-space: nowrap">{{$item->created_at}}</td>
                <td style="white-space: nowrap">{{$item->updated_at}}</td>
                <td>
                    <a class="btn btn-secondary" href="{{route('admin.pages.update', $item->id)}}">Edit</a>
                    <a class="btn btn-secondary" href="{{route('admin.pages.show', $item->id)}}">Show</a>
                    <a class="btn btn-secondary" href="{{route('page', ['slug' => $item->slug])}}" target="_blank">Open Page</a>
                    <form action="{{ route('admin.pages.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-light" type="submit">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $items->appends(request()->query())->links('pagination.my_default') }}</div>

        <div class="mt-5"><a class="btn btn-primary" href="{{route('admin.pages.create')}}">Create Page</a></div>
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
