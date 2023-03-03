<div class="columns lesson-tile @if(!empty($customClass)) {{ $customClass }} @endif">
    <img src="{{ $imageURL }}" alt="{{ $tileTitle }} thumbnail">
    <h1>{{ $tileTitle }}</h1>
    <p>{{ $tileDescription }}</p>
</div>
