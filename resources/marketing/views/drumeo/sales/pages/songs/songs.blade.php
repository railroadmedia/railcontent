@extends('drumeo.sales.pages.coaches-method-songs-layout')

@section('page-meta')

@endsection
<title></title>
<meta property="og:title" content="">
<meta property="og:url" content="https://www.drumeo.com/">
<meta name="description" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">

@section('body-data')
    x-data ='{
    trailer : false
    }'
@endsection

@section('header-img', 'https://drumeo-assets.s3.amazonaws.com/sales/2023/songs-thumb.jpg')

@section('header', 'Play your favorite songs.')

@section('desc', 'Get 5000+ note-for-note song breakdowns for every style, era, and skill with handy play-along tools')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 lg:px-0">
            <h4 class="font-extrabold mb-4">Rock</h4>
            @component('_partials.components.carousel',[
                'xdata' => "
                    classes: {
                        arrow: 'hidden',
                        pagination: 'hidden',
                    },
                    perPage: 6,
                    perMove: 1,
                    gap: '1rem',
                    type: 'loop',
                    interval: 2000,
                    breakpoints: {
                        1024: {
                            perPage: 4,
                        },
                        720: {
                            perPage: 3,
                        },
                        620: {
                            perPage: 2,
                        },
                    },
                ",
                'slider' => [
                    [
                        'img' => '',
                        'title' => '',
                        'artist' => '',
                    ],
                ]
            ])
                @slot('content')
                    <div>
                        <img
                            class="rounded-xl mb-1 transition-opacity opacity-0"
                            src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
                            alt="somthing"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                        <p class="font-bold">{{$slide['title']}}</p>
                        <p class="text-[#838C98]">{{$slide['artist']}}</p>
                    </div>
                @endslot
            @endcomponent
        </div>
    </section>

    {{--    @include('_partials.components.video-modal',[--}}
    {{--        'name' => 'trailer',--}}
    {{--        'video' => '772644658'--}}
    {{--    ])--}}
@stop
