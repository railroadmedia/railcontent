<div class="testimonial w-full md:w-1/2 lg:w-1/3 text-center flex-wrap justify-center transition-all duration-200 ease-in-out @if(!empty($customClass)) {{ $customClass }} @endif">
    <img class="lazyload rounded-full border-4 bg-pianote border-pianote h-28 md:h-40 lg:h-44" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/testimonials/{{ strtolower(str_replace(' ', '-', $name)) }}.jpg">
    <div class="float-left w-full px-3 md:px-4 text">
        <h5 class="leading-tight my-4"><strong>"{!!  $heading  !!}"</strong></h5>
        <p class="leading-normal">{!! $testimonial !!}<br><br>
        <strong class="text-red font-black">{{ $name }}</strong><br>
        <span>{{ $location }}</span> </p>
    </div>
</div>