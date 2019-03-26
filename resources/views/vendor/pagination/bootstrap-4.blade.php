@if ($paginator->hasPages())
    {{--<ul class="pagination" role="navigation">--}}
    <div class="row align-items-center justify-content-center py-4">
        {{-- Previous Page Link --}}
        {{--@if ($paginator->onFirstPage())--}}
            {{--<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
            {{--<span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
            {{--</li>--}}

            {{--<a href="{{ ($jobs->currentPage() == 1) ? '' : $jobs->url(1) }}">@lang('pagination.previous')</a>--}}
        {{--@else--}}
            {{--<li class="page-item">--}}
            {{--<a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
            {{--</li>--}}
            {{--<a href="{{ $paginator->previousPageUrl() }}">Previous</a>--}}
        {{--@endif--}}

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="num" >{{ $element }}</span>
                {{--<a >{{ $element }}</a>--}}
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{--<li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
                        <span class="num active">{{ $page }}</span>
                    @else
                        {{--<li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
                        <a class="num"
                           href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        {{--@if ($paginator->hasMorePages())--}}
            {{--<li class="page-item">--}}
                {{--<a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"--}}
                   {{--aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
            {{--</li>--}}
        {{--@else--}}
            {{--<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
                {{--<span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
            {{--</li>--}}
        {{--@endif--}}
    </div>
    {{--</ul>--}}
@endif
