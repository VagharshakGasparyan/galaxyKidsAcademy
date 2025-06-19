
<div class="dropdown">
    @if($item->page_id || $item->link)
        <a href="{{str_replace('//', '/', '/'.($item->link ?? $item->page->slug))}}">{{$item->name[app()->getLocale()] ?? '-'}}</a>
    @else
        <div style="padding: 10px;">{{$item->name[app()->getLocale()] ?? '-'}}</div>
    @endif
    @if(count($item->children))
        <div class="dropdown-content">
            @foreach($item->children as $child)
                @include('root.main_menu_item', ['item' => $child])
            @endforeach
        </div>
    @endif

</div>
