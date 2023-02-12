<div id="sidebar">
    @yield('mainepisode')
    @foreach ($tops as $top)
        @include('themes::themekiss.inc.' . $top['template'])
    @endforeach
</div>
