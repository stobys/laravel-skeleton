@if($paginator->hasPages())
<nav class="text-center">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url(1) }}" rel="first"
                aria-label="@lang('pagination.first')">
                <x-icon icon="angle-double-left" />
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                aria-label="@lang('pagination.previous')">
                    <x-icon icon="angle-left" />
            </a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">{{ $element }}</span>
            </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                aria-label="@lang('pagination.next')">
                    <x-icon icon="angle-right" class="fas" />
            </a>
        </li>
        @endif

        @if( $paginator->lastPage() > $paginator->currentPage() )
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url( $paginator->lastPage() ) }}" rel="last"
                    aria-label="Last Page">
                        <x-icon icon="angle-double-right" class="fas" />
                </a>
            </li>
        @endif

        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true">
{{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }} -
{{ ($paginator->currentPage() - 1) * $paginator->perPage() + $paginator->count() }}
/
{{ $paginator->total() }}
            </span>
        </li>

    </ul>
</nav>

@endif