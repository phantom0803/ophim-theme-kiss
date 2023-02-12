@extends('themes::layout')
@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_week', 'desc', 4, 'top_text']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
    <meta name="theme-color" content="#e7b53a">
    <script type='text/javascript' src='{{ asset('/themes/kiss/js/jquery.min.js') }}' id='jquery-js'></script>
    <link rel="stylesheet" href="{{ asset('/themes/kiss/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
@endpush

@section('body')
    <div id='shadow'></div>
    <div class="mainholder">
        @include('themes::themekiss.inc.header')
        <div id="content">
            <div class="wrapper">
                <div class="notf"> <img src="/themes/kiss/images/404.png"></div>
            </div>
        </div>
        {!! get_theme_option('footer') !!}
    </div>
@endsection

@push('scripts')
@endpush

@section('footer')
    <script type='text/javascript' src='{{ asset('/themes/kiss/js/app_2.js') }}' id='qtip-js'></script>
    {!! setting('site_scripts_google_analytics') !!}
@endsection
