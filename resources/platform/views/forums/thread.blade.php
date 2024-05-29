@extends('partials.layout')

@section('meta')
    <title>{{ $threadTitle }} | {{$categoryTitle}} | Forums | {{ $brand }}</title>
@endsection

@section('content')

    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <forum-thread
            :thread="{{ $thread }}"
            :current-user="{{ $currentUser }}"
            show-categories-url="{{ url()->route('forums.show-categories') }}"
            category-title="{{ $categoryTitle }}"
            category-url="{{ $categoryUrl }}"
            thread-title="{{ $threadTitle }}"
            post-store-form-url="{{ url()->route('railforums.post.store')}}"
            update-post-base-route="{{ url()->route('railforums.post.update',['#####']).'?redirect='.url()->route('forums.jump-to-post',['#####']) }}"
        />
    </div>

@endsection
