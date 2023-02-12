<div class="bixbox">
    <div class="releases hothome">
        <h3>{{ $item['label'] }}</h3>
    </div>
    <div class="listupd flex">
        <div class="excstf">
            @foreach ($item['data'] as $movie)
                <article class="stylefor" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
                    <div class="bsx"><a href="{{ $movie->getUrl() }}" itemprop="url" title="{{ $movie->name }}"
                            class="tip" rel="{{ $movie->id }}">
                            <div class="limit">
                                <div class="typez">{{ $movie->quality }}</div>
                                <img src="{{ $movie->thumb_url }}"
                                    class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy"
                                    itemprop="image" title="{{ $movie->name }}" alt="{{ $movie->name }}"
                                    width="203" height="300" />
                                <div class="tt">
                                    <h2 itemprop="headline">{{ $movie->name }}</h2> <span>{{ $movie->episode_current }}
                                        <i>{{ $movie->language }}</i></span>
                                </div>
                            </div>
                        </a></div>
                </article>
            @endforeach
        </div>
        <div class="hpage"><a href="{{ $item['link'] }}" class="r">Xem thêm <i class="fa fa-chevron-right"
                    aria-hidden="true"></i></a></div>
    </div>
</div>
