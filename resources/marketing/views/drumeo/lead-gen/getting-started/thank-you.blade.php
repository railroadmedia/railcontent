@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}">
@stop

@section('content')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7 lg:py-12" style="background-color:#000a1e;">
        <div class="container mx-auto max-w-2xl clearfix">
            <div class="text-center sm:px-3">
                <img class="h-12 sm:h-16 lg:h-20" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/logo_centre_white.png">
                <h2 class="my-5"><i class="fal fa-check-circle text-drumeo"></i> <strong>Success!</strong> Check your email.</h2>
                <h6 class="text-light-navy leading-normal">You will receive an email from team@drumeo.com within 10 minutes with your lessons. Good luck! And if you don’t receive that email for some funky reason, please check your spam folder or re-enter your email address again.</h6>
                <div class="aspect-16:9 w-full relative mx-auto inline-block rounded-xl my-7 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/E-mail.jpg"></div>
                <p class="leading-tight mb-5">In the meantime, subscribe on YouTube & get more of our free drum lessons!</p>
                <a target="_blank" href="https://www.youtube.com/freedrumlessons/" class="hover:opacity-80 transition-opacity"><p class="rounded-xl text-white inline-block px-4" style="background-color:#cd201f;"><i class="fab fa-youtube mr-1"></i> YouTube</p></a>

            </div>
        </div>
    </div>

@stop
