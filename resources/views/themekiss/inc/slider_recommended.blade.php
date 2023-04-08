<div class="slidtop">
    <div class="loop owl-carousel full">
        @foreach ($recommendations as $movie)
            <div class="slide-item full">
                <div class="slide-bg"><img src="{{ $movie->getPosterUrl() }}"
                        class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy" itemprop="image"
                        title="{{ $movie->name }}" alt="{{ $movie->name }}" width="212" height="300" /></div>
                <div class="slide-shadow"></div>
                <div class="slide-content">
                    <div class="poster" style="position:relative"><a href="{{ $movie->getUrl() }}"> <img
                                src="{{ $movie->getThumbUrl() }}"
                                class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy"
                                itemprop="image" title="{{ $movie->name }}" alt="{{ $movie->name }}" width="212"
                                height="300" /> </a></div>
                    <div class="info-left">
                        <div class="title">
                            <div class="rating">
                                <div class="vote">
                                    <div class="site-vote"><span class="fa fa-star"
                                            aria-hidden="true"><span>{{$movie->getRatingStar()}}</span></span>
                                    </div>
                                </div>
                            </div>
                            <span class="ellipsis"><a href="{{ $movie->getUrl() }}">{{ $movie->name }}</a></span>
                            <span class="release-year ellipsis">{{ $movie->origin_name }}
                                ({{ $movie->publish_year }})</span>
                        </div>
                        <div class="extras">
                            <div class="extra-category">
                                {!! $movie->categories->map(function ($category) {
                                        return '<a href="' .
                                            $category->getUrl() .
                                            '" tite="Phim ' .
                                            $category->name .
                                            ' rel="tag"">' .
                                            $category->name .
                                            '</a>';
                                    })->implode(', ') !!}
                            </div>
                        </div>
                        <div class="excerpt"><span class="title">Nội dung</span>
                            <p class="story">
                            <p>
                                {{ strip_tags($movie->content) }}
                            </p>
                            </p>
                        </div>
                        <div class="cast"><span class="director"><strong>Tình trạng:</strong>
                                {{ $movie->episode_current }}</span>
                            <span class="actor"><strong>Định dạng:</strong>
                                {{ $movie->type == 'single' ? 'Phim lẻ' : 'Phim bộ' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="trending">
        <div class="tdb"><a href="{{ $trending_this_week->getUrl() }}">
                <div class="crown"></div>
                <div class="textbg blxc">
                    <div class="bghover"><span class="numa"><b>Trending</b> This Week</span>
                        <span class="numb"><b>{{ $trending_this_week->name }}</b></span>
                    </div>
                </div>
                <div class="imgxa">
                    <div class="imgxb" style="background-image: url('{{ $trending_this_week->getThumbUrl() }}');">
                    </div>
                </div>
            </a></div>
    </div>
</div>
