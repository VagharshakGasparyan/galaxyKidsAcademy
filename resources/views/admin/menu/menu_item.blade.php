<div class="menu_item_group" data-id="{{$item->id}}">
    <div class="menu_item_info">
        <div class="handle" style="user-select: none;cursor: move; width: 35px;background-color: var(--c);color: var(--bg1);text-align: center;font-size: 25px;display:flex;align-items: center;justify-content: center;"><i class="fa fa-th"></i></div>
        <div style="padding: 10px;">{{$item->id}}</div>
        <div>
            @foreach($item->name as $local => $name)
                <div style="display: flex;">
                    <div style="padding: 0 5px;display: flex;align-items: center;background-color: var(--c);color: var(--bg1);">{{$local}}</div>
                    <div style="flex: 1;border: 1px solid var(--c);padding: 0 5px; margin-top: -1px;">{{$name}}</div>
                </div>
            @endforeach
        </div>
        <div style="border-right: 1px solid var(--c);padding: 5px;"><strong>Link: </strong>{{$item->link ?? '-'}}</div>
        <div style="border-right: 1px solid var(--c);padding: 5px;"><strong>Page slug: </strong>{{$item->page->slug ?? '-'}}</div>
        <div style="flex: 1"></div>
        <div style="display: flex;align-items: center;">
            <div class="me-2"><a class="btn btn-sm btn-secondary" href="{{route('admin.main_menu.update', $item->id)}}">Edit</a></div>
            <form class="me-2" action="{{ route('admin.main_menu.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-light" type="submit">Delete</button>
            </form>
        </div>
    </div>
    <div class="menu_child_container">
        @foreach($item->children as $child)
            @include('admin.menu.menu_item', ["item" => $child])
        @endforeach
    </div>
</div>
