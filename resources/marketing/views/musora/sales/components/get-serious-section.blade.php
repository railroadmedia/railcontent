<section class="bg-white py-10 sm:py-20 lg:py-28 px-4 lg:px-6">
    <div class="container mx-auto max-w-4xl">
        <div class="text-center py-12">
            <h2 class="mb-7 sm:mb-10"><strong>{!! $title !!}</strong></h2>
            <div class="grid grid-cols-1 gap-8 lg:gap-16 mx-auto max-w-2xl">
                @foreach ($items as $item)
                    <div class="text-center">
                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/{{ $item['icon'] }}" alt="Icon" class="h-10 sm:h-14 lg:h-16">
                        <h4 class="my-3"><strong>{!! $item['heading'] !!}</strong></h4>
                        <p class="lg:px-7">{!! $item['description'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
