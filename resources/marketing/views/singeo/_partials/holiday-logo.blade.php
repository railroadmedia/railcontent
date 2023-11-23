<img class="{{ $styles }}"
    @if(Carbon\Carbon::create(2023, 11, 27, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/promos/november/BF-sing-logo-web.png"
    @else
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/promos/november/CM-sing-logo-web.png"
    @endif
>
