<?php

    $background = '';
    $logo = '';

    if($theme === 'drumeo') {
        $background = 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg';
        $logo = 'https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png';
    }
    elseif($theme === 'pianote') {
        $background = 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/header-background.jpg';
        $logo = 'https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png';
    }
    elseif($theme === 'singeo') {
        $background = 'https://d21xeg6s76swyd.cloudfront.net/products/shop-header.jpg';
        $logo = 'https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png';
    }
    elseif($theme === 'guitareo') {
        $background = 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/black-friday/shop-bg.jpg';
        $logo = 'https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png';
    }
?>

<header class="text-center text-white bg-cover bg-center relative py-7 md:py-12" style="background-image:url({{ $background }});">
    <div class="container mx-auto">
        <div class="px-2 md:px-3">
{{--            @include($theme.'._partials.holiday-logo', [--}}
{{--                'styles' => 'h-14 sm:h-16 lg:h-20'--}}
{{--            ])--}}
            <img class="h-6 md:h-9 mx-auto" src="{{ $logo }}" alt="{{ $theme  }} logo">
            <h1 class="text-[54px] md:text-[100px] tracking-tight uppercase leading-none"><strong>SHOP!!</strong></h1>
            <p>GET LESSONS, MERCH, GEAR, & MUCH MORE!</p>
        </div>
    </div>
</header>


