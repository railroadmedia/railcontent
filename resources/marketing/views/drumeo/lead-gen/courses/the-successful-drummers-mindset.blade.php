@extends('drumeo.lead-gen.courses.courses-layout')

@section('title')
    Jared Falk - The Successful Drummer’s Mindset
@endsection

@section('description')
    In this course, the focus is having a vision for your playing, finding the time to make that vision a reality, and maintaining momentum so you truly become a better musician.
@endsection

@section('header-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-successful-drummers-mindset/header-image.jpg' )

@section('trailer-url', '//player.vimeo.com/video/323865080?autoplay=1' )

@section('logo')
    <h3 class="tall">Jared Falk</h3>
    <h2>The Successful<br> Drummer’s Mindset</h2>
@endsection

@section('time', '29' )

@section('theme', 'for reaching your drumming goals' )

@section('url-slug', 'the-successful-drummers-mindset' )

@section('course-url')
    /members/lessons/courses/221439
@endsection

@section('biography')
    <h1>Gain a clearer vision for your goals and purpose as a drummer.</h1>
    <p>Jared Falk is the Co-Founder and CEO of Drumeo -- and a respected educator whose video drum lessons have been watched by millions of drummers around the world.
        <br><br>
        But in this course, it’s not about the beats, fills, or techniques. While you’ll jump behind your kit for some of the ideas and exercises, the bigger focus is having a vision for your playing, finding the time to make that vision a reality, and maintaining momentum so you truly become a better musician.
    </p>
@endsection

@section('grid-title')
    5 Fundamental Lessons For Achieving <br class="show-for-medium">
    Real Results On The Drums
@endsection

@section('lesson-grid')
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/221961-card-thumbnail-1552647482.jpg",
         "lessonText" => "It’s Not About Practice, It’s About Purpose!"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/221962-card-thumbnail-1552661620.jpg",
         "lessonText" => "Finding The Time To Work On Your Drumming"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/221963-card-thumbnail-1552661674.jpg",
         "lessonText" => "How To Be An Efficient Drumming Practitioner"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/221964-card-thumbnail-1552661962.jpg",
         "lessonText" => "What To Do When You’re Stuck In A Rut"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/221965-card-thumbnail-1552662456.jpg",
         "lessonText" => "Become A Better Musician"
    ])
@endsection

@section('artists')

    @include('lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/jared-falk.jpg",
    "tileName" => "Jared Falk",
    "tileText" => "THE SUCCESSFUL DRUMMER’S MINDSET"
    ])
    @include('lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/rich-redmond.jpg",
    "tileName" => "Rich Redmond",
    "tileText" => "Useful Grooves Drummers Should Know"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/tommy-igoe.jpg",
    "tileName" => "Tommy Igoe",
    "tileText" => "The Secrets Of Groove Essentials"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/instructors/john-blackwell.png",
    "tileName" => "John Blackwell",
    "tileText" => "Building Groove"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://d1923uyy6spedc.cloudfront.net/harry-miree-1.jpg",
    "tileName" => "Harry Miree",
    "tileText" => "Tools For The Average Working Drummer"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/todd-sucherman.jpg",
    "tileName" => "Todd Sucherman",
    "tileText" => "How To Become A Good Sounding Drummer"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/casey-cooper.jpg",
    "tileName" => "Casey Cooper",
    "tileText" => "How To Learn Songs Quickly"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/instructors/chip-ritter.png",
    "tileName" => "Chip Ritter",
    "tileText" => "Developing Showmanship & Stage Presence"
    ])
@endsection



