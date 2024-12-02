<img @if(!empty($isProductPage)) class="{{ $productPageStyles }}" @else class="{{ $styles }}" @endif
    @if(Carbon\Carbon::create(2024, 12, 03, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/december/cyber-monday/pianote-cm-logo.svg"
    @else
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/december/xm-logo.svg"
    @endif
>
