@if ($paginator->hasPages())
    <nav class="presto-pagination" role="navigation" aria-label="Pagination Navigation">
        <div class="presto-pagination-summary">
            Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }} results
        </div>

        <ul class="presto-pagination-list">
            @if ($paginator->onFirstPage())
                <li class="presto-pagination-item is-disabled" aria-disabled="true" aria-label="Previous page">
                    <span class="presto-pagination-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="presto-pagination-item">
                    <a class="presto-pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">&lsaquo;</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="presto-pagination-item is-ellipsis" aria-disabled="true">
                        <span class="presto-pagination-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="presto-pagination-item is-active" aria-current="page">
                                <span class="presto-pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="presto-pagination-item">
                                <a class="presto-pagination-link" href="{{ $url }}" aria-label="Go to page {{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="presto-pagination-item">
                    <a class="presto-pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">&rsaquo;</a>
                </li>
            @else
                <li class="presto-pagination-item is-disabled" aria-disabled="true" aria-label="Next page">
                    <span class="presto-pagination-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
