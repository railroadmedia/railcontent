@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>100 Drumming Anthems | Drumeo</title>
    <meta property="og:title" content="100 Drumming Anthems | Drumeo">

    <meta name="description" content="Get expertly transcribed sheet music for 100 of drumming’s biggest songs (FREE).">
    <meta property="og:description" content="Get expertly transcribed sheet music for 100 of drumming’s biggest songs (FREE).">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/og-image.png" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/100-songs/">
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
       
        @media (min-width:768px) {
             .background-gradient {
            background-image: linear-gradient(265deg, #0B76DB 0%, #010B1F 100%); 
        }
        }
        
        /* Styles for mobile screens */
        @media (max-width: 767px) {
            .background-gradient {
                background-image: linear-gradient(265deg, #00BEF3 0%, #02163D 100%);
            }
        .header-custom-section {
            font-size: 30px;
        }
        .container-custom-section{
            padding-left: 10px;
        }
        }
    </style>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop

@section('body-data')
    x-data ='{
    trailer : false,
    }'
@endsection

@section('content')
<!-- Hero banner -->
 <div class="overflow-hidden text-white px-3 py-5 sm:py-7 lg:py-12 background-gradient relative">
        <div class="container mx-auto max-w-3xl clearfix">
            <div class="text-center sm:px-3">
                                <img
                    class="h-12 transition-opacity opacity-0 my-2"
                    src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/logo.png"
                    alt="logo"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
                <h3 class="my-4 text-3xl"><strong>
                        Check your email for<br class="inline sm:hidden"> your free songs.</strong></h3>
                <p class="leading-normal mb-8">
                    Begin a free 30-day trial to test-drive<br class="inline sm:hidden">
                    the entire Drumeo song library!</p>
                
                    <div class="sm:py-10"> 
                        <img
                    class="transition-opacity opacity-0 "
                    src="https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/vinyl-header.png"
                    alt="logo"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                /> 
                <img
                    class="transition-opacity opacity-0 mr-10 w-20"
                    src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/arrow.png"
                    alt="arrow"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    style="position: absolute; bottom: 15px"
                />
            </div>
               
               
            </div>
        </div>
    </div>
    
<!-- Section with button -->
<section class="sticky lg:top-10 md:top-8 sm:top-8 text-center px-3 py-5 sm:py-7 z-40" style="background-color:#FFAC00;">
        <div class="container mx-auto max-w-5xl" >
            <h5 class="mb-4" style="line-height: 2rem">
                Start playing the songs you love<br class="inline sm:hidden">
                with a free 30-day trial to Drumeo.</h5>
            <a class="join blue smaller anchor-slide" href="#customize-anchor">FREE FOR 30 DAYS <i class="fas fa-arrow-right"></i></a>
        </div> 
</section>

<!-- Main section -->
<section class="flex flex-col tw-justify-items-center sm:justify-items-left align-center sm:p-9" style="background: #F5F5F5">


            @component('musora.sales.components.custom-section-100songs', [
                'title' => 'Change The Tempo',
                'subtitle' => 'Figure out the hard parts.',
                'description' => 'Slow down or speed up any section of a song to hear every note. Practice any song with your desired tempo.',
                'imageSrc' => 'https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/hard-parts.png',
                'altText' => 'drummer',
                'textOnLeft' => true, 
            ])
            @endcomponent

            @component('musora.sales.components.custom-image-100songs', [
                'title' => '5000+ songs',
                'subtitle' => 'Play the songs you love.',
                'description' => 'Get note-for-note song breakdowns for every style, era, and skill level.',
                'desktopImageSrc' => 'https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/play-songs.png',
                'mobileImageSrc' => 'https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/play-songs-m.png',
                'altText' => 'mobile phone',
                'textOnLeft' => false, 
            ])
            @endcomponent

            @component('musora.sales.components.custom-section-100songs', [
                'title' => 'LOOP SECTIONS',
                'subtitle' => 'Woodshed it until you nail it.',
                'description' => 'Slow down or speed up any section of a song to hear every note.',
                'imageSrc' => 'https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/woodshed-it.png',
                'altText' => 'singer',
                'textOnLeft' => true, 
            ])
            @endcomponent

            @component('musora.sales.components.custom-image-100songs', [
                'title' => 'Remove The Drums',
                'subtitle' => 'Be the drummer in the band.',
                'description' => 'Magically remove the original drums to make each song uniquely yours.',
                'desktopImageSrc' => 'https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/be-the-drummer.png',
                'mobileImageSrc' => 'https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/be-the-drummer-m.png',
                'altText' => 'drummer',
                'textOnLeft' => false, 
            ])
            @endcomponent

            @component('musora.sales.components.custom-section-100songs', [
                'title' => 'Perfect Notation',
                'subtitle' => 'Learn it right the first time.',
                'description' => 'Get note-for-note notation and learn to play accurately from the get-go.',
                'imageSrc' => 'https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/learn-it-right.png',
                'altText' => 'note sheets',
                'textOnLeft' => true, 
            ])
            @endcomponent

            @component('musora.sales.components.custom-section-100songs', [
                'title' => 'On-The-Go',
                'subtitle' => 'Take your songs with you.',
                'description' => 'Accessible on any device, or printable, so you can play any song, any time.',
                'imageSrc' => 'https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/take-your-songs-with-you.png',
                'altText' => 'drummer',
                'textOnLeft' => false, 
            ])
            @endcomponent


</section>
<!-- End of main section -->

<!-- Review section -->
<div class="h-5 sm:h-10 relative z-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F6F8FC calc(50% + 1px));"></div>
    @php
        $testimonials = [
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
            'name' => 'Ed Koop',
            'video' => '342059271',
            'title' => 'I’m loving music more than I ever did before!',
            'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
            'name' => 'Barry Lisle',
            'video' => '342066433',
            'title' => 'They walk you through, step-by-step, for any goal.',
            'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
            'name' => 'Lisa Aragon',
            'video' => '373252004',
            'title' => 'I was able to play drums on stage!',
            'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
            'name' => 'Guy Dobbins',
            'video' => '373445704',
            'title' => 'Drummers from all around the world helping you out.',
            'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
            ],
            [
            'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620.jpg',
            'name' => 'Omari Augustine',
            'video' => '553438851',
            'title' => 'Something you can’t get from having a drum teacher.',
            'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
            'name' => 'Marlene Rosen',
            'video' => '373446024',
            'title' => 'I’m rediscovering music again.',
            'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
            'name' => 'Jay Damberg',
            'video' => '373445466',
            'title' => 'Anytime, day or night, I can access the lessons I need.',
            'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
            'name' => 'Ivy Elizondo',
            'video' => '373445819',
            'title' => 'Now we have a band and we’re recording an album!',
            'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead — she’s used Drumeo to build a foundation and formed a band.',
            ],
        ]
    @endphp
   
    <section style="background-color: #F6F8FC"> @include('musora.sales.components.testimonials-section', [
        'desktopGrid' => true,
        'header' => 'Drumeo is trusted by 78,229 active students.',
        'reviewText' => 'We want to help you reach all of your drumming goals! Watch some of our students stories below:',
    ])</section>

   <!-- End of review section --> 
   
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('musora.sales.components.card-selection-section', [
        "plusLogo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeoplus_logo.svg",
        "logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png",
        "songs" => "5000+ popular songs.",
        "firstPoint" => "The world’s best drum lessons.",
        "thirdPoint" => "Unlimited personal support.",
        "fifthPoint" => "Lesson access for piano, guitar, and singing.",
        "plusAnnualLink" => "/getting-started/ty-annual",
        "plusMonthlyLink" => "/getting-started/ty-monthly",
    ])
    
    @include('musora.sales.components.trial-explanation', [
        'instrument' => 'drumming',
    ])
    @include('drumeo._partials.faq')
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314424',
        'vimeo' => true,
    ])
@stop
