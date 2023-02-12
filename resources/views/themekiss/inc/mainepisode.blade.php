<div id="mainepisode">
    <div id="singlepisode">
        @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
            <div class="headlist">
                <div class="thumb">
                    <a href="{{$currentMovie->getUrl()}}">
                        <img src="{{$currentMovie->thumb_url}}"
                            class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy"
                            title="{{$currentMovie->name}}" alt="{{$currentMovie->name}}" width="203" height="300">
                    </a>
                </div>
                <div class="det">
                    <h3>
                        <a href="{{$currentMovie->getUrl()}}">{{$currentMovie->name}}</a>
                    </h3>
                    <span>
                        @if ($episode->server == $server) <i>Đang xem tập {{ $episode->name }}</i> - @endif {{$server}}</span>
                </div>
                <div class="search-ep">
                    <input type="text" class="search-ep-text" id="search-ep-text-{{$loop->index}}" value="" placeholder="Tìm tập nhanh...">
                    <button type="button" class="search-ep-eraser" id="search-ep-eraser-{{$loop->index}}" style="display: none; top: 4px">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div class="episodelist" id="episodelist-{{ $loop->index }}">
                <ul>
                    <li id="search-ep-no-result-{{ $loop->index }}" style="display:none; text-align: center; padding: 10px 5px">Không thấy tập này</li>
                    @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                        <li data-server="{{$loop->parent->index}}" data-name="{{$name}}" data-id="{{$item->sortByDesc('type')->first()->id}}" @if ($item->contains($episode)) class="selected" selected="selected" @endif>
                            <a href="{{ $item->sortByDesc('type')->first()->getUrl() }}" itemprop="url"
                                title="{{$currentMovie->name}} Tập {{$name}}">
                                <div class="thumbnel">
                                    @php
                                        $ep_link = $item->sortByDesc('type')->first()->link;
                                        $ep_img = str_replace('index.m3u8', '1.jpg', $ep_link, $check_replace);
                                        if ($check_replace == 0) {
                                            $ep_img = $currentMovie->poster_url ?: $currentMovie->thumb_url;
                                        }
                                    @endphp
                                    <img src="{{$ep_img}}"
                                        class="ts-post-image wp-post-image attachment-post-thumbnail size-post-thumbnail"
                                        loading="lazy" itemprop="image" title="{{$currentMovie->name}} Tập {{$name}}"
                                        alt="{{$currentMovie->name}} Tập {{$name}}" width="900" height="1332">
                                    <div class="nowplay">
                                        <i class="far fa-play-circle"></i>
                                    </div>
                                </div>
                                <div class="playinfo">
                                    <h4>{{ $currentMovie->name }} Tập {{ $name }}</h4>
                                    <span class="epname">Tập {{ $name }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    <script>
        var tsMediaSelectedId = {{$episode->id}};
        var tsMediaEpNow = "{{$episode->name}}";
        tsMedia(tsmmedia);
        tsMediaPickList();
    </script>
    <script>
        $(document).ready(function() {
            $(".search-ep-text").on("keyup", function () {
                let keyword = this.value;
                let server_id = this.getAttribute("id").split('search-ep-text-')[1];
                if(keyword && keyword != '') {
                    $(`#search-ep-eraser-${server_id}`).show();
                } else {
                    $(`#search-ep-eraser-${server_id}`).hide();
                }
                let result_count = 0;
                $(`#episodelist-${server_id} ul li`).each(function (idx, item) {
                    let item_name = item.getAttribute('data-name');
                    let item_server = item.getAttribute('data-server');
                    if (item_server == server_id) {
                        if(item_name.toLowerCase().indexOf(keyword.toLowerCase()) !== -1) {
                            $(item).show();
                            result_count++;
                        } else {
                            $(item).hide();
                        }
                    }
                })
                if(result_count == 0) $(`#search-ep-no-result-${server_id}`).show();
                else $(`#search-ep-no-result-${server_id}`).hide();
            })
            $(".search-ep-eraser").on("click", function () {
                let server_id = this.getAttribute("id").split('search-ep-eraser-')[1];
                $(`#search-ep-eraser-${server_id}`).hide();
                $(`#search-ep-text-${server_id}`).val("");
                $(`#search-ep-no-result-${server_id}`).hide();
                $(`#episodelist-${server_id} ul li`).each(function (idx, item) {
                    let item_server = item.getAttribute('data-server');
                    if (item_server == server_id) {
                        $(item).show();
                    }
                })
            })
        });
    </script>
</div>
