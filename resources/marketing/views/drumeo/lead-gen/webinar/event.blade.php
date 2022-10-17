@extends('drumeo.lead-gen.lead-gen-layout')

@section('meta')
    <title>Coming Back To The Drums | Drumeo</title>
    <meta name="description"
            content="In this one-hour live event, you’ll get the ammunition you need ‘come back to the drums’ with more clarity, clearer expectations, and a practice plan that’s guaranteed to work.">

    <meta property="og:description"
            content="In this one-hour live event, you’ll get the ammunition you need ‘come back to the drums’ with more clarity, clearer expectations, and a practice plan that’s guaranteed to work.">
    <meta property="og:url" content="https://www.drumeo.com/druminar/coming-back-to-the-drums">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/header.jpg"/>
@stop()

@section('styles')
    <link href="{{ asset('/assets/members-area/css/gulp/webinar.css') }}" rel="stylesheet">
@stop()

@section('content')
    <section class="event-wrap">
        <div class="row text-center">
            <h1><strong>COMING BACK <br class="hide-for-medium">TO THE DRUMS</strong></h1>
            <h5>Re-Ignite Your Passion & Establish <br class="hide-for-medium">
                A Plan For Success On The Drums</h5>
            <br><br><br><br>
            <h2 class="red"><strong>Sorry, the recording and special offer<br class="show-for-medium"> are no longer available.</strong></h2>
            <br><br>
        </div>


        {{--new 2022 method--}}

        {{--<div class="flex" style="height: 640px;">--}}
            {{--<iframe class="w-9/12 h-full" src="https://www.youtube.com/embed/5qap5aO4i9A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
            {{--<iframe class="w-3/12 h-full" src="https://www.youtube.com/live_chat?v=5qap5aO4i9A&embed_domain=dev.drumeo.com" ></iframe>--}}
        {{--</div>--}}


        {{--<div class="row">--}}
            {{--<div class="columns video">--}}
                {{--<div class="columns flex-video widescreen">--}}
                    {{--<iframe src="//www.youtube.com/embed/3bSYzdnfIhE?autoplay=1;iv_load_policy=3;rel=0;showinfo=0"--}}
                            {{--frameborder="0" allowfullscreen=""></iframe>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="columns chat-wrap">--}}
                {{--<div class="chat-border">--}}
                    {{--<iframe class="chat" width="100%" height="333px" frameborder="0" scrolling="no" marginheight="0"--}}
                            {{--marginwidth="0" allowtransparency="true"--}}
                            {{--src="https://chatroll.com/embed/chat/druminar?id=paXdD5tV6i0&platform=html"></iframe>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row text-center">--}}
            {{--<div class="columns">--}}
                {{--<br><br>--}}
                {{--<a style="padding: 17px 7%;" class="join" href="/druminar/coming-back-to-the-drums/special-bundle">YOUR DRUMEO <br class="hide-for-medium">SPECIAL OFFER &raquo;</a>--}}
                {{--<h5 style="margin: 7px auto 0;"><em>This deal is only available <br class="hide-for-medium">until June 16th at midnight.</em></h5>--}}
            {{--</div>--}}
        {{--</div>--}}
    </section>
@stop
