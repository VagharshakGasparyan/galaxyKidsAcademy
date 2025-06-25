@if ($paginator->hasPages())
    <div>
        <div style="display: flex;flex-wrap: wrap;font-size: 18px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-prev-next-off" aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
            @else
                <a class="pagination-prev-next-on" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-chevron-left"></i></a>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-tree-dot">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-current-on">{{ $page }}</span>
                        @else
                            <a class="pagination-current-off" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="pagination-prev-next-on" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-chevron-right"></i></a>
            @else
                <span class="pagination-prev-next-off"><i class="fa fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
@endif
