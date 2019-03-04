@header
    {{--slot命名插槽    --}}
    @slot('title')
        @yield('title')
    @endslot
@endheader

@section('content')

@show

@if ( $show_footer === 1)
    @footer
    @endfooter
@endif