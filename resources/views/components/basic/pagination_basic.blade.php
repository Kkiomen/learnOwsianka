@if ($paginator->hasPages())
    <ul class="pagination pagination-style-01 text-small font-weight-500 align-items-center">
        @if ($paginator->onFirstPage())
            <li class="page-item">
                <i class="page-link fa-solid fa-angle-left icon-extra-small d-xs-none" style="color: #a1a1a1;"></i>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fa-solid fa-angle-left icon-extra-small d-xs-none"></i></a>
            </li>
        @endif
        @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fa-solid fa-angle-right icon-extra-small d-xs-none"></i></a>
            </li>
        @else
            <li class="page-item">
                <i class="page-link fa-solid fa-angle-right icon-extra-small d-xs-none" style="color: #a1a1a1;"></i>
            </li>
        @endif

    </ul>
@endif
