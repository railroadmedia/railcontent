@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <meta name="robots" content="noindex">
    <title>{{ $title }} | Guitareo</title>
    <meta name="description" content="Sign up on this page and you'll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.">
    <meta property="og:image" content="https://s3.amazonaws.com/guitareo/acoustic-jump-start/6.jpg" style="display: none;">
    <meta property="og:title" content="Acoustic Guitar Jumpstart">
    <meta property="og:description" content="Sign up on this page and you'll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.">
    <meta property="og:url" content="https://www.guitareo.com/acoustic-guitar-jumpstart/">
@stop

@section('layout-scripts')
    @parent

    <script type="text/javascript">
        $(document).ready(function (e) {
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
        });

        (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://guitareo.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

        var disqus_config = function () {
            this.page.url = 'https://www.guitareo.com/acoustic-guitar-jumpstart/course-index/2';
        };
    </script>
@stop

@section('body')
    @php
        $PDF = 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/acoustic-guitar-jump-start.pdf';
        $themeColor = '#ff8c00';
        $fromText = 'ACOUSTIC GUITAR JUMPSTART';
        $allLessons = '/acoustic-guitar-jumpstart/course-index';
    @endphp

    @include('guitareo.lead-gen.partials._lesson-page-layout1')
@stop