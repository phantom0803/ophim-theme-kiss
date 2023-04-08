<div class="bixbox">
    <div class="releases"><h3>Phim cùng thể loại</h3></div>
    <div class="series-gen">
        <div class="listupd">
            <div id="series-390" class="tab-pane active">
                @foreach ($movie_related as $movie)
                <article class="bs" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
                    <div class="bsx"><a href="{{ $movie->getUrl() }}" itemprop="url"
                            title="{{ $movie->name }} ({{ $movie->origin_name }}) [{{ $movie->publish_year }}]"
                            class="tip" rel="{{ $movie->id }}">
                            <div class="limit">
                                @if ($movie->is_recommended)
                                    <div class="hotbadge"><i class="fas fa-fire-alt"></i></div>
                                @endif
                                @if ($movie->type == 'series' && $movie->status == 'completed')
                                    <div class="status Completed">Trọn bộ</div>
                                @endif
                                <div class="typez {{ $movie->type == 'series' ? 'Drama' : 'Movie' }}">
                                    {{ $movie->type == 'series' ? 'Phim bộ' : 'Phim lẻ' }}</div>
                                <div class="ply"><i class="far fa-play-circle"></i></div>
                                <div class="bt"><span class="epx">{{ $movie->episode_current }}</span> <span
                                        class="sb Soft Sub">{{ $movie->language }}</span></div>
                                <img src="{{ $movie->getThumbUrl() }}"
                                    class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy"
                                    itemprop="image"
                                    title="{{ $movie->name }} ({{ $movie->origin_name }}) [{{ $movie->publish_year }}]"
                                    alt="{{ $movie->name }} ({{ $movie->origin_name }}) [{{ $movie->publish_year }}]"
                                    width="240" height="300" />
                            </div>
                            <div class="ttt">
                                <div class="tt"> {{ $movie->name }}<h2 itemprop="headline">
                                        {{ $movie->origin_name }} {{ $movie->episode_current }}</h2>
                                </div>
                                <div class="timeago"> {{ $movie->origin_name }}</div>
                            </div>
                        </a></div>
                </article>
            @endforeach
            </div>
        </div>
    </div>
</div>
