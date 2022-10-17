@extends('products.500-songs-layout')

@php $productPrice = PianotePrices::$songs500Regular @endphp

@section('topbar')
    <div class="messenger-banner-shim hidden-xs"></div>
    <a href="@yield('order-link')" class="messenger-banner fixed">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg"> <p>Facebook Messenger  <br>Discount - Save {{ round(100 - (100 * ($productPrice / PianotePrices::$songs500Full))) }}%</p>
        </div>
    </a>
@endsection

@section('badge')
    <strong><u><i class="fab fa-facebook-messenger"></i> MESSENGER DISCOUNT ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / PianotePrices::$songs500Full))) }}%)
@endsection

@section('banner')
    <section class="messenger-slice">
        <div class="container">
            <a href="@yield('order-link')">
                <h1><i class="fab fa-facebook-messenger"></i> Facebook Messenger Discount <i class="fab fa-facebook-messenger"></i><br>
                    <em>Save {{ round(100 - (100 * ($productPrice / PianotePrices::$songs500Full))) }}%</em></h1>
                <p>You’ve already watched the first lesson -- and we want to make it insanely easy for you to continue your journey towards playing 500 songs on the piano. So we’re giving you a 50% discount when you register before November 15th @ Midnight.</p>
                {{--<div class="tzcd-fb">--}}
                    {{--<div><h1>00</h1><p>days</p></div>--}}
                    {{--<div><h1>00</h1><p>hrs</p></div>--}}
                    {{--<div><h1>00</h1><p>mins</p></div>--}}
                    {{--<div><h1>00</h1><p>secs</p></div>--}}
                {{--</div>--}}
            </a>
        </div>
    </section>
@endsection

@section('lesson-watched', true)

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days' => 1], 'redirect' => '/order', 'locked' => 'true', 'promo-code' => 'facebook']) }}
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('.tzcd-fb').countdown('2019/12/15')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
@endsection
