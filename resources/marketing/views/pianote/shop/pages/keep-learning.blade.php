@extends('pianote.shop.shop-page-layout')

@section('meta')
    @parent
    <title>Continue your membership</title>
    <meta property="og:title" content="Continue your membership">

    <meta name="description" content="You’ve come so far, and we’d love you to see what’s possible for your future.">
    <meta property="og:description" content="You’ve come so far, and we’d love you to see what’s possible for your future.">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
@stop()

@php
    $bonuses = [
        [
            'name' => 'Annual Pianote Membership',
            'price' => 'Normally $197',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Guided, step-by-step video lessons from REAL teachers that you can watch anytime, anywhere. Learn your favorite songs in the comfort of your own home, whenever you want. Impress your family and friends with your piano playing – for a tiny fraction of the cost of private lessons. And get support and feedback from real teachers and world-class artists who will help you every step of the way.',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => false,
            'img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/pianote-annual.png',
        ],
        [
            'name' => 'Practice Planner',
            'price' => 'Normally $39',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'They say practice makes perfect. It’s a cliche -- but it’s not entirely true. Because if you’re not practicing the RIGHT things -- the RIGHT way.... You won’t be perfect. Worse -- you could be wasting your time. The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve. This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/planner.png',
        ],
    ];
@endphp

@section('top')
    @include('pianote.shop._partials._slider', [
        "headerText" => "<strong>Lock in your progress! Get this exclusive offer when you continue your membership today.</strong>",
        "images" => array(
            (object)['path' => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/planner-thumb.jpg"]
        ),
        "noSlider" => true,
    ])

    <div class="shop-sidebar sliding-function px-3 md:px-4 lg:px-4 lg:w-1/3 lg:mt-5">
        <div id="order" class="anchor"></div>
        <div class="side-slide md:border md:border-solid md:rounded-md" style="width: 360px; border-color: #CCD3D3;">
            <div class="text-center md:py-6 md:px-4">
                <p class="text-center font-bold text-sm leading-none mb-1 md:text-base" style="color:#10D05F;">Save {{ round(100 - (100 * (177 / 236))) }}%</p>
                <h1 class="text-center text-4xl no-leading uppercase md:text-3xl" style="color:#8C9698;"><s>$236</s> <strong class="text-pianote">$177</strong></h1>
                <a class="online-atc" href="/ecommerce/add-to-cart?redirect=%2Forder&amp;products[PIANOTE-MEMBERSHIP-1-YEAR]=1&amp;products[pianote-practice-planner]=1&amp;redirect=%2Forder&amp;locked=true&promo-code=roland">
                    <button class="bg-pianote font-bold text-xl leading-none uppercase text-white w-full py-4 px-2 rounded-full border-0 mx-auto my-2 md:py-5 md:py-2 md:my-4 md:mx-auto hover:opacity-90" style="font-family: Roboto Condensed, san-serif;">Get The Deal &raquo;</button>
                </a>
                <a class="text-pianote" href="/ecommerce/add-to-cart?products%5BPIANOTE-MEMBERSHIP-1-MONTH%5D=1&redirect=%2Forder&locked=true"><em>Or choose a monthly membership for ${{ PianotePrices::$pianoteMembershipMonthlyRegular }}/month (no bonuses)</em></a>
                <br><br>
                <p class="text-black italic text-xs leading-normal text-center mx-auto">You can also order by phone toll-free at<br class="hidden-xs">
                    <a class="text-pianote" href="tel:+18004398921">1-800-439-8921</a> or directly at
                    <a class="text-pianote" href="tel:+16048557605">1-604-855-7605</a>. </p>
            </div>
            <div class="flex justify-center items-center px-5 pb-5 text-center md:pt-2 md:pt-4 md:pb-6 lg:p-5 lg:-mt-1 lg:mx-auto lg:mb-0 border-t-0 lg:border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="w-36 my-0 pr-6" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/90-day.png">
                <p class="text-xs font-bold text-left my-0 text-pianote">Your entire order is backed by<br class="lg:hidden" /> our 90-Day Money Back <br class="lg:hidden" /> Guarantee.</p>
            </div>
        </div>
    </div>
@endsection

@section('bottom')
    <p>You’ve come so far, and now you can lock in a super-low rate for a year of lessons with Pianote. So to help you stick around, we want to give you a discount and a FREE gift when you decide to continue your journey with us.
        <br><br>
        Continue your membership today and get…</p>
    {{--<div class="flex-images nine">--}}
        {{--<img class="special" src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/pianote-annual.png">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/foundations.jpg">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/planner.png">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/de-stupefy-your-left-hand.jpg">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/worship-piano.jpg">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/faster-fingers.jpg">--}}
        {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/sight-reading-made-simple.jpg">--}}
    {{--</div>--}}
    {{--<hr>--}}
    <hr class="my-5">

    @include('pianote.shop._partials._bonuses')
    {{--<div class="bonus-pic">--}}
        {{--<div class="image-wrap shipping">--}}
            {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/foundations.jpg">--}}
        {{--</div>--}}
        {{--<p>--}}
            {{--<strong>Pianote Foundations Books - Normally $149</strong><br> The perfect companion to your Lifetime Membership. This box-set of 10 hardcover piano books makes a stunning guide to learning and mastering the piano.--}}
            {{--<br><br> With lay-flat spines to rest perfectly on your music stand, and presented in beautiful color, each page builds on the one before to show you the best way to learn and progress as a piano player.--}}
            {{--<br><br> Take your learning offline and simply turn the page to find your perfect lesson.--}}
            {{--<br><br> Complete with bonus exercises and a library of online resources. <br></p>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<hr>--}}
    {{--<div class="bonus-pic">--}}
        {{--<div class="image-wrap">--}}
            {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg">--}}
        {{--</div>--}}
        {{--<p>--}}
            {{--<strong>Piano Technique Made Easy - Normally $120<br>(Lifetime Access)</strong><br> What does piano technique have to do with songs? Well, having good piano technique makes learning and playing the songs you love SO MUCH EASIER.--}}
            {{--<br><br> After all, what are songs?--}}
            {{--<br><br> They’re simply a combination of chords, scales, and arpeggios. So it makes sense that getting better at playing all of those things will make playing songs easier.--}}
            {{--<br><br> Piano Technique Made Easy is the comprehensive guide for learning and perfecting your technique.--}}
            {{--<br><br> Every scale. Every key signature. Every chord. <br><br> You’ll learn them all.--}}
            {{--<br></p>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="bonus-pic">--}}
        {{--<div class="image-wrap">--}}
            {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/de-stupefy-your-left-hand.jpg">--}}
        {{--</div>--}}
        {{--<p>--}}
            {{--<strong>De-Stupefy Your Left Hand - Normally $99<br>(Lifetime Access)</strong><br> Your left hand is weaker. And that’s normal. Most piano players struggle with their left hand, and sadly, most just accept it.--}}
            {{--<br><br> De-Stupefy Your Left Hand is your 3-step path to a better left hand.--}}
            {{--<br><br> First, you’ll learn how to get your left hand to listen to your brain, so it moves when YOU want it to (and not whenever it feels like it).--}}
            {{--<br><br> Then, you’ll start playing faster, more accurately, and with more control, as you put your left hand to work.--}}
            {{--<br><br> And finally, you’ll discover how to transform your playing with beautiful and musical left-hand accompaniments that would have seemed out of reach at the beginning of the training pack.--}}
            {{--<br><br> Yes, your left hand might be weaker… <br><br> But it doesn’t have to be. <br>--}}
        {{--</p>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="bonus-pic">--}}
        {{--<div class="image-wrap">--}}
            {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg">--}}
        {{--</div>--}}
        {{--<p>--}}
            {{--<strong>Piano Riffs & Fills - Normally $99<br>(Lifetime Access)</strong><br> Anyone can play a chord -- but what happens in the spaces between the chords distinguishes the great players from the mediocre ones.--}}
            {{--<br><br> Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect.--}}
            {{--<br><br> Learn the secrets and tips to play fills that sound complicated and advanced, but are actually very simple to learn and start adding to your repertoire.--}}
            {{--<br><br> This pack is broken down so even complete beginners can start sounding amazing. You’ll be shown exactly how to play the fills -- note for note.--}}
            {{--<br></p>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="bonus-pic">--}}
        {{--<div class="image-wrap">--}}
            {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/worship-piano.jpg">--}}
        {{--</div>--}}
        {{--<p>--}}
            {{--<strong>Worship Piano - Normally $99<br>(Lifetime Access)</strong><br> Master the skills to play modern worship songs and learn how to be part of a band.--}}
            {{--<br><br> You’ll learn how to read worship chord charts, create beautiful background music, and how to be part of a worship team.--}}
            {{--<br><br> Plus, this pack comes with your own band as a backing track, so YOU can join the band and play piano with other musicians.--}}
            {{--<br><br> No prior knowledge or experience necessary. We start from scratch with this one.--}}
            {{--<br></p>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="bonus-pic">--}}
        {{--<div class="image-wrap">--}}
            {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/faster-fingers.jpg">--}}
        {{--</div>--}}
        {{--<p>--}}
            {{--<strong>Faster Fingers - Normally $99<br>(Lifetime Access)</strong><br> Increase your finger speed, strength, and accuracy with this complete digital training pack. Faster Fingers is your roadmap to success on the piano.--}}
            {{--<br><br> You’ll be guided every step of the way with daily practice videos and encouragement, plus you’ll be able to play along with every exercise and record your speed.--}}
            {{--<br><br> The metronome doesn’t lie -- you’ll be able to SEE how much faster you’re getting.--}}
            {{--<br><br> As a beginner, some of the later exercises may be too difficult, to begin with, but you’ll find immense value in the early exercises, and it will help speed up your learning as well as your fingers.--}}
            {{--<br></p>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="bonus-pic">--}}
        {{--<div class="image-wrap">--}}
            {{--<img src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/sight-reading-made-simple.jpg">--}}
        {{--</div>--}}
        {{--<p>--}}
            {{--<strong>Sight-Reading Made Simple - Normally $19<br>(Lifetime Access)</strong><br> Start reading music in MINUTES with this fantastic digital training pack. Sight-Reading Made Simple breaks down the task or reading music into short FUN lessons, so you can learn the basics in no time.--}}
            {{--<br><br> If you’ve ever wanted to read music, or tried before and had a bad experience, this training pack will have you reading notes, rhythm, and time signatures in no time.--}}
            {{--<br><br> You’ll get practice exercises to go along with the lessons, PLUS a downloadable glossary of music notes and symbols that you can download, print, and keep at the keyboard.--}}
            {{--<br><br> Reading music doesn’t have to be hard. This training pack will show you just how easy it can be.--}}
            {{--<br></p>--}}
    {{--</div>--}}
    {{--<a href="#order" class="anchor-slide join hidden-md hidden-lg">Jump To Top <i class="fas fa-angle-up"></i></a>--}}
@endsection

@section('end-body-scripts')
    <script>
        $(document).ready(function(){
            $(".bundle-pick").change(function () {
                var orderButton = $(this).parent().find(".selected-bundle");
                var selectedOption = $(this).find("option:selected");
                $(this).removeClass('error');
                orderButton.addClass('active');
                orderButton.attr('href', selectedOption.val());
            });

            $(".selected-bundle").on('click', function (ev) {
                if (!$(this).hasClass('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var selecter = $(this).parent().find(".bundle-pick");
                    selecter.addClass('error');
                }
            });
        });
    </script>
@stop
