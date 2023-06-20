@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>David Raouf - Drum Set Maintenance | Drumeo</title>
    <meta name="description" content="Sign up on this page and you’ll get 7 videos with David Raouf that are normally reserved for Drumeo members.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/og-image.jpg" style="display: none;">
    <meta property="og:title" content="David Raouf - Drum Set Maintenance">
    <meta property="og:description" content="Sign up on this page and you’ll get 7 videos with David Raouf that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/drum-set-maintenance/">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-course.css') }}" rel="stylesheet">
@stop

@php
    $lessons = [
        [
            "lessonNumber" => "1",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/1.jpg",
            "lessonText" => "Drums",
            "description" => "The routine maintenance you KNOW you should be doing -- changing drum heads, oiling lugs, and removing scuff marks."
        ],
        [
            "lessonNumber" => "2",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/2.jpg",
            "lessonText" => "Cymbals",
            "description" => "A layer of dust and grime affects the sound of your cymbals. Learn how to keep them shimmering like they just left the factory."
        ],
        [
            "lessonNumber" => "3",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/3.jpg",
            "lessonText" => "Hardware",
            "description" => "Take care of your hardware, and it should last a lifetime. Learn these cheap tricks to prevent rust & breakdown."
        ],
        [
            "lessonNumber" => "4",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/4.jpg",
            "lessonText" => "Pedal",
            "description" => "Your pedal sees the most wear & tear on the kit -- use these tips to keep yours clean, springy, and squeak-free. "
        ],
        [
            "lessonNumber" => "5",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/5.jpg",
            "lessonText" => "Hoops",
            "description" => "Bent and rusty hoops are a common issue on older drum sets that can affect the shell over time. Keep your hoops round with this technique."
        ],
        [
            "lessonNumber" => "6",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/6.jpg",
            "lessonText" => "Snares",
            "description" => "Replacing snare wires and preventative maintenance on your snare thcontainer px-4 max-w-6xl mx-auto will keep your most valuable drum pristine."
        ],
    ];
@endphp

@section('content')

    <header class="header">
        <div class="container px-4 max-w-6xl mx-auto" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/header-gradient.jpg);">
            <div class="text-center">
                <div class="course-logo raouf">
                    <h3>Learn Drum Set</h3>
                    <h2>Maintenance</h2>
                    <h4 class="text-yellow">WITH DAVID RAOUF</h4>
                </div>
                <div class="condensed uppercase mb-2 text-xl sm:text-3xl">Keep your kit <strong><em>sparkling</em></strong><br class="sm:hidden"> with this free series</div>
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "formId" => "Drumeo - Engagement - Trigger - Drum Maintenance - Web Form",
                    "formName" => 'Drum Set Maintenance',
                    "buttonText" => 'Send The Videos&nbsp;'
                ])
            </div>
        </div>
    </header>

    @include('drumeo.lead-gen.courses.full.partials.lessons',[
        "headLine" => '
            Your guide to better sounding, nicer<br class="hidden sm:inline">
            looking, and longer-lasting gear.
        '
    ])

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "#eff0f0",
        "textColor" => "black",
    ])

    <section class="final">
        <div class="container px-4 max-w-5xl mx-auto">
            <div class="course-logo raouf">
                <h3>Learn Drum Set</h3>
                <h2>Maintenance</h2>
                <h4 class="text-yellow">WITH DAVID RAOUF</h4>
            </div>
            <p>Enter your email and receive <br class="sm:hidden"> the seven video series, FREE.</p>
            <br><br class="hidden sm:inline">
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "formId" => "Drumeo - Engagement - Trigger - Drum Maintenance - Web Form",
                "formName" => 'Drum Set Maintenance',
                "buttonText" => 'Send The Videos&nbsp;',
                "multipleSignUpFormsOnThePage" => true
            ])
        </div>
    </section>
@stop
