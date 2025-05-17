@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Affichage de {{ $paginator->firstItem() }} à {{ $paginator->lastItem() }} sur {{ $paginator->total() }} résultats
        </div>
        <nav>
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0 bg-transparent">Précédent</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link border-0 bg-transparent" href="{{ $paginator->previousPageUrl() }}" rel="prev">Précédent</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link border-0 bg-transparent">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link border-0" style="background-color: #0d6efd; color: white;">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link border-0 bg-transparent" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link border-0 bg-transparent" href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0 bg-transparent">Suivant</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif 