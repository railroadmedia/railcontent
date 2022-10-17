@extends('pianote.lead-gen.lead-gen-layout')

@section('meta')
    @parent
    <title>Sight-Reading Made Simple | Pianote</title>
    <meta name="description" content="If you’ve ever struggled through a music class or felt daunted by the notes on the page -- let us show you how easy reading music can be.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Sight-Reading Made Simple">
    <meta property="og:description" content="If you’ve ever struggled through a music class or felt daunted by the notes on the page -- let us show you how easy reading music can be.">
    <meta property="og:url" content="https://www.pianote.com/sight-reading-made-simple">
    <style>

        .join.smaller {
            padding:8px 20px;
            font-size:14px;
        }

        @media only screen and (min-width:40em) {
            .join.smaller {
                font-size:16px;
                padding:13px 30px;
            }
        }
    </style>
@endsection
