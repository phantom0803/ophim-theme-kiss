@extends('themes::themekiss.layout')

@php
    use Ophim\Core\Models\Movie;

    $recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('is_recommended', true)
            ->limit(get_theme_option('recommendations_limit', 10))
            ->orderBy('updated_at', 'desc')
            ->get();
    });

    $data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $limit, $link, $template] = array_merge($list, ['Phim mới cập nhật', '', 'type', 'series', 8, '/', 'section_1']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->limit($limit)
                            ->orderBy('updated_at', 'desc')
                            ->get(),
                        'link' => $link ?: '#',
                    ];
                } catch (\Exception $e) {
                }
            }
        }
        return $data;
    });

@endphp

@section('content')
    @if (count($recommendations))
        @include('themes::themekiss.inc.slider_recommended')
    @endif
    @foreach ($data as $item)
        @include('themes::themekiss.inc.' . $item['template'])
    @endforeach
@endsection

@push('scripts')
    <script type='text/javascript' src='{{ asset('/themes/kiss/js/owl.carousel.min.js') }}' id='owl-carousel-js'></script>
    <script>
        $(document).ready(function() {
            $('.loop').owlCarousel({
                center: true,
                loop: true,
                nav: true,
                //animateOut: 'fadeOut',
                navText: ["<span class='prev icon-angle-left'></span>",
                    "<span class='next icon-angle-right'></span>"
                ],
                margin: 0,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1,
                        stagePadding: 0,
                    }
                }
            });
        });
    </script>
@endpush
