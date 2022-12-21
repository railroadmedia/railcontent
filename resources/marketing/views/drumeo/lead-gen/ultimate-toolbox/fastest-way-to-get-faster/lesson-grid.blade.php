@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Fastest Way To Get Faster | The Ultimate Drumming Toolbox | Drumeo</title>
    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Ultimate Drumming Toolbox | Drumeo">
    <meta property="og:description" content="Sign up for these free resources to expand your drumming education today.">
    <meta property="og:url" content="https://www.drumeo.com/ultimate-toolbox">
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
            <h1>Fastest Way To Get Faster</h1>
            <p>In this free video course, you’ll get the detailed video training
                you need to improve your speed around the kit.</p>
            <h1>Module 1</h1>
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/1/",
                        "image" => "https://i.vimeocdn.com/video/468462591-0591247a658a222a1451ddba9374e9825368731349ef1978c2d4ab94290dcc33-d_640",
                        "badge" => "Module #1",
                        "title" => "Introduction"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/2/",
                        "image" => "https://i.vimeocdn.com/video/468462922-4e60de18d43a40d3d449d8b56735e01b60494d619cf2a1bbd422d1c7e35dcdd3-d_640",
                        "badge" => "Module #1",
                        "title" => "Exercise 1"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/3/",
                        "image" => "https://i.vimeocdn.com/video/468463206-70e2ae1aff12b5b73b2675bdb2f39aa9b47fe4b6b063c16262c84ae7d76d154f-d_640",
                        "badge" => "Module #1",
                        "title" => "Exercise 2"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/4/",
                        "image" => "https://i.vimeocdn.com/video/468463619-751c666bf20b290baedbd20b81cc5f68e696df01af2e0c790f36b41e2153844c-d_640",
                        "badge" => "Module #1",
                        "title" => "Exercise 3"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/5/",
                        "image" => "https://i.vimeocdn.com/video/468463970-f53c0f17d09c71453503ab638a3c6708cc424874bce5f877ad9df11ac97fa6c9-d_640",
                        "badge" => "Module #1",
                        "title" => "Exercise 4"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/6/",
                        "image" => "https://i.vimeocdn.com/video/468463959-b15f743f876736499972705d6fd975620d97ba6e6cc91b2d1648e2962349009c-d_640",
                        "badge" => "Module #1",
                        "title" => "Exercise 5"
                    ])
                </div>
            </div>
            <h1>Module 2</h1>
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/7/",
                        "image" => "https://i.vimeocdn.com/video/468464265-11fa28922153ddd0a5c18307ffb4b4a8ca3b2ae99b0ee35c91cbbbd9dd4198cd-d_640",
                        "badge" => "Module #2",
                        "title" => "Introduction"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/8/",
                        "image" => "https://i.vimeocdn.com/video/468464558-8ab3abdf097c6d07c260fb3a6069f914a26a619b16aff7bf2f8c2105351fdb4b-d_640",
                        "badge" => "Module #2",
                        "title" => "Exercise 1"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/9/",
                        "image" => "https://i.vimeocdn.com/video/468464697-c789c4f1e95ad173da4eb0acb177c3b8640174230433021132e84e7f27fae524-d_640",
                        "badge" => "Module #2",
                        "title" => "Exercise 2"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/10/",
                        "image" => "https://i.vimeocdn.com/video/468465312-3bc75a3cb1fff8da83c97c0ad3fa6feeeea7161412bf4a2cd3014b3140c41d25-d_640",
                        "badge" => "Module #2",
                        "title" => "Exercise 3"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/11/",
                        "image" => "https://i.vimeocdn.com/video/468465007-d931b0fb1564d04666c21897fcfb3258a8f67668f8df2be39ab0ff2086702a32-d_640",
                        "badge" => "Module #2",
                        "title" => "Exercise 4"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/12/",
                        "image" => "https://i.vimeocdn.com/video/468465317-36b42df8d9585ede4560350d2529469c3fde6d81e6a43558b4d3ae54260a3b01-d_640",
                        "badge" => "Module #2",
                        "title" => "Exercise 5"
                    ])
                </div>
            </div>
            <h1>Module 3</h1>
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/13/",
                        "image" => "https://i.vimeocdn.com/video/468465303-ae3eeb22d4d9f54d97aacb71014dfe35d62e723651952a1dffed8f2d33de0cdd-d_640",
                        "badge" => "Module #3",
                        "title" => "Introduction"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/14/",
                        "image" => "https://i.vimeocdn.com/video/468465837-a713fe204be18020e4dd63d5b70b6554c3b04efdd6443f754f47f9742e58d9b4-d_640",
                        "badge" => "Module #3",
                        "title" => "Exercise 1"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/15/",
                        "image" => "https://i.vimeocdn.com/video/468465825-1ae84191e678505bb3867eb7d224d1b380c11261d4dd530affce1dc169cd4d46-d_640",
                        "badge" => "Module #3",
                        "title" => "Exercise 2"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/16/",
                        "image" => "https://i.vimeocdn.com/video/468466472-cafd2faf42e3c0d925a881856a6a012b51cd600e879b82626e3b5da272fc8b3f-d_640",
                        "badge" => "Module #3",
                        "title" => "Exercise 3"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/17/",
                        "image" => "https://i.vimeocdn.com/video/468466651-c5db0822c030c82859d7c766965e4db86ba37af00c78e52fe25639f5742ae00f-d_640",
                        "badge" => "Module #3",
                        "title" => "Exercise 4"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/18/",
                        "image" => "https://i.vimeocdn.com/video/468466646-4e47a36cb4b8058d59b98cf9b05d25184d7b00a5913b16fc2575d1a576571582-d_640",
                        "badge" => "Module #3",
                        "title" => "Exercise 5"
                    ])
                </div>
                <div class="w-full end">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/19/",
                        "image" => "https://i.vimeocdn.com/video/468466881-30ddd2f68277c803b48b5012f17cba6bf7136c8805b22b6b806f6edf45b1fd56-d?mw=1200&mh=675",
                        "badge" => "Module #3",
                        "title" => "Conclusion"
                    ])
                </div>
            </div>
        </div>
    </section>
@stop
