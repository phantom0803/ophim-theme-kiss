@extends('themes::themekiss.layout')

@push('header')
    <script>
        function tsMedia(e) {
            e.matches ? jQuery("#singlepisode").appendTo(jQuery("#mobilepisode")) : jQuery("#singlepisode").prependTo(
                jQuery("#mainepisode")), tsMediaPickList()
        }

        function tsMediaSetEpNow() {
            jQuery(document).find("#singlepisode .headlist .det em.epnow").replaceWith(tsMediaEpNow || "?"),
                tsMediaSetEpNow = function() {}
        }

        function tsMediaPickList() {
            jQuery(document).find(".episodelist ul li").each(function(e, t) {
                t.getAttribute("data-id") == tsMediaSelectedId && (t.className = "selected", t.setAttribute(
                    "selected", "selected"))
            }), tsMediaShowItem(), tsMediaSetPlayIcon(), tsMediaSetEpNow()
        }

        function tsMediaShowItem() {
            var e = jQuery(document).find(".episodelist ul li.selected").get(0);
            e.parentNode.scrollTop = e.offsetTop - $(e).height()
        }

        function tsMediaSetPlayIcon() {
            jQuery(document).find(".episodelist ul li .thumbnel .nowplay").remove(), jQuery(document).find(
                ".episodelist ul li.selected .thumbnel").append(
                '<div class="nowplay"><i class="far fa-play-circle"></i></div>')
        }
        var tsmmedia = matchMedia("(max-width: 880px)");
        "addEventListener" in tsmmedia ? tsmmedia.addEventListener("change", tsMedia) : tsmmedia.addListener(tsMedia);
    </script>
@endpush

@section('mainepisode')
    @include('themes::themekiss.inc.mainepisode')
@endsection

@section('content')
    <article id="post-{{ $currentMovie->id }}" class="post-{{ $currentMovie->id }} hentry" itemscope="itemscope"
        itemtype="http://schema.org/Episode">
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
                ›
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item"
                        href=""><span itemprop="name">Tập {{ $episode->name }}</span></a>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
        <div class="megavid">
            <div class="mvelement">
                <div class="item meta">
                    <div class="tb" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <img src="{{$currentMovie->thumb_url}}"
                            class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy" width="169"
                            height="300" />
                        <meta itemprop="url"
                            content="{{$currentMovie->thumb_url}}">
                        <meta itemprop="width" content="190">
                        <meta itemprop="height" content="260">
                    </div>
                    <div class="lm">
                        <h1 class="entry-title" itemprop="name">{{ $currentMovie->name }} Tập {{ $episode->name }}</h1>

                        <div class="box-rating">
                            <div class="rate-title">
                                <span class="rate-lable"></span>
                            </div>
                            <div id="div_average" style="">
                                <span class="average" id="average" itemprop="ratingValue">
                                    {{ number_format($currentMovie->rating_star, 1) == "0.0" ? "8.0" : number_format($currentMovie->rating_star, 1) }}
                                </span>
                                điểm
                                /
                                <span id="rate_count" itemprop="reviewCount">{{ $currentMovie->rating_count == 0 ? 1 : $currentMovie->rating_count }}</span> lượt đánh giá
                            </div>
                            <div id="star" data-score="{{ number_format($currentMovie->rating_star, 1) == "0.0" ? "8.0" : number_format($currentMovie->rating_star, 1) }}"
                                style="cursor: pointer;">
                            </div>
                            <div>
                                <span id="hint"></span>
                                <meta itemprop="bestRating" content="10" />
                                <meta itemprop="worstRating" content="1" />
                                <meta itemprop="ratingValue" content="{{ number_format($currentMovie->rating_star, 1) == "0.0" ? "8.0" : number_format($currentMovie->rating_star, 1) }}" />
                                <meta itemprop="ratingCount" content="{{ $currentMovie->rating_count == 0 ? 1 : $currentMovie->rating_count }}" />
                            </div>
                        </div>
                        <span class="epx"> <span class="lg">{{ $currentMovie->language }}</span></span> <span
                            class="year"> <i class="status Hard Sub">{{ $currentMovie->language }}</i> Updated on <span
                                class="updated">{{ $currentMovie->updated_at }}</span> · <span
                                id="ts-ep-view">{{ $currentMovie->view_total }} lượt xem</span></span>
                    </div>
                    <div class="sosmed"><a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ $currentMovie->getUrl() }}&t={{ $currentMovie->name }}"
                            aria-label="Share on Facebook"><span class="fab fa-facebook-f" aria-hidden="true"></span></a> <a
                            href="https://www.twitter.com/intent/tweet?url={{ $currentMovie->getUrl() }}&text={{ $currentMovie->name }}"
                            aria-label="Share on Twitter"><span class="fab fa-twitter" aria-hidden="true"></span></a> <a
                            href="whatsapp://send?text={{ $currentMovie->name }} {{ $currentMovie->getUrl() }}"
                            aria-label="Share on Whatsapp"><span class="fab fa-whatsapp" aria-hidden="true"></span></a>
                    </div>
                </div>
                @if ($currentMovie->notify && $currentMovie->notify != '')
                    <div class="bixbox infx"><strong>Thông báo: </strong>{{ strip_tags($currentMovie->notify) }}
                    </div>
                @endif
                @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
                    <div class="bixbox infx"><strong>Lịch chiếu: </strong>{{ strip_tags($currentMovie->showtimes) }}
                    </div>
                @endif
                <div class="video-content">
                    <div class="lowvid">
                        <div class="media-player" id="pembed">
                            <p style="text-align: center;">Đang tải, đợi tí nhé ...</p>
                        </div>
                    </div>
                </div>
                <div class="item video-nav">
                    <div class="mobius">
                        <div class="iconx">
                            <div class="icol report">
                                <i class="fa fa-bug"></i>
                                <span>Báo Lỗi</span>
                            </div>
                            <div class="icol expand">
                                <i class="fa fa-expand" aria-hidden="true"></i>
                                <span>Expand</span>
                            </div>
                            <div class="icol light">
                                <i class="far fa-lightbulb"></i>
                                <span>Turn Off Light</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="change-server">
            <center>
                <ul class="server-list">
                    <li class="backup-server"> <span class="server-title">Đổi Nguồn Phát</span>
                        <ul class="list-episode">
                            <li class="episode">
                                @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                    <a data-id="{{ $server->id }}" data-link="{{ $server->link }}"
                                        data-type="{{ $server->type }}" onclick="chooseStreamingServer(this)"
                                        class="streaming-server btn-link-backup btn-episode black episode-link">Nguồn Phát
                                        #{{ $loop->index + 1 }}</a>
                                @endforeach
                            </li>
                        </ul>
                    </li>
                </ul>
            </center>
        </div>

        <div id="mobilepisode"></div>
        <div class="single-info bixbox">
            <div class="thumb"><img
                    src="{{ $currentMovie->thumb_url }}"
                    class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy" itemprop="image"
                    title="{{ $currentMovie->name }}" alt="{{ $currentMovie->name }}" width="169" height="300" /></div>
            <div class="infox">
                <div class="infolimit">
                    <h2 itemprop="partOfSeries">{{ $currentMovie->name }}</h2> <span class="alter">Tên khác: {{ $currentMovie->origin_name }}</span>
                </div>
                <div class="rating"><strong>Rating {{ number_format($currentMovie->ratting_star, 1) == 0.0 ? '8.0' : number_format($currentMovie->ratting_star, 1) }}</strong>
                    <div class="rating-prc">
                        <div class="rtp">
                            <div class="rtb"><span style="width:{{ (number_format($currentMovie->ratting_star, 1) == 0.0 ? '8.0' : number_format($currentMovie->ratting_star, 1)) * 10 }}%"></span></div>
                        </div>
                    </div>
                </div>
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
                    <div class="desc mindes">{!! $currentMovie->content !!} <span class="colap"></span>
                    </div>
                </div>
            </div>
        </div>
        @include('themes::themekiss.inc.comment')
        @include('themes::themekiss.inc.movie_related')
    </article>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#shadow").css("height", $(document).height()).hide();
            $(".light").click(function() {
                $("#shadow").toggle();
                if ($("#shadow").is(":hidden")) {
                    $(".video-content").css({'z-index':'0'})
                    $(this).html(
                        "<i class='far fa-lightbulb' aria-hidden='true'></i> <span>Turn Off Light</span>")
                    .removeClass("turnedOff");
                } else {
                    $(".video-content").css({'z-index':'1000'})
                    $(this).html(
                        "<i class='fas fa-lightbulb' aria-hidden='true'></i> <span>Turn On Light</span>")
                    .addClass("turnedOff");
                }

            });

        });
    </script>

    <script src="/themes/kiss/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/kiss/player/js/p2p-media-loader-hlsjs.min.js"></script>

    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script type="text/javascript" src="{{ asset('/themes/kiss/plugins/jquery-raty/jquery.raty.js') }}"></script>

    <script>
        var rated = false;
        $('#star').raty({
            score: {{ number_format($currentMovie->rating_star ?? 0, 1) }},
            number: 10,
            numberMax: 10,
            hints: ['quá tệ', 'tệ', 'không hay', 'không hay lắm', 'bình thường', 'xem được', 'có vẻ hay', 'hay',
                'rất hay', 'siêu phẩm'
            ],
            starOff: '/themes/kiss/plugins/jquery-raty/images/star-off.png',
            starOn: '/themes/kiss/plugins/jquery-raty/images/star-on.png',
            starHalf: '/themes/kiss/plugins/jquery-raty/images/star-half.png',
            click: function(score, evt) {
                if (rated) return
                fetch("{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]')
                            .getAttribute(
                                'content')
                    },
                    body: JSON.stringify({
                        rating: score
                    })
                }).then((response) => response.json()).then((data) => {
                    $('#rate_count').html(data.rating_count);
                    $('#average').html(data.rating_star);
                    rated = true;
                    $('#star').data('raty').readOnly(true);
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('.megavid').offset().top
            }, 'slow');
        });
    </script>

    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('pembed');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('active');
            })
            el.classList.add('active');

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer" style="height: 100%"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        height: "100%",
                        file: "/themes/kiss/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    height: "100%",
                    image: "{{ $currentMovie->poster_url ?: $currentMovie->thumb_url }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>

    <script>
        $(".report").click(() => {
            fetch("{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug, 'id' => $episode->id]) }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    message: ''
                })
            });
            alert("Báo lỗi thành công!");
            $(".report").remove();
        })
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}

@endpush
