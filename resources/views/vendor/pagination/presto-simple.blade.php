@if ($paginator->hasPages())
    <nav class="presto-pagination presto-pagination-simple" role="navigation" aria-label="Pagination Navigation">
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

            <li class="presto-pagination-item is-current-range">
                <span class="presto-pagination-link">{{ $paginator->currentPage() }}</span>
            </li>

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
