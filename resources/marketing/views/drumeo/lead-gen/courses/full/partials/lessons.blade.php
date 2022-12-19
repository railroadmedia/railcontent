<section class="lesson-breakdown text-center">
    <div class="container px-4 max-w-6xl mx-auto">
        <h1>
            {!! $headLine !!}
        </h1>
        <div class="tile-wrap grid gap-4 grid-cols-2 sm:grid-cols-3">
            @foreach ($lessons as $lesson)
                @include('drumeo.lead-gen.courses._lesson-grid', [
                    "lessonNumber" => $lesson['lessonNumber'],
                    "lessonThumb" => $lesson['lessonThumb'],
                    "lessonText" => $lesson['lessonText'],
                    "description" => $lesson['description']
                ])
            @endforeach
        </div>
    </div>
</section>
