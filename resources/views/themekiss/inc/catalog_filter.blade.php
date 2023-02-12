<div class="quickfilter">
    <form action="/" class="filters " method="GET">
        <div class="filter dropdown">
            <button type="button" class="dropdown-toggle" data-toggle="dropdown"> Sắp xếp
                <span id="filtercount">Thời gian đăng</span> <i class="fa fa-angle-down"
                    aria-hidden="true"></i></button>
            <ul class="dropdown-menu c4">
                <li>
                    <input type="radio" id="sort-update" name="filter[sort]" value="update"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'update') checked @endif>
                    <label for="sort-update">Thời gian cập nhật</label>
                </li>
                <li>
                    <input type="radio" id="sort-create" name="filter[sort]" value="create"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'create') checked @endif>
                    <label for="sort-create">Thời gian đăng</label>
                </li>
                <li>
                    <input type="radio" id="sort-year" name="filter[sort]" value="year"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'year') checked @endif>
                    <label for="sort-year">Năm sản xuất</label>
                </li>
                <li>
                    <input type="radio" id="sort-view" name="filter[sort]" value="view"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'view') checked @endif>
                    <label for="sort-view">Lượt xem</label>
                </li>
            </ul>
        </div>

        <div class="filter dropdown">
            <button type="button" class="dropdown-toggle" data-toggle="dropdown"> Định dạng
                <span id="filtercount">Toàn bộ</span> <i class="fa fa-angle-down"
                    aria-hidden="true"></i></button>
            <ul class="dropdown-menu c4">
                <li>
                    <input type="radio" id="type-all" name="filter[type]" value=""
                        @if (!isset(request('filter')['type']) || request('filter')['type'] == '') checked @endif>
                    <label for="type-all">Toàn bộ</label>
                </li>
                <li>
                    <input type="radio" id="type-series" name="filter[type]" value="series"
                        @if (isset(request('filter')['type']) && request('filter')['type'] == 'series') checked @endif>
                    <label for="type-series">Phim bộ</label>
                </li>
                <li>
                    <input type="radio" id="type-single" name="filter[type]" value="single"
                        @if (isset(request('filter')['type']) && request('filter')['type'] == 'single') checked @endif>
                    <label for="type-single">Phim lẻ</label>
                </li>
            </ul>
        </div>

        <div class="filter dropdown">
            <button type="button" class="dropdown-toggle" data-toggle="dropdown"> Thể loại
                <span id="filtercount">Toàn bộ</span> <i class="fa fa-angle-down"
                    aria-hidden="true"></i></button>
            <ul class="dropdown-menu c4">
                <li>
                    <input type="radio" id="category-all" name="filter[category]" value=""
                        @if (!isset(request('filter')['category']) || request('filter')['category'] == '') checked @endif>
                    <label for="category-all">Toàn bộ</label>
                </li>
                @foreach (\Ophim\Core\Models\Category::fromCache()->all() as $item)
                    <li>
                        <input type="radio" id="category-{{ $item->id }}" name="filter[category]"
                            value="{{ $item->id }}" @if (
                                (isset(request('filter')['category']) && request('filter')['category'] == $item->id) ||
                                    (isset($category) && $category->id == $item->id)) checked @endif>
                        <label for="category-{{ $item->id }}">{{ $item->name }}</label>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="filter dropdown">
            <button type="button" class="dropdown-toggle" data-toggle="dropdown"> Quốc gia
                <span id="filtercount">Toàn bộ</span> <i class="fa fa-angle-down"
                    aria-hidden="true"></i></button>
            <ul class="dropdown-menu c4">
                <li>
                    <input type="radio" id="region-all" name="filter[region]" value=""
                        @if (!isset(request('filter')['region']) || request('filter')['region'] == '') checked @endif>
                    <label for="region-all">Toàn bộ</label>
                </li>
                @foreach (\Ophim\Core\Models\Region::fromCache()->all() as $item)
                    <li>
                        <input type="radio" id="region-{{ $item->id }}" name="filter[region]"
                            value="{{ $item->id }}" @if (
                                (isset(request('filter')['region']) && request('filter')['region'] == $item->id) ||
                                    (isset($region) && $region->id == $item->id)) checked @endif>
                        <label for="region-{{ $item->id }}">{{ $item->name }}</label>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="filter dropdown">
            <button type="button" class="dropdown-toggle" data-toggle="dropdown"> Năm phát hành
                <span id="filtercount">Toàn bộ</span> <i class="fa fa-angle-down"
                    aria-hidden="true"></i></button>
            <ul class="dropdown-menu c4">
                <li>
                    <input type="radio" id="year-all" name="filter[year]" value=""
                        @if (!isset(request('filter')['year']) || request('filter')['year'] == '') checked @endif>
                    <label for="year-all">Toàn bộ</label>
                </li>

                @foreach ($years as $year)
                    <li>
                        <input type="radio" id="year-{{ $year }}" name="filter[year]"
                            value="{{ $year }}"
                            @if (isset(request('filter')['year']) && request('filter')['year'] == $year) checked @endif>
                        <label for="year-{{ $year }}">{{ $year }}</label>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="filter submit">
            <button type="submit" class="btn btn-custom-search"><i class="fa fa-search"
                    aria-hidden="true"></i>
                Lọc Phim
            </button>
        </div>
    </form>
</div>
