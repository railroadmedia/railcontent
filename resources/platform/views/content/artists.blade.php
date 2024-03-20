@extends('partials.layout')

@section('meta')
    <title> {{ ucfirst($brand) }} Artists | Musora</title>
@endsection

@section('content')

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-py-12">
        <div class="tw-flex tw-flex-col ">

            <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-flex tw-items-center">
                    <a href="javascript:history.back()" class="tw-no-underline tw-inline-flex tw-items-center tw-text-[#00101D] dark:tw-text-white">
                        <i class="fas fa-arrow-circle-left tw-text-2xl tw-mr-2"></i>
                    </a>
                    All Artists
                </h1>
            </div>

            <div class="tw-flex tw-flex-row bb-grey-1-1 dark:tw-border-[#223457] ">
            </div>
        </div>
    </div>

<div class=" tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-2 tw-mb-[30px]">
    <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-3">
        {{ $numberOfArtists}} Artists
    </h2>

    <div class="flex flex-row">
        <div class="flex flex-column">
            @foreach ($artists as $artist)
            <a href="{{ $artist['url'] }}">
                <p >{{ $artist['name'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection
