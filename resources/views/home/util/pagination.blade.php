<div class="upstudy-pagination">
    @if ($paginator->hasPages())
        <ul class="pagination justify-content-center">

            @if ($paginator->onFirstPage())
                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
            @else
            @endif

            @foreach ($elements as $element)

                @if (is_string($element))
                    <li><a class="active" href="#">{{ $element }}</a></li>
                @endif


                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())

                            <li><a class="active" href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach



            @if ($paginator->hasMorePages())

                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>

            @else
                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>

            @endif
        </ul>
    @endif
</div>
