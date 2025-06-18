@if ($paginator->hasPages())
    <div>
        <div style="display: flex;flex-wrap: wrap;align-items: center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div style="color: #999999;padding: 5px;">
                    <span aria-hidden="true">&lsaquo;</span>
                </div>
            @else
                <div style="color: black;">
                    <a style="text-decoration: none;padding: 5px;" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </div>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <div style="color: #999;padding: 5px;"><span>{{ $element }}</span></div>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div style="color: black;background-color: #aaa;padding: 5px;">
                                <span>{{ $page }}</span>
                            </div>
                        @else
                            <div style="color: #999;padding: 5px;">
                                <a style="text-decoration: none;padding: 5px;" href="{{ $url }}">{{ $page }}</a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div>
                    <a style="text-decoration: none;padding: 5px;" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </div>
            @else
                <div  style="color: #999999;padding: 5px;">
                    <span>&rsaquo;</span>
                </div>
            @endif
        </div>
    </div>
@endif
