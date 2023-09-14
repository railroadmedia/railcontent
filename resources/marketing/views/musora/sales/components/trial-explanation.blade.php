<section class="py-12 sm:py-16 px-5 sm:px-6">
    <div class="container mx-auto max-w-2xl">
        <h2 class="font-extrabold mb-5 sm:mb-8 text-center leading-tight">How your free trial works.</h2>
        <div class="relative pb-5">
            <div class="rounded-full w-6 bg-{{ $theme }} absolute top-0 left-0 z-20" style="bottom:20%;"></div>
            <div class="w-6 absolute top-1/2 left-0 z-10 bottom-0" style="background:linear-gradient(to bottom, #FFAE00 50%, transparent);"></div>
            <div class="flex flex-wrap text-left pl-8 sm:pl-12">
                <div class="py-4 pl-4 pr-2 sm:px-5 mb-2 w-full">
                    <p class="z-30 absolute left-0 w-6 text-white text-center text-sm"><i class="fas fa-unlock"></i></p>
                    <h5 class="font-extrabold mb-1.5">Today</h5>
                    <p class="leading-normal">Get instant access and see how {{ ucfirst($theme) }} will improve your {{ $instrument }} journey!</p>
                </div>
                <div class="py-4 pl-4 pr-2 sm:px-5 mb-2 w-full">
                    <p class="z-30 absolute left-0 w-6 text-white text-center text-sm"><i class="fas fa-music"></i></p>
                    <h5 class="font-extrabold mb-1.5">@if(empty($month)) 7 @else 30 @endif Days</h5>
                    <p class="leading-normal">Learn, practice, and play as much as you want… for free!</p>
                </div>
                <div class="py-4 pl-4 pr-2 sm:px-5 mb-2 w-full">
                    <p class="z-30 absolute left-0 w-6 text-white text-center text-sm"><i class="fas fa-star"></i></p>
                    <h5 class="font-extrabold mb-1.5">Day @if(empty($month)) 7 @else 30 @endif</h5>
                    <p class="leading-normal">You’ll be charged on
                        @if(empty($month)) {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} @else {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }} @endif
                        and we’ll donate 20% to charity.
                        Cancel anytime before.</p>
                </div>
                <div class="py-4 pl-4 pr-2 sm:px-5 w-full border-b-2 border-musora" style="background-color:rgba(255,172,0,0.05);">
                    <p class="z-30 absolute left-0 w-6 text-white text-center text-sm"><i class="fas fa-heart"></i></p>
                    <h5 class="font-extrabold mb-1.5">Plus 90 days worry-free.</h5>
                    <p class="leading-normal">If you don’t love your trial but forget to cancel, don’t worry! You’ll still have a full 90-day money-back guarantee.</p>
                </div>
            </div>
        </div>
    </div>
</section>
