<div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
<section class="relative text-center px-6" style="background-color:#f6f8fc;">
    <div class="container mx-auto max-w-5xl relative z-20">
        <div class="text-left flex justify-center items-center">
            <div class="pr-4 lg:pr-7">
                <h4 class="leading-normal mb-3 lg:mb-7"><strong>Available across web,<br> tablet, & mobile.</strong></h4>
                <a class="inline-block" href="{!! $appleLink !!}" target="_blank">
                    <img class="h-10 m-1" src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
                <a class="inline-block" href="{!! $googleLink !!}" target="_blank">
                    <img class="h-10 m-1" src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
            </div>
            <img class="lg:-mt-11 lg:-mb-4 max-w-md lg:max-w-2xl transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/{!! $image !!}">
        </div>
    </div>
</section>
