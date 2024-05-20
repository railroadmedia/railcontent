@extends('partials.layout')

@section('meta')
    <title>Drumeo Legacy Resources | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb
            :breadcrumbs="{{ json_encode([ [ 'title' => 'Legacy Resources',] ]) }}"
        ></breadcrumb>
        <page-header
            page-type="resources"
            title="Legacy Resources"
            icon-name="play-circle-filled"
            description="Legacy Resources are lessons or tools that are no longer added to or supported. Rather than remove them from the site completely you can access them here."
        ></page-header>

        <div class="tw-py-4">
            <div class="tw-flex tw-flex-col">
                <div class="tw-flex tw-items-center tw-mt-4 tw-w-full tw-justify-between">
                    <div class="tw-flex tw-items-center">           
                        <h2 class="tw-text-[#00101D] dark:tw-text-white tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">
                            Choose A Resource
                        </h2>
                    </div>
                </div>

                @include('partials.bladesora.members.account.partials._settings-links', [
                    "brand" => "drumeo",
                    "sections" => $sections
                ])
            </div>
        </div>
    </div>
@endsection

