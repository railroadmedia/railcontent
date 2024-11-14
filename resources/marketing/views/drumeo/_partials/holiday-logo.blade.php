@if(!empty($isProductPage))
    <img class="{{ $productPageStyles }}"
        @if(Carbon\Carbon::create(2024, 12, 02, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/BF-drummers-logo-web.png"
        @elseif(Carbon\Carbon::create(2024, 12, 03, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/CM-drummers-logo-web.png"
        @else
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/xmas-logo.png"
        @endif
    >
@else
    <img class="{{ $styles }}"
        @if(Carbon\Carbon::create(2024, 12, 02, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/BF-drummers-logo-web.png"
        @elseif(Carbon\Carbon::create(2024, 12, 03, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/CM-drummers-logo-web.png"
        @else
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/xmas-logo.png"
        @endif
    >
@endif
