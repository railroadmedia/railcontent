@extends('drumeo._partials.layout-template')

@section('global-head')
    @yield('meta')
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .imgfilter-coaches {
            filter:invert(1) brightness(.65) sepia(1) saturate(24) hue-rotate(363deg)
        }

        .imgfilter-songs {
            filter:invert(1) brightness(.1835) sepia(1) saturate(25) hue-rotate(323deg)
        }

        .imgfilter-method {
            filter:invert(1) brightness(.682) sepia(1) saturate(30) hue-rotate(126deg)
        }

        .opacity-50 {
            opacity:.5
        }

        .uppercase {
            text-transform:uppercase
        }

        .hover-scale {
            transition:all .3s;
            outline:none;
            cursor:pointer
        }

        .hover-scale:hover {
            transform:scale(1.05)
        }

        @media (min-width:768px) {
            .hover-scale:hover {
                transform:scale(1.1)
            }
        }

        .join.smaller {
            padding:7px 12px;
            font-size:13px
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:14px;
                padding:13px 30px
            }
        }

        .join.coaches {
            background-color:#fe9f13;
            color:#000
        }

        .join.coaches:hover, .join.coaches:focus {
            background:#feb446;
            color:#000
        }

        .join.white {
            background:#fff;
            color:#000
        }

        .join.white:hover, .join.white:focus {
            background:#eee;
            color:#000
        }

        .join.promo {
            background:#de0031
        }

        .join.promo:hover, .join.promo:focus {
            background:#ff1246
        }

        .join.outline {
            background:0 0;
            border:1px solid #fff;
            color:#fff;
            padding:6px 12px
        }

        @media (min-width:768px) {
            .join.outline {
                border-width:2px;
                padding:11px 30px
            }
        }

        .join.outline:hover, .join.outline:focus {
            background:#fff;
            color:#000
        }

        .join.outline.method {
            border-color:#00d6af;
            color:#00d6af
        }

        .join.outline.method:hover, .join.outline.method:focus {
            background:#00d6af;
            color:#fff
        }

        .join.outline.songs {
            border-color:#ec0061;
            color:#ec0061
        }

        .join.outline.songs:hover, .join.outline.songs:focus {
            background:#ec0061;
            color:#fff
        }

        .join.outline.coaches {
            border-color:#fe9f13;
            color:#fe9f13
        }

        .join.outline.coaches:hover, .join.outline.coaches:focus {
            background:#fe9f13;
            color:#fff
        }

        .join.outline.promo {
            border-color:#de0031;
            color:#de0031
        }

        .join.outline.promo:hover, .join.outline.promo:focus {
            background:#de0031;
            color:#fff
        }

        .play-button {
            cursor:pointer;
            outline:none;
            transition:opacity .3s;
            background:rgba(0, 0, 0, .6);
            border:3px solid #fff;
            border-radius:200px;
            text-indent:3px;
            line-height:1em;
            font-size:29px;
            padding:22px
        }

        @media (min-width:768px) {
            .play-button {
                font-size:35px;
                padding:26px 27px;
                border-width:4px
            }
        }

        @media (min-width:1024px) {
            .play-button {
                font-size:39px;
                padding:29px 30px
            }
        }

        .play-button:hover {
            opacity:.8
        }

        .header {
            position:relative;
            background:#000;
            color:#fff;
            overflow:hidden;
            height:540px
        }

        @media (min-width:768px) {
            .header {
                height:750px
            }
        }

        @media (min-width:1024px) {
            .header {
                height:850px
            }
        }

        .header video {
            object-fit:cover;
            height:100%;
            width:100%;
            position:relative;
            z-index:1
        }

        .header .centered {
            left:50%;
            width:100%;
            position:absolute;
            z-index:3;
            transform:translate(-50%, -50%);
            top:50%
        }

        .header .centered .join {
            margin-top:10px
        }

        @media (min-width:768px) {
            .header .centered .join {
                margin-top:20px
            }
        }

        @media (min-width:1024px) {
            .header .centered .join {
                margin-top:30px
            }
        }

        .header h1 {
            font-size:30px
        }

        @media (min-width:768px) {
            .header h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            .header h1 {
                font-size:46px
            }
        }

        .header h5 {
            width:100%;
            line-height:1.3em;
            max-width:290px;
            margin:10px auto 0
        }

        @media (min-width:768px) {
            .header h5 {
                max-width:540px;
                margin:15px auto 0
            }
        }

        .header .bottom {
            position:absolute;
            z-index:3;
            bottom:0;
            left:0;
            right:0
        }

        .header .awards {
            width:100%;
            max-width:530px;
            display:inline-block;
            margin:0 auto
        }

        .header .awards img {
            width:auto;
            max-height:35px
        }

        @media (min-width:1024px) {
            .header .awards img {
                max-height:50px
            }
        }

        .header .awards p {
            font:400 10px/1.2em "Open Sans", sans-serif;
            margin:7px auto 0
        }

        @media (min-width:1024px) {
            .header .awards p {
                font-size:11px
            }
        }

        .header .down-arrow {
            display:inline-block;
            text-shadow:0 0 10px rgba(0, 0, 0, .7);
            color:#fff;
            font-size:22px
        }

        @media (min-width:768px) {
            .header .down-arrow {
                font-size:35px
            }
        }

        .header .overlay {
            background:rgba(0, 0, 0, .5);
            background:linear-gradient(to bottom, rgba(1, 8, 15, 0.7) 0%, rgba(11, 118, 219, 0.7) 100%);
            height:100%;
            position:absolute;
            width:100%;
            top:0;
            left:0;
            z-index:2
        }

        .content-section {
            background:#000a1e center top/contain no-repeat;
            color:#fff;
            position:relative;
            overflow:hidden;
            padding:30px 0;
            background-size:800px
        }

        @media (min-width:768px) {
            .content-section {
                padding:50px 0;
                background-size:1050px
            }
        }

        @media (min-width:1024px) {
            .content-section {
                padding:70px 0;
                background-size:1550px
            }
        }

        .content-section.learn-faster .logo {
            height:30px;
            margin:0 auto 15px
        }

        @media (min-width:768px) {
            .content-section.learn-faster .logo {
                height:50px;
                margin:0 auto 25px
            }
        }

        @media (min-width:1024px) {
            .content-section.learn-faster .logo {
                height:78px;
                margin:0 auto 45px
            }
        }

        .content-section.learn-faster h6 {
            line-height:1.3em;
            margin:7px auto 0
        }

        @media (min-width:768px) {
            .content-section.learn-faster h6 {
                margin:10px auto 0
            }
        }

        @media (min-width:1024px) {
            .content-section.learn-faster h6 {
                margin:20px auto 0
            }
        }

        .content-section.learn-faster .play-button {
            margin:80px auto
        }

        @media (min-width:768px) {
            .content-section.learn-faster .play-button {
                margin:120px auto
            }
        }

        @media (min-width:1024px) {
            .content-section.learn-faster .play-button {
                margin:180px auto
            }
        }

        .content-section.learn-faster .text-wrap {
            margin:0 auto 40px;
            font-size:0
        }

        @media (min-width:768px) {
            .content-section.learn-faster .text-wrap {
                margin:0 auto
            }
        }

        .content-section.learn-faster .text-wrap:last-child {
            margin-bottom:0
        }

        .content-section.learn-faster .text-wrap .icon {
            display:inline-block;
            margin:0 auto;
            height:28px
        }

        @media (min-width:768px) {
            .content-section.learn-faster .text-wrap .icon {
                height:35px
            }
        }

        @media (min-width:1024px) {
            .content-section.learn-faster .text-wrap .icon {
                height:49px
            }
        }

        .content-section.learn-faster .text-wrap i {
            font-size:28px
        }

        @media (min-width:768px) {
            .content-section.learn-faster .text-wrap i {
                font-size:35px
            }
        }

        @media (min-width:1024px) {
            .content-section.learn-faster .text-wrap i {
                font-size:49px
            }
        }

        .content-section.learn-faster .text-wrap img {
            width:100%;
            margin:7px auto 0;
            height:13px
        }

        @media (min-width:768px) {
            .content-section.learn-faster .text-wrap img {
                height:17px
            }
        }

        @media (min-width:1024px) {
            .content-section.learn-faster .text-wrap img {
                height:19px
            }
        }

        .content-section.learn-faster .text-wrap h3 {
            line-height:1.2em;
            margin:15px auto 10px
        }

        @media (min-width:1024px) {
            .content-section.learn-faster .text-wrap h3 {
                margin:25px auto 15px
            }
        }

        .content-section.learn-faster .text-wrap p {
            margin:0 auto;
            max-width:300px
        }

        @media (min-width:768px) {
            .content-section.learn-faster .text-wrap p {
                max-width:100%
            }
        }

        .content-section.learn-faster .text-wrap p em {
            display:block;
            margin:10px auto 0
        }

        .content-section.learn-faster .text-wrap p i {
            vertical-align:middle;
            font-size:15px
        }

        @media (min-width:768px) {
            .content-section.learn-faster .text-wrap p i {
                font-size:18px
            }
        }


        .content-section.songs-info h2 {
            margin:0 auto 15px
        }

        @media (min-width:768px) {
            .content-section.songs-info h2 {
                margin:0 auto 20px
            }
        }

        .content-section.songs-info h6 {
            line-height:1.3em
        }

        .content-section.songs-info .flex-container {
            width:100%;
            padding:0 20px;
            margin:15px auto 35px
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container {
                display:flex;
                align-items:center;
                margin:60px auto 40px;
                padding:0 30px;
                max-width:1150px
            }
        }

        @media (min-width:1024px) {
            .content-section.songs-info .flex-container {
                margin:80px auto 40px
            }
        }

        .content-section.songs-info .flex-container .pic-wrap {
            margin:20px auto;
            min-height:386px;
            width:220px;
            min-width:220px
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .pic-wrap {
                order:1;
                margin:0;
                min-height:457px;
                width:290px;
                min-width:290px;
                padding-left:30px
            }
        }

        @media (min-width:1024px) {
            .content-section.songs-info .flex-container .pic-wrap {
                min-height:665px;
                width:430px;
                min-width:430px;
                padding-left:50px
            }
        }

        .content-section.songs-info .flex-container .pic-wrap.on-left {
            padding-left:0
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .pic-wrap.on-left {
                order:0;
                padding-right:30px
            }
        }

        @media (min-width:1024px) {
            .content-section.songs-info .flex-container .pic-wrap.on-left {
                padding-right:50px
            }
        }

        .content-section.songs-info .flex-container .side-pic {
            display:none;
            width:100%
        }

        .content-section.songs-info .flex-container .side-pic.mobile-feature {
            display:block
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .side-pic.mobile-feature {
                display:none
            }
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .side-pic.active {
                display:block
            }
        }

        .content-section.songs-info .flex-container .text-icon-wrap {
            display:flex;
            margin:0 auto 20px
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .text-icon-wrap {
                cursor:pointer;
                opacity:.4;
                margin:0 auto 35px
            }
        }

        @media (min-width:1024px) {
            .content-section.songs-info .flex-container .text-icon-wrap {
                margin:0 auto 60px
            }
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .text-icon-wrap:hover {
                opacity:.6
            }
        }

        .content-section.songs-info .flex-container .text-icon-wrap:last-child {
            margin-bottom:0
        }

        .content-section.songs-info .flex-container .text-icon-wrap.active, .content-section.songs-info .flex-container .text-icon-wrap.active:hover {
            opacity:1
        }

        .content-section.songs-info .flex-container .text-icon-wrap i {
            font-size:25px;
            padding-right:15px;
            min-width:45px
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .text-icon-wrap i {
                font-size:35px;
                min-width:55px
            }
        }

        @media (min-width:1024px) {
            .content-section.songs-info .flex-container .text-icon-wrap i {
                font-size:40px;
                min-width:80px
            }
        }

        .content-section.songs-info .flex-container .text-icon-wrap h3 {
            margin:0 auto 10px
        }

        @media (min-width:768px) {
            .content-section.songs-info .flex-container .text-icon-wrap h3 {
                margin:0 auto 15px
            }
        }

        .content-section.songs-info .flex-container .text-icon-wrap p {
            line-height:1.4em
        }

        .content-section.coaches-info .text-section {
            width:100%;
            margin:20px auto 0;
            padding:0 20px
        }

        @media (min-width:768px) {
            .content-section.coaches-info .text-section {
                display:flex;
                max-width:960px;
                margin:40px auto 0;
                align-items:flex-start;
                padding:0 20px
            }
        }

        @media (min-width:1024px) {
            .content-section.coaches-info .text-section {
                align-items:center;
                padding:0 30px
            }
        }

        .content-section.coaches-info .text-section img {
            height:300px
        }

        @media (min-width:768px) {
            .content-section.coaches-info .text-section img {
                height:512px
            }
        }

        @media (min-width:1024px) {
            .content-section.coaches-info .text-section img {
                height:670px
            }
        }

        .content-section.coaches-info .text-section p {
            margin:20px auto
        }

        @media (min-width:768px) {
            .content-section.coaches-info .text-section p {
                margin:0;
                padding-left:30px
            }
        }

        @media (min-width:1024px) {
            .content-section.coaches-info .text-section p {
                padding-left:60px
            }
        }

        .content-section.better-legends h3 {
            margin:0 auto 10px
        }

        @media (min-width:768px) {
            .content-section.better-legends h3 {
                margin:25px auto 15px
            }
        }

        .content-section.better-legends hr {
            border-color:#fe9f13;
            max-width:150px;
            margin:20px auto
        }

        .content-section.better-legends p.text-light-navy {
            width:100%;
            max-width:340px
        }

        @media (min-width:768px) {
            .content-section.better-legends p.text-light-navy {
                max-width:660px
            }
        }

        .content-section.better-legends p.text-coaches {
            margin:20px auto 30px
        }

        @media (min-width:768px) {
            .content-section.better-legends p.text-coaches {
                margin:30px auto 0
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends p.text-coaches {
                margin:30px auto -10px
            }
        }

        .content-section.better-legends .coaches-bg {
            background-color:#040718;
            position:relative;
            padding:0
        }

        @media (min-width:768px) {
            .content-section.better-legends .coaches-bg {
                padding:40px 0 0
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .coaches-bg {
                padding:50px 0 0
            }
        }

        .content-section.better-legends .coaches-bg::before {
            content:' ';
            position:absolute;
            left:0;
            right:0;
            height:140px;
            border-bottom:5px solid #000a1e;
            z-index:1;
            transform:rotate(-4deg);
            background:#000a1e url(https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-graphics-1.png) 120% 100px/150px no-repeat;
            top:-120px
        }

        @media (min-width:768px) {
            .content-section.better-legends .coaches-bg::before {
                background-position:100% 73px;
                background-size:210px;
                top:-100px
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .coaches-bg::before {
                top:-70px;
                background-size:270px
            }
        }

        .content-section.better-legends .coaches-bg::after {
            content:' ';
            position:absolute;
            left:0;
            right:0;
            height:140px;
            z-index:1;
            background:#000a1e;
            transform:rotate(4deg);
            bottom:-120px
        }

        @media (min-width:768px) {
            .content-section.better-legends .coaches-bg::after {
                bottom:-100px
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .coaches-bg::after {
                bottom:-70px
            }
        }

        .content-section.better-legends .coaches-wrap {
            position:relative;
            width:100%;
            max-width:400px;
            display:inline-block
        }

        @media (min-width:768px) {
            .content-section.better-legends .coaches-wrap {
                max-width:850px
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .coaches-wrap {
                max-width:1000px
            }
        }

        .content-section.better-legends .coaches-wrap .coach {
            background:#00141d center 10%/cover no-repeat;
            overflow:hidden;
            cursor:pointer;
            position:relative;
            transition:all .3s;
            margin:0 auto 15px;
            padding-bottom:52.65%;
            border-radius:25px
        }

        @media (min-width:768px) {
            .content-section.better-legends .coaches-wrap .coach {
                border-radius:35px
            }
        }

        .content-section.better-legends .coaches-wrap .coach:hover {
            filter:brightness(1.15)
        }

        .content-section.better-legends .coaches-wrap .coach:hover .hover-icon {
            opacity:1
        }

        .content-section.better-legends .coaches-wrap .coach:after {
            content:' ';
            top:0;
            position:absolute;
            left:0;
            right:0;
            bottom:0;
            background:linear-gradient(90deg, #00141d 5%, transparent 60%);
            z-index:0
        }

        .content-section.better-legends .coaches-wrap .coach .top-icon {
            position:absolute;
            top:15px;
            left:15px;
            z-index:1
        }

        .content-section.better-legends .coaches-wrap .coach .top-icon img {
            height:10px;
            margin-right:5px
        }

        .content-section.better-legends .coaches-wrap .coach .top-icon img.icon {
            height:18px
        }

        .content-section.better-legends .coaches-wrap .coach .hover-icon {
            position:absolute;
            top:20px;
            right:20px;
            font-size:25px;
            z-index:1;
            transition:all .3s
        }

        @media (min-width:1024px) {
            .content-section.better-legends .coaches-wrap .coach .hover-icon {
                opacity:0
            }
        }

        .content-section.better-legends .coaches-wrap .coach .text-wrap {
            position:absolute;
            left:15px;
            color:#fff;
            text-transform:uppercase;
            text-align:left;
            text-shadow:0 0 5px #000;
            z-index:2;
            user-select:none;
            bottom:15px
        }

        @media (min-width:1024px) {
            .content-section.better-legends .coaches-wrap .coach .text-wrap {
                transform:translate(0, -50%);
                bottom:unset;
                top:50%
            }
        }

        .content-section.better-legends .coaches-wrap .coach .text-wrap h2 {
            padding:0;
            line-height:1em;
            transition:all .5s;
            margin:0 auto 7px
        }

        @media (min-width:1024px) {
            .content-section.better-legends .coaches-wrap .coach .text-wrap h2 {
                margin:0 auto 15px
            }
        }

        .content-section.better-legends .text-spacer {
            margin:30px auto
        }

        @media (min-width:768px) {
            .content-section.better-legends .text-spacer {
                margin:40px auto
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .text-spacer {
                margin:50px auto
            }
        }

        .content-section.better-legends .flex-container {
            width:100%;
            padding:0 20px;
            margin:15px auto 35px
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container {
                display:flex;
                align-items:center;
                padding:0 30px;
                max-width:1150px;
                margin:0 auto 50px
            }
        }

        .content-section.better-legends .flex-container .pic-wrap {
            margin:20px auto;
            min-height:386px;
            width:220px;
            min-width:220px
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container .pic-wrap {
                margin:0;
                min-height:457px;
                width:290px;
                min-width:290px;
                padding-right:30px
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .flex-container .pic-wrap {
                min-height:665px;
                width:430px;
                min-width:430px;
                padding-right:50px
            }
        }

        .content-section.better-legends .flex-container .side-pic {
            display:none;
            width:100%
        }

        .content-section.better-legends .flex-container .side-pic.mobile-feature {
            display:block
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container .side-pic.mobile-feature {
                display:none
            }
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container .side-pic.active {
                display:block
            }
        }

        .content-section.better-legends .flex-container .text-icon-wrap {
            display:flex;
            margin:0 auto 20px
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container .text-icon-wrap {
                cursor:pointer;
                margin:0 auto 35px
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .flex-container .text-icon-wrap {
                margin:0 auto 60px
            }
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container .text-icon-wrap:hover {
                opacity:.6
            }
        }

        .content-section.better-legends .flex-container .text-icon-wrap:last-child {
            margin-bottom:0
        }

        .content-section.better-legends .flex-container .text-icon-wrap.active, .content-section.better-legends .flex-container .text-icon-wrap.active:hover {
            opacity:1
        }

        .content-section.better-legends .flex-container .text-icon-wrap i {
            font-size:25px;
            padding-right:15px;
            min-width:45px
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container .text-icon-wrap i {
                font-size:35px;
                min-width:55px
            }
        }

        @media (min-width:1024px) {
            .content-section.better-legends .flex-container .text-icon-wrap i {
                font-size:40px;
                min-width:80px
            }
        }

        .content-section.better-legends .flex-container .text-icon-wrap h3 {
            margin:0 auto 10px
        }

        @media (min-width:768px) {
            .content-section.better-legends .flex-container .text-icon-wrap h3 {
                margin:0 auto 15px
            }
        }

        .content-section.better-legends .flex-container .text-icon-wrap p {
            line-height:1.4em
        }



        .reveal-overlay {
            position:fixed;
            top:0;
            right:0;
            bottom:0;
            left:0;
            z-index:2147483002;
            display:none;
            overflow-y:auto;
            background-color:rgba(0, 0, 0, .8)
        }

        .reveal-overlay:after {
            -moz-osx-font-smoothing:grayscale;
            -webkit-font-smoothing:antialiased;
            font-family:"font awesome 5 pro";
            font-weight:900;
            font-style:normal;
            font-variant:normal;
            text-rendering:auto;
            content:"\f00d";
            color:#fff;
            z-index:1;
            opacity:.8;
            position:absolute;
            margin:0;
            line-height:1em;
            text-align:center;
            display:inline-block;
            outline:none;
            top:0;
            right:0;
            font-size:35px;
            width:35px
        }

        @media (min-width:768px) {
            .reveal-overlay:after {
                top:7px;
                right:7px;
                font-size:50px;
                width:50px
            }
        }

        .reveal-overlay .reveal {
            z-index:1006;
            -webkit-backface-visibility:hidden;
            backface-visibility:hidden;
            display:none;
            background-color:#fefefe;
            position:relative;
            top:100px;
            margin-right:auto;
            margin-left:auto;
            overflow-y:auto;
            width:95%;
            max-width:75rem;
            height:inherit;
            min-height:0;
            outline:none;
            padding:0;
            border:none;
            border-radius:7px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal {
                right:auto;
                left:auto;
                margin:0 auto
            }
        }

        .reveal-overlay .reveal .flex-video {
            margin:0 auto
        }

        .reveal-overlay .reveal p {
            margin:5px auto
        }

        .reveal-overlay .reveal .join {
            margin:10px auto
        }

        .reveal-overlay .reveal.annual-pitch {
            max-width:740px;
            padding:15px 20px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.annual-pitch {
                padding:15px 30px
            }
        }

        @media (min-width:1024px) {
            .reveal-overlay .reveal.annual-pitch {
                padding:15px 50px
            }
        }

        .reveal-overlay .reveal.annual-pitch h3 {
            line-height:1.3em
        }

        .reveal-overlay .reveal.annual-pitch .flex-video {
            margin:20px auto;
            border-radius:7px
        }

        .reveal-overlay .reveal.annual-pitch .join {
            margin:0 auto
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.annual-pitch .join {
                width:75%
            }
        }

        .reveal-overlay .reveal.annual-pitch p {
            font-size:13px
        }

        .reveal-overlay .reveal.level-wrap, .reveal-overlay .reveal.coach-wrap {
            user-select:none;
            border-radius:10px;
            text-align:center;
            overflow:visible;
            position:relative;
            max-width:310px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap, .reveal-overlay .reveal.coach-wrap {
                max-width:450px
            }
        }

        .reveal-overlay .reveal.level-wrap .top-image, .reveal-overlay .reveal.coach-wrap .top-image {
            position:relative;
            background:#333 center top/cover no-repeat;
            border-radius:10px 10px 0 0
        }

        .reveal-overlay .reveal.level-wrap .top-image .top-icon, .reveal-overlay .reveal.coach-wrap .top-image .top-icon {
            position:absolute;
            top:15px;
            left:15px;
            z-index:1
        }

        .reveal-overlay .reveal.level-wrap .top-image .top-icon img, .reveal-overlay .reveal.coach-wrap .top-image .top-icon img {
            height:10px;
            margin-right:5px
        }

        .reveal-overlay .reveal.level-wrap .top-image .top-icon img.icon, .reveal-overlay .reveal.coach-wrap .top-image .top-icon img.icon {
            height:18px
        }

        .reveal-overlay .reveal.level-wrap .top-image .centered-wrap, .reveal-overlay .reveal.coach-wrap .top-image .centered-wrap {
            position:relative;
            z-index:2;
            color:#fff
        }

        .reveal-overlay .reveal.level-wrap .top-image .centered-wrap img, .reveal-overlay .reveal.coach-wrap .top-image .centered-wrap img {
            width:175px
        }

        .reveal-overlay .reveal.level-wrap .bottom-details, .reveal-overlay .reveal.coach-wrap .bottom-details {
            padding:15px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .bottom-details, .reveal-overlay .reveal.coach-wrap .bottom-details {
                padding:20px
            }
        }

        .reveal-overlay .reveal.level-wrap .bottom-details strong, .reveal-overlay .reveal.coach-wrap .bottom-details strong {
            font-weight:900
        }

        .reveal-overlay .reveal.level-wrap .bottom-details p, .reveal-overlay .reveal.coach-wrap .bottom-details p {
            margin:0 auto 3px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .bottom-details p, .reveal-overlay .reveal.coach-wrap .bottom-details p {
                margin:7px auto
            }
        }

        .reveal-overlay .reveal.level-wrap .bottom-details p.text-blue, .reveal-overlay .reveal.level-wrap .bottom-details p.text-coaches, .reveal-overlay .reveal.coach-wrap .bottom-details p.text-blue, .reveal-overlay .reveal.coach-wrap .bottom-details p.text-coaches {
            text-transform:uppercase
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles {
            margin:0 auto 5px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles {
                margin:0 auto 10px
            }
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble {
            display:inline-block;
            padding:0 5px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble {
                padding:0 10px
            }
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble p, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble p {
            font:400 10px/1.2em "Open Sans", sans-serif;
            margin:0 auto;
            text-transform:uppercase
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble p i, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble p i {
            font-size:12px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble p i, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble p i {
                font-size:13px
            }
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble p strong, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble p strong {
            line-height:1.2em;
            color:#000;
            font-size:13px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble p strong, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble p strong {
                font-size:14px
            }
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble.facebook, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble.facebook {
            color:#3b5998
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble.youtube, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble.youtube {
            color:#cd201f
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble.instagram, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble.instagram {
            color:#e1306c
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble.spotify, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble.spotify {
            color:#1db954
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .social-bubbles .bubble.grammy, .reveal-overlay .reveal.coach-wrap .bottom-details .social-bubbles .bubble.grammy {
            color:#b69859
        }

        .reveal-overlay .reveal.level-wrap .bottom-details .bio, .reveal-overlay .reveal.coach-wrap .bottom-details .bio {
            margin:0 auto;
            text-align:left;
            line-height:1.3em
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .bottom-details .bio, .reveal-overlay .reveal.coach-wrap .bottom-details .bio {
                line-height:1.5em
            }
        }

        .reveal-overlay .reveal.level-wrap .next-prev, .reveal-overlay .reveal.coach-wrap .next-prev {
            position:absolute;
            top:50%;
            color:#fff;
            cursor:pointer;
            font-size:50px;
            padding:10px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .next-prev, .reveal-overlay .reveal.coach-wrap .next-prev {
                font-size:70px;
                padding:10px 20px
            }
        }

        .reveal-overlay .reveal.level-wrap .next-prev.fa-angle-left, .reveal-overlay .reveal.coach-wrap .next-prev.fa-angle-left {
            left:-37px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .next-prev.fa-angle-left, .reveal-overlay .reveal.coach-wrap .next-prev.fa-angle-left {
                left:-70px
            }
        }

        .reveal-overlay .reveal.level-wrap .next-prev.fa-angle-right, .reveal-overlay .reveal.coach-wrap .next-prev.fa-angle-right {
            right:-37px
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .next-prev.fa-angle-right, .reveal-overlay .reveal.coach-wrap .next-prev.fa-angle-right {
                right:-70px
            }
        }

        .reveal-overlay .reveal.level-wrap .top-image {
            padding:50px 0
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.level-wrap .top-image {
                padding:70px 0
            }
        }

        .reveal-overlay .reveal.level-wrap .top-image:after {
            content:'';
            position:absolute;
            z-index:1;
            top:0;
            bottom:0;
            left:0;
            right:0;
            border-radius:7px;
            overflow:hidden;
            background:linear-gradient(to bottom, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.4) 30%, rgba(11, 118, 219, 0.6) 100%)
        }

        .reveal-overlay .reveal.coach-wrap .top-image {
            padding-bottom:50%
        }

        @media (min-width:768px) {
            .reveal-overlay .reveal.coach-wrap .top-image {
                padding-bottom:62%
            }
        }
        .header {
            height:570px;
        }
        @media (min-width: 768px) {
            .header {
                height: 750px;
            }
        }
        @media (min-width: 1024px) {
            .header {
                height: 850px;
            }
        }
        .header .join {
            padding-left:25px;
            padding-right:25px;
        }
        @media (min-width: 768px) {
            .header .join {
                padding-left:40px;
                padding-right:40px;
            }
        }
        .content-section.method-info:after {
            content:none;
        }
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "edgeVersion" => true,
        "scrollToJoin" => true,
    ])

    @yield('content')

    <section class="content-section text-center learn-faster" style="background-image:url(https://cdn.musora.com/image/fetch/w_2400,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/faster-background-alt.jpg);">
        <div class="container mx-auto clearfix">
            <h2><strong>Learn the drums faster, <br class="inline-block lg:hidden"> easier, better. Guaranteed.</strong></h2>
            <i class="fas fa-play play-button methodvideo autoplay-video" data-open="trailer"></i>
            <br>
            <div class="float-left w-full px-1 md:px-2 lg:px-7 md:w-1/3 text-wrap">
                <i class="icon-drumeo-method text-method"></i>
                <img class="imgfilter-method lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg">
                <h4 class="mt-4 md:mt-6 mb-3 md:mb-4"><strong>Step-By-Step<br class="hidden sm:inline"> Curriculum</strong></h4>
                <p>Stop wasting your practice time on random drum lessons. With an exclusive curriculum featuring the best teachers in the world, you’ll always know what to work on for maximum results.
                <em class="text-method">
                    <i class="far fa-check"></i> 10-level drum curriculum<br>
                    <i class="far fa-check"></i> {{ Prices::$courses }}+ courses from drum legends<br>
                    <i class="far fa-check"></i> All skill levels, topics, and styles</em>
                </p>
            </div>
            <div class="float-left w-full px-1 md:px-2 lg:px-7 md:w-1/3 text-wrap">
                <i class="icon-songs text-songs"></i>
                <img class="imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg">
                <h4 class="mt-4 md:mt-6 mb-3 md:mb-4"><strong>{{ Prices::$songs }}+ Songs &<br class="hidden sm:inline"> Practice Tools</strong></h4>
                <p>Nothing is better than playing real music! You’ll love our songs area - including full transcriptions, audio loops, and practice tools for music by popular bands of all eras and styles.
                <em class="text-songs">
                    <i class="far fa-check"></i> {{ Prices::$songs }}+ play-along songs<br>
                    <i class="far fa-check"></i> Full transcriptions & practice tools<br>
                    <i class="far fa-check"></i> Practice anytime on any device</em>
                </p>
            </div>
            <div class="float-left w-full px-1 md:px-2 lg:px-7 md:w-1/3 text-wrap">
                <img class="icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg">
                <img class="imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg">
                <h4 class="mt-4 md:mt-6 mb-3 md:mb-4"><strong>Motivation <br class="hidden sm:inline">& Support</strong></h4>
                <p>Your favorite drummers have never been closer! You’ll get weekly live events and personal feedback with drum legends -- sharing their best advice and guiding your drumming journey.
                    <em class="text-coaches">
                    <i class="far fa-check"></i> Connect with your drum heroes<br>
                    <i class="far fa-check"></i> 10+ live events every week<br>
                    <i class="far fa-check"></i> Personal feedback & video reviews</em>
                </p>
            </div>
        </div>
    </section>


    @include("drumeo.sales.partials._subscribe-options")

    <div class="reveal large" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/495414119?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="/marketing/js/drumeo/jquery.countdown-2.min.js"></script>
    <script>
        $(function() {
            $('.tzcd-full').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
    @yield('scripts')
@stop
