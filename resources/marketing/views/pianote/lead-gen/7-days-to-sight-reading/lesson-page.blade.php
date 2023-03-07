@php
  require_once(resource_path('marketing/views/pianote/lead-gen/7-days-to-sight-reading/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', '7 Days to Sight Reading')

@section('meta-description', 'Learn to read music. Play your favorite songs. Have more fun.')

@section('meta-img', 'https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/7-days-to-sight-reading/share_image.jpg')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/7-days-to-sight-reading/logo.png')

@section('lesson-index-url', '/7-days-to-sight-reading/lessons')

@section('lesson-total-number', 7)

@section('all-course-resource')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Days 1-7 Exercises",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%20QT%20-%20Score-1664655069.pdf",
    ])
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Note Values PDFs",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/note-values-sheet-1664816317.pdf",
    ])
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Grand Staff Cheat Sheet PDF",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/TheGrandStaff-1664821463.pdf",
    ])
@endsection

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 md:w-1/4',
    ])
@endsection

@section('offers')
    <section class="text-center py-12 md:py-20 text-white bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/7-days-to-sight-reading/footer_lessons.jpg">
        <div class="max-w-2xl mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h3 class="mb-6"><strong>Ready for the next step?</strong></h3>
                <p style="color:#D0E2E7;">Get unlimited lessons, detailed song tutorials, and personal support from real teachers with a Pianote membership. Try it free for 7 days.</p>
                <a class="join my-5 md:my-7" href="/choose-plan">Start a free trial &raquo;</a>
            </div>
        </div>
    </section>
@endsection
