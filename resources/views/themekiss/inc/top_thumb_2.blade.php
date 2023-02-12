<div class="section">
    <div class="releases">
        <h3><span>{{ $top['label'] }}</span></h3>
    </div>
    <div class='serieslist'>
        <ul>
            @foreach ($top['data'] as $movie)
                <li>
                    <div class="imgseries"><a class="series" href="{{ $movie->getUrl() }}" rel=""> <img
                                src="{{ $movie->thumb_url }}"
                                class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy"
                                itemprop="image" title="{{$movie->name}} ({{$movie->publish_year}})" alt="{{$movie->name}} ({{$movie->publish_year}})"
                                width="200" height="300" /> </a></div>
                    <div class="leftseries">
                        <h4><a class="series" href="{{ $movie->getUrl() }}" rel="37993"> {{$movie->name}} ({{$movie->publish_year}}) </a>
                        </h4>
                        <span>{{$movie->origin_name}}</span>
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
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
