@extends('guitareo.lead-gen.lead-gen-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>2 Simple Guitar Tricks | Guitareo</title>
    <meta name="description" content="How to use vibrato & palm muting to unlock new possibilities on the guitar."/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/og-image.jpg">
    <meta property="og:title" content="2 Simple Guitar Tricks">
    <meta property="og:description" content="How to use vibrato & palm muting to unlock new possibilities on the guitar.">
    <meta property="og:url" content="https://www.guitareo.com/guitar-tricks/">
    @parent
@stop

@section('body')

    @include('guitareo.lead-gen.partials._course-lessons1', [
        "bgColor" => "#000316",
        "bgImg" => "https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/map-background.jpg",
        "img" => '<img class="h-20 md:h-28 lg:h-40 inline-block" style="margin-bottom: 0;" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/logo-with.png">',
        "rootLink" => "/guitar-tricks/your-videos/",
        "bonuses" => [
            [
            'URL' => '1-intro',
            'lessonNumber' => '1',
            'thumbUrl' => 'https://i.vimeocdn.com/video/997054724-4d463ff2db28c0ea62592effdb7f09a1df500854a839741b2a5caacecae484f6-d_180',
            'lessonName' => 'Introduction',
            'duration' => '1',
            ],
            [
            'URL' => '2-vibrato',
            'lessonNumber' => '2',
            'thumbUrl' => 'https://i.vimeocdn.com/video/997055252-6a79e3c18f41a2299a119f47d4cdd239280dfaaf6c0a60c358aa47f2542c3c2c-d_180',
            'lessonName' => 'Skill #1 - Vibrato',
            'duration' => '6',
            ],
            [
            'URL' => '3-shampoo',
            'lessonNumber' => '3',
            'thumbUrl' => 'https://i.vimeocdn.com/video/997056488-b8a318adb6981c3394bb2cc8ca65108ddafb390dec5f63c2fb4c058b0d7a97c8-d_180',
            'lessonName' => 'Shampoo Jingle',
            'duration' => '1',
            ],
            [
            'URL' => '4-palm-muting',
            'lessonNumber' => '4',
            'thumbUrl' => 'https://i.vimeocdn.com/video/997057305-44a6271229a63cf48cabd949ec2d8edd6d7bbb4af54f38c38236b0fc9f55e80f-d_180',
            'lessonName' => 'Skill #2 - Palm Muting',
            'duration' => '7',
            ],
            [
            'URL' => '5-truck',
            'lessonNumber' => '5',
            'thumbUrl' => 'https://i.vimeocdn.com/video/997057977-34a12c51aaa79cda646d8186793fcf677beb1610e4801404fc2e49247f4221d2-d_180',
            'lessonName' => 'Truck Jingle',
            'duration' => '1',
            ],
            [
            'URL' => '6-whats-next',
            'lessonNumber' => '6',
            'thumbUrl' => 'https://i.vimeocdn.com/video/997058436-babe1561549ca8e8b548cf70d98ff35cc84abc56ad6be9bfa00e911ffb0394d2-d_180',
            'lessonName' => 'What’s Next...',
            'duration' => '1',
            ],
        ]
    ])

@stop
