@include('shop.partials._promo-banner')

<div class="tw-container tw-max-w-6xl tw-mx-auto">
    <div class="tw-uppercase tw-text-xs tw-leading-tight tw-my-5 tw-px-3 md:tw-px-4 md:tw-mt-5 md:tw-mb-2 lg:tw-mb-0">
        <p><a class="tw-text-black hover:tw-underline" href="/shop/">SHOP</a> &nbsp;/&nbsp;
        {{--@if(!empty($videos))--}}
            {{--<a href="/lessons/">VIDEO LESSONS</a> &nbsp;/&nbsp;--}}
        {{--@elseif(!empty($clothing))--}}
            {{--<a href="/clothing/">CLOTHING</a> &nbsp;/&nbsp;--}}
        {{--@elseif(!empty($accessories))--}}
            {{--<a href="/accessories/">ACCESSORIES</a> &nbsp;/&nbsp;--}}
        {{--@endif--}}
        <strong>{{ $name }}</strong></p>
    </div>
</div>