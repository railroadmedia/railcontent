@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $ctas = [
            [
                'type' => 'PageHeaderPrimaryCta',
                'props' => [
                    'text' => 'Create Thread',
                    'url' => url()->route('forums.show-create-thread-form'),
                    'faIconClass' => 'fa-pencil'
                ]
            ]
        ];
@endphp

@extends('partials.layout')

@section('meta')
    <title>All latest threads  | Forums | {{ $brand }}</title>
@endsection


@section('content')

    <div class="tw-w-full tw-mx-auto tw-max-w-[1703px] tw-px-4 md:tw-px-8">
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Forums",
                    "url" => url()->route('forums.show-categories'),
                ],
                [
                    "title" => "All Latest Threads",
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="unreleased"
            title="All Latest Threads"
            icon-name="clock-filled"
            description="Checkout all the latest threads from all our forums."
            :ctas="{{ json_encode($ctas) }}"
        ></page-header>
    </div>

    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex">
                <forum-threads-table
                    theme-color="{{ $brand }}"
                    brand="{{ $brand }}"
                    :only-followed="false"
                    :show-tabs="false"
                    :threads="{{ json_encode($threads) }}"
                    :thread-count="{{ $threadCount }}"
                />
            </div>
        <!-- <p class="font-bold">{{ json_encode($threads) }}</p> -->
        </div>
    </div>

@endsection
