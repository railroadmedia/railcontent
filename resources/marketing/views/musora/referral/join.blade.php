@php
    $cardImages = [
        'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/30-day-guest-pass.png',
        'pianote' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-guest-pass.png',
        'singeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-guest-pass.png',
        'guitareo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-guest-pass.png',
    ];

    $brand = $referralBrand;
    $cardImage = $cardImages[$brand];

@endphp

@section('body-data')
    x-data="{
        drumeoTrailer: false,
        pianoteTrailer: false,
        guitareoTrailer: false,
        singeoTrailer: false,
    }"
@endsection

<div class="referral-sections pt-8 lg:pt-0" style="background:linear-gradient(to bottom, #010e2c, #000c17);">
    <section class="text-center text-white py-16">
        <div class="container mx-auto max-w-6xl px-4 md:px-8">
            @if ($canRefer && !$errors->has('email-invite-message'))
                <h1 class="leading-tight @if($brand === 'pianote') mb-4 lg:mb-6 @else lg:mb-14 @endif"><strong>{{ $referredByUserName }} gifted you 30 days<br class="hidden lg:inline"> of free lessons!</strong></h1>
                <p class="lg:mb-10 max-w-3xl mx-auto">
                    Redeem your 30-Day Guest Pass for a chance to win a piano, a VIP lesson, and more! This contest runs between June 19 and 30, 2023. <br><br>
                    <a href="#terms" class="font-bold underline text-white">See contest details*</a>
                </p>
                <div class="flex flex-wrap lg:flex-nowrap items-center sm:px-4">
                    <div class="flex-shrink-0 w-full lg:w-auto my-5 md:my-6 lg:my-0">
                        <div class="relative">
                            <img class="inline-block w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl" src="{{ $cardImage }}" alt="{{ $brand }} guest card">
                            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center cursor-pointer" @click="{{ $brand }}Trailer = true;">
                                <i class="fas fa-play play-button border-white border-2 rounded-full text-xl py-3 px-5 sm:text-2xl sm:py-4 sm:px-6 md:text-3xl md:py-6 md:px-8" style="background:#0009;"></i>
                            </div>
                        </div>

                        <ul class="fa-ul text-left mb-0 mt-4 md:mt-6 lg:mt-14 ml-6 md:ml-7 lg:ml-8 w-auto inline-block">
                            <li class="mb-4 lg:mb-6 leading-tight"><i class="fas fa-li fa-check text-{{ $brand }}"></i> Organized step-by-step lessons for all skill levels.</li>
                            <li class="mb-4 lg:mb-6 leading-tight"><i class="fas fa-li fa-check text-{{ $brand }}"></i> Play your favorite songs with better practice tools.</li>
                            <li class="leading-tight"><i class="fas fa-li fa-check text-{{ $brand }}"></i> Get your questions answered by helpful teachers.</li>
                        </ul>
                    </div>


                    <div class="lg:pl-10 max-w-md lg:max-w-none mx-auto">
                        <form id="join-form" name="join-form" method="post" action="{{ url()->route('referral.claiming-join') }}">
                            <input type="hidden" name="_token" class="sort-input" value="{{ csrf_token() }}" />
                            <input type="hidden" name="redirect" value="/members">
                            <input type="hidden" name="referral_code" value="{{ $referralCode ?? request()->get('rsCode') }}">
                            <input type="hidden" name="brand" value="{{ $brand }}">

                            <label class="inline-block w-full text-left @if($errors->has('name')) text-red-600 @endif" for="name"><strong>Your name</strong> <em class="opacity-70 text-xs md:float-right">@if($errors->has('name')) {{ $errors->first('name') }} @else Used to say hello! @endif</em></label>
                            <input class="main-form pt-0 inline-block w-full mt-1 mb-4 default-form-field @if($errors->has('name')) text-red-600 @else text-black @endif" type="text" id="name" name="name" placeholder="Your name..." value="{{ old('name') }}">

                            <label class="inline-block w-full text-left @if($errors->has('email')) text-red-600 @endif" for="email"><strong>Email address</strong> <em class="opacity-70 text-xs md:float-right">@if($errors->has('email')) {{ $errors->first('email') }} @else Used for member communication. @endif</em></label>
                            <input class="main-form pt-0 inline-block w-full mt-1 mb-4 default-form-field @if($errors->has('email')) text-red-600 @else text-black @endif" type="email" id="email" name="email" placeholder="Email address..." value="{{ old('email') }}">

                            <label class="inline-block w-full text-left @if($errors->has('password')) text-red-600 @endif" for="password"><strong>Password</strong> <em class="opacity-70 text-xs md:float-right">@if($errors->has('password')) {{ $errors->first('password') }} @else Used to access your lessons. @endif</em></label>
                            <input class="main-form pt-0 inline-block w-full mt-1 mb-4 default-form-field @if($errors->has('password')) text-red-600 @else text-black @endif" type="password" id="password" name="password" placeholder="Password..." value="{{ old('password') }}">

                            <label class="inline-block w-full text-left" for="password_confirmation"><strong>Password confirm</strong> <em class="opacity-70 text-xs md:float-right">No typos.</em></label>
                            <input class="main-form pt-0 inline-block w-full mt-1 mb-4 default-form-field text-black" type="password" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm..." value="{{ old('password_confirmation') }}">

                            @if(!empty($googleRecaptchaSiteKey))
                                @if($errors->has('g-recaptcha-response')) <label class="inline-block w-full text-left  text-red-600">  <em class="text-red-600 opacity-70 text-xs md:float-right"> {{ $errors->first('g-recaptcha-response') }}</em></label>@endif
                                <div class="g-recaptcha mx-auto @if($errors->has('g-recaptcha-response')) text-red-600 @endif " name="recaptcha" style="display: inline-block;" id='recaptcha_token' data-sitekey="{{ $googleRecaptchaSiteKey }}"></div>
                            @endif
                            <input name="button" type="submit" id="button" class="mt-2 text-white bg-{{ $brand }} leading-none text-lg border-0 rounded-full select-none cursor-pointer text-center py-4 px-16 uppercase font-bebas-neue" value="Redeem Guest Pass"/>
                        </form>

                    </div>
                </div>
            @else
                <h1 class="leading-tight lg:mb-14"><strong>Referral link has expired.</strong></h1>
            @endif
        </div>
    </section>

    @if($brand === 'pianote')
        <section class="bg-[#00101D] py-10 lg:py-20">
            <div class="max-w-5xl mx-auto px-3 sm:px-6 xl:px-0 text-white text-center">
                <h3 class="mb-10 text-xl sm:text-2xl md:text-3xl"><strong>You can win...</strong></h3>
                <div class="md:grid md:grid-cols-3 md:gap-4 mb-14 max-w-xs sm:max-w-none mx-auto">
                    <img class="mx-auto mb-6 sm:mb-0" src="https://musora-web-platform.s3.amazonaws.com/referral/pianote_1st+Prize.png" alt="1st prize" />
                    <img class="mx-auto mb-6 sm:mb-0" src="https://musora-web-platform.s3.amazonaws.com/referral/pianote_2nd+Prize.png" alt="2nd prize" />
                    <img class="mx-auto" src="https://musora-web-platform.s3.amazonaws.com/referral/pianote_3rd+Prize.png" alt="3rd prize" />
                </div>
            </div>
        </section>

        <div id="terms" class="block relative invisible"></div>
        <section class="py-12 lg:py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6 2xl:px-0">
                <h4 class="mb-4"><strong>Terms and Conditions</strong></h4>
                <p>
                    <strong>Eligibility:</strong> This contest is open to Musora students with an active, paid membership and new students who sign up for a 30-Day Guest Pass, 18 years or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.
                    <br><br>
                    <strong>How to Enter:</strong> Musora students automatically receive (1) entry to the contest when a referred friend signs up for a 30-Day Guest Pass between June 19 to 30, 2023. Musora students may collect up to (5) contest entries by having 5 successful referrals within this timeframe. New students who sign-up for a 30-Day Guest Pass within this period will have (1) entry to the contest. No purchase is necessary to enter or win.
                    <br><br>
                    <strong>Prize:</strong> The first prize is a Casio PXS3100BK Digital Piano with a retail value of US$879.99. The second prize is a Pianote Book Bundle & a VIP lesson with an estimated value of US$250. The third prize is a Pianote Book Bundle with a retail value of US$117. The prizes are non-transferable and cannot be exchanged for cash.
                    <br><br>
                    <strong>Winner Selection:</strong> The winner will be selected randomly from all eligible entries received during the entry period. The winner will be notified by email or direct message within 48 hours of the selection. If the winner does not respond within 48 hours, another winner will be selected.
                    <br><br>
                    <strong>Release:</strong> By entering the contest, participants release and hold harmless the sponsor, their affiliates, and their respective officers, directors, employees, and agents from any liability or any injury, loss, or damage of any kind arising from or in connection with the contest or any prize won.
                    <br><br>
                    <strong>General Conditions:</strong> The sponsor reserves the right to cancel, suspend, or modify the contest if fraud, technical failures, or any other factor beyond their control impairs the contest's integrity, as determined by the sponsor in their sole discretion. The sponsor reserves the right to disqualify any individual who violates these Terms and Conditions or interferes with the contest in any way.
                    <br><br>
                    <strong>Governing Law:</strong> The contest shall be governed by and construed by the laws of the country where the contest is held, without regard to conflicts of law principles.
                    <br><br>
                    <strong>Privacy:</strong> Personal information collected from participants will be used only to administer the contest and will not be shared with any third party except as necessary to fulfill the prize.
                    <br><br>
                    By participating in the contest, participants agree to be bound by these Terms and Conditions.
                </p>
            </div>
        </section>
    @endif

    @include('_partials.components.video-modal',[
        'name' => 'drumeoTrailer',
        'video' => '785314424',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'pianoteTrailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'guitareoTrailer',
        'video' => '785314408',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'singeoTrailer',
        'video' => '785314379',
        'vimeo' => true,
    ])
</div>
