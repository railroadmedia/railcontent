{{--<style>--}}
    {{--.big-promo-banner{position:relative;z-index:98;text-align:center;text-transform:uppercase;color:#193b8b}@media (min-width:991px){.big-promo-banner{text-align:left}}.big-promo-banner .noise-wrap{padding:10px 0}.big-promo-banner .row{padding:0 15px;margin:0 auto}@media (min-width:768px){.big-promo-banner .row{display:flex;align-items:center}}.big-promo-banner img{min-width:150px;width:150px;display:inline-block}@media (min-width:991px){.big-promo-banner img{min-width:200px;width:200px}}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p{font:400 17px/1.2em Bebas Neue,sans-serif;text-transform:uppercase;display:inline-block;margin:0 auto}@media (min-width:768px){.big-promo-banner p{font-size:18px}}@media (min-width:991px){.big-promo-banner p{font-size:20px;margin:0 auto;white-space:nowrap}}.big-promo-banner p strong{display:inline-block}.big-promo-banner .tzcd-big{text-transform:uppercase;display:inline-block;vertical-align:middle;margin:0 0 0 7px}@media (min-width:991px){.big-promo-banner .tzcd-big{margin:0 0 0 15px}}.big-promo-banner .tzcd-big div{float:left;text-align:center;padding:0 7px 0 0}@media (min-width:991px){.big-promo-banner .tzcd-big div{padding:0 10px 0 0}}.big-promo-banner .tzcd-big div:last-child{padding-right:0}.big-promo-banner .tzcd-big div h1{margin:0 auto;font:900 21px/1em Open Sans,sans-serif;display:block}@media (min-width:991px){.big-promo-banner .tzcd-big div h1{font-size:28px}}.big-promo-banner .tzcd-big div p{font:800 10px/1em Open Sans,sans-serif;display:block;color:#000;margin:0 auto}--}}
    {{--.promo-banner-shim{display:block;width:100%;height:40px}.promo-banner{display:block;background:#ddf7ff 50%/cover;text-align:center;color:#193b8b;width:100%;transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Bebas Neue,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:#000;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;text-transform:uppercase;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}--}}
{{--</style>--}}
{{--<div class="big-promo-banner" style="background: linear-gradient(to bottom, #dfeef2, #f9e4d3);">--}}
    {{--<div class="noise-wrap">--}}
        {{--<div class="row container tw-container mx-auto tw-mx-auto">--}}
            {{--<a href="/shop/"><img src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/july/guitareo-summer-sale-dark.png"></a>--}}
            {{--<span class="text-right tw-text-right">--}}
                    {{--<p>@if(!empty($price))--}}
                            {{--@if(round(100 - (100 * ($price / $fullPrice))) > 1)--}}
                                {{--<strong>Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</strong> on {{ $name }}.--}}
                            {{--@elseif(!empty($specialText))--}}
                                {{--{!!  $specialText  !!}--}}
                            {{--@endif--}}
                        {{--@endif</p>--}}
                    {{--@if(empty($noCountdown))--}}
                    {{--<div class="tzcd-big">--}}
                                {{--<div><h1>00</h1> <p>days</p></div>--}}
                                {{--<div><h1>00</h1> <p>hrs</p></div>--}}
                                {{--<div><h1>00</h1> <p>mins</p></div>--}}
                                {{--<div><h1>00</h1> <p>secs</p></div>--}}
                            {{--</div>--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--@if(!empty($noBreadcrumb))--}}
    {{--<a href="/shop" class="promo-banner fixed" style="background: linear-gradient(to bottom, #dfeef2, #f9e4d3);">--}}
        {{--<div class="noise-wrap">--}}
            {{--<div class="container tw-container mx-auto tw-mx-auto">--}}
                {{--<div class="text text-left">--}}
                    {{--<img class="logo" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/july/guitareo-summer-sale-dark.png">--}}
                    {{--<p>--}}
                        {{--@if(!empty($price))--}}
                            {{--@if(round(100 - (100 * ($price / $fullPrice))) > 1)--}}
                                {{--Save {{ round(100 - (100 * ($price / $fullPrice))) }}% on <br><strong>{{ $name }}</strong>.--}}
                            {{--@elseif(!empty($specialText))--}}
                                {{--{!!  $specialText !!}--}}
                            {{--@endif--}}
                        {{--@endif--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</a>--}}
{{--@endif--}}