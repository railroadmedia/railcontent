@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent
    <title>You Can Be A Singer – Let’s Sing A Song! | Singeo</title>
    <meta name="description" content="There is no better way to start singing than by actually singing something!"/>

    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2022/og-image.jpg">
    <meta property="og:title" content="You Can Be A Singer – Let’s Sing A Song!">
    <meta property="og:description" content="There is no better way to start singing than by actually singing something!">
    <meta property="og:url" content="https://www.singeo.com/lets-sing-a-song/">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">
@stop

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
@stop

@section('body')
    <div class="overflow-hidden text-white px-3 py-10 sm:py-16" style="background-color:#000718;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                <div class="video-row relative mb-4 sm:mb-7">
                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/554944488" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>You Can Be A Singer – Let’s Sing A Song!</strong></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="px-3 pb-10 sm:pb-16 text-white" style="background-color:#000718;">
        <div class="container mx-auto clearfix" style="max-width:920px">
            <div class="text-left lesson-text">
                <p>There is no better way to start singing than by actually singing something! In this lesson, you will sing your first song. Don’t worry, it doesn’t have to sound good yet! This lesson is about getting you comfortable making sound.</p>
            </div>
        </div>
    </div>
@stop
