@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Drumeo P4 Practice Pad - Designed By Pat Petrillo</title>
    <meta name="description"
            content="Four unique playing surfaces. Three levels for movement. The Drumeo P4 Practice Pad by Pat Petrillo was designed to help you develop more skills that will transfer easily to the drum set. Click here to see the difference.">
    <meta property="og:image" content="https://i.vimeocdn.com/video/601570925-0bd7be34161bdea9c32b201d4225c3e9924bb83c52ff0089ac52112cbd181824-d_1200" style="display: none;">
    <meta property="og:title" content="The Most Versatile Practice Pad In The World">
    <meta property="og:description"
            content="Four unique playing surfaces. Three levels for movement. The Drumeo P4 Practice Pad by Pat Petrillo was designed to help you develop more skills that will transfer easily to the drum set. Click here to see the difference.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <style>
        @import "../_variables";
        .no-padding {
            padding: 0;
        }
        .half-padding {
            padding: 0 8px;
        }
        .no-select {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        h1 {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.3em;
            margin: 0 auto;
        }
        h2 {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.3em;
            margin: 0 auto;
        }
        h3 {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.3em;
            margin: 0 auto;
        }
        p {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.3em;
            margin: 0 auto;
        }
        .black {
            background: #1c1c1c;
            color: #fff;
        }
        .grey {
            background: #e6e6e6;
        }
        .white {
            background: #fff;
        }
        .hero-header {
            background: #000;
            color: #fff;
            text-align: center;
            padding: 30px 0;
        }
        .hero-header .logo img {
            max-width: 300px;
        }
        .hero-header .video {
            max-width: 1000px;
            margin: 0 auto;
            display: inline-block;
            float: none;
        }
        .hero-header .video .flex-video {
            position: relative;
            margin: 20px 0;
        }
        .hero-header .join {
            width: 100%;
            margin-bottom: 10px;
        }
        .hero-header p {
            line-height: 1.7em;
            font-size: 15px;
        }
        .hero-header p.yellow {
            text-transform: uppercase;
            color: #ffcf00;
            line-height: 1.2em;
        }
        .hidden-buy-slice {
            padding: 8px 0;
            text-align: center;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 99;
            position: fixed;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
            animation-duration: 0.5s !important;
            background: rgba(17, 17, 17, 0.8);
            top: 40px;
        }
        .hidden-buy-slice .join {
            font-size: 18px;
            padding: 8px 12%;
            width: auto;
        }
        #triple-benefit {
            text-align: center;
            padding: 30px 0;
        }
        #triple-benefit h1 {
            font-weight: 700;
        }
        #triple-benefit h1 strong {
            text-decoration: underline;
        }
        #triple-benefit h1.upper {
            margin: 0 auto 20px;
        }
        #triple-benefit h2 {
            font-weight: 400;
            font-size: 21px;
        }
        #triple-benefit h2 strong {
            text-decoration: underline;
        }
        #triple-benefit .benefit-wrap {
            padding: 0 15px;
        }
        #triple-benefit .benefit {
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            margin: 0 auto 15px;
        }
        #triple-benefit .benefit .image {
            position: relative;
        }
        #triple-benefit .benefit .image .overlay {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            line-height: 1.2em;
            position: absolute;
            text-transform: uppercase;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 20px;
            padding: 20px 0;
        }
        #triple-benefit .benefit .text {
            padding: 20px 20px 40px;
            text-align: left;
        }
        #triple-benefit .benefit .text p {
            line-height: 1.6em;
            font-size: 14px;
        }
        .warning-section {
            background: #840a16;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
            padding: 30px 0;
        }
        .warning-section .bg-icon {
            position: absolute;
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
            opacity: 0.3;
            filter: brightness(0%);
            z-index: 1;
            top: 15%;
            height: 100px;
        }
        .warning-section .bg-icon.sign {
            left: -30px;
        }
        .warning-section .bg-icon.cal {
            right: -50px;
        }
        .warning-section h1 {
            position: relative;
            z-index: 2;
            font-family: 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            margin: 0 auto;
            font-size: 40px;
        }
        .warning-section .sticks-x {
            position: relative;
            z-index: 2;
            opacity: 0.3;
            filter: brightness(0%);
            margin: 17px auto;
        }
        .warning-section .sticks-x img {
            width: 80px;
        }
        .warning-section p {
            position: relative;
            z-index: 2;
            font: 400 16px/1.7em "Open Sans", sans-serif;
            display: inline-block;
            max-width: inherit;
            padding: 0 10px;
            margin: 0 auto;
        }
        .warning-section p strong {
            font-weight: 800;
            color: #ffdb01;
        }
        .personal-letter {
            padding: 30px 0;
        }
        .personal-letter .row {
            width: 100%;
            max-width: 1000px;
        }
        .personal-letter h1 {
            font-weight: 700;
            line-height: 1.2em;
            text-align: center;
        }
        .personal-letter h1.upper {
            margin: 0 auto 30px;
        }
        .personal-letter h2 {
            font-family: 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            font-size: 19px;
            margin: 0 auto 10px;
        }
        .personal-letter p {
            line-height: 1.5em;
            margin: 0 auto 15px;
            font-size: 15px;
        }
        .personal-letter .jared-portrait img {
            border-radius: 7px;
        }
        .personal-letter .path-point {
            background: #e6e6e6;
            padding: 15px;
            margin: 0 auto 15px;
        }
        .personal-letter .path-point .icon {
            padding-left: 0;
        }
        .personal-letter .path-point p {
            margin: 0 auto;
        }
        .personal-letter .path-point img {
            width: 70px;
        }
        .personal-letter .path-point .text {
            padding: 0;
        }
        .personal-letter .path-point h2 {
            margin: 0 auto;
        }
        .personal-letter .sig-point {
            margin: 5px auto 0;
        }
        .personal-letter .sig-point .icon {
            display: inline-block;
            background: #1bb25f;
            line-height: 0;
            text-align: center;
            border-radius: 20px;
            padding: 5px;
            margin: 0 5px 0 0;
            width: 30px;
            height: 30px;
        }
        .personal-letter .sig-point .icon img {
            width: 20px;
        }
        .personal-letter .sig-point p {
            display: inline-block;
            font-size: 12px;
        }
        .personal-letter .number-paths {
            margin: 20px auto 10px;
        }
        .personal-letter .signature {
            margin: 15px auto 5px;
        }
        .personal-letter .signature img {
            width: 200px;
        }
        #icon-grid > .row > h1 {
            font-family: 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            color: #1bb25f;
            text-align: center;
            font-size: 30px;
            line-height: 1.2em;
        }
        #icon-grid > .row > p {
            line-height: 1.6em;
            clear: both;
            text-align: center;
            font-size: 16px;
            max-width: inherit;
            margin: 0 auto 15px;
            padding: 0 15px;
        }
        #icon-grid .icon-wrap {
            padding: 15px 30px;
        }
        #icon-grid .icon-wrap .text {
            padding: 5px 0 0;
        }
        #icon-grid .icon-wrap .icon {
            border: 2px solid #1bb25f;
            border-radius: 50px;
            text-align: center;
            margin: 0 auto;
            float: none;
            width: 50px;
            line-height: 46px;
            font-size: 23px;
            padding: 0;
        }
        #icon-grid .icon-wrap h1 {
            font-weight: 700;
            margin: 0 auto 2px;
            font-size: 20px;
        }
        #icon-grid .icon-wrap h2 {
            line-height: 1.6em;
            font-size: 14px;
        }
        .compare-table {
            background: #fff;
            text-align: center;
            padding: 40px 10px;
        }
        .compare-table h1 {
            margin: 0 auto 30px;
            font-weight: 700;
            line-height: 1.2em;
        }
        .compare-table table {
            border-collapse: separate;
            border-spacing: 10px 0;
            margin: 0 auto 45px;
            padding: 0;
        }
        .compare-table table tbody {
            border: none;
            color: #99a19e;
            background: #fff;
        }
        .compare-table table tbody tr td {
            width: 33.33%;
            border: 1px solid #dfe6e3;
            border-width: 0 1px;
            padding: 7px;
            font: 600 11px/1.2em 'Bebas Neue', sans-serif;
            text-transform: uppercase;
        }
        .compare-table table tbody tr td i {
            font-size: 24px;
        }
        .compare-table table tbody tr td:nth-child(2) {
            border-color: #00bb74;
            color: #00bb74;
        }
        .compare-table table tbody tr td:nth-child(2) i {
            font-size: 34px;
        }
        .compare-table table tbody tr:nth-child(even) {
            background-color: #f2f5f4;
        }
        .compare-table table tbody tr:nth-child(even):hover {
            background-color: #e8ebea;
        }
        .compare-table table tbody tr:nth-child(even) td:nth-child(2) {
            background-color: #effcf5;
        }
        .compare-table table tbody tr:nth-child(even) td:nth-child(2):hover td:nth-child(2) {
            background-color: #dfebe4;
        }
        .compare-table table tbody tr:nth-child(odd):hover {
            background-color: #f7faf9;
        }
        .compare-table table tbody tr:nth-child(1) td {
            border-width: 1px 1px 0;
            border-radius: 4px 4px 0 0;
            padding: 10px 0 15px;
        }
        .compare-table table tbody tr:nth-child(1) td .macbook {
            width: 70%;
            image-rendering: -webkit-optimize-contrast;
            margin: 0 auto 5px;
        }
        .compare-table table tbody tr:nth-child(1) td .blue-logo {
            width: 80%;
            image-rendering: -webkit-optimize-contrast;
        }
        .compare-table table tbody tr:nth-child(1) td i {
            margin: 0 0 5px;
            font-size: 50px;
        }
        .compare-table table tbody tr:nth-child(1) td:nth-child(1) {
            border-width: 0;
            background: #fff;
        }
        .compare-table table tbody tr:nth-child(2) td:nth-child(1) {
            border-width: 1px 1px 0;
            border-radius: 4px 4px 0 0;
        }
        .compare-table table tbody tr:last-child td {
            border-width: 0 1px 1px;
            border-radius: 0 0 4px 4px;
        }
        .compare-table p {
            text-align: left;
            font: 400 16px/1.4em "Open Sans", sans-serif;
            margin: 0 auto;
            padding: 0 10px;
        }
        .guarantee {
            background: #eff0f0;
            text-align: center;
            padding: 30px 7px;
        }
        .guarantee h1 {
            line-height: 1em;
            font-family: 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            color: #00bc75;
            font-size: 27px;
            margin: 0 auto 15px;
        }
        .guarantee h1 i {
            display: block;
            vertical-align: middle;
            font-size: 50px;
            margin: 0 auto 10px;
        }
        .guarantee p {
            line-height: 1.7em;
            padding: 0 15px;
            margin: 0 auto;
            clear: both;
            font-size: 14px;
            max-width: inherit;
        }
        .guarantee p strong {
            font-weight: 700;
        }
        #faster {
            image-rendering: -webkit-optimize-contrast;
            background: #000 url(https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/bg.jpg) center center/cover;
            color: #fff;
            max-width: 800px;
            padding: 45px 0;
            text-align: center;
            outline: none;
            border-radius: 5px;
        }
        #faster .series-logo {
            width: 100%;
            max-width: 270px;
        }
        #faster .series-logo.slim {
            max-width: 330px;
        }
        #faster h2 {
            font: 400 17px/1.3em "Open Sans", sans-serif;
            margin: 0 auto 20px;
        }
        #faster p {
            font: 400 16px/1.5em "Open Sans", sans-serif;
            text-align: center;
            margin: 15px auto;
        }
        #faster form {
            position: relative;
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
        }
        #faster form .form-arrow {
            position: absolute;
            top: 65%;
            width: 25px;
        }
        #faster form .form-arrow.arrow-right {
            left: -30px;
            transform: translate(0, -50%);
        }
        #faster form .form-arrow.arrow-left {
            right: -30px;
            transform: translate(0, -50%);
        }
        #faster form input {
            font: 400 18px/50px "Open Sans", sans-serif;
            height: 50px;
            color: #999;
            border-radius: 5px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 10px;
        }
        #faster form input[type="submit"] {
            font-family: 'Bebas Neue', sans-serif;
            color: #fff;
            background: #0b76db;
            text-transform: uppercase;
            margin: 0 auto 15px;
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        #faster form input[type="submit"]:hover {
            background: #0f84f2;
        }
        #faster .disclaimer {
            display: inline-block;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }
        #faster .disclaimer i {
            width: 40px;
            font-size: 29px;
            line-height: 1em;
            float: left;
        }
        #faster .disclaimer p {
            font: 400 12px/1.4em "Open Sans", sans-serif;
            margin: 0 auto;
            width: calc(100% - 40px);
            float: left;
            text-align: left;
        }
        .yellow-banner {
            background: #fdce02;
            padding: 20px 10px;
        }
        .yellow-banner .row {
            padding: 0 10px;
        }
        .yellow-banner .row p {
            font: 400 14px/1.5em "Open Sans", sans-serif;
            margin: 0 auto;
            width: 90%;
        }
        .yellow-banner .row p a {
            color: #000;
            text-decoration: underline;
        }
        .yellow-tab {
            background: #fdce02;
            text-align: center;
            position: relative;
            padding: 10px;
        }
        .yellow-tab:after {
            content: "";
            position: absolute;
            height: 0;
            width: 0;
            margin: -2px -50px 0 0;
            top: 100%;
            right: 50%;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-top: 15px solid #fdce02;
        }
        .yellow-tab p {
            font: 700 15px/1em "Open Sans", sans-serif;
            margin: 0 auto;
            text-transform: uppercase;
        }
        @media (min-width: 40em) {
            .warning-section {
                padding: 50px 15px 60px;
            }
            .warning-section .bg-icon {
                top: 25%;
                height: 200px;
            }
            .warning-section .bg-icon.sign {
                left: -20px;
            }
            .warning-section .bg-icon.cal {
                right: -70px;
            }
            .warning-section h1 {
                font-size: 50px;
            }
            .warning-section .sticks-x {
                margin: 25px auto;
            }
            .warning-section .sticks-x img {
                width: 100px;
                width: 90px;
            }
            .warning-section p {
                font-size: 17px;
                max-width: 650px;
            }
            .compare-table {
                padding: 70px 10px;
            }
            .compare-table h1 {
                margin: 0 auto 40px;
            }
            .compare-table table {
                padding: 0 15px;
            }
            .compare-table table tbody tr td {
                font-size: 15px;
            }
            .compare-table table tbody tr:nth-child(1) td {
                font-size: 24px;
                padding: 20px 10px 30px;
            }
            .compare-table table tbody tr:nth-child(1) td .macbook {
                width: 175px;
                margin: 0 auto 15px;
            }
            .compare-table table tbody tr:nth-child(1) td .blue-logo {
                width: 200px;
            }
            .compare-table table tbody tr:nth-child(1) td i {
                font-size: 100px;
                margin: 0 0 10px;
            }
            .compare-table p {
                padding: 0 25px;
                font-size: 18px;
            }
            .guarantee {
                padding: 60px 15px;
            }
            .guarantee h1 {
                font-size: 50px;
                margin: 0 auto 20px;
            }
            .guarantee h1 i {
                font-size: 25px;
                margin: 0 auto;
                display: inline;
            }
            .guarantee p {
                font-size: 17px;
                max-width: 700px;
            }
            #faster .series-logo {
                max-width: 420px;
            }
            #faster .series-logo.slim {
                max-width: 500px;
            }
            #faster h2 {
                font-size: 20px;
                margin: 0 auto 35px;
            }
            #faster form {
                margin: 0 auto 10px;
                max-width: 510px;
            }
            #faster form .form-arrow {
                top: 40%;
            }
            #faster form .form-arrow.arrow-right {
                left: -25px;
            }
            #faster form .form-arrow.arrow-left {
                right: -25px;
            }
            #faster form input {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
                margin: 0 auto 15px;
            }
            .yellow-banner {
                padding: 30px 15px;
            }
            .yellow-banner .row {
                padding: 0 15px;
            }
            .yellow-banner .row p {
                font-size: 16px;
            }
            .yellow-tab {
                padding: 15px;
            }
            .yellow-tab p {
                font-size: 18px;
            }
        }
        @media (min-width: 64em) {
            .warning-section {
                padding: 70px 15px 80px;
            }
            .warning-section .bg-icon {
                top: 45%;
                height: 400px;
            }
            .warning-section .bg-icon.sign {
                left: -110px;
            }
            .warning-section .bg-icon.cal {
                right: -230px;
            }
            .warning-section h1 {
                font-size: 60px;
            }
            .warning-section .sticks-x {
                margin: 30px auto;
            }
            .warning-section p {
                font-size: 19px;
                max-width: 910px;
            }
            .compare-table {
                padding: 90px 10px;
            }
            .compare-table h1 {
                margin: 0 auto 50px;
            }
            .compare-table table {
                padding: 0 45px;
            }
            .compare-table table tbody tr td {
                font-size: 18px;
            }
            .compare-table table tbody tr td i {
                font-size: 35px;
            }
            .compare-table table tbody tr td:nth-child(2) i {
                font-size: 50px;
            }
            .compare-table table tbody tr:nth-child(1) td {
                font-size: 30px;
                padding: 20px 10px 40px;
            }
            .compare-table table tbody tr:nth-child(1) td .macbook {
                width: 250px;
                margin: 10px auto 30px;
            }
            .compare-table table tbody tr:nth-child(1) td .blue-logo {
                width: 290px;
            }
            .compare-table table tbody tr:nth-child(1) td i {
                font-size: 145px;
                margin: 0 0 30px;
            }
            .compare-table p {
                padding: 0 55px;
            }
            .guarantee {
                padding: 90px 20px;
            }
            .guarantee h1 {
                font-size: 70px;
            }
            .guarantee h1 i {
                font-size: 40px;
            }
            .guarantee p {
                font-size: 20px;
                max-width: 970px;
            }
            #faster .series-logo {
                max-width: 500px;
            }
            #faster .series-logo.slim {
                max-width: 700px;
            }
            #faster p {
                font-size: 19px;
            }
            #faster form {
                max-width: 530px;
            }
            #faster form .form-arrow.arrow-right {
                left: -30px;
            }
            #faster form .form-arrow.arrow-left {
                right: -30px;
            }
            .yellow-banner {
                padding: 45px 20px;
            }
            .yellow-banner .row p {
                font-size: 18px;
            }
            .yellow-tab:after {
                border-top-width: 20px;
            }
            .yellow-tab p {
                font-size: 21px;
            }
        }
        @media screen {
            h1.upper {
                font-size: 22px;
            }
            #icon-grid {
                padding: 30px 0;
                text-align: center;
            }
            #social-proof > .row > h1.upper {
                margin: 0 auto 30px;
            }
            #social-proof > .row > h1.upper.students {
                margin: 0 auto 15px;
            }
            #social-proof .instructor-wrap.horizontal .white .image {
                height: 170px;
                position: inherit;
            }
            #social-proof .instructor-wrap.vertical.middle .white .image {
                height: 180px;
            }
            #social-proof .instructor-wrap .white .text {
                padding: 15px;
                position: relative;
            }
            #social-proof .student-reviews {
                margin-bottom: 30px;
            }
            .final .logo img {
                max-width: 300px;
            }
            .final h1 .small {
                font-size: 16px;
            }
            .final .cards {
                margin: 20px auto 0;
            }
            .final p.final-questions {
                margin: 60px auto 0;
                opacity: 0.7;
            }
        }
        @media screen and (min-width: 40em) {
            .join {
                font-size: 35px;
                padding: 20px 15px;
                width: auto;
            }
            h1.upper {
                font-size: 27px;
            }
            .hero-header {
                padding: 60px 0;
            }
            .hero-header .logo img {
                max-width: 550px;
            }
            .hero-header .video .flex-video {
                margin: 30px 0;
            }
            .hero-header .join {
                margin-bottom: 15px;
            }
            .hero-header p {
                font-size: 19px;
            }
            .hidden-buy-slice {
                top: 50px;
            }
            .hidden-buy-slice .join {
                font-size: 21px;
                padding: 10px 35px;
            }
            #triple-benefit {
                padding: 70px 0;
            }
            #triple-benefit h1.upper {
                margin: 0 auto 30px;
            }
            #triple-benefit h2 {
                font-size: 24px;
            }
            #triple-benefit .benefit .image .overlay {
                font-size: 19px;
                padding: 15px 0;
            }
            #triple-benefit .benefit .text p {
                font-size: 15px;
            }
            .personal-letter {
                padding: 70px 0;
            }
            .personal-letter h1.upper {
                margin: 0 auto 40px;
            }
            .personal-letter h2 {
                font-size: 24px;
                margin: 0 auto 15px;
            }
            .personal-letter p {
                font-size: 17px;
                margin: 0 auto;
            }
            .personal-letter .number-paths {
                margin: 30px auto 20px;
            }
            .personal-letter .path-point img {
                width: 140px;
            }
            .personal-letter .path-point .text {
                padding: 0 15px;
            }
            .personal-letter .path-point h2 {
                margin: 0 auto 5px;
            }
            .personal-letter .signature {
                margin: 30px auto 10px;
            }
            .personal-letter .signature img {
                width: 250px;
            }
            .personal-letter .sig-point {
                margin: 8px auto 0;
            }
            .personal-letter .sig-point .icon {
                width: 40px;
                height: 40px;
            }
            .personal-letter .sig-point .icon img {
                width: 30px;
            }
            .personal-letter .sig-point p {
                font-size: 12px;
            }
            #icon-grid {
                text-align: left;
                padding: 60px 0;
            }
            #icon-grid > .row > h1 {
                font-size: 50px;
            }
            #icon-grid > .row > p {
                font-size: 18px;
                max-width: 650px;
                margin: 0 auto 25px;
                padding: 0;
            }
            #icon-grid .icon-wrap {
                padding: 15px;
            }
            #icon-grid .icon-wrap .icon {
                float: left;
            }
            #icon-grid .icon-wrap .text {
                padding: 0 0 0 15px;
                float: left;
                width: calc(100% - 50px);
            }
            #icon-grid .icon-wrap h1 {
                font-size: 16px;
            }
            #icon-grid .icon-wrap h2 {
                font-size: 13px;
            }
            #social-proof {
                padding: 70px 0;
            }
            #social-proof > .row > h1.upper {
                margin: 0 auto 40px;
            }
            #social-proof .shopper-rating {
                font-size: 50px;
                margin: 0 auto 40px;
            }
            #social-proof .instructor-wrap.horizontal {
                text-align: left;
            }
            #social-proof .instructor-wrap.horizontal .white .image {
                position: absolute;
                height: auto;
            }
            #social-proof .instructor-wrap.vertical .white .image {
                height: 190px;
            }
            #social-proof .instructor-wrap.vertical .white .text {
                padding: 15px;
            }
            #social-proof .instructor-wrap.vertical.middle .white .image {
                height: 170px;
            }
            #social-proof .instructor-wrap .white .image {
                background-position: center top;
            }
            #social-proof .instructor-wrap .white .text {
                padding: 15px 20px;
            }
            #social-proof .instructor-wrap .white .text h1 {
                font-size: 18px;
            }
            #social-proof .instructor-wrap .white .text h2 {
                font-size: 14px;
                margin: 5px auto 10px;
            }
            #social-proof .instructor-wrap .white .text p {
                font-size: 15px;
            }
            #social-proof .instructor-wrap .white .text .sa-rating {
                top: 15px;
                right: 20px;
                position: absolute;
                font-size: 30px;
            }
            #social-proof .student-reviews {
                margin-bottom: 40px;
            }
            .final {
                padding: 80px 0;
            }
            .final .logo img {
                max-width: 480px;
            }
            .final h1 {
                font-size: 20px;
                margin: 70px auto 20px;
            }
            .final h1 .small {
                font-size: 17px;
            }
            .final h3 {
                font-size: 16px;
                margin: -15px auto 20px;
            }
            .final h3.yellow {
                margin: 25px auto 0;
            }
            .final .cards {
                margin: 25px auto 0;
            }
            .final .cards i {
                font-size: 45px;
            }
            .final p.final-questions {
                margin: 70px auto 0;
            }
            .final p {
                font-size: 15px;
            }
            .final p span {
                font-size: 16px;
            }
        }
        @media screen and (min-width: 64em) {
            .join {
                font-size: 40px;
                padding: 25px 35px;
            }
            h1.upper {
                font-size: 37px;
            }
            .hero-header {
                padding: 70px 0;
            }
            .hero-header .logo img {
                max-width: 600px;
            }
            .hidden-buy-slice .join {
                font-size: 22px;
                padding: 12px 12%;
            }
            #triple-benefit {
                padding: 90px 0;
            }
            #triple-benefit h1.upper {
                margin: 0 auto;
            }
            #triple-benefit h2 {
                font-size: 28px;
                margin: 0 auto 40px;
            }
            #triple-benefit .benefit .image .overlay {
                font-size: 25px;
                padding: 25px 0;
            }
            #triple-benefit .benefit .text p {
                font-size: 16px;
            }
            .personal-letter {
                padding: 90px 0;
            }
            .personal-letter h1.upper {
                margin: 0 auto 50px;
            }
            .personal-letter h2 {
                margin: 0 auto 25px;
            }
            .personal-letter p {
                font-size: 19px;
            }
            .personal-letter .number-paths {
                margin: 40px auto 30px;
            }
            .personal-letter .path-point h2 {
                margin: 20px auto 5px;
            }
            #icon-grid {
                padding: 90px 0;
            }
            #icon-grid > .row > h1 {
                font-size: 70px;
            }
            #icon-grid > .row > p {
                font-size: 20px;
                max-width: 900px;
                margin: 10px auto 30px;
            }
            #icon-grid .icon-wrap {
                padding: 25px 15px;
            }
            #icon-grid .icon-wrap .text {
                width: calc(100% - 60px);
            }
            #icon-grid .icon-wrap h1 {
                font-size: 20px;
            }
            #icon-grid .icon-wrap h2 {
                font-size: 14px;
            }
            #icon-grid .icon-wrap .icon {
                width: 60px;
                line-height: 56px;
                font-size: 27px;
            }
            #social-proof {
                padding: 90px 0;
            }
            #social-proof > .row > h1.upper {
                margin: 0 auto 50px;
            }
            #social-proof .shopper-rating {
                font-size: 64px;
                margin: 0 auto 50px;
            }
            #social-proof .instructor-wrap.vertical .white .image {
                height: 258px;
            }
            #social-proof .instructor-wrap.vertical .white .text {
                padding: 30px 20px;
            }
            #social-proof .instructor-wrap.vertical.middle .white .image {
                height: 161px;
            }
            #social-proof .instructor-wrap .white .text {
                padding: 30px;
            }
            #social-proof .instructor-wrap .white .text h1 {
                font-size: 20px;
            }
            #social-proof .instructor-wrap .white .text h2 {
                font-size: 15px;
                margin: 5px auto 20px;
            }
            #social-proof .instructor-wrap .white .text p {
                font-size: 16px;
            }
            #social-proof .instructor-wrap .white .text .sa-rating {
                top: 30px;
                right: 30px;
                font-size: 36px;
            }
            #social-proof .student-reviews {
                margin-bottom: 55px;
            }
            .final {
                padding: 100px 0;
            }
            .final .logo img {
                max-width: 530px;
            }
            .final h1 {
                font-size: 30px;
                margin: 60px auto 25px;
            }
            .final h3 {
                font-size: 22px;
                margin: -20px auto 25px;
            }
            .final p.final-questions {
                margin: 80px auto 0;
            }
        }
        @media screen and (min-width: 75em) {
            #social-proof .instructor-wrap.vertical .white .image {
                height: 226px;
            }
            #social-proof .instructor-wrap.vertical.middle .white .image {
                height: 219px;
            }
        }

    </style>

    <?php \App\Analytics\Tracker::trackProductImpression('practicepad'); ?>
    <style>
        body {
            background:#fff !important;
        }

        sup {
            top:-.1em;
            font-size:14px;
            vertical-align:super;
        }

        .bg-gray {
            background:#222;
        }

        .title h1 {
            margin:0 auto;
            color:#FFF;
            font:500 23px/0.9em "Open Sans", sans-serif;
        }

        .flex-video {
            margin:7px auto 3px;
        }

        .order-bar {
            font-size:0;
        }

        .order-bar p {
            font:400 15px/1em "Open Sans", sans-serif;
            margin:15px auto;
        }

        .join.stores {
            display:inline-block;
            background:#3F72C4;
            transition:all .2s;
            text-align:center;
            font-size:18px;
            padding:17px;
            height:45px;
            width:auto;
            min-width:300px;
            margin:5px;
            vertical-align:middle;
            position:relative;
        }

        .join.stores:hover {
            background:#4883db;

        }

        .join.stores.big {
            height:50px;
        }

        .join.stores.amazon {
            background:#FE9900;
        }

        .join.stores.amazon:hover {
            background:#ffaa33;
        }

        .join.stores.musicians-friend {
            background:#f5b717;
        }

        .join.stores.musicians-friend:hover {
            background:#ffc533;
        }

        .join.stores.guitar-center {
            background:#cd2418;
        }

        .join.stores.guitar-center:hover {
            background:#e6261c;
        }

        .join.stores.thomann {
            background:#01b5bd;
        }

        .join.stores.thomann:hover {
            background:#02cfd6;
        }

        .join.stores img {
            width:auto;
            height:auto;
            max-width:130px;
            max-height:31px;
            position:absolute;
            transform:translate(-50%, -50%);
            top:50%;
            left:50%;
        }
        .hero-header .join.stores {
            width:auto;
        }

        .details-section {
            padding:40px 0;
        }

        .details-section img {
            width:100%;
            border-radius:10px;
            margin-bottom:15px;
        }

        .details-section h1 {
            margin:0;
            color:#000;
            font:700 22px/1em "Open Sans", sans-serif;
        }

        .details-section h2 {
            color:#000;
            font:500 20px/1em "Open Sans", sans-serif;
            margin:0 auto 25px;
        }

        .details-section p {
            color:#000;
            text-align:left;
            font:500 16px/1.4em "Open Sans", sans-serif;
            max-width:300px;
            margin:0 auto 15px;
        }

        .details-section p strong {
            color:#3F72C4;
            font:700 19px/1.4em "Open Sans", sans-serif;
        }

        .pat-quote {
            padding:17px 0;
            max-width:900px;
        }

        .pat-quote p {
            color:#FFF;
            font:italic 400 16px/1.6em "Open Sans";
            margin:5px 0 0;
        }

        .pat-quote p strong {
            color:#D06835;
            font:700 16px "Open Sans", sans-serif;
        }

        .pad-overview {
            padding:50px 0;
        }

        .pad-overview .title h1 {
            margin:0 auto 20px;
            color:#000;
            font:500 22px/0.9em "Open Sans", sans-serif;
        }

        .pad-overview .pad-point p {
            color:#000;
            font:500 16px/1.2em "Open Sans", sans-serif;
            margin:0 auto 5px;
        }

        .pad-overview .pad-point.active p {
            font-weight:700;
        }

        .pad-overview .pad-point.snare p {
            color:#3E5885;
        }

        .pad-overview .pad-point.hitom p {
            color:#2C2A20;
        }

        .pad-overview .pad-point.lotom p {
            color:#867F6C;
        }

        .pad-overview .pad-point.cymbal p {
            color:#D87943;
        }

        .pad-overview area {
            outline:1px solid #FFF;
        }

        .pad-overview .close-up {
            margin-bottom:5px;
            text-align:center;
        }

        .pad-overview .join {
            margin-top:15px;
        }


        .vid-push h3 {
            color:#FFF;
            font:500 18px/1.2em "Open Sans", sans-serif;
            margin:0 auto 10px;
        }

        .vid-push h3 img {
            margin-left:10px;
        }

        .vid-push h1 {
            color:#FFF;
            font:500 22px/1.2em "Open Sans", sans-serif;
            margin:0 auto 15px;
        }

        .vid-push .fb_iframe_widget {
            background:#FFF;
            border-radius:5px;
            display:inline-block;
            margin:0 auto 15px;
        }

        .vid-push .fb_iframe_widget span {
            vertical-align:middle !important;
        }

        .vid-push {
            padding:40px 0;
        }

        .vid-push .instagram-media {
            width:320px !important;
            margin:0 5px 10px !important;
            display:inline-block !important;
        }

        .reveal-ig {
            display:none;
        }

        .reveal-ig div {
            margin:20px auto;
            text-align:center;
            background:#3F72C4;
            border-radius:5px;
            cursor:pointer;
            color:#fff;
            font:400 20px/1em "Open Sans", sans-serif;
            width:170px;
            padding:3% 0;
        }

        .reveal-ig div:hover {
            background:#407ccf;
        }

        .insta-hidden {
            display:none;
            text-align:center;
        }

        .insta-hidden .centering-wrap {
            margin:0 auto;
        }

        .insta-hidden .centering-wrap .columns {
            padding:0 5px;
        }

        .insta-hidden a {
            margin:0 auto 20px;
            display:block;
        }

        .insta-hidden a img {
            border-radius:6px;
        }

        .show-more {
            margin:20px auto;
            text-align:center;
            background:#3F72C4;
            border-radius:5px;
            cursor:pointer;
            color:#fff;
            display:none;
            font:400 20px/1em "Open Sans", sans-serif;
            width:170px;
            padding:3% 0;
        }

        .show-more:hover {
            background:#407ccf;
        }

        .reveal-group {
            display:none;
        }


        .pad-compare {
            padding:50px 0;
        }

        .pad-compare h1 {
            margin:0 auto 30px;
            color:#000;
            font:500 22px/0.9em "Open Sans", sans-serif;
        }

        .pad-compare table {
            border:none;
            margin-bottom:35px;
        }

        .pad-compare td {
            font:900 13px/1em "Open Sans", sans-serif;
            color:#000;
            text-align:center;
            padding:5px;
        }

        .pad-compare table tr td:nth-child(1) {
            text-align:left;
        }

        .pad-compare table tr:nth-child(1) td {
            font-size:15px;
        }

        .pad-compare table tr:nth-of-type(even) td:nth-child(2) {
            background:#ECF1F9;
        }

        .pad-compare table tr td:nth-child(2) {
            color:#3F72C4;
        }

        .pad-compare table tr td:nth-child(3) {
            color:#AAA;
        }

        .pad-compare table tr td.some {
            font-weight:400;
            font-size:15px;
        }

        .pad-compare table td img {
            margin-bottom:15px;
            width:70px;
        }

        .pad-compare table tr:hover {
            background:#EEE;
        }

        .pad-compare table tr:hover td:nth-child(2) {
            background:#d8e2f3;
        }

        .pad-compare table tr:nth-of-type(even):hover td:nth-child(2) {
            background:#d8e2f3;
        }

        .guarantee {
            background:transparent;
            padding:25px 0;
            max-width: 980px;
        }

        .guarantee p {
            color:#FFF;
            font:500 16px/1.7em "Open Sans", sans-serif;
            margin:5px auto 0;
        }

        .customize-section {
            text-align:center;
            padding:60px 0;
        }

        .customize-section .final-pitch {
            padding:20px 0 40px;
            font-size:0;
        }

        .customize-section .final-pitch h1 {
            font:700 35px/1em "Open Sans", sans-serif;
            margin:0 auto 20px;
            text-transform:capitalize;
            color:#000;
            text-align:center;
        }

        .customize-section .final-pitch h1 s {
            color:#777;
        }

        .customize-section .final-pitch p {
            font:400 16px/1.2em "Open Sans", sans-serif;
            margin:15px auto;
        }

        .customize {
            padding:10px 10px 0;
        }

        .credit-cards {
            margin:30px 0 15px;
        }

        @media (min-width:40em) {
            .credit-cards {
                margin:40px auto 15px;
            }
        }

        @media (min-width:64em) {
            .credit-cards {
                margin:50px auto 15px;
            }
        }

        .credit-cards i {
            opacity:0.7;
            margin:0 3px;
            font-size:33px;
        }

        @media (min-width:40em) {
            .credit-cards i {
                font-size:45px;
            }
        }

        .credit-cards img {
            width:100%;
            max-width:340px;
        }

        @media (min-width:40em) {
            .credit-cards img {
                max-width:480px;
            }
        }

        @media (min-width:64em) {
            .credit-cards img {
                max-width:550px;
            }
        }

        .questions {
            padding:0 15px;
            background:transparent;
        }

        .questions p {
            margin:0;
            opacity:0.7;
            max-width:100%;
            font-size:13px;
        }

        .questions p a {
            color:inherit;
            display:inline-block;
        }


        .bulk-order {
            color:#3F72C4;
            margin:0 auto;
            display:block;
            float:left;
            width:100%;
            text-decoration:underline;
        }

        .order-bar .bulk-order {
            margin:15px auto 0;
            color:#fff;
        }

        .hidden-buy-slice .join {
            background:#3F72C4;
        }

        .hidden-buy-slice .join:hover {
            background:#407ccf;
        }

        .thank-you-banner {
            background:#d06835;
            padding:30px 0;
        }

        .thank-you-banner a {
            color:#000;
            text-decoration:underline;
        }

        @media only screen and (min-width:40em) {
            .title h1 {
                font-size:48px;
            }

            sup {
                font-size:16px;
            }

            .order-bar p {
                font-size:18px;
            }

            .join.stores {
                min-width:240px;
                height:50px;
                font-size:27px;
                padding:21px;
            }

            .join.stores.big {
                width:100%;
                max-width:490px;
                margin:0;
                height:70px;
            }

            .details-section {
                padding:50px 0;
            }

            .details-section h1 {
                font-size:38px;
            }

            .details-section h2 {
                font-size:27px;
                margin:0 auto 35px;
            }

            .details-section p {
                margin:0 auto;
                max-width:inherit;
            }

            .details-section p strong {
                font-size:15px;
            }

            .pat-quote p {
                font-size:17px;
            }

            .pad-overview .title h1 {
                font-size:38px;
                margin:0 auto 40px;
            }

            .pad-overview .pad-point.snare p,
            .pad-overview .pad-point.hitom p,
            .pad-overview .pad-point.lotom p,
            .pad-overview .pad-point.cymbal p {
                color:#000;
            }

            .pad-overview .pad-point p {
                margin:0 auto 15px;
            }

            .pad-overview .close-up {
                margin-bottom:40px;
            }

            .pad-overview .join {
                margin-top:0;
            }

            .vid-push {
                padding:60px 0;
            }

            .insta-hidden .centering-wrap {
                max-width:675px;
            }

            .vid-push h3 {
                line-height:80px;
                margin:0 auto;
            }

            .vid-push h3 img {
                width:60px;
            }

            .vid-push .fb_iframe_widget {
                margin:0 5px 10px;
            }

            .vid-push .fb_iframe_widget:last-child {
                display:none;
            }

            .vid-push h1 {
                font-size:38px;
            }

            .reveal-ig div {
                width:200px;
                padding:1% 0;
            }

            .show-more {
                width:200px;
                padding:1% 0;
            }

            .pad-compare h1 {
                font-size:38px;
            }

            table tr td {
                padding:0.5625rem 0.625rem;
            }

            .pad-compare td {
                font-size:20px;
            }

            .pad-compare table td img {
                width:100px;
            }

            .pad-compare table tr td:nth-child(2) {
                font-size:40px;
            }

            .pad-compare table tr td:nth-child(3) {
                font-size:30px;
            }

            .pad-compare table tr:nth-child(1) td {
                font-size:20px;
            }

            .pad-compare table tr td.some {
                font-size:20px;
            }

            .guarantee p {
                font-size:19px;
                line-height:1.3em;
                margin:0 auto;
            }

            .customize-section .final-pitch {
                padding:30px 0 50px;
            }

            .customize-section .final-pitch h1 {
                font-size:45px;
                margin:0 auto 30px;
            }

            .customize-section .final-pitch p {
                font-size:18px;
            }

            .customize {
                padding:10px 15px 0;
            }

            .customize .cards i {
                font-size:43px;
            }
        }

        @media only screen and (min-width:64em) {
            .title h1 {
                font-size:60px;
            }

            sup {
                font-size:22px;
            }

            .order-bar p {
                font-size:20px;
            }

            .join.stores {
                min-width:220px;
            }

            .join.stores.big {
                max-width:910px;
                font-size:30px;
            }

            .details-section h1 {
                font-size:47px;
            }

            .details-section h2 {
                font-size:30px;
            }

            .details-section p strong {
                font-size:20px;
            }

            .pat-quote p {
                font-size:20px;
            }

            .pad-overview .title h1 {
                font-size:50px;
            }

            .insta-hidden .centering-wrap {
                max-width:1010px;
            }

            .vid-push h3 {
                font-size:32px;
            }

            .vid-push h3 img {
                width:80px;
            }

            .vid-push h1 {
                font-size:47px;
            }

            .vid-push .fb_iframe_widget:last-child {
                display:inline-block;
            }

            .pad-compare h1 {
                font-size:47px;
            }

            .guarantee p {
                margin:15px auto 0;
                font-size:21px;
                line-height:1.7em;
            }

            .customize-section h1 {
                font-size:45px;
            }

            .customize-section .final-pitch {
                padding:30px 0 70px;
            }

            .customize .cards i {
                font-size:48px;
            }
        }

        .thank-you-box {
            width:100%;
            max-width:960px;
            border-radius:5px;
            height:auto;
            max-height:0;
            visibility:hidden;
            opacity:0;
            transition:all .4s ease-in;
            display:block;
            margin:0 auto;
            background:#FFF;
            text-align:center;
            overflow:hidden;
            color:#000
        }

        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:15px
        }

        @media (min-width:40em) {
            .thank-you-box.active {
                padding:20px
            }
        }

        @media (min-width:64em) {
            .thank-you-box.active {
                padding:30px
            }
        }

        .thank-you-box p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto
        }

        @media (min-width:40em) {
            .thank-you-box p {
                font-size:19px
            }
        }

        @media (min-width:64em) {
            .thank-you-box p {
                font-size:23px
            }
        }

        .thank-you-box p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px
        }

        @media (min-width:40em) {
            .thank-you-box p em {
                font-size:14px
            }
        }

        .thank-you-box h2 {
            font:700 30px/1em "Bebas Neue", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db
        }

        @media (min-width:40em) {
            .thank-you-box h2 {
                font-size:37px;
                margin:20px auto
            }
        }

        @media (min-width:64em) {
            .thank-you-box h2 {
                font-size:44px
            }
        }

        .thank-you-box .social-media a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 3px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px
        }

        @media (min-width:64em) {
            .thank-you-box .social-media a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0
            }
        }

        #bulkOrder {
            display:inline-block;
            font-family:"Open Sans", sans-serif;
            background:#e5f0ff;
            border-top:4px solid #0b76db;
            max-width:700px;
            height:0;
            visibility:hidden;
            opacity:0;
            overflow:hidden;
            transition:all 0.7s;
            min-height:inherit;
            border-radius:7px
        }

        #bulkOrder.active {
            height:inherit;
            visibility:visible;
            opacity:1;
            padding:20px 20px 30px;
            margin:30px auto 0
        }

        #bulkOrder.success {
            background:#dbffe1;
            border-color:#00991a
        }

        #bulkOrder.success .g-recaptcha {
            display:none
        }

        #bulkOrder.success .join {
            display:none
        }

        #bulkOrder.success p.success-text {
            display:inline-block
        }

        #bulkOrder p.success-text {
            display:none;
            font-weight:700;
            text-align:center;
            margin:0 auto;
            width:100%
        }

        #bulkOrder input, #bulkOrder textarea, #bulkOrder button {
            font:400 15px "Open Sans", sans-serif;
            border-radius:7px;
            box-shadow:none
        }

        #bulkOrder .join {
            font-family:"Bebas Neue", sans-serif;
            border-radius:6px;
            background:#0b76db;
            padding:13px 30px;
            margin:10px auto 0;
            width:auto
        }
    </style>
@stop()

@section('scripts')
    @parent
    <script src="{{ asset('/marketing/js/drumeo/imageMapResizer.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        $(document).ready(function () {

            //bulk order display
            $(".bulk-order").click(function () {
                $('#bulkOrder').addClass('active');
            });

            //pad hover mapper
            $('map').imageMapResize();
            $(".pad-section").click(function () {
                    $(".pad-point").removeClass('active');
                    $(this).addClass('active');
                    var index = $(".pad-point").index(this);
                }
            );
            $('area.pad-click').hover(function () {
                var index = $('area.pad-click').index(this);

                $('div.pad-click').removeClass('active').eq(index).addClass('active');
            }, function () {
                $('div.pad-click').removeClass('active');
            });
            $('area.pad-click').click(function () {
                var index = $('area.pad-click').index(this);

                $('div.pad-click').removeClass('active').eq(index).addClass('active');
            });

            //desktop testimonials
            var nowLoaded = 0;
            $(".insta-hidden").eq(nowLoaded).show().after($(".reveal-ig").show());

            $(".reveal-ig").click(function () {
                nowLoaded++;
                $(".insta-hidden").eq(nowLoaded).show().after($(".reveal-ig"));
                $(window).trigger('resize');

                if (nowLoaded == $(".insta-hidden").length - 1) {
                    $(".reveal-ig").hide()
                }
            });

            //mobile testimonials
            var currentlyLoaded = 0;
            $(".reveal-group").eq(currentlyLoaded).show().after($(".show-more").show());

            $(".show-more").click(function () {
                currentlyLoaded++;
                $(".reveal-group").eq(currentlyLoaded).show().after($(".show-more"));
                $(window).trigger('resize');

                if (currentlyLoaded == $(".reveal-group").length - 1) {
                    $(".show-more").hide()
                }
            });
        });
    </script>
@stop()

@section('content')

    @include('_partials.components.shop.promo-banner', [
        "name" => "The P4 Practice Pad",
        "fullPrice" => floatval($productPrices['practicepad']->price),
        "price" => floatval($productPrices['practicepad']->discounted_price),
        "noBreadcrumb" => true
    ])
    @if(strpos(url()->full(), 'thankyou'))
        <div class="thank-you-banner text-center">
            <p>
                <strong>Thanks for contacting us!</strong><br> We'll respond to you soon! If you haven't heard back in the next week, please <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">contact us</a>.</p>
        </div>
    @endif
    @if(strpos(url()->full(), 'error'))
        <div class="thank-you-banner text-center">
            <p><strong>Oops!</strong><br> Please go back and make sure you check the security CAPTCHA box.<br> <a
                        class="bulk-order anchor-slide" href="#bulk-order-anchor">click here</a></p>
        </div>
    @endif
    <div class="hero-header">
        <div class="row title text-center">
            <h1>THE <strong>MOST VERSATILE<br> PRACTICE PAD</strong> IN THE WORLD<sup>&trade;</sup>
            </h1>
        </div>
        <div class="video columns">
            <div class="columns flex-video widescreen vimeo">
                <iframe src="//player.vimeo.com/video/190602007" frameborder="0" allowfullscreen title="Practice pad video"></iframe>
            </div>
        </div>
        <div class="row order-bar text-center">
            <div class="columns">
                <a class="join stores big"
                        href="/ecommerce/add-to-cart?products[practicepad]=1">Click Here To Order &raquo;</a>
                <p>Or buy through your favorite online stores:</p>
                {{--<a target="_blank" class="join amazon" href="https://www.amazon.com/dp/B01IRNGWDK"><img style="padding-top: 5px;"--}}
                {{--src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/amazon-logo.png"></a>--}}
                <a target="_blank"
                   class="join stores musicians-friend"
                   href="https://www.musiciansfriend.com/accessories/drumeo-p4-practice-pad">
                    <img
                        src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/musicians-friend-logo.png"
                        alt="Musician's Friend"
                    >
                </a>
                <br class="show-for-medium-only">
                <a target="_blank"
                   class="join stores guitar-center"
                   href="https://www.guitarcenter.com/Drumeo/P4-Practice-Pad.gc">
                    <img style="padding-bottom: 2px;"
                         src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/guitar-center-logo.png"
                         alt="Guitar center"
                    >
                </a>
                <a target="_blank"
                   class="join stores thomann"
                   href="https://www.thomann.de/gb/drumeo_p4_pat_petrillo_practice_pad.htm">
                    <img
                        src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/thomann-logo.png"
                        alt="thomann"
                    >
                </a>
            </div>
            <div class="columns">
                <p>
                    <strong>
                        <a class="bulk-order anchor-slide" href="#bulk-order-anchor">Are you a drum shop? Click here <br class="hide-for-medium"> to stock the pad in your store!</a>
                    </strong>
                </p>
            </div>
        </div>
    </div>
    <div class="row details-section">
        <div class="columns text-center">
            <h1>THE DRUMEO P4 PRACTICE PAD<sup>&trade;</sup></h1>
            <h2>DESIGNED BY PAT PETRILLO</h2>
        </div>
        <div class="medium-4 columns  text-center medium-text-left">
            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/details-photo1.jpg" alt="Detail 1">
            <p>
                <strong>PRACTICE WITHOUT LIMITS</strong><br>
                Expand your practice beyond a single surface. With a snare-like pad, harder neoprene for high-tom, strength-building rubber for floor tom, and a ride cymbal-like surface, you're ready for anything.
            </p>
        </div>
        <div class="medium-4 columns  text-center medium-text-left">
            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/details-photo2.jpg" alt="Detail 2">
            <p>
                <strong>BOOST SPEED, POWER & CONTROL</strong><br>
                Refine your rebound and kit movement on multiple surfaces. Build speed, accuracy, and power for a smoother transition to the drum set.
            </p>
        </div>
        <div class="medium-4 columns  text-center medium-text-left">
            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/details-photo3.jpg" alt="Detail 3">
            <p>
                <strong>IGNITE YOUR CREATIVITY</strong><br>
                Designed by groove expert Pat Petrillo, the P4 Practice Pad helps you develop key skills for the kit, rooted in his expertise from "Hands, Grooves, & Fills."
            </p>
        </div>
    </div>
    <div class="bg-gray">
        <div class="row pat-quote">
            <div class="large-2 medium-3 columns  text-center medium-text-left">
                <img src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/floating-head.png" alt="Pat Petrillo" /></div>
            <div class="large-10 medium-9 columns">
                <p>“I’ve used this practice pad while teaching privately in New York. It has helped my students really replicate the feel of moving around the drum set and work on independence techniques - and I know it will do the same for you.”<br>
                    <strong>- PAT PETRILLO</strong></p></div>
        </div>
    </div>
    <div class="row pad-overview">
        <div class="columns title text-center">
            <h1>DEVELOP YOUR MUSICALITY<br class="show-for-medium"><strong> - ANYTIME, ANYWHERE</strong></h1></div>
        <div class="medium-3 small-6 columns pad-point snare pad-click"><p>
                <strong>Standard gum-rubber</strong> like your traditional practice pad (feels like a snare drum)</p>
        </div>
        <div class="medium-3 small-6 columns pad-point hitom pad-click"><p>
                <strong>Harder neoprene-rubber</strong> with a similar responsiveness to your high-toms.</p></div>
        <div class="columns close-up hide-for-medium">
            <img src="https://s3.amazonaws.com/drumeo-packs/practice-pad/close-up-pad.png" alt="Close up pad" />
        </div>
        <div class="medium-3 small-6 columns pad-point lotom pad-click"><p>
                <strong>Quiet floor-tom feel</strong>, perfect for strength-building or late night practice.</p></div>
        <div class="medium-3 small-6 columns pad-point cymbal pad-click"><p>
                <strong>The hardest surface</strong> that delivers a unique sound and emulates the ride cymbal.</p>
        </div>
        <div class="columns close-up show-for-medium">
            <img src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/close-up-arrows.png" usemap="#Map" alt="Close up pad" />
            <map name="Map" id="Map">
                <area class="pad-click" title="Standard gum-rubber" shape="poly"
                        coords="406,68,305,81,158,119,67,160,8,226,15,287,91,333,206,373,316,389,430,397,531,397,608,390,606,373,538,333,467,281,409,214,393,151,396,95"/>
                <area class="pad-click" title="Harder neoprene-rubber" shape="poly"
                        coords="402,167,398,139,400,94,411,67,437,33,510,29,589,28,625,29,641,35,656,54,728,115,672,125,485,141,407,148"/>
                <area class="pad-click" title="Quiet floor-tom feel" shape="poly"
                        coords="634,362,571,329,495,274,433,220,404,174,408,153,510,141,633,132,731,122,741,128,799,182,890,259,896,272,897,297,780,336"/>
                <area class="pad-click" title="The hardest surface" shape="poly"
                        coords="915,225,875,222,838,192,772,135,721,90,681,59,647,28,646,7,651,3,689,1,758,9,830,23,890,42,941,63,987,94,998,129,993,173,962,207,931,222"/>
            </map>
        </div>
    </div>
    <div class="bg-gray">
        <div class="row vid-push text-center">
            <h1>SEE WHAT DRUMMERS<br class="hide-for-medium"> ARE SAYING</h1>
            <div class="columns no-padding insta-hidden">
                <div class="centering-wrap">
                    <div class="large-4 medium-6 columns">
                        <a target="_blank" href="https://www.instagram.com/p/BlNaPIrAKBu/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/sanghyunsimonlee.png" alt="Testimonial 1">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/p/Bm8nxCInKoT/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/stephanemoureu.png" alt="Testimonial 2">
                        </a>
                    </div>
                    <div class="large-4 medium-6 columns">
                        <a target="_blank" href="https://www.instagram.com/p/BmDunJEHkQf/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/livethedrumlifestyle.png" alt="Testimonial 3">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/p/Bm1_5dtAjqE/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/wareke.png" alt="Testimonial 4">
                        </a>
                    </div>
                    <div class="large-4 medium-6 columns show-for-large">
                        <a target="_blank" href="https://www.instagram.com/p/BpcWwh2lqZl/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/gowrivation.png" alt="Testimonial 4">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/p/BiSPK2HAGCJ/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/jorddrummer.png" alt="Testimonial 5">
                        </a>
                    </div>
                </div>
            </div>
            <div class="columns no-padding reveal-ig">
                <div>Show more...</div>
            </div>
            <div class="columns no-padding insta-hidden">
                <div class="centering-wrap">
                    <div class="large-4 medium-6 columns">
                        <a target="_blank" href="https://www.instagram.com/p/Bj8GZoSnz42/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/qvantdrums.png" alt="Testimonial 6">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/p/BiyLLEohs0F/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/markefeetus.png" alt="Testimonial 7">
                        </a>
                    </div>
                    <div class="large-4 medium-6 columns">
                        <a target="_blank" href="https://www.instagram.com/p/BjqVOYdhWw_/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/diegotcprodesign.png" alt="Testimonial 8">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/p/BikJm19H-hL/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/rhodzadrumma.png" alt="Testimonial 9">
                        </a>
                    </div>
                    <div class="large-4 medium-6 columns show-for-large">
                        <a target="_blank" href="https://www.instagram.com/p/Bi_5VeqH6ef/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/phoenix1974.png" alt="Testimonial 10">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/p/BizJ2--jRYX/">
                            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/testimonials/2018/hyunook.png" alt="Testimonial 11">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pad-compare text-center">
        <div class="columns"><h1>HOW <strong>THE DRUMEO P4 PRACTICE PAD</strong><sup>&trade;</sup><br
                        class="show-for-medium"> COMPARES TO THE ALTERNATIVES
            </h1></div>
        <table class="w-full max-w-2xl mx-auto">
            <tbody>
            <tr>
                <td></td>
                <td>
                    <img src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/pad-spread.png" alt="Drumeo practice pad"><br>DRUMEO P4<br> PRACTICE PAD
                </td>
                <td><img src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/other-pad.png" alt="Other brand practice pad"><br>OTHER<br> PRACTICE PADS
                </td>
            </tr>
            <tr>
                <td>Snare-Like Surface</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-check"></i></td>
            </tr>
            <tr>
                <td>Practice Rudiments</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-check"></i></td>
            </tr>
            <tr>
                <td>Designed By An Instructor</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-adjust"></i></td>
            </tr>
            <tr>
                <td>Hand Assembled</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-adjust"></i></td>
            </tr>
            <tr>
                <td>Made In The USA</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-adjust"></i></td>
            </tr>
            <tr>
                <td>Worldwide Shipping</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-adjust"></i></td>
            </tr>
            <tr>
                <td>High-Tom Surface</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-minus"></i></td>
            </tr>
            <tr>
                <td>Floor-Tom Surface</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-minus"></i></td>
            </tr>
            <tr>
                <td>Ride-Cymbal Surface</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-minus"></i></td>
            </tr>
            <tr>
                <td>Practice Movement</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-minus"></i></td>
            </tr>
            <tr>
                <td>Practice Musicality</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-minus"></i></td>
            </tr>
            <tr>
                <td>90-Day Guarantee</td>
                <td><i class="fas fa-check"></i></td>
                <td><i class="fas fa-minus"></i></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="bg-gray guarantee-wrap">
        <div class="row guarantee">
            <div class="medium-2 columns"><img src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/guarantee.png" alt="Guarantee Badge" />
            </div>
            <div class="medium-10 columns text-left show-for-medium">
                <p>We’re so confident that you’ll LOVE the Drumeo P4 Practice Pad that you’ll get a full 90 day 100% money-back guarantee, so you can try it risk-free for three full months. If it’s not for you, simply send it back to us for a full refund. </p>
            </div>
        </div>
    </div>
    <div class="row customize-section">
        <div class="columns"><img src="https://www.musora.com/musora-cdn/image/width=1300,quality=95/https://s3.amazonaws.com/drumeo-packs/practice-pad/photo-bow.png" alt="Practice pad photos"></div>
        <div id="customize-anchor" class="anchor"></div>
        <div class="columns customize text-center">
            <div class="final-pitch">
                @if(floatval($productPrices['practicepad']->price) > floatval($productPrices['practicepad']->discounted_price))
                    <h1><s>WAS ${{ floatval($productPrices['practicepad']->price) }}</s> NOW ${{ floatval($productPrices['practicepad']->discounted_price) }}</h1>
                @else
                    <h1>ONLY ${{ floatval($productPrices['practicepad']->discounted_price) }}</h1>
                @endif
                <a class="join stores big"
                        href="/ecommerce/add-to-cart?products[practicepad]=1">Click Here To Order &raquo;</a>
                <p>Or buy through your favorite online stores:</p>
                {{--<a target="_blank" class="join stores amazon" href="https://www.amazon.com/dp/B01IRNGWDK"><img style="padding-top: 5px;"--}}
                {{--src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/amazon-logo.png"></a>--}}
                <a
                    target="_blank"
                    class="join stores musicians-friend"
                    href="https://www.musiciansfriend.com/accessories/drumeo-p4-practice-pad"
                >
                    <img src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/musicians-friend-logo.png" alt="musicians friend">
                </a>
                <br class="show-for-medium-only">
                <a target="_blank"
                   class="join stores guitar-center"
                   href="https://www.guitarcenter.com/Drumeo/P4-Practice-Pad.gc">
                    <img style="padding-bottom: 2px;" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/guitar-center-logo.png" alt="guitar center">
                </a>
                <a
                    target="_blank"
                    class="join stores thomann"
                    href="https://www.thomann.de/gb/drumeo_p4_pat_petrillo_practice_pad.htm"
                >
                    <img src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/thomann-logo.png" alt="thomann">
                </a>
            </div>


            <p><strong> <a class="bulk-order anchor-slide" href="#bulk-order-anchor">Are you a drum shop? Click here <br
                                class="hide-for-medium"> to stock the pad in your store!</a> </strong></p>

            <div class="credit-cards columns">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i> <i
                        class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <div class="columns questions">
                <p><strong>Any questions?</strong><br class="hide-for-medium"> Call us toll-free at <a
                            href="tel:+18004398921">1-800-439-8921</a> <br class="hide-for-medium"> or directly at <a
                            href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
        <div id="bulk-order-anchor" class="anchor columns"></div>
        <div id="bulkOrder" class="text-center">
            <h4 class="columns"><strong>Get a better rate when ordering in bulk.</strong></h4>

            <form id="ajaxForm" class="ajax-form" name="drumeo" method="post" action="/form-mail/practice-pad.php">
                <input type="hidden" name="subject" value="Bulk Order - P4 Practice Pad"/> <input type="hidden"
                        name="redirect" value="/drumshop/practice-pad-full/?thankyou"/>
                <div class="medium-6 columns half-padding">
                    <input name="email" type="email" placeholder="Email Address" required/>
                </div>
                <div class="medium-6 columns half-padding">
                    <input name="company" type="text" placeholder="Company"/>
                </div>
                <div class="medium-6 columns half-padding">
                    <input name="country" type="text" placeholder="Country"/>
                </div>
                <div class="medium-6 columns half-padding"><input name="quantity" type="number"
                            placeholder="Book Quantity"/>
                </div>
                <div class="columns half-padding">
                    <textarea name="message" placeholder="Optional Message"></textarea>
                </div>
                <div class="medium-6 columns half-padding">
                    <div class="g-recaptcha" data-sitekey="6LcBSxYUAAAAANEVgiFM3kmHOjzbcrkspWBtQd9n"></div>
                </div>
                <div class="medium-6 columns text-right half-padding">
                    <button class="button join" type="submit">
                        <span class="pre-add"><i class="fad fa-paper-plane"></i> Send</span> <span class="pending hide"><i
                                    class="fad fa-spinner-third fa-spin"></i> Sending</span> <span class="success hide"><i
                                    class="fad fa-thumbs-up"></i> Sent</span> <span class="fail hide"><i
                                    class="fad fa-exclamation-triangle"></i> Oops</span>
                    </button>
                </div>
            </form>

            <div class="disclaimer"></div>

            @include('drumeo.lead-gen.partials.thank-you-box', [
                "headline" => "SENT",
                "body" => "We'll respond to you soon! If you haven't heard back in the next week, please email <a class='text-white' href='{{ get_musora_brand_base_url() }}/contact'>contact us</a>."
            ])
        </div>
    </div>
    @include("drumeo.sales.partials._footer")
@stop
