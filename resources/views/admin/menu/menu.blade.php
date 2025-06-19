@extends('admin_root.admin_root')
@section('title', 'Menu')
@section('content')
    <h1 style="text-align: center">Main Menu</h1>
    <div style="width: 1024px;margin: 0 auto 150px auto;">
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
            <tbody id="multiDrag">
            @foreach($menu as $item)
                <tr>
                    <td class="handle" style="cursor: move;user-select: none">{{$item->id}}</td>
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
                        <div>{{count($item->children)}}</div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>



        <div style="margin-top: 15px;">
            <button type="button" id="reorder_menu">Reorder</button>
        </div>
        <div style="margin: 25px 0;"><a href="{{route('admin.main_menu.create')}}">Create Main Menu</a></div>

        <div id="menu_container">
            @foreach($menu as $item)
                @include('admin.menu.menu_item', $item)
            @endforeach
        </div>

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
        .menu_child_container{
            min-height: 0;
            margin-left: 35px;
            padding-top: 15px;
        }
        .menu_item_info{
            display: flex;
            border: 1px solid black;
            border-radius: 5px;
            overflow: hidden;
        }

    </style>
@endpush
@push('head_js')
    <script src="{{asset('assets/js/sortable1.js')}}"></script>
@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            let multiDrag = document.getElementById('multiDrag');
            new Sortable(multiDrag, {
                multiDrag: true, // Enable multi-drag
                // selectedClass: 'selected', // The class applied to the selected items
                fallbackTolerance: 3, // So that we can select items on mobile
                animation: 150,
                handle: '.handle',
            });

            new Sortable(document.getElementById('menu_container'), {
                multiDrag: true, // Enable multi-drag
                // selectedClass: 'selected', // The class applied to the selected items
                fallbackTolerance: 3, // So that we can select items on mobile
                animation: 150,
                group: 'nested',
                handle: '.handle',
            });

            let nestedSortables =  document.querySelectorAll('#menu_container .menu_child_container');
            for(let i = 0; i < nestedSortables.length; i++){
                new Sortable(nestedSortables[i], {
                    group: 'nested',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    // invertSwap: true,
                });
            }

            let reorder_menu = document.getElementById('reorder_menu');
            reorder_menu.addEventListener('click', ()=>{
                let data = findOrders(document.getElementById('menu_container'));
                console.log(data);
                sendReorder({"data": data});
            });

            function findOrders(el) {
                let arr = [];
                    el.querySelectorAll(':scope > .menu_item_group, :scope > .menu_child_container > .menu_item_group').forEach((mg)=>{
                        let menuId = mg.getAttribute('data-id');
                        arr.push(menuId);
                        if(mg.querySelectorAll('.menu_item_group').length > 0){
                            arr.push(findOrders(mg));
                        }
                    });
                return arr;
            }

            function sendReorder(data) {
                let csrf = "{{ csrf_token() }}";
                let fd = new FormData();
                fd.append('data', JSON.stringify(data));
                let aj = new XMLHttpRequest();
                aj.open('post', '{{route('admin.main_menu.reorder')}}');
                aj.setRequestHeader('X-CSRF-TOKEN', csrf);
                aj.send(fd);
                aj.onreadystatechange = function () {
                    if(this.readyState === 4 && this.status === 200){
                        // let data = this.responseText;
                        // let newJsonData = JSON.parse(data);
                        window.location.reload();
                    }
                };
            }

        });

    </script>
@endpush
