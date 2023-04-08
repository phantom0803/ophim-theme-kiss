@extends('themes::themekiss.layout')

@php
    $years = Cache::remember('all_years', \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60), function () {
        return \Ophim\Core\Models\Movie::select('publish_year')
            ->distinct()
            ->pluck('publish_year')
            ->sortDesc();
    });
@endphp

@section('breadcrumb')
@endsection

@section('content')
    <div class="bixbox bixboxarc bbnofrm">
        <div class="releases">
            <h1><span>{{ $section_name }}</span></h1>
        </div>
        <div class="mrgn">
            <div class="advancedsearch">
                @include('themes::themekiss.inc.catalog_filter')
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="listupd">
                @if (count($data))
                    @foreach ($data as $movie)
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
                @else
                    <p>Không có dữ liệu cho mục này!</p>
                @endif
            </div>
            {{ $data->appends(request()->all())->links('themes::themekiss.inc.pagination') }}
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
@endsection

@push('scripts')
    <script type='text/javascript' src='{{ asset('/themes/kiss/js/filter.js') }}' id='filter-js'></script>
@endpush
