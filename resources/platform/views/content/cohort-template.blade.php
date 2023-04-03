@extends('partials.layout')

@section('meta')
    <title>Cohort Template | Musora</title>
@endsection

@section('content')
    <header class="tw-bg-[#F1F7FE] tw-py-9">
        <div class="tw-max-w-5xl tw-mx-auto">
            <div class="tw-flex tw-items-center tw-gap-10 tw-mb-12">
                <div class="tw-flex-1">
                    <img class="tw-h-14 sm:tw-h-18 lg:tw-h-20 tw-mb-2" alt="new piano players start here logo" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-2+1.png">
                    <h1 class="tw-font-extrabold -tw-mb-3">Online piano lessons </h1>
                    <h2 class="tw-font-normal">for all skill levels.</h2>
                    <p class="tw-font-bold tw-mt-6 tw-mb-9">Save your seat for season 2 starting May 1st.</p>
                    <div class="md:tw-flex md:tw-items-center">
                        <a class="tw-uppercase tw-bg-{{ $brand }} tw-rounded-full tw-py-2 tw-w-1/2 tw-text-white tw-text-center tw-font-bebas-neue tw-mr-2">Enroll Now</a>
                        <div class="tw-w-1/2 tw-flex tw-items-center">
                            <img class="tw-h-7 sm:tw-mb-1 lg:tw-mb-0 tw-mr-1 sm:tw-mr-0 lg:tw-mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png" alt="joined student profiles">
                            <p class="tw-text-sm tw-align-middle">Join 8,539 piano players who have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="tw-flex-1">
                    <img class="tw-rounded-xl" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/header-thumb2.jpg" alt="header thumb" />
                </div>
            </div>
            <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-text-center tw-border tw-rounded-lg tw-border-gray-300 tw-mb-2 lg:tw-mb-4">
                <div class="tw-w-full sm:tw-w-auto tw-border-b sm:tw-border-b-0 sm:tw-border-r tw-border-gray-300 tw-py-4 sm:tw-py-3 lg:tw-py-4">
                    <p class="tw-tracking-wide tw-opacity-70 tw-text-sm">STARTS ON</p>
                    <h4 class="tw-px-3 lg:tw-px-5"><strong>February 27th</strong></h4>
                    <hr class="tw-border-gray-300 tw-my-4 sm:tw-my-2 lg:tw-my-4">
                    <p class="tw-text-sm tw-px-3 lg:tw-px-5">
                        Enrollment closed
                    </p>
                </div>
                <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-evenly tw-w-full sm:tw-w-auto sm:tw-flex-grow tw-py-4 sm:tw-py-3 lg:tw-py-4 tw-text-left sm:tw-text-center">
                    <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                        <i class="far fa-fw tw-mr-3 sm:tw-mr-0 fa-calendar-day tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                        <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">Course Dates</strong><br>
                            <span class="tw-text-sm"> February 27th to<br class="tw-hidden sm:tw-inline"> March 28th.</span></p>
                    </div>
                    <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                        <i class="far fa-fw tw-mr-3 sm:tw-mr-0 fa-clock tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                        <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">Commitment</strong><br>
                            <span class="tw-text-sm">10 minutes/day<br class="tw-hidden sm:tw-inline"> for 30 days.</span></p>
                    </div>
                    <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3">
                        <i class="far fa-fw tw-mr-3 sm:tw-mr-0 fa-trophy tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                        <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">Result</strong><br>
                            <span class="tw-text-sm">Play real songs on the <br> piano and sound beautiful.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="tw-bg-white tw-py-7">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-10">
            <h3 class="tw-font-extrabold tw-text-center tw-mb-7">Learn the piano in 30 days.</h3>
            <p class="tw-px-10 tw-mb-8">
                You don’t learn by watching. You learn by doing. <br><br>

                Start the year off right and learn the piano by playing the piano. You’ll be playing a song from the very first lesson and you’ll follow along with 10-minute daily guided sessions that show you exactly what to play.<br><br>

                No complicated theory. No need to read music. No frustration.<br><br>

                All you have to do is press play and follow along. Plus, you’ll have a weekly live lesson with Lisa Witt to answer your questions, stay motivated, and make sure you’re on track and having FUN on the piano.<br><br>

                So if you’re a new piano player and you’re wondering where to start…<br><br>

                Start here.<br><br>

                Scroll down to save your seat.
            </p>
            <div class="tw-relative">
                <img class="tw-rounded-xl" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/video-thumb.jpg" alt="video thumb" />
                <div class="tw-absolute tw-inset-0 tw-flex tw-justify-center tw-items-center">
                    <i class="fa-regular fa-play tw-z-10 tw-border-white tw-border-2 tw-text-white tw-p-2 tw-rounded-full" aria-hidden="true"></i>
                </div>
            </div>

        </div>
    </section>
@endsection
