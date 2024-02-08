<div class="columns lesson-tile @if(!empty($customClass)) {{ $customClass }} @endif">
    <div class="text-center">
        <img src="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/tiles/{{ strtolower(str_replace(array(' ', '.'), '-', $tileTitle)) }}.jpg" alt="{{ $tileTitle }} Image" class="transition-all opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')">
    </div>
    <h1>{{ $tileTitle }}</h1>
    <p>{{ $tileDescription }}</p>
</div>
