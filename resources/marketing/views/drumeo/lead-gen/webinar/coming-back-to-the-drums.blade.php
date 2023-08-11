@extends('drumeo.lead-gen.lead-gen-layout')

@section('meta')
    <title>Coming Back To The Drums | Drumeo</title>
    <meta name="description" content="In this one-hour live event, you’ll get the ammunition you need ‘come back to the drums’ with more clarity, clearer expectations, and a practice plan that’s guaranteed to work.">

    <meta property="og:description" content="In this one-hour live event, you’ll get the ammunition you need ‘come back to the drums’ with more clarity, clearer expectations, and a practice plan that’s guaranteed to work.">
    <meta property="og:url" content="https://www.drumeo.com/druminar/coming-back-to-the-drums">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/header.jpg"/>
@stop()

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/webinar.css') }}" rel="stylesheet">
@stop()

@section('scripts')
    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
    <script>
        $(document).ready(function () {

            var showModal = location.search.substr(1).includes('thankyou');

            if (showModal) {
                $('#previewModal').foundation('open');
            }
        });
    </script>
@stop()

@section('content')

    <header class="jared-header">
        <div class="row">
            <div class="logo">
                <h1>Jared Falk's<br> <strong>Coming Back<br class="hide-for-medium"> To The Drums</strong></h1>
            </div>
            <p><em>Live Online Event</em></p>
        </div>
    </header>

    <section class="three-details">
        <div class="row">
            <div class="detail-box clearfix">
                <i class="fas fa-calendar-alt"></i>
                <p><strong>When</strong><br> JUNE 12 @ 5:00PM PDT<br>
                    <em>(7PM Central / 8PM Eastern)</em></p>
            </div>
            <br class="hide-for-medium">
            <div class="detail-box clearfix">
                <i class="fas fa-location-arrow"></i>
                <p><strong>Location</strong><br> ANYWHERE - WATCH ONLINE<br>
                    <em>This is a live-streaming video event.</em></p>
            </div>
            <br class="hide-for-large">
            <div class="detail-box clearfix">
                <i class="fas fa-signal-alt-3"></i>
                <p><strong>Skill Level</strong><br> Beginner & Intermediate<br>
                    <em>But all levels are welcome.</em></p>
            </div>
            <br class="hide-for-large"> <a {{--data-open=signUpModal--}} class="join sold-out">SORRY, YOU MISSED IT</a>
            {{--<p><em>The Live Event Starts In <strong class="tzcd">A Limited Time</strong></em></p>--}}
        </div>
    </section>

    <section class="jared-letter">
        <div class="row">
            <h2 class="blue-tab"><strong>For Returning Drummers Only</strong></h2>
            <p class="text-left">I hear it all the time, “I’m coming back to the drums, but…”.
                <br><br> Maybe you don’t know where to start. Maybe it’s not feeling as easy as it used to be. And we both know that you don’t want to waste your time sorting through YouTube videos without knowing whether they’ll actually help.
                <br><br> You just want to PLAY THE DRUMS!
                <br>
                <img class="quote float-right" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/quote-image.png">
                <br> You want to play along to your favorite songs. You want to play the beats and fills that you used to love — and add new ones that you always wished you could play. And you want to have fun!
                <br><br> So in this one-hour live event, you’ll get the ammunition you need ‘come back to the drums’ with more clarity, clearer expectations, and a practice plan that’s guaranteed to work.
                <br><br> And the best part? It’s live. So we’ll take YOUR questions and talk about what’s working, what’s not, and make sure that you have a better plan going forward. Just click any of the big buttons on this page to register. Let’s do this!
                <br><br> To Your Drumming Success,
            </p>
            <div class="avatar">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/jared-falk.jpg">
                <h4><strong>Jared Falk</strong></h4>
                <h5><strong>DRUMEO CO-FOUNDER & CEO</strong></h5>
            </div>
            <div class="awards columns">
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/modern-drummer-award.png">
                </div>
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/drum-magazine-award.png">
                </div>
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/rhythm-magazine-award.png">
                </div>
            </div>
        </div>
    </section>

    <section class="equipment text-center">
        <div class="row">
            <h2 class="blue-tab"><strong>What You'll Need</strong></h2>
            <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/computer.png">
            <div class="details columns no-padding">
                <div class="detail-box clearfix">
                    <i class="fa-light fa-globe"></i>
                    <p>
                        <strong>INTERNET READY DEVICE</strong><br> This is a live-streaming event. You’ll be able to watch from any internet-ready phone, tablet, laptop, or desktop computer.
                    </p>
                </div>
                <div class="detail-box clearfix">
                    <i class="icon-drums2"></i>
                    <p>
                        <strong>DRUM KIT</strong><br> This isn’t a requirement, but it’ll help. We’ll talk about setting up your kit and go through a few exercises and tips for what you should be practicing the most.
                    </p>
                </div>
                <div class="detail-box clearfix">
                    <i class="fa-light fa-file-edit"></i>
                    <p>
                        <strong>PEN & PAPER</strong><br> I know everybody isn’t a ‘pen and paper’ note taker. And that’s fine. If you are, bring a pen and paper. If not, bring whatever works best for you!
                    </p>
                </div>
            </div>
            <br>
            <h2 class="blue-tab"><strong>It's Free, But There's One Catch...</strong></h2>
            <p>This live event won’t cost you a dollar, but there’s ONE CATCH: If you register, you’re expected to add this event to your calendar and actually show up.
                <br><br>
                I’m not doing this to help no-shows. I’m here to help returning drummers who are committed to seeing faster results. That means showing up on time, having a pen and paper ready (or whatever you need to take notes), and preparing YOUR questions so I can help.</p>
        </div>
    </section>
    <section class="final text-center">
        <div class="row">
            <div class="logo">
                <h1>Jared Falk's<br> <strong>Coming Back<br class="hide-for-medium"> To The Drums</strong></h1>
            </div>
            <h2>LIVE ONLINE EVENT ON <br class="hide-for-medium">JUNE 12 @ 5:00PM PST</h2>

            <h5><em>Re-Ignite Your Passion & Establish <br class="hide-for-large">A Plan For Success On The Drums</em></h5>

            <a {{--data-open=signUpModal--}} class="join white sold-out">SORRY, YOU MISSED IT</a>
            {{--<p><em>The Live Event Starts In <strong class="tzcd">A Limited Time</strong></em></p>--}}
        </div>
    </section>
    <section class="billy-quote">
        <div class="row">
            <div class="columns">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/webinar/billy-cobham.jpg">
                <p>“Jared Falk and his team have my confidence and support in what is done to promote music through the art of drumming and percussion.”
                    <strong>BILLY COBHAM</strong>
                    <em>Legendary Drummer For Miles Davis,<br class="hide-for-medium">
                        Spectrum, and many others.</em></p>
            </div>
        </div>
    </section>

    <div class="reveal medium" id="signUpModal" data-reveal>
        <section class="header pop-up">
            <div class="logo">
                <h1><strong>Coming Back<br class="hide-for-medium"> To The Drums</strong></h1>
            </div>
            <h2>LIVE ONLINE EVENT ON <br class="hide-for-medium">JUNE 12 @ 5:00PM PST</h2>
            {{--<p>Just enter your name and email<br class="hide-for-medium"> to reserve your seat:</p>--}}
        </section>
    </div>

    <div class="reveal medium text-center" id="previewModal" data-reveal>
            <h1><strong>SUCCESS!</strong></h1>
            <h2><strong>CHECK YOUR EMAIL</strong></h2>
            <p>You will receive an email from Jared Falk and “team@drumeo.com” within 10 minutes.
                If you don’t, then check your spam folder or re-enter your email address again.
                <br><br>
                <span class="red">
                    Important: Click the button below to <br>
                    add the event to your online calendar.</span>
            </p>

            <div class="addeventatc">
                Add to Calendar <i class="fas fa-caret-down"></i>
                <span class="start">06/12/2019 05:00 PM</span>
                <span class="end">06/12/2019 06:00 PM</span>
                <span class="timezone">America/Los_Angeles</span>
                <span class="title">Drumeo: Coming Back To The Drums</span>
                <span class="description">Get the ammunition you need to come back to the drums with more clarity, clearer expectations, and a practice plan that’s guaranteed to work: <br/><br/> https://drumeo.com/druminar/coming-back-to-the-drums/june-12-live-event/</span>
                <span class="location">Online (See link in description)</span>
                <span class="organizer">Drumeo</span>
                <span class="organizer_email">support@drumeo.com</span>
            </div>

            <div class="social-links">
                <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
    </div>
@stop
