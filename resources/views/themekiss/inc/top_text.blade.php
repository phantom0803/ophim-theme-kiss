<div class="section">
    <div class="releases">
        <h3>{{ $top['label'] }}</h3>
    </div>
    <span class="ts-ajax-cache">
        <div class='ongoingseries'>
            <ul>
                @foreach ($top['data'] as $movie)
                    <li>
                        <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }} {{ $movie->publish_year }}">
                            <span class="l"><i class="fas fa-angle-right"></i> {{ $movie->name }}</span>
                            <span class="r"> {{ $movie->publish_year }} </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </span>
</div>
