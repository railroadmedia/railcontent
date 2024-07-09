@if(!empty($isProductPage))
    <img class="{{ $productPageStyles }}"
         src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-logo-text-only.webp">
@elseif(!empty($isShop))
        <div class="flex items-center justify-center"> 
        <img class="{{ $shopStyles }}"
             src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-logo-text-only.webp">
        <img class="{{ $shopStyles }}"
             src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-hand-icon.webp"> 
        </div>
       
@else
<img class="{{ $styles }}"
             src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-logo.webp">
@endif