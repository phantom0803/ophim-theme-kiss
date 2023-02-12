@extends('themes::themekiss.layout')

@php
    $watchUrl = '#';
    $watchUrlLast = '#';
    $firstWatchName = '';
    $lastWatchName = '';

    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $firstWatch = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first();
        $firstWatchName = $firstWatch->name;
        $watchUrl = $firstWatch->getUrl();

        $lastWatch = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->last()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->first()
            ->sortByDesc('type')
            ->last();
        $lastWatchName = $lastWatch->name;
        $watchUrlLast = $lastWatch->getUrl();
    }

@endphp

@push('header')
    <link rel="stylesheet" href="{{ asset('/themes/kiss/css/jquery.fancybox.min.css') }}">
@endpush

@section('content')
    <article id="post-{{ $currentMovie->id }}" class="post-{{ $currentMovie->id }} hentry" itemscope="itemscope"
        itemtype="http://schema.org/CreativeWorkSeries">
        <div class="ts-breadcrumb bixbox">
            <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item"
                        href="/"><span itemprop="name">Xem phim</span></a>
                    <meta itemprop="position" content="1">
                </li>
                ›
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item"
                        href="{{ $currentMovie->getUrl() }}"><span itemprop="name">{{ $currentMovie->name }}</span></a>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
        <div class="bixbox animefull">
            <div class="bigcover">
                <div class="ime"><a href="{{ $watchUrl }}" class="lnk"></a> <img
                        src="{{ $currentMovie->poster_url ?: $currentMovie->thumb_url }}" alt="{{ $currentMovie->name }}" />
                </div>
                @if ($watchUrl != '#')
                    <a href="{{ $watchUrl }}" class="gp"><i class="far fa-play-circle" aria-hidden="true"></i></a>
                @endif
            </div>
            <div class="bigcontent">
                <div class="thumbook">
                    <div class="thumb" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <img src="{{ $currentMovie->thumb_url }}"
                            class="ts-post-image wp-post-image attachment-post-thumbnail size-post-thumbnail" loading="lazy"
                            itemprop="image" title="{{ $currentMovie->name }}" alt="{{ $currentMovie->name }}"
                            width="900" height="1594" />
                    </div>
                    <div class="rt">
                        <div class="rating"><strong>Rating
                                {{ number_format($currentMovie->ratting_star, 1) == 0.0 ? '8.0' : number_format($currentMovie->ratting_star, 1) }}</strong>
                            <div class="rating-prc" itemscope="itemscope" itemprop="aggregateRating"
                                itemtype="//schema.org/AggregateRating">
                                <meta itemprop="ratingValue"
                                    content="{{ number_format($currentMovie->ratting_star, 1) == 0.0 ? '8.0' : number_format($currentMovie->ratting_star, 1) }}">
                                <meta itemprop="worstRating" content="1">
                                <meta itemprop="bestRating" content="10">
                                <meta itemprop="ratingCount"
                                    content="{{ $currentMovie->ratting_count == 0 ? 1 : $currentMovie->ratting_count }}">
                                <div class="rtp">
                                    <div class="rtb"><span
                                            style="width:{{ (number_format($currentMovie->ratting_star, 1) == 0.0 ? '8.0' : number_format($currentMovie->ratting_star, 1)) * 10 }}%"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($currentMovie->trailer_url)
                            <a data-fancybox href="{{ $currentMovie->trailer_url }}" class="trailerbutton"> <i
                                    class="fab fa-youtube"></i> Trailer </a>
                        @endif
                        @if ($watchUrl != '#')
                            <a style="display: block" href="{{ $watchUrl }}" class="bookmark"><i
                                    class="far fa-play-circle" aria-hidden="true"></i> Xem Phim</a>
                        @endif
                    </div>
                </div>
                <div class="infox">
                    <h1 class="entry-title" itemprop="name">{{ $currentMovie->name }}</h1>
                    <div class="ninfo">
                        <span class="alter">Tên khác: {{ $currentMovie->origin_name }}</span>
                        <div class="info-content">
                            <div class="spe">
                                <span>
                                    <b>Status:</b> {{ $currentMovie->status }} </span>
                                <span class="split">
                                    <b>Năm phát hành:</b> {{ $currentMovie->publish_year }} </span>
                                <span>
                                    <b>Thời lượng:</b> {{ $currentMovie->episode_time }} </span>
                                <span>
                                    <b>Quốc gia:</b>
                                    {!! $currentMovie->regions->map(function ($region) {
                                            return '<a href="' .
                                                $region->getUrl() .
                                                '" tite="Phim ' .
                                                $region->name .
                                                ' rel="tag"">' .
                                                $region->name .
                                                '</a>';
                                        })->implode(', ') !!}
                                </span>
                                <span>
                                    <b>Định dạng:</b> {{ $currentMovie->type == 'series' ? 'Phim bộ' : 'Phim lẻ' }} </span>
                                <span>
                                    <b>Số tập:</b> {{ $currentMovie->episode_total }} </span>
                                <span class="split">
                                    <b>Đạo diễn:</b>
                                    {!! $currentMovie->directors->map(function ($director) {
                                            return '<a href="' .
                                                $director->getUrl() .
                                                '" tite="Đạo diễn ' .
                                                $director->name .
                                                ' rel="tag"">' .
                                                $director->name .
                                                '</a>';
                                        })->implode(', ') !!}
                                </span>
                                <span class="split">
                                    <b>Diễn viên:</b>
                                    {!! $currentMovie->actors->map(function ($actor) {
                                            return '<a href="' .
                                                $actor->getUrl() .
                                                '" tite="diễn viên ' .
                                                $actor->name .
                                                ' rel="tag"">' .
                                                $actor->name .
                                                '</a>';
                                        })->implode(', ') !!}
                                </span>
                                <span class="split">
                                    <b>Chất lượng:</b>
                                    {{ $currentMovie->quality }} {{ $currentMovie->language }}
                                </span>
                            </div>
                            <div class="genxed">
                                {!! $currentMovie->categories->map(function ($category) {
                                        return '<a href="' .
                                            $category->getUrl() .
                                            '" tite="Phim ' .
                                            $category->name .
                                            ' rel="tag"">' .
                                            $category->name .
                                            '</a>';
                                    })->implode('') !!}
                            </div>
                            @if ($currentMovie->notify && $currentMovie->notify != '')
                                <div class="desc"><strong>Thông báo: </strong>{{ strip_tags($currentMovie->notify) }}
                                </div>
                            @endif
                            @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
                                <div class="desc"><strong>Lịch chiếu: </strong>{{ strip_tags($currentMovie->showtimes) }}
                                </div>
                            @endif
                            <div class="desc">
                                Xem phim {{ $currentMovie->name }} có phụ đề tiếng việt trên {{ request()->getHost() }}.
                                Bạn cũng có thể tải xuống {{ $currentMovie->name }} vietsub miễn phí, đừng quên xem phát
                                trực tuyến với nhiều chất lượng khác nhau 720P 360P 240P 480P (nếu có) tùy theo đường truyền
                                của bạn để tiết kiệm dung lượng internet. Hãy chia sẻ {{ $currentMovie->name }} trên
                                {{ request()->getHost() }} tới mọi người để cùng thưởng thức nhé.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom tags">
                {!! $currentMovie->tags->map(function ($tag) {
                        return '<a href="' . $tag->getUrl() . '" tite="Phim ' . $tag->name . ' rel="tag"">' . $tag->name . '</a>';
                    })->implode('') !!}
            </div>
        </div>
        <div class='socialts'>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentMovie->getUrl() }}&t={{ $currentMovie->name }}"
                target="_blank" class="fb"> <i class="fab fa-facebook-f"></i> <span>Facebook</span> </a> <a
                href="https://www.twitter.com/intent/tweet?url={{ $currentMovie->getUrl() }}&text={{ $currentMovie->name }}"
                target="_blank" class="twt"> <i class="fab fa-twitter"></i> <span>Twitter</span> </a> <a
                href="whatsapp://send?text={{ $currentMovie->name }} {{ $currentMovie->getUrl() }}" target="_blank"
                class="wa"> <i class="fab fa-whatsapp"></i> <span>WhatsApp</span> </a> <a
                href="https://pinterest.com/pin/create/button/?url={{ $currentMovie->getUrl() }}&media={{ $currentMovie->thumb_url }}&description={{ $currentMovie->name }}"
                target="_blank" class="pntrs"> <i class="fab fa-pinterest-p"></i> <span>Pinterest</span>
            </a>
        </div>
        <div class="bixbox synp">
            <div class="releases">
                <h2>Thông tin phim {{ $currentMovie->name }}</h2>
            </div>
            <div class="entry-content" itemprop="description">
                {!! $currentMovie->content !!}
            </div>
        </div>
        @if ($currentMovie->type == 'series' && $watchUrl != '#')
            <div class="bixbox bxcl epcheck">
                <div class="releases">
                    <h2>Xem {{ $currentMovie->name }}</h2>
                </div>
                <div class="lastend">
                    <div class="inepcx"><a href="{{ $watchUrl }}"> <span>Tập đầu</span> <span
                                class="epcur epcurfirst">Tập {{ $firstWatchName }}</span>
                        </a></div>
                    <div class="inepcx"><a href="{{ $watchUrlLast }}">
                            <span>{{ $currentMovie->status == 'completed' ? 'Tập cuối' : 'Tập mới' }}</span>
                            <span class="epcur epcurlast">Tập {{ $lastWatchName }}</span> </a></div>
                </div>
                <div class="eplister">
                    <div class="ephead">
                        <div class="eph-num">STT</div>
                        <div class="eph-title">Tiêu đề</div>
                        <div class="eph-sub">Server</div>
                    </div>
                    <ul>

                        @foreach ($currentMovie->episodes->sortBy([['server', 'desc']])->groupBy('server')->take(1) as $server => $data)
                            @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name')->take(15) as $name => $item)
                                <li><a href="{{ $item->sortByDesc('type')->first()->getUrl() }}">
                                        <div class="epl-num">{{ $name }}</div>
                                        <div class="epl-title">{{ $currentMovie->name }} Tập {{ $name }}</div>
                                        <div class="epl-sub"><span class="status Hard Sub">{{ $server }}</span>
                                        </div>
                                    </a></li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @include('themes::themekiss.inc.comment')
        @include('themes::themekiss.inc.movie_related')
    </article>
@endsection

@push('scripts')
    <script type='text/javascript' src='/themes/kiss/js/jquery.fancybox.min.js' id='fancybox-js'></script>
    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
