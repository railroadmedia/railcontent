{{-- Guitar Quest: Start Here --}}
<section class="py-24 bg-top bg-cover md:py-48" style="background-image: url('https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Forder-background.jpg?auto=format&ixlib=php-1.2.1&w=1500&s=102f8f89fa2527e02113803a5fa19e3c')">
    <div class="max-w-screen-xl m-auto px-6 flex">
        <div class="w-full m-auto text-white text-center lg:w-2/3">
            <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Fguitar-quest-logo.png?auto=format&ixlib=php-1.2.1&w=700&s=5768e9ca4e1a3a4a28966bd8fcad1d61" width="400px" class="m-auto block mb-10">
            <h2 class="uppercase text-3xl font-bison-bold sm:text-5xl md:text-6xl mb-2">Your Guitar Journey<br class="inline xl:hidden"> Starts Here.</h2>

            <h4 class="text-xl mb-2 md:mb-10 font-primary sm:text-2xl md:text-3xl">
                @if($productPrice < floatval($productPrices['guitar-quest']->price))
                    <span class="text-gray-500 line-through">Normally&nbsp;$197</span>
                    <span class="font-bold text-goldenrod uppercase font-extrabold">Only&nbsp;${{ $productPrice }}</span>
                    <span>(Save&nbsp;{{ round(100 - (100 * ($productPrice / floatval($productPrices['guitar-quest']->price)))) }}%)</span>
                @else
                    <span class="text-goldenrod uppercase">
                        Reach your goals on the <br class="inline xl:hidden">
                        guitar for just&nbsp;${{ $productPrice }}</span>
                @endif
            </h4>

            <a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient transition duration-500 linear px-4 py-4 w-full inline-block uppercase text-black font-roboto-condensed-bold rounded-full text-3xl mb-5 md:w-3/4">
                Start Your Quest &raquo;
            </a>
            <p class="font-primary text-sm mb-10">
                <a href="{{ $orderLinkAlt }}" class="text-goldenrod underline font-bold transition-colors text-goldenrod-hover" title="Go To Order Page">OR CHOOSE A PAYMENT PLAN<br class="inline sm:hidden">
                    ON THE NEXT PAGE</a>
            </p>

            <div class="opacity-40 flex justify-center text-5xl mb-4">
                <i class="fab fa-cc-visa mr-2"></i>
                <i class="fab fa-cc-mastercard mr-2"></i>
                <i class="fab fa-cc-amex mr-2"></i>
                <i class="fab fa-cc-paypal mr-2"></i>
            </div>
            <p class="opacity-40 text-xs m-0 font-semibold">Any questions? Call us toll-free at 1-800-439-8921 or directly at 1-604-855-7605.</p>
        </div>
    </div>
</section>
