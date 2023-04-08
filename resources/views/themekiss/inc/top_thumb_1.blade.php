<div class="section">
    <div class="releases">
        <h3>{{ $top['label'] }}</h3>
    </div>
    <div id="wpop-items">
        <div class='serieslist pop wpop wpop-weekly'>
            <ul>
                @foreach ($top['data'] as $movie)
                    <li>
                        <div class="ctr">{{ $loop->index + 1 }}</div>
                        <div class="imgseries"><a class="series" href="{{ $movie->getUrl() }}" rel="68"> <img
                                    src="{{ $movie->getThumbUrl() }}"
                                    class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy"
                                    width="214" height="300" /> </a></div>
                        <div class="leftseries">
                            <h4><a class="series" href="{{ $movie->getUrl() }}" rel="68">{{ $movie->name }}</a>
                            </h4>
                            <span><b>Thể loại</b>:
                                {!! $movie->categories->map(function ($category) {
                                        return '<a href="' .
                                            $category->getUrl() .
                                            '" tite="Phim ' .
                                            $category->name .
                                            ' rel="tag"">' .
                                            $category->name .
                                            '</a>';
                                    })->implode(', ') !!}
                            </span>
                            <div class="rt">
                                <div class="rating">
                                    <div class="rating-prc">
                                        <div class="rtp">
                                            <div class="rtb"><span style="width:{{($movie->getRatingStar())*10}}%"></span></div>
                                        </div>
                                    </div>
                                    <div class="numscore">{{$movie->getRatingStar()}}</div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
