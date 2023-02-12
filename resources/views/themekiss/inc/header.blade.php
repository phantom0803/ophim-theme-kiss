@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<div class="th">
    <div class="centernav bound">
        <div class="shme"><i class="fa fa-bars" aria-hidden="true"></i></div>
        <header class="mainheader" role="banner" itemscope itemtype="http://schema.org/WPHeader">
            <div class="site-branding logox">
                <h1 class="logos">
                    <a href="/" itemprop="url" title="{{ $title }}">
                        @if ($logo)
                            {!! $logo !!}
                        @else
                            {!! $brand !!}
                        @endif
                    </a>
                </h1>
            </div>
        </header>
        <div class="searchx">
            <form method="GET" action="/" id="form" itemprop="potentialAction" itemscope
                itemtype="http://schema.org/SearchAction">
                <meta itemprop="target" content="{{ request()->getSchemeAndHttpHost() }}/?search={query}" />
                <input id="s" name="search" itemprop="query-input" class="search-live" type="text"
                    placeholder="Tìm kiếm phim..." value="{{ request('search') }}" />
                <button type="button" id="submit-search" onclick="$(this).parent().submit()">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <div id="thememode"><label class="switch"> <input type="checkbox"> <span class="slider round"></span>
            </label></div>
    </div>
</div>
<nav id="main-menu" class="mm">
    <div class="centernav">
        <div class="bound"><span itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"
                role="navigation">
                <ul id="menu-menu" class="menu">
                    @foreach ($menu as $item)
                        @if (count($item['children']))
                            <li id="menu-item-{{ $item['id'] }}"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-{{ $item['id'] }}">
                                <a href="{{$item['link']}}" itemprop="url"><span itemprop="name">{{ $item['name'] }}</span></a>
                                <ul>
                                    @foreach ($item['children'] as $children)
                                        <li>
                                            <a href="{{$children['link']}}">{{$children['name']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li id="menu-item-{{ $item['id'] }}"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-{{ $item['id'] }}">
                                <a href="{{$item['link']}}" itemprop="url"><span itemprop="name">{{ $item['name'] }}</span></a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </span>
            {!! get_theme_option('button_navbar') !!}
            <div class="clear"></div>
        </div>
    </div>
</nav>
