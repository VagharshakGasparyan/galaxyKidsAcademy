<div class="menu_item_group" data-id="{{$item->id}}">
    <div class="menu_item_info">
        <div class="handle" style="user-select: none;cursor: move; width: 35px;background-color: #aaa;text-align: center;font-size: 25px;">:::</div>
        <div style="padding: 10px;">{{$item->id}}</div>
        <div>
            @foreach($item->name as $local => $name)
                <div style="display: flex;">
                    <div style="padding: 0 5px;display: flex;align-items: center;background-color: #ddd;">{{$local}}</div>
                    <div style="flex: 1;border: 1px solid #ddd;padding: 0 5px;">{{$name}}</div>
                </div>
            @endforeach
        </div>
        <div style="flex: 1"></div>
        <div>
            <form action="{{ route('admin.main_menu.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            <div><a href="{{route('admin.main_menu.update', $item->id)}}">Edit</a></div>
        </div>
    </div>
    <div class="menu_child_container">
        @foreach($item->children as $child)
            @include('admin.menu.menu_item', ["item" => $child])
        @endforeach
    </div>
</div>
