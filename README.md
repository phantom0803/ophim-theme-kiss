# THEME - KISS 2023 - OPHIM CMS

## Demo
### Trang Chủ
<!-- ![Alt text](https://i.ibb.co/MBSg0Dr/BPTV-INDEX.png "Home Page") -->

### Trang Danh Sách Phim
<!-- ![Alt text](https://i.ibb.co/vZ6FKCN/BPTV-CATALOG.png "Catalog Page") -->

### Trang Thông Tin Phim
<!-- ![Alt text](https://i.ibb.co/gwTv76L/BPTV-SINGLE.png "Single Page") -->

### Trang Xem Phim
<!-- ![Alt text](https://i.ibb.co/zFL4LKT/BPTV-EPISODE.png "Episode Page") -->

## Requirements
https://github.com/hacoidev/ophim-core

## Install
1. Tại thư mục của Project: `composer require ophimcms/theme-kiss`
2. Kích hoạt giao diện trong Admin Panel

## Update
1. Tại thư mục của Project: `composer update ophimcms/theme-kiss`
2. Re-Activate giao diện trong Admin Panel

## Note
- Một vài lưu ý quan trọng của các nút chức năng:
    + `Activate` và `Re-Activate` sẽ publish toàn bộ file js,css trong themes ra ngoài public của laravel.
    + `Reset` reset lại toàn bộ cấu hình của themes
    
## Document
### List
- Trang chủ: `display_label|relation|find_by_field|value|limit|show_more_url|show_template (section_1|section_2)`
    ```
    Phim chiếu rạp mới||is_shown_in_theater|1|8|/danh-sach/phim-chieu-rap|section_1
    Phim bộ mới||type|series|20|/danh-sach/phim-bo|section_2
    Phim lẻ mới||type|single|8|/danh-sach/phim-le|section_1
    Phim hoạt hình|categories|slug|hoat-hinh|20|/the-loai/hoat-hinh|section_2
    ```

- Danh sách hot:  `Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_text|top_thumb_1|top_thumb_2)`
    ```
    Sắp chiếu||status|trailer|publish_year|desc|10|top_text
    Top phim lẻ||type|single|view_week|desc|10|top_thumb_1
    Top phim bộ||type|series|view_week|desc|10|top_thumb_2
    ```

### Custom View Blade
- File blade gốc trong Package: `/vendor/ophimcms/theme-kiss/resources/views/themekiss`
- Copy file cần custom đến: `/resources/views/vendor/themes/themekiss`
