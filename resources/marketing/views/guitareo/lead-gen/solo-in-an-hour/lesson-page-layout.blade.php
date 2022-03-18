@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <meta name="robots" content="noindex">
    <title>@if(!empty($title)) {{ $title }} @endif | Solo In An Hour | Guitareo</title>
    <meta property="og:title" content="Solo In An Hour">
    <meta name="description" content="Play your first solo in less than 60 minutes"/>
    <meta property="og:description" content="Play your first solo in less than 60 minutes">
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/solo-in-an-hour/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/solo-in-an-hour/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link rel="stylesheet" href="{{ asset('/assets/marketing/lead-gen.css') }}">
@stop

@section('layout-scripts')
    @parent

    <script type="text/javascript">
        $(document).ready(function (e) {
            $(document).foundation();
            $('.lesson-row').click(function () {
                    $('.more-info').removeClass('active');
                    $(this).find('.more-info').addClass('active');
                    e.preventDefault();
                    e.stopPropagation();
                }
            );
            $('.more-info').click(function (ev) {
                    $('.more-info').removeClass('active');
                    ev.preventDefault();
                    ev.stopPropagation();
                }
            );
            $('.assignment-row .fa-angle-down').click(function() {
                $(this).parent().parent().toggleClass('active');
            });
        });

        (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://guitareo.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

        var disqus_config = function () {
            this.page.url = 'https://www.guitareo.com/solo-in-an-hour/lessons/';
        };
    </script>
    <script src="/assets/js/modal-autoplay.js"></script>
@stop

@section('layout-body')
    @php
        $themeColor = '#ffde16';
        $fromText = 'solo in an hour';
        $allLessons = '/solo-in-an-hour/lessons';
    @endphp

    @include('guitareo.lead-gen.partials._lesson-page-layout1')
@stop