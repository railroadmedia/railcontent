@extends('musora._partials.layout')

@section('head-includes')
    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop

{{-- <!-- Main --> --}}
@section('layout-body')

    <section class="py-24 md:py-40 text-white text-center relative">
        <img 
            src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/header-about.jpg"
            class="absolute object-cover w-full h-full top-0 left-0 z-[-2] transition-opacity opacity-0"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
        <div class="container mx-auto relative z-0">
            <h1><strong>Contact Us</strong></h1>
        </div>
    </section>

    <div class="pt-20 pb-10 text-white bg-[#000c17]">
        <div class="container mx-auto text-center">
            <h2 class="font-bold text-xl md:text-3xl">We'd love to hear from you!</h2>
            <p class="mt-5 text-sm md:text-base text-[#a1afc9] max-w-3xl mx-auto">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!
                <br><br>
                You may find your response in our <a href="https://help.drumeo.com/" class="tw-font-bold tw-no-underline tw-text-drumeo" title="go to help center"><u>Help Center here</u></a>, but if not, fill out the below.</p>
        </div>
    </div>

    <div class="bg-[#000c17]">
        <div class="max-w-3xl mx-auto">
            @include('musora._partials.forms.contact-form')
        </div>
    </div>
    
    <div class="pt-16 text-white bg-[#000c17]">
        <div class="container mx-auto text-center max-w-3xl">
            <div class="flex flex-wrap items-center">
                <h2 class="font-bold text-xl md:text-3xl w-full">Old fashioned phone calls work too!</h2>
                <div class="md:w-1/3 w-full px-3 md:px-4 py-5">
                    <p class="mx-auto text-sm md:text-base"><strong>Toll-Free</strong><br> <a href="tel:+18004398921">1-800-439-8921</a></p>
                </div>
                <div class="md:w-1/3 w-full px-3 md:px-4 py-5 border-r border-l">
                    <p class="mx-auto text-sm md:text-base"><strong>Direct/International</strong><br> <a href="tel:+16048557605">1-604-855-7605</a></p>
                </div>
                <div class="md:w-1/3 w-full px-3 md:px-4 py-5">
                    <p class="mx-auto text-sm md:text-base"><strong>Office Hours</strong><br> <a target="_blank" href="https://www.google.com/search?q=time+in+pacific+time">Monday - Friday<br> 8 AM - 4 PM Pacific Time</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 text-white bg-[#000c17]">
        <div class="container mx-auto text-center">
            <h2 class="font-bold text-xl md:text-3xl">Want to join the team?</h2>
            <p class="mt-5 text-sm md:text-base text-[#a1afc9]">For current available positions at our company, please visit <a href="/careers"><u>Musora.com/Careers</u></a>.</p>
        </div>
    </div>

    @include('musora._partials._lets-chat', [
        'onContact' => true
    ])

@stop

