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
                    <th class="action-td">ID</th>
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
                    <th class="action-td sticky-column">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
            <tr>
                <td class="action-td">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->enabled ? 'Yes' : 'No'}}</td>
                <td>{{$item->type}}</td>
                <td>
                    @if($item->image)
                        <img alt="image" src="{{asset('storage/'.$item->image)}}" style="max-width: 100px;border-radius: 5px;">
                    @endif
                </td>
                <td style="min-width: 200px;">
                    <div class="row">
                        @foreach($item->images as $image)
                            <div class="col-4 p-2">
                                <img alt="image" src="{{asset('storage/' . $image)}}" style="width: 50px;border-radius: 5px;">
                            </div>
                        @endforeach
                    </div>

                </td>
                <td>
                    @foreach($item->big_title as $local => $big_title)
                    <div class="by-locales">
                        <div>{{$local}}</div>
                        <div>{{$big_title}}</div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->medium_title as $local => $medium_title)
                        <div class="by-locales">
                            <div>{{$local}}</div>
                            <div>{{$medium_title}}</div>
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->small_title as $local => $small_title)
                        <div class="by-locales">
                            <div>{{$local}}</div>
                            <div>{{$small_title}}</div>
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->content as $local => $content)
                        <div class="by-locales">
                            <div>{{$local}}</div>
                            <div>{{$content}}</div>
                        </div>
                    @endforeach
                </td>
                <td>{{$item->slug}}</td>
                <td style="white-space: nowrap">{{$item->created_at}}</td>
                <td style="white-space: nowrap">{{$item->updated_at}}</td>
                <td class="action-td sticky-column">
                    <a class="btn btn-secondary me-2" href="{{route('admin.pages.update', $item->id)}}">Edit</a>
                    <a class="btn btn-secondary me-2" href="{{route('admin.pages.show', $item->id)}}">Show</a>
                    <a class="btn btn-secondary me-2" href="{{route('page', ['slug' => $item->slug])}}" target="_blank">Open Page</a>
                    <form class="d-inline-block" action="{{ route('admin.pages.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-light" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-5">{{ $items->appends(request()->query())->links('pagination.my_default') }}</div>

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
