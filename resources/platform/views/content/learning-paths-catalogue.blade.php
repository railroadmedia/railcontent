@extends('partials.layout')

@section('meta')
    <title>Learning Paths | Singeo</title>
@endsection

@section('content')
    <page-container brand="{{ $brand }}">
        <div v-cloak>

            @component('partials._header-banner')
                @slot('content')
                    <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4 tw-mt-14">
                        <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                            <i class="icon-learning-paths tw-text-singeo tw-mr-3 tw-text-3xl"></i>
                            <span class="tw-text-32">Learning Paths</span>
                        </h1>
                        <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                            Learning Paths take the guesswork out of what you need to be practicing in order to reach
                            your goals
                        </p>
                    </div>
                @endslot
            @endcomponent

            <div class="tw-container tw-mx-auto">
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
                                    :is-admin="{{ json_encode(current_user()->getPermissionLevel() === 'administrator') }}"
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

        </div>
    </page-container>
@endsection
