<ul class="pagination">
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                @else
                    <li class="waves-effect"><a class="" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
</ul>