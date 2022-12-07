@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | The Ultimate Drumming Toolbox | Drumeo</title>
    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Ultimate Drumming Toolbox | Drumeo">
    <meta property="og:description" content="Sign up for these free resources to expand your drumming education today.">
    <meta property="og:url" content="https://www.drumeo.com/ultimate-toolbox/">
@stop

@section('content')
    <header class="header toolbox">
        <div class="container mx-auto max-w-6xl px-4">
            <div class="text-center">
                <img class="series-logo mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/tudt-logo.png" alt="The Ultimate Drumming Toolbox">
            </div>
            <div class="text-center">
                <a class="go-back" href="/ultimate-toolbox/catalogue">Back To All Lessons</a>
            </div>
        </div>
    </header>


    <section class="lesson-grid">
        <div class="container mx-auto max-w-6xl px-4">
            <h1>@yield('title')</h1>
            <p>@yield('description')</p>
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 md:grid-cols-3">
                @foreach ($lessons as $lesson)
                    <div class="w-full">
                        @include("drumeo.lead-gen.partials.thumbnail-signup", [
                            "url" => $lesson['url'],
                            "image" => $lesson['image'],
                            "badge" => $lesson['badge'],
                            "title" => $lesson['title']
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
