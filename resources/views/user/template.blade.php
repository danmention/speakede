
@include('user.layout.header')
@yield('content')

@if(request()->segment(3) == "get-availability")
@include('user.layout.footer')
@else
    @include('user.layout.footer-datatables')
@endif
