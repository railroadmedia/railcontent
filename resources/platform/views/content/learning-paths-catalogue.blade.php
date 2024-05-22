@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Learning Paths | Musora</title>
@endsection

{{-- Is this page still Relevant?? --}}
@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Learning Paths"
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="learning-path"
            title="Learning Paths"
            iconName="method"
            description="Learning Paths take the guesswork out of what you need to be practicing in order to reach your goals"
        ></page-header>
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-flex-col mv-3">
            <div class="tw-flex tw-flex-row pv-3">
                <h1 class="heading tw-capitalize">All Learning Paths</h1>
            </div>
            <div class="tw-flex tw-flex-row">
                <transition appear name="fade">
                    <content-catalogue
                            catalogue-type="list"
                            brand="{{ $brand }}"
                            theme-color="{{ $brand }}"
                            limit="20"
                            user-id="{{ auth()->id() }}"
                            :is-admin="{{ json_encode(user()->isAdmin()) }}"
                            :infinite-scroll="true"
                            :filterable-values="{{ json_encode([]) }}"
                            :included-types="{{ json_encode(['learning-path']) }}"
                            :use-theme-color="true"
                            :pre-loaded-content="{{ $listLessons }}"
                            :use-url-params="true"
                            :lock-unowned="true"
                            :display-items-as-overview="true"
                            :show-loading-animation="true">
                        @for($i = 0; $i < 2; $i++)
                            @include('partials.bladesora.members.skeletons.list-item', [
                                "overview" => true,
                                "showNumbers" => false,
                                "thumbnailType" => 'widescreen'
                            ])
                        @endfor
                    </content-catalogue>
                </transition>
            </div>
        </div>
    </div>

@endsection
