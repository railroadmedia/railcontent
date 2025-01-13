<section class="py-10 sm:py-20 lg:py-28 px-4 lg:px-6">
    <div class="container mx-auto max-w-4xl">
        <div class="text-center py-12">
            <h2 class="mb-8"><strong>{!! $title !!}</strong></h2>
            <div class="grid grid-cols-1 gap-8 lg:gap-16 mx-auto max-w-2xl"> 
                @foreach ($items as $item)
                    <div class="text-center">
                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/{{ $item['icon'] }}" alt="Icon" class="h-10 sm:h-14 md:h-19">
                        <h3 class="my-2"><strong>{!! $item['heading'] !!}</strong></h3>
                        <p class="lg:px-7">{!! $item['description'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
