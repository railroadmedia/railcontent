<section class="text-center text-white relative pt-64 pb-8 md:py-20 lg:py-24 px-4 teacher-section bg-no-repeat relative lazyload">
    <div class="container mx-auto relative z-10">
        <div class="flex flex-wrap items-center mx-auto max-w-md md:max-w-5xl lg:px-3">
            <div class="w-full md:w-7/12 z-20 lg:w-1/2">
                {!! $headLine !!}
                <p class="text-left text-navy leading-tight mt-4">
                    {!! $description !!}
                </p>
            </div>
        </div>
    </div>
    @if (!empty($gradient))
        {!! $gradient !!}
    @endif
</section>