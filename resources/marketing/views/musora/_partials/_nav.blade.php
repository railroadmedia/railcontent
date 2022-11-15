<style>
    body {
        font-family:Open Sans, sans-serif;
        padding-top:40px
    }

    @media (min-width:768px) {
        body {
            padding-top:56px
        }
    }

    body.cart-sidebar-active {
        overflow:hidden
    }

    @media (min-width:768px) {
        body.cart-sidebar-active {
            margin-right:14px
        }
    }

    body.cart-sidebar-active .top-bar {
        z-index:2147483002
    }

    .anchor {
        display:block;
        position:relative;
        top:-86px;
        visibility:hidden
    }

    @media (min-width:768px) {
        .anchor {
            top:-105px
        }
    }

    .no-padding {
        padding-left:0;
        padding-right:0
    }

    a {
        transition:all .3s
    }

    .join {
        display:inline-block;
        font:600 20px/1em "Open Sans", sans-serif;
        letter-spacing: 0.1em;
        text-transform:uppercase;
        background:#10d05f;
        border-radius:50px;
        color:#fff;
        padding:17px 7%;
        outline:none;
        cursor:pointer;
        text-align:center;
        user-select:none;
        text-decoration:none;
        transition:background-color .3s;
        box-shadow:0 0 0 rgba(0, 0, 0, .35)
    }

    @media (min-width:768px) {
        .join {
            font-size:28px
        }
    }

    .join:focus, .join:hover {
        color:#fff;
        background:#13e868;
        box-shadow:0 0 7px rgba(0, 0, 0, .35)
    }

    .join.white {
        background:#fff;
        color:#0b76db;
    }
    
    .join.drumeo,
	.join.blue {
        background:#0b76db
    }

    .join.drumeo:focus,
    .join.drumeo:hover,
    .join.blue:focus,
    .join.blue:hover {
        background:#258ff4
    }
    .join.pianote {
        background:#ff383f
    }

    .join.pianote:focus,
    .join.pianote:hover {
        background:#ff525a
    }
    .join.guitareo {
        background:#00C9AC
    }

    .join.guitareo:focus,
    .join.guitareo:hover {
        background:#00e0bf
    }
    .join.pianote {
        background:#f61a30
    }

    .join.pianote:focus, .join.blue:hover {
        background:#ff364a
    }
    .join.singeo {
        background:#8300E9
    }

    .join.singeo:focus,
    .join.singeo:hover {
        background:#8c00ff
    }

    .join.sold-out {
        background:#777
    }

    .join.sold-out:focus, .join.sold-out:hover {
        background:#919191
    }

    .join.smaller {
        padding:7px 25px;
        font-size:13px;
    }

    @media (min-width:768px) {
        .join.smaller {
            font-size:14px;
            padding:13px 30px;
        }
    }

    .text-gradient {
        background:-webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
    }

    .top-bar {
        transition:background-color .3s, box-shadow .3s;
        background:#020815;
        box-shadow:0 0 10px rgba(0, 0, 0, .5);
        position:fixed;
        padding:0;
        top:0;
        left:0;
        width:100%;
        max-width:none;
        z-index:100;
        height:40px
    }

    @media (min-width:768px) {
        .top-bar {
            height:56px
        }
    }

    .top-bar.transparent {
        background:transparent;
        position:absolute;
        box-shadow:0 0 0 rgba(0, 0, 0, .5)
    }

    .top-bar.transparent.scrolled {
        background:#020815;
        box-shadow:0 0 10px rgba(0, 0, 0, .5);
        position:fixed
    }

    .top-bar .logo {
        display:inline-block;
        box-sizing:border-box;
        height:100%;
        width:100%;
        float:left;
        padding:11px 0 11px 10px;
        font-size:0;
        max-width:120px
    }

    @media (min-width:768px) {
        .top-bar .logo {
            padding:16px 16px;
            max-width:180px
        }
    }

    .top-bar .button-wrap, .top-bar .logo img {
        display:inline-block;
        height:100%
    }

    .top-bar .button-wrap {
        box-sizing:border-box;
        padding:6px 5px 6px 0;
        float:right
    }

    @media (min-width:768px) {
        .top-bar .button-wrap {
            padding:8px
        }
    }

    @media screen and (max-width:39.99875em) {
        .top-bar .button-wrap .show-for-medium {
            display:none !important
        }
    }

    .top-bar .button-wrap .join {
        padding:7px 10px;
        width:auto;
        font-size:13px
    }

    @media (min-width:768px) {
        .top-bar .button-wrap .join {
            font-size:14px;
            padding:13px 30px
        }
    }

    .top-bar .button-wrap .join.outline-button {
        padding:5px 12px;
        background:transparent;
        border:2px solid #fff;
        margin-right:5px
    }

    @media (min-width:768px) {
        .top-bar .button-wrap .join.outline-button {
            padding:11px 30px
        }
    }

    .top-bar .button-wrap .join.outline-button:hover {
        background:#fff;
        color:#020815
    }

    .top-bar .button-wrap .join.cart-button {
        position:relative
    }

    .top-bar .button-wrap .join.cart-button .cart-number {
        background:red;
        color:#fff;
        font:700 10px/15px Open Sans, sans-serif;
        width:15px;
        height:15px;
        border-radius:50%;
        position:absolute;
        top:0;
        right:0
    }

    .top-bar .menu-toggle {
        display:inline-block;
        box-sizing:border-box;
        padding:10px 0;
        float:right;
        height:100%;
        color:#fff;
        text-align:center;
        width:40px;
        cursor:pointer;
        -webkit-touch-callout:none;
        -webkit-user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        user-select:none
    }

    @media (min-width:768px) {
        .top-bar .menu-toggle {
            padding:18px 24px;
            width:auto
        }
    }

    .top-bar .menu-toggle span {
        background-color:#fff;
        display:block;
        transition:all .3s;
        border-radius:25px;
        width:16px;
        height:3px;
        margin:3px auto
    }

    .top-bar .menu-toggle.active span:nth-child(2) {
        opacity:0
    }

    .top-bar .menu-toggle.active span:first-child {
        transform:translateY(6px) rotate(45deg)
    }

    .top-bar .menu-toggle.active span:nth-child(3) {
        transform:translateY(-6px) rotate(-45deg)
    }

    .nav-side-bar {
        position:fixed;
        right:-325px;
        top:40px;
        height:calc(100% - 40px);
        width:275px;
        max-width:275px;
        background:#fff;
        z-index:101;
        transition:all .1s;
        overflow:auto;
        overflow-x:hidden
    }

    @media (min-width:768px) {
        .nav-side-bar {
            top:56px;
            height:calc(100% - 56px);
            width:325px;
            max-width:325px
        }
    }

    @media (min-width:1024px) {
        .nav-side-bar {
            width:325px;
            max-width:325px
        }
    }

    .nav-side-bar.active {
        right:0
    }

    .nav-side-bar .bottom-section .nav-link {
        width:100%;
        padding:10px 15px;
        font:400 16px/1.4em Open Sans, sans-serif;
        color:#333;
        position:relative;
        border-bottom:1px solid hsla(0, 0%, 49.4%, .2);
        display:inline-block;
        user-select:none;
        box-sizing:border-box
    }

    @media (min-width:768px) {
        .nav-side-bar .bottom-section .nav-link {
            padding:10px 20px;
            font-size:18px
        }
    }

    @media (min-width:1024px) {
        .nav-side-bar .bottom-section .nav-link {
            padding:10px 20px
        }
    }

    .nav-side-bar .bottom-section .nav-link:hover {
        background:#f2f2f2
    }

    .nav-side-bar .bottom-section .nav-link i {
        margin-right:5px;
        position:relative;
        top:3px;
        font-size:18px;
        width:25px;
        text-align:center
    }

    .nav-side-bar .bottom-section .nav-link i.fa, .nav-side-bar .bottom-section .nav-link i.fab, .nav-side-bar .bottom-section .nav-link i.fal, .nav-side-bar .bottom-section .nav-link i.far, .nav-side-bar .bottom-section .nav-link i.fas {
        top:0
    }

    .nav-side-bar .bottom-section .nav-link i.fa-external-link {
        color:#000;
        font-size:16px
    }

    .nav-side-bar .bottom-section .nav-link i.promo-color {
        color:#00bc75
    }

    .nav-side-bar .bottom-section .nav-link .drop-down-arrow {
        position:absolute;
        top:0;
        right:0;
        height:100%;
        width:45px;
        line-height:45px;
        text-align:center
    }

    .nav-side-bar .bottom-section .nav-link .drop-down-arrow i {
        font-size:20px;
        margin:0;
        line-height:45px;
        transition:all .1s
    }

    .nav-side-bar .bottom-section .nav-link .drop-down-arrow i.rotate {
        -webkit-transform:rotate(180deg);
        transform:rotate(180deg)
    }

    .nav-side-bar .bottom-section .lesson-links {
        max-height:0;
        overflow:hidden;
        transition:all .1s;
        -webkit-transform:translateZ(0);
        transform:translateZ(0);
        background:#f7f7f7
    }

    .nav-side-bar .bottom-section .lesson-links.active {
        max-height:500px
    }

    .nav-side-bar .bottom-section .lesson-links .nav-link {
        padding-left:30px;
        background:#f7f7f7;
        font-size:16px;
        border-bottom:1px solid hsla(0, 0%, 49.4%, .2)
    }

    .nav-side-bar .bottom-section .lesson-links .nav-link:hover {
        background:#f2f2f2
    }

    .nav-side-bar .bottom-section .lesson-links .nav-link i {
        font-size:16px;
        color:#000
    }

    .nav-side-bar .bottom-section .secondary-link {
        font:400 14px Open Sans, sans-serif;
        color:#000;
        padding:2px 20px;
        margin-bottom:0;
        margin-top:5px
    }

    .nav-side-bar .bottom-section .secondary-link:hover {
        text-decoration:underline
    }

    .nav-side-bar .shim {
        display:block;
        height:15px
    }

    .menu-overlay {
        position:fixed;
        top:0;
        height:100%;
        width:100%;
        background:rgba(0, 0, 0, .2);
        z-index:99;
        visibility:hidden;
        opacity:0;
        transition:all .3s
    }

    .menu-overlay.active {
        visibility:visible;
        opacity:1
    }
</style>
<div class="top-bar">
    <div class="logo">
        <a href="/">
            <img src="https://dmmior4id2ysr.cloudfront.net/logos/musora-logo-white.png" alt="Musora">
        </a>
    </div>
    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<div class="nav-side-bar">
    <div class="bottom-section">
        @include('public.partials._nav-link', [
            "linkName" => "Home",
            "linkIcon" => "fas fa-home",
            "linkUrl" => "/"
        ])
        @include('public.partials._nav-link', [
            "linkName" => "Contact",
            "linkIcon" => "fas fa-phone",
            "linkUrl" => get_legacy_brand_base_url("musora").'/contact'
        ])
        @include('public.partials._nav-link', [
            "linkName" => "Careers",
            "linkIcon" => "fas fa-users",
            "linkUrl" => "/careers"
        ])
        @include('public.partials._nav-link', [
            "linkName" => "About",
            "linkIcon" => "fas fa-question",
            "linkUrl" => "/about"
        ])
        @include('public.partials._nav-link', [
            "linkName" => "Ambassador Program",
            "linkIcon" => "fas fa-comment-dollar",
            "linkUrl" => "/ambassador"
        ])
        @include('public.partials._nav-link', [
            "linkName" => "Brand Guides",
            "linkIcon" => "fas fa-pencil-paintbrush",
            "linkUrl" => "/brand"
        ])
        <span class="shim"></span>
        @include('public.partials._secondary-nav-link', [
            "linkName" => "Drumeo <i class='text-gradient fas fa-external-link'></i>",
            "linkUrl" => "https://www.drumeo.com/",
            "externalLink" => true
        ])
        @include('public.partials._secondary-nav-link', [
            "linkName" => "Pianote <i class='text-gradient fas fa-external-link'></i>",
            "linkUrl" => "https://www.pianote.com/",
            "externalLink" => true
        ])
        @include('public.partials._secondary-nav-link', [
            "linkName" => "Guitareo <i class='text-gradient fas fa-external-link'></i>",
            "linkUrl" => "https://www.guitareo.com/",
            "externalLink" => true
        ])
        @include('public.partials._secondary-nav-link', [
            "linkName" => "Singeo <i class='text-gradient fas fa-external-link'></i>",
            "linkUrl" => "https://www.singeo.com/",
            "externalLink" => true
        ])
        <span class="shim"></span>
    </div>
</div>
<div class="menu-overlay"></div>