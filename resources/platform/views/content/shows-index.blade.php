@php
    $headerDescription = "";
    if($brand === 'drumeo'){
        $headerDescription = "Whether you're looking for drumming inspiration, entertainment, or education, Drumeo Shows has something for everyone.";
    }
    $breadcrumbs = [
        [
            'title' => 'Shows',
        ]
    ];
@endphp
@extends('partials.layout')

@section('meta')
    <title>Shows | Drumeo</title>
@endsection

@section('content')
    <breadcrumb :breadcrumbs="{{ json_encode($breadcrumbs) }}"></breadcrumb>
    <page-header
        page-type="shows"
        title="Shows"
        icon-name="shows-filled"
        description="{{ $headerDescription }}"
    ></page-header>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-2">
        <div class="flex flex-row flex-wrap nmh-1">
            @foreach($shows as $type=>$show)
                <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => $type]) }}"
                    class="flex flex-column xs-6 sm-3 lg-2 pa-1">
                    <div class="show-index-card square corners-10 bg-grey-2 dark:tw-bg-[#081825] relative">
                        <img
                            src="{{ $show['thumbnailUrl'] }}"
                            class="corners-10 tw-transition-opacity tw-opacity-0"
                            alt="{{ $type }} Show Card"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        >

                        <span class="box-hover heading corners-10">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection
