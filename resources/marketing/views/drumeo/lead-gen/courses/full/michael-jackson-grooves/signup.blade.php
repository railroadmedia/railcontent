@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Jonathan Moffett - The Grooves Of Michael Jackson | Drumeo</title>
    <meta name="description" content="Sign up on this page and you’ll get 10 videos with Jonathan Moffett that are normally reserved for Drumeo members.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Jonathan Moffett - The Grooves Of Michael Jackson">
    <meta property="og:description" content="Sign up on this page and you’ll get 10 videos with Jonathan Moffett that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/michael-jackson-grooves/">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-course.css') }}" rel="stylesheet">
@stop

@php
    $lessons = [
        [
            "lessonNumber" => "1",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-1.jpg",
            "lessonText" => "Introduction",
            "description" => "Meet Jonathan “Sugarfoot” Moffett, one of pop’s most in-demand drummers for 30-years."
        ],
        [
            "lessonNumber" => "2",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-2.jpg",
            "lessonText" => '"Wanna Be Startin Something"',
            "description" => "Learn how Jonathan earned the nickname “Sugarfoot” with this live favorite’s driving kick pattern.",
        ],
        [
            "lessonNumber" => "3",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-3.jpg",
            "lessonText" => '"Smooth Criminal"',
            "description" => "One of Michael’s most iconic grooves, Jonathan explains the importance of precision when replicating this part in an arena setting.",
        ],
        [
            "lessonNumber" => "4",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-4.jpg",
            "lessonText" => '"Billie Jean"',
            "description" => "Jonathan shows you how to hit another gear with his electrifying performance of one of Michael’s most intense live tracks.",
        ],
        [
            "lessonNumber" => "5",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-5.jpg",
            "lessonText" => '"Human Nature"',
            "description" => "A challenge in coordination and feel, Jonathan walks you through playing one of his personal favorite Michael Jackson songs.",
        ],
        [
            "lessonNumber" => "6",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-6.jpg",
            "lessonText" => '"Beat It"',
            "description" => "One of the world’s most recognized drum beats, Jonathan describes how to take a seemingly ordinary drum pattern to extraordinary levels.",
        ],
        [
            "lessonNumber" => "7",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-7.jpg",
            "lessonText" => '"Threatened"',
            "description" => "Combining sonic precision with visual excitement, Jonathan shows you his signature kung fu cymbal moves.",
        ],
        [
            "lessonNumber" => "8",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-8.jpg",
            "lessonText" => '"Thriller"',
            "description" => "Step into the sweet shoes of Sugarfoot as he performs the title track of the world’s all-time best selling album.",
        ],
        [
            "lessonNumber" => "9",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-9.jpg",
            "lessonText" => '"Working Day And Night"',
            "description" => "Michael counted on Sugarfoot’s driving kick drum and articulate cymbal shots on this R&B/pop hybrid.",
        ],
    ];
@endphp

@section('content')

    <header class="header" style="background: linear-gradient(180deg, #010101 25%, #021526 66%, #021526 80%, #000);">
        <div class="container px-4 mx-auto max-w-6xl" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/header.jpg);">
            <div class="text-center">
                <div class="course-logo sugarfoot">
                    <h3>The Grooves Of</h3>
                    <h2>Michael Jackson</h2>
                </div>
                <p>Enter your email below <br class="inline sm:hidden"> for 10 free video lessons...</p>
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "formId" => "Drumeo - Engagement - Trigger - Grooves of MJ - Web Form",
                    "formName" => 'Grooves Of Michael Jackson',
                    "buttonText" => 'Send The Videos&nbsp;'
                ])
            </div>
        </div>
    </header>

    @include('drumeo.lead-gen.courses.full.partials.instructor',[
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/avatar.jpg",
        "title" => '
            Learn From The Master --
            <br class="hidden sm:inline lg:hidden">
            Michael\'s Go-To Live Drummer
        ',
        "desc" => '“Billie Jean”, “Smooth Criminal”, “Thriller”... For 30-years, Michael Jackson’s music topped charts around the globe and packed stadiums in every city. His shows were a must-see spectacle of music, dance, and visuals requiring top performers in every discipline. During his career, Michael relied on one drummer more than any other to deliver night in, night out: Jonathan “Sugarfoot” Moffett.
        <br><br>
        In this 10-video series, you’ll learn Michael Jackson’s most iconic drum grooves firsthand from the man who brought them to life in arenas around the world. “Sugarfoot” doesn’t just break down the technical, he teaches you the composure and passion required to hold it down for the world’s biggest pop artist.'
    ])

    @include('drumeo.lead-gen.courses.full.partials.lessons',[
        "headLine" => "THE SERIES"
    ])

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "#eff0f0",
        "textColor" => "black",
    ])

    <section class="final">
        <div class="container px-4 mx-auto max-w-6xl">
            <div class="course-logo sugarfoot">
                <h3>The Grooves Of</h3>
                <h2>Michael Jackson</h2>
            </div>
            <p>Enter your email below <br class="sm:hidden"> for 10 free video lessons...</p>
            <br><br class="hidden sm:inlin">
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "formId" => "Drumeo - Engagement - Trigger - Grooves of MJ - Web Form",
                "formName" => 'Grooves Of Michael Jackson',
                "buttonText" => 'Send The Videos&nbsp;'
            ])
        </div>
    </section>
@stop
