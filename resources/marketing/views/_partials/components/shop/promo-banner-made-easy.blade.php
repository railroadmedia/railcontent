<style>
    .big-promo-banner{z-index:98;}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p.text{font:400 17px/1.2em Open Sans,sans-serif;display:inline-block;}@media (min-width:768px){.big-promo-banner p.text{font-size:16px}}@media (min-width:991px){.big-promo-banner p.text{font-size:18px;white-space:nowrap}}.big-promo-banner p.text strong{display:inline-block}
    .promo-banner-shim{display:block;width:100%;height:104px;}@media (min-width:768px){.promo-banner-shim{height:69px;}}
    .promo-banner{transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Open Sans,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:white;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
    [x-cloak] { visibility: hidden !important; }
</style>
 <div class="big-promo-banner w-full text-white text-center lg:text-left relative py-2 bg-cover bg-top shadow-lg @if(!empty($isFixed)) z-[60] sticky top-[40px] md:top-[56px] @endif"
     style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/summer-sale/header-bg.webp'); position: fixed">
   <div class="container max-w-6xl mx-auto px-3 flex flex-row justify-between items-center">
   <div class="w-2/3 sm:w-3/4"> 
            <h4 class="text-center sm:text-left mx-auto sm:mx-0 my-2 sm:my-0 uppercase"><strong>
                    @if(!empty($price))
                        @if(round(100 - (100 * ($price / $fullPrice))) > 1)
                            Save <strong>{{ round(100 - (100 * ($price / $fullPrice))) }}%</strong> on {{ $name }}
                        @elseif(!empty($specialText))
                            {!!  $specialText  !!}
                        @endif
                    @endif
                    </strong>
            </h4>
   </div> 

    <div class="w-1/3 sm:w-1/4 text-right">
        <button class="join vue-add-to-cart smaller text-white bg-pianote my-2 sm:m-2 hover:bg-red-500 max-w-[180px]" href="/ecommerce/add-to-cart?products[piano-technique-made-easy]=1"  data-product-json='{"piano-technique-made-easy": 1}'>GET STARTED</button>
    </div>
         
            {{-- <h4 class="text-white uppercase font-semibold tracking-wide"><strong>Final sale</strong></h4> --}}
        </div>
    </div>
</div>
<div class="promo-banner-shim"></div>

