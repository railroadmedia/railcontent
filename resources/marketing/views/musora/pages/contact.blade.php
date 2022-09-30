@extends('musora._partials.layout')

@section('head-includes')
    <title>Contact Us | Musora</title>
    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://musora-center.s3.amazonaws.com/homepage/2021/share-image.jpg">
@endsection

<!-- Main -->
@section('layout-body')

<section class="py-24 md:py-40 text-white text-center bg-center bg-cover" style="background-color:#1a1e58;background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/header-about.jpg);">
    <div class="container mx-auto relative z-0">
        <h1 class="text-2xl sm:text-4xl lg:text-5xl"><strong>Contact Us</strong></h1>
    </div>
</section>

<div class="pt-28 pb-8 text-white" style="background:#000c17;">
    <div class="container mx-auto text-center">
        <h2 class="font-bold text-xl md:text-3xl">We'd love to hear from you!</h2>
        <p class="mt-5 text-sm md:text-base text-[#a1afc9] max-w-3xl mx-auto">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!
            <br><br>
            You may find your response in our <a href="https://help.drumeo.com/" class="font-bold no-underline text-white" title="go to help center">Help Center here</a>, but if not, fill out the quick form below</a>.
        </p>
    </div>
</div>

<!-- Form -->
<section id="app" class="bg-[#000c17] tw-text-white">
    <div class="container mx-auto text-center max-w-3xl">
        <contact-email-form 
            brand="drumeo"
            captchakey="6LcBSxYUAAAAANEVgiFM3kmHOjzbcrkspWBtQd9n "
            email-subject="Support Request From Drumeo.com"
            email-type="support-contact"
            email-endpoint="/laravel/public/mailora/public/send"
            email-logo="https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo.png"
            input-label="Report your issue here.."
            recipient="support@drumeo.com"
            success-message="Your email has been sent!"
        />
    </div>
</section>

<!-- Contact -->
<section class="flex flex-col text-center bg-[#000c17] text-white">
    <div class="container mx-auto text-center max-w-3xl">
        <h2 class="font-bold text-3xl">Old fashioned phone calls work too!</h2>
        <div class="flex mb-8 flex-col items-center sm:flex-row">
            <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3 border-solid border-0 border-b-2 sm:border-b-0 sm:border-r-2 border-gray-300">
                <h4 class="font-bold mb-1">Toll-Free</h4>
                <a href="tel:+18004398921" class=" text-white sm:mb-2 no-underline text-base">1-800-439-8921</a>
            </div>
            <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3 border-solid border-0 border-b-2 sm:border-b-0 sm:border-r-2 border-gray-300">
                <h4 class="font-bold mb-1">Direct/International</h4>
                <a href="tel:+16048557605" class=" text-white sm:mb-2 no-underline text-base">1-604-855-7605</a>
            </div>
            <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3">
                <h4 class="font-bold mb-1">Office Hours</h4>
                <p class="text-white text-base"> Monday-Friday</p>
                <p class="text-white sm:mb-2 text-base">8 AM - 4 PM Pacific Time</p>
            </div>
        </div>
    </div>
</section>

<div class="pt-8 pb-16 text-white" style="background:#000c17;">
    <div class="container mx-auto text-center">
        <h2 class="font-bold text-xl md:text-3xl">Want to join the team?</h2>
        <p class="mt-5 text-sm md:text-base text-[#a1afc9]">For current available positions at our company, please visit <a href="/careers" class="font-bold text-white">Musora.com/Careers</a>.</p>
    </div>
</div>

<section class="py-12 sm:py-16 lg:py-20 px-5 relative overflow-hidden text-white text-center" style="background:linear-gradient(40deg,#03c8ac, #0976db, #9a01ee, #f61a30);">
    <div class="container mx-auto max-w-xl relative z-0">
        <h3 class="font-bold text-3xl"><strong>Let’s chat.</strong></h3>
        <p class="max-w-2xl my-4 leading-normal">We want to fill the world with music! So if you’re looking to partner, inquire about media opportunities, join our team, or just want to ask a few questions -- click  the button  below to start the conversation.</p>
        <a class="btn-primary bg-white text-[#0b76db]" href="/careers">
            SEE CAREER OPENINGS
        </a>     
    </div>
</section>

@stop
