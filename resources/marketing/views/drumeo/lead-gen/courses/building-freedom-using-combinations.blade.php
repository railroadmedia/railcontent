@extends('drumeo.lead-gen.courses.courses-layout')

@section('title')
    Marco Minnemann - Building Freedom Using Combinations
@endsection

@section('description')
    In this course, Marco will share some of his favorites combinations for various fills and grooves, and the importance of using them.
@endsection

@section('header-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/header-image.jpg' )

@section('trailer-url', '//player.vimeo.com/video/332475392?autoplay=1' )

@section('logo')
    <h3 class="tall">Marco Minnemann</h3>
    <h2>Building Freedom <br>Using Combinations</h2>
@endsection

@section('time', '43' )

@section('theme', 'with the king of interdependence' )

@section('url-slug', 'building-freedom-using-combinations' )

@section('course-url')
    /members/lessons/courses/222613
@endsection

@section('biography')
    <h1>Utilize Your Basic Rudiments To Gain Freedom Around The Kit</h1>
    <p>Marco Minnemann is known for his technical playing and insane interdependence -- on which he’s published several educational books and a DVD, and played with artists including The Aristocrats, Joe Satriani, Paul Gilbert, Eddie Jobson, Steven Wilson, Trey Gunn, Kreator, Necrophagist, Adrian Belew, Nena, Udo Lindenberg, Mike Keneally, Andy Partridge, FFW, Gianna Nannini, The Buddy Rich Big Band and more.
        <br><br>
        In this course, Marco will share some of his favorites combinations for various fills and grooves, and the importance of using them. And while these combinations alone will give you more freedom on the drums, you’ll also gain the framework for building your own creative combinations on the kit.
    </p>
@endsection

@section('grid-title')
    Add 7 Incredible Combinations <br class="show-for-medium">To Your Arsenal
@endsection

@section('lesson-grid')
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223759-card-thumbnail-1555584155.jpg",
         "lessonText" => "The Importance Of Combinations"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223760-card-thumbnail-1555584322.jpg",
         "lessonText" => "Tom-Snare Combination"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223761-card-thumbnail-1555584389.jpg",
         "lessonText" => "Speed Combination"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223762-card-thumbnail-1555584547.jpg",
         "lessonText" => "THREES!"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223763-card-thumbnail-1555584724.jpg",
         "lessonText" => "Triplet Hand To Foot Combo"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223764-card-thumbnail-1555584793.jpg",
         "lessonText" => "16th Triplet Hand To Foot"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223765-card-thumbnail-1555584889.jpg",
         "lessonText" => "Hi-Hat Inverted Paradiddle"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223766-card-thumbnail-1555585350.jpg",
         "lessonText" => "The Overlap Combination"
    ])
    @include('lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223767-card-thumbnail-1555585413.jpg",
         "lessonText" => "Combining Combinations"
    ])
@endsection

@section('artists')

    @include('lead-gen.courses._artist-tile', [
    "tileThumb" => "https://d1923uyy6spedc.cloudfront.net/marco-minnemann-thumb.jpg",
    "tileName" => "Marco Minnemann",
    "tileText" => "BUILDING FREEDOM USING COMBINATIONS"
    ])
    @include('lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/jp-bouvet.jpg",
    "tileName" => "JP Bouvet",
    "tileText" => "Creating Unique Grooves"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/todd-sucherman.jpg",
    "tileName" => "Todd Sucherman",
    "tileText" => "Expanding Rudimental Ideas"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/instructors/scott-pellegrom.png",
    "tileName" => "Scott Pellegrom",
    "tileText" => "Recycling What You Already Know"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/eric-moore.jpg",
    "tileName" => "Eric Moore",
    "tileText" => "Creative Concepts With Diddles"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/anika-nilles.jpg",
    "tileName" => "Anika Nilles",
    "tileText" => "Building Creativity With Groupings"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/matt-garstka.jpg",
    "tileName" => "Matt Garstka",
    "tileText" => "Creating Freedom By Building Systems"
    ])
    @include('lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/kaz-rodriguez.jpg",
    "tileName" => "Kaz Rodriguez",
    "tileText" => "Musical Exercises For Drummers"
    ])
@endsection



