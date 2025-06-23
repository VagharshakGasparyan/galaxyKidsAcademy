@extends('admin_root.admin_root')
@section('title', 'Menu')
@section('content')
    <div style="width: 1024px;">
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Main Menu</h1>
        </div>

        <div id="menu_container">
            @foreach($menu as $item)
                @include('admin.menu.menu_item', $item)
            @endforeach
        </div>
        <div style="margin-top: 15px;">
            <button type="button" class="btn btn-primary" id="reorder_menu">Reorder</button>
        </div>
        <div style="margin: 25px 0;"><a class="btn btn-secondary" href="{{route('admin.main_menu.create')}}">Create Main Menu</a></div>
    </div>


@endsection
@push('css')
    <style>
        .menu_child_container{
            min-height: 0;
            margin-left: 35px;
            padding-top: 15px;
        }
        .menu_item_info{
            display: flex;
            border: 1px solid var(--c);
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
