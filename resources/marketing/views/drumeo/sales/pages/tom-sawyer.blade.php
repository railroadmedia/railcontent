<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    @include('drumeo._partials._favicons')

    <title>Tom Sawyer Practice Tool Demo | Drumeo</title>
    <meta property="og:title" content="Tom Sawyer Practice Tool Demo">

    <meta name="description" content="Accurate sheet music that scrolls-along with the music -- and practice tools to slow it down, speed it up, create loops, add or remove the metronome, and… well, play songs faster!">
    <meta property="og:description" content="Accurate sheet music that scrolls-along with the music -- and practice tools to slow it down, speed it up, create loops, add or remove the metronome, and… well, play songs faster!">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"/>

    {!! \App\Analytics\Tracker::trackPageView() !!}

    {!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body>
{!! \App\Analytics\Tracker::bodyTop() !!}

<div class="w-full relative overflow-hidden" style="padding-bottom: 100vh;">
    <iframe class="fixed inset-0 h-full w-full absolute"
            src="https://www.soundslice.com/scores/169812/embed/?api=1&amp;scroll_type=2&amp;branding=0"
            frameborder="0" allowfullscreen="allowfullscreen"></iframe>
</div>


{!! \App\Analytics\Tracker::bodyBottom() !!}

</body>
</html>
