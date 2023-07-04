@extends('pianote.lead-gen.lead-gen-layout-tw',[ 'appTailwind' => true, ])

@section('meta')
    @parent
    <title>Getting Started On The Piano</title>
    <meta name="description" content="Go from absolute beginner to playing your first song in four easy lessons!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started-2022/share-image.jpg" style="display: none;">
    <meta property="og:title" content="Getting Started On The Piano">
    <meta property="og:description" content="Go from absolute beginner to playing your first song in four easy lessons!">
    <meta property="og:url" content="https://www.pianote.com/getting-started">
@endsection

@section('head')
    <style>
        .container.thank-you {
            padding:30px 15px;
        }

        @media (min-width:768px) {
            .container.thank-you {
                width:750px;
                padding:50px 15px;
            }
        }

        @media (min-width:992px) {
            .container.thank-you {
                width:850px;
            }
        }

        p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto;
        }

        @media (min-width:768px) {
            p {
                font-size:19px;
            }
        }

        @media (min-width:992px) {
            p {
                font-size:23px;
            }
        }

        h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#F61A30;
        }

        @media (min-width:768px) {
            h2 {
                font-size:40px;
                margin:20px auto;
            }
        }

        @media (min-width:992px) {
            h2 {
                font-size:50px;
            }
        }

        .video-wrap {
            margin:0 auto 15px;
        }

        p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px;
        }

        @media (min-width:768px) {
            p em {
                font-size:14px;
            }
        }

        .social-links a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 10px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px;
        }

        @media (min-width:768px) {
            .social-links a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0;
            }
        }

        @media (min-width:992px) {
            .social-links a {
                width:90px;
                height:90px;
                line-height:90px;
                font-size:45px;
            }
        }
    </style>
@endsection

@section('page-body')
    <div class="thank-you container text-center mx-auto lg:max-w-5xl">
        <p><strong>You're Almost There!</strong></p>
        <h2>Check your email</h2>
        <div class="video-wrap">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/332020736" frameborder="0" allowfullscreen title="getting-started-thank-you-video"></iframe>
            </div>
        </div>
        <p style="color:#333;">
            <em>You should receive an email from <a class="text-blue-600" href="mailto:team@pianote.com?">team@pianote.com</a> within 10 minutes.
            <br class="hidden md:inline">
            If you don’t, then check your spam folder or re-enter your email address again.
            <br class="hidden md:inline">
            Or you can contact us <a class="text-blue-600" href="{{ get_musora_brand_base_url() }}/contact">here</a><br><br>
            You can also reach us any time <a class="text-blue-600" href="tel:+18004398921">1-800-439-8921</a><br class="md:hidden"> or directly at <a class="text-blue-600" href="tel:+16048557605">1-604-855-7605</a>.</em>
        </p>
        <div class="social-links">
            <a href="https://youtube.com/user/pianolessonscom" target="_blank" class="youtube" aria-label="youtube">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="https://facebook.com/pianoteofficial" target="_blank" class="facebook" aria-label="facebook">
                    <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://instagram.com/pianoteofficial" target="_blank" class="instagram" aria-label="instagram">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
@endsection
