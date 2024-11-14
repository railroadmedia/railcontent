
<img @if(!empty($isProductPage)) class="{{ $productPageStyles }}" @else class="{{ $styles }}" @endif
    @if(Carbon\Carbon::create(2024, 12, 02, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/bf-logo.svg"
    @elseif(Carbon\Carbon::create(2024, 12, 03, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/cm-logo.svg"
    @else
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/xm-logo.svg"
    @endif
>
