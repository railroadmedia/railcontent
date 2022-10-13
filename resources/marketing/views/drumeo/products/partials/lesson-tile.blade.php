<div class="columns lesson-tile @if(!empty($customClass)) {{ $customClass }} @endif">
    <img src="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/tiles/{{ strtolower(str_replace(array(' ', '.'), '-', $tileTitle)) }}.jpg">
    <h1>{{ $tileTitle }}</h1>
    <p>{{ $tileDescription }}</p>
</div>