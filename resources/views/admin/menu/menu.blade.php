@extends('admin_root.admin_root')
@section('title', 'Menu')
@section('content')
    <h1 style="text-align: center">Main Menu</h1>
    <div style="width: 1024px;margin: 0 auto;">
        <table class="my_table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Page</th>
                <th>Link</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menu as $item)
                <tr>
                    <td style="cursor: move;user-select: none">{{$item->id}}</td>
                    <td>
                        @foreach($item->name as $local => $name)
                            <div style="display: flex;">
                                <div style="padding: 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                                <div style="flex: 1;border: 1px solid #ddd;">{{$name}}</div>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <div><strong>Name:</strong>{{$item->page->name}}</div>
                        <div><strong>Slug:</strong>{{$item->page->slug}}</div>
                    </td>
                    <td>{{$item->link}}</td>
                    <td>{{$item->order}}</td>
                    <td>
                        <form action="{{ route('admin.main_menu.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <div><a href="{{route('admin.main_menu.update', $item->id)}}">Edit</a></div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="margin-top: 15px;">
            <button type="button">Reorder</button>
        </div>
        <div style="margin: 25px 0;"><a href="{{route('admin.main_menu.create')}}">Create Main Menu</a></div>

    </div>


@endsection
@push('css')
    <style>
        .my_table{
            border-collapse: collapse;
            width: 100%;
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
