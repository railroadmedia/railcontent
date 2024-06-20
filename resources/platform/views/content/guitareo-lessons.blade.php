@extends('partials.layout')

@section('meta')
    <title>Guitareo Lessons | Musora</title>
@endsection

{{-- Page Specific Styles --}}
@section('styles')
    <style>
        .pack-header::after {
            content: '';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            z-index:1;
            background:rgba(0,0,0,.4);
        }
        .pack-header > * {
            z-index:2;
            position:relative;
        }
    </style>
@endsection

{{-- Content --}}
@section('content')
    <guitareo-lessons
        :guitar-quest-pack="{{ json_encode($guitarQuestPack) }}"
        :packs="{{ json_encode($packs) }}"
        :courses="{{ $newCourses }}"
        :quick-tips="{{ $newQuickTips }}"
        :topics="{{ json_encode($topics) }}"
    ></guitareo-lessons>
@endsection
