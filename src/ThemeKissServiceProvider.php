<?php

namespace Ophim\ThemeKiss;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeKissServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/kiss')
        ], 'kiss-assets');

        $this->publishes([
            __DIR__ . '/../resources/views/errors' => base_path('resources/views/errors')
        ], 'kiss-error-page');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'kiss' => [
                'name' => 'Theme Kiss',
                'author' => 'opdlnf01@gmail.com',
                'package_name' => 'ophimcms/theme-kiss',
                'publishes' => ['kiss-assets', 'kiss-error-page'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommended movies limit',
                        'type' => 'number',
                        'value' => 10,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 20,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 10,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template (section_1|section_2)',
                        'value' => <<<EOT
                        Phim chiếu rạp mới||is_shown_in_theater|1|8|/danh-sach/phim-chieu-rap|section_1
                        Phim bộ mới||type|series|20|/danh-sach/phim-bo|section_2
                        Phim lẻ mới||type|single|8|/danh-sach/phim-le|section_1
                        Phim hoạt hình|categories|slug|hoat-hinh|20|/the-loai/hoat-hinh|section_2
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_text|top_thumb_1|top_thumb_2)',
                        'value' => <<<EOT
                        Sắp chiếu||status|trailer|publish_year|desc|10|top_text
                        Top phim lẻ||type|single|view_week|desc|10|top_thumb_1
                        Top phim bộ||type|series|view_week|desc|10|top_thumb_2
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "data-rsssl=1 class='tsdefaultlayout' itemscope='itemscope' itemtype='http://schema.org/WebPage'",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div id="footer">
                            <footer id="colophon" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter"
                                role="contentinfo">
                                <div class="footermenu">
                                    <div class="menu-foot-container">
                                        <ul id="menu-foot" class="menu">
                                            <li id="menu-item-17253"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-17253"><a
                                                    href="/" itemprop="url">DMCA</a></li>
                                            <li id="menu-item-17256"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-17256"><a
                                                    href="/" itemprop="url">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="footercopyright">
                                    <div class="footer-az"><span class="ftaz">OPHIMCMS</span><span class="size-s">Xem phim miễn phí</span>
                                        <ul class="ulclear az-list">
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                            <li><a href="/">Text Link</a></li>
                                        </ul>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="copyright">
                                        <div class="txt">
                                            <p>This site <i>OPHIMCMS</i> does not store any files on its server. All contents
                                                are provided by non-affiliated third parties.</p>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'button_navbar',
                        'label' => 'Button Navbar ',
                        'type' => 'code',
                        'value' => <<<EOT
                        <a href="" class="surprise"><i class="fa fa-star-o" aria-hidden="true"></i>Fanpage</a>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
