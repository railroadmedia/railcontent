@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}">
@stop

@section('content')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7 lg:py-12" style="background-color:#000a1e;">
        <div class="container mx-auto max-w-2xl clearfix">
            <div class="text-center sm:px-3">
                <img class="h-12 sm:h-16 lg:h-20" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/logo_centre_white.png">
                <h2 class="my-5"><strong>Your free drum lessons are on the way.</strong></h2>
                <h6 class="leading-normal">Before you get started, here’s a message from Domino Santantonio!</h6>
                <div class="aspect-16:9 w-full relative mx-auto inline-block rounded-xl my-7 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/E-mail.jpg"></div>
            </div>
        </div>
    </div>

@stop
