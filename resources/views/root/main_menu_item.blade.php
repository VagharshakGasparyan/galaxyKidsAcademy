
<li class=" @if(count($item->children)) with-submenu @endif @if(isset($list_is_tablet) && $list_is_tablet) list-is-tablet @endif ">
    @if($item->page_id || $item->link)
        <a href="{{str_replace('//', '/', '/'.($item->link ?? $item->page->slug))}}">{{$item->name[app()->getLocale()] ?? '-'}}</a>
    @else
        <a href="javascript:void(0)">{{$item->name[app()->getLocale()] ?? '-'}}</a>
    @endif
    @if(count($item->children))
        <div class="submenu">
            <ul class="submenu-inner">
                @foreach($item->children as $child)
                    @include('root.main_menu_item', ['item' => $child])
                @endforeach
            </ul>
        </div>
    @endif

</li>
