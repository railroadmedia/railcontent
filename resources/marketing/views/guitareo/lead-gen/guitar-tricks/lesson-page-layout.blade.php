@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <meta name="robots" content="noindex">
    <title>{{ $title }} | 2 Simple Guitar Tricks | Guitareo</title>
    <meta name="description" content="How to use vibrato & palm muting to unlock new possibilities on the guitar."/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/og-image.jpg">
    <meta property="og:title" content="2 Simple Guitar Tricks">
    <meta property="og:description" content="How to use vibrato & palm muting to unlock new possibilities on the guitar.">
    <meta property="og:url" content="https://www.guitareo.com/guitar-tricks/">
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
            this.page.url = 'https://www.guitareo.com/guitar-tricks/your-videos/';
        };
    </script>
@stop

@section('layout-body')
    @php
        $themeColor = 'gold';
        $fromText = '2 SIMPLE GUITAR TRICKS';
        $allLessons = '/guitar-tricks/your-videos';
    @endphp

    @include('guitareo.lead-gen.partials._lesson-page-layout1')
@stop