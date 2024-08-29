@php
    require_once(resource_path('marketing/views/musora/_partials/homepage-data.php'));
@endphp

@extends('musora._partials.layout', [
    "hideJoin" => true,
])

@section('head-includes')

    <title>Access Pass Redeem | Drumeo</title>
    <meta name="description" content="To redeem your access pass enter your code below!">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <style>
        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent;
        }

        input::-webkit-input-placeholder,
        textarea::-webkit-input-placeholder {
            color:#AAA;
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color:#AAA;
        }

        input:-ms-input-placeholder,
        textarea:-ms-input-placeholder {
            color:#AAA;
        }

        input::placeholder,
        textarea::placeholder {
            color:#AAA;
        }

        .error {
            color:red;
            font:500 20px "Open Sans", sans-serif;
        }

        input.jq-couponcode-part {
            width:69px;
        }

        input.jq-couponcode-good {
            background-color:#77ff77;
        }

        input.jq-couponcode-good-nohighlight {
            text-align:center;
            padding:2px 10px;
        }

        input.jq-couponcode-bad {
            background-color:#ff7777;
        }

        .jq-couponcode-sep {
            width:6px;
        }

        .apply {
            background:#00060B;
            border-radius:70px;
            color:#FFF;
            font:400 28px/60px "Bebas Neue", sans-serif;
            text-transform:uppercase;
            height:60px;
            width:100%;
            margin:20px auto 0;
            border:none;
            cursor:pointer;
        }

        input[type="text"],
        input[type="password"] {
            background:#FFF;
            color:#000;
            border:1px solid #ccc;
            font:400 20px/20px "Open Sans", sans-serif;
            margin:0;
            padding:15px 20px;
            box-sizing:border-box;
            box-shadow:none !important;
            border-radius:100px;
        }

        .default-form-field {
            width:100%;
        }

        .help-message {
            color:#666;
            font:400 16px "Open Sans", sans-serif;
            padding:0 0.9375rem;
            margin-bottom:10px;
        }

        .validation-error {
            color: red;
            font: 600 20px/1em "Open Sans", sans-serif;
        }

        #commentform .code-input {
            text-align:center;
            display:inline-block;
            margin:0;
            font-size:10px;
        }

        .redeem-switcher {
            font:400 16px "Open Sans", sans-serif;
            text-align:center;
            display:block;
            margin:0 auto 5px;
        }

        .input-describer {
            font:900 20px "Open Sans", sans-serif;
            margin:15px auto 10px;
        }

        @media only screen and (min-width:40em) {
            .redeem-switcher {
                margin:0 auto 15px;
            }

            #commentform .code-input {
                font-size:16px;
                width:95%;
            }
        }

        .apply {
            background:#ffae00;
            color:#000;
        }

        .apply:hover {
            background:#ffb61a;
            color:#000;
        }
    </style>

    @if(!empty($thomann))
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.agent='fmc-sunlab';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','//connect.facebook.net/en_US/fbevents.js');
            fbq('init', '520898398018927');
            fbq('track', "PageView");
            fbq('trackCustom', 'FNet', {
                cat1: 'DR'
            });
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id=520898398018927&ev=PageView&noscript=1"
            /></noscript>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-1019120767"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'AW-1019120767');
            gtag('event', 'conversion', {
                'send_to': 'AW-1019120767',
                'cat1': 'DR',
                'arena': 'fnet',
                'fnet': 'drumeo'
            });
        </script>
    @endif
@endsection

@section('body-data')
    x-data ='{
        tos: false,
        lazyLoad: false,
    }'
@endsection

@section('layout-scripts')
    @if(!empty($guitarcenter))
        <script>
            function redeemForm() {
                return {
                    submitRedeem(event) {
                        if (!this.$refs.termsCheckbox.checked) {
                            alert('You must agree to the terms and conditions.');
                            return false;
                        }
                        event.target.submit();
                    }
                }
            }
        </script>
    @endif
@endsection

@section('layout-body')
    <div class="py-8 sm:py-12 px-4 sm:px-6 bg-black bg-cover bg-center text-white text-center" style="background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/{{ musora_cdn('redeem/sweetwater/bg.jpg') }});">
        <div class="container mx-auto max-w-3xl">
            @if(!empty($thomann))
                <div class="mb-2 align-middle flex items-center justify-center w-full">
                    <img class="inline-block h-6 sm:h-8 lg:h-9 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/musora/membership/redeem/thomann-white.png"
                        alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h2 class="inline-block font-black mx-3 sm:mx-5">+</h2>
                    <img class="inline-block h-12 sm:h-20 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/Musora-AllBrands.png"
                        alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
                <h3 class="leading-tight my-2"><strong>Redeem your @if(!empty($day90)) 90-Day @endif membership for Musora.</strong></h3>
            @elseif(!empty($guitarcenter))
                <div class="mb-2 align-middle flex items-center justify-center w-full">
                    <img class="inline-block h-12 sm:h-20 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/musora/membership/redeem/guitarcenter-white.png"
                        alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h2 class="inline-block font-black mx-3 sm:mx-5">+</h2>
                    <img class="inline-block h-12 sm:h-20 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/Musora-AllBrands.png"
                        alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
                <h3 class="leading-tight my-2"><strong>Redeem your @if(!empty($day90)) 90-Day @endif membership for Musora.</strong></h3>
            @elseif(!empty($spotify))
                <img class="h-7 sm:h-8 lg:h-9 mb-2 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/musora/membership/redeem/musora-spotify-logo-white.svg"
                    alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                <h3 class="leading-tight my-2"><strong>Redeem your membership for Musora.</strong></h3>
            @else
                <h3 class="leading-tight"><strong>Redeem your membership for Musora.</strong></h3>
            @endif
            <h5 class="leading-tight mt-2 mb-6 sm:mb-8 mx-auto max-w-md">Level up your skills with the lessons, songs, teachers, and practice tools trusted by <strong>thousands of active students.</strong></h5>
            <picture>
                <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1480x0/filters:quality(95)/marketing/musora/membership/redeem/redeem-laptop2.webp">
                <img class="h-40 sm:h-72 lg:h-96 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/musora/membership/redeem/redeem-laptop2.webp"
                    alt="laptop spread" loading="lazy" onload="this.classList.remove('opacity-0')" >
            </picture>
        </div>
    </div>
    <div class="py-8 sm:py-12 px-4 sm:px-6">
        <div class="container mx-auto max-w-3xl">
             @if($newAccount)
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong><b>Existing Member?</b>
                        <br>
                        <a class="text-drumeo underline"
                            @if(!empty($spotify))
                                href="/redeem-spotify/existing"
                            @elseif(!empty($thomann))
                                href="/thomann/existing"
                            @elseif(!empty($guitarcenter))
                                href="/guitarcenter/redeem/existing"
                            @else
                                href="/redeem/existing"
                            @endif
                        >Click here to add to your account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for new accounts)</em>
                </div>

                @foreach ($errors->all() as $error)
                    <br>
                    <p class="validation-error">{{ $error }}</p>
                @endforeach

                @include('musora.pages.redeem._redeem-form', [
                    'existing' => !$newAccount,
                    'buttonText' => 'Click To Redeem &raquo;',
                    'buttonColor' => 'bg-drumeo text-white',
                ])
             @else
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong> <b>Not already a member?</b>
                        <br>
                        <a class="text-drumeo underline"
                            @if(!empty($spotify))
                                href="/redeem-spotify"
                            @elseif(!empty($thomann))
                                href="/thomann"
                            @elseif(!empty($guitarcenter))
                                href="/guitarcenter/redeem/"
                            @else
                                href="/redeem"
                            @endif>Click here to redeem on a new account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for existing members)</em>
                </div>

                @foreach ($errors->all() as $error)
                    <br>
                    <p class="validation-error">{{ $error }}</p>
                @endforeach

                @include('musora.pages.redeem._redeem-form', [
                    'existing' => !$newAccount,
                    'buttonText' => 'Click To Redeem &raquo;',
                    'buttonColor' => 'bg-drumeo text-white',
                ])
             @endif


            <br>
            @if(!$newAccount)
                <p class="help-message">
                    ** If you apply your code to an account that already has an active Membership subscription, your subscription will be extended based on the time associated with your card.
                </p>
            @endif

            <p class="help-message">
                ** Your Access Pass will give you access to all four of our communities: Drumeo, Pianote, Guitareo, and Singeo!
            </p>
        </div>
    </div>

    @php
        $gridItems = $musora['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'seven' => true,
    ])

    @include('_partials.components.forms.redeem-form-script', [
        'api' => empty($existing) ? get_musora_brand_base_url().'/ecommerce/access-codes/redeem' : URL::route('access-codes.form-claim'),
        'existingMember' => !$newAccount,
    ])

    @if(!empty($guitarcenter))
        @component('_partials.components.modal',[
            'name' => 'tos',
        ])
            @slot('content')
                <div class="relative overflow-y-visible max-w-3xl p-4 md:p-5 lg:p-7 text-black bg-white mx-auto rounded-xl shadow-lg text-left">
                    <h4 class="font-bold mt-6 mb-2">Your Acceptance of our Terms of Use:</h4>
                    <p class="text-sm mb-4">The following terms of use (these “Terms”) govern all use of all of the websites and mobile applications operated by Musora Media Inc. (“Musora”, “us, “we” or “our”), including, www.drumeo.com and/or the Drumeo mobile application, www.pianote.com and/or the Pianote mobile application, www.guitareo.com and/or the Guitareo mobile application and www.singeo.com and/or Singeo mobile application, www.musora.com and/or the Musora mobile application, including all content, services, other applications and products available at or through such websites, platforms and applications, whether now in existence or added in the future (collectively, the “Services” and each, a ”Service”).</p>
                    <p class="text-sm mb-4">The use of any of the Services is offered subject to your acceptance, without modification, of all of these Terms.  PLEASE READ THESE TERMS CAREFULLY BEFORE ACCESSING OR USING ANY OF THE SERVICES.   By accessing or using any of the Services, you agree to become bound by these Terms.   If you do not agree to all of these Terms, then you may not access or use the Services.</p>
                    <p class="text-sm mb-4">These Terms may be revised from time to time by updating this posting.  You should visit this page regularly to review the current Terms.  If we deem a revision to be material, we will provide you at least 30 days’ notice prior to any such terms taking effect.  Your continued access and use of any of the Services after such posting will signify your acceptance of any revisions.  If you do not agree to the revisions, you do not have permission to access, and should discontinue use of, the Services.  These Terms were last updated on September 27, 2023.</p>
                    <h4 class="font-bold mt-6 mb-2">Eligibility</h4>
                    <p class="text-sm mb-4">To be eligible to become a member of Musora (a “Member”) and able to subscribe to a Service, you must be at least sixteen (16) years old or older; however, if you are under 18 years of age or under the age of majority in your jurisdiction, your registration must include the consent of your parent of legal guardian.</p>
                    <h4 class="font-bold mt-6 mb-2">Content Advisory</h4>
                    <p class="text-sm mb-4">You and your legal guardian understand that certain content in the Services may not be appropriate for persons under the age of 18 years.  Although we may endeavour from time to time to provide appropriate advisories, we will not be held liable in any manner whatsoever for failure to do so.</p>
                    <h4 class="font-bold mt-6 mb-2">Privacy Policy</h4>
                    <p class="text-sm mb-4">As your privacy is important to us, we have adopted a privacy policy that explains and governs the manner in which information is collected and used at or in connection with the Services (the “Privacy Policy”).  Please read the Privacy Policy that forms a part of these Terms.  By accepting these Terms, you shall also be deemed to have accepted the terms of the Privacy Policy.  Our Privacy Policy is at https://www.musora.com/privacy.</p>
                    <h4 class="font-bold mt-6 mb-2">Membership</h4>
                    <p class="text-sm mb-4">To become a Member, you will need to create a Musora account and fill out the information necessary to create a profile.  You can do this by accessing our membership sign-up page at the home page for each of our websites, using your email address or through your account with other third party services such as Google Play or Apple, where indicated.</p>
                    <p class="text-sm mb-4">In creating a profile, you agree to provide true, accurate, current, and complete information about yourself as prompted by the Service registration process.  When creating your account, you will have to provide your credit card information. If we are not provided such details or if we believe the details are not accurate, current and complete, we have the unconditional right to refuse your access to, or use of, the Services.  By registering with us and/or through an applicable third party service, you agree to abide and be bound by these Terms and all applicable terms and policies of such third party services.</p>
                    <p class="text-sm mb-4">If you decide to register with Musora and become a Member, your account is just for you, and you cannot share your account details or let anyone else access or use your account or the Services.</p>
                    <h4 class="font-bold mt-6 mb-2">Username and Password</h4>
                    <p class="text-sm mb-4">It's important to keep your username and password secret since you're responsible for all the activity that happens using your account, including any purchases made, whether or not authorized by you. If there's any unauthorized use of your account, you'll be responsible for any losses you face and any losses Musora or other users experience.  If you suspect someone else accessed your account or got hold of your account information, you need to let Musora know right away by emailing support@musora.com or through our general contact form accessible at https://www.musora.com/contact.</p>
                    <p class="text-sm mb-4">Musora reserves the right to remove or reclaim any usernames or passwords that violate any laws, rules, regulations or policies, or infringe upon or otherwise violate any third party’s rights.</p>
                    <h4 class="font-bold mt-6 mb-2">Consent to Commercial Messages from Musora</h4>
                    <p class="text-sm mb-4">By creating an account and becoming a Member, you might receive occasional emails about special offers, marketing, and surveys related to Musora. If you want to stop receiving these commercial emails from Musora, you can easily unsubscribe by following the “unsubscribe” instructions in the emails.</p>
                    <h4 class="font-bold mt-6 mb-2">Guitar Center Promotional Memberships</h4>
                    <p class="text-sm mb-4">The access code provided to you through qualifying for the promotion by Guitar Center Inc. will grant you access to Musora’s services, including a Musora+ Membership with full access to Songs. This non-recurring membership requires no credit card or payment processing information and will commence on the date of redemption and conclude 6 months from that date. Upon expiration of the promotional subscription period, the continuation of the subscription may be purchased through Musora’s site using links provided in any subsequent promotional material that may be sent to you during or upon the conclusion of your initial membership period.</p>
                    <h4 class="font-bold mt-6 mb-2">Prepaid Subscriptions/Gift Cards and Promotions</h4>
                    <p class="text-sm mb-4">You can purchase Musora prepaid subscriptions/gift cards (“Gift Cards”) for the Services either on the Musora website or at other retail outlets and websites.</p>
                    <p class="text-sm mb-4">You can only use Gift Cards to buy certain of the Services on the Musora website at Musora.com/redeem. Sometimes there might be other types of promotional codes available from third parties or Musora.  You may use these codes and described in the specific promotion.</p>
                    <p class="text-sm mb-4">Additional terms and conditions may apply as set forth on the Gift Cards or at point of registration.</p>
                    <p class="text-sm mb-4">The rules for Musora Gift Cards may be changed at any time and must be activated within 24 months from the date of purchase.  Any Gift Cards not activated within 24 months from the date of purchase will expire and become null and void.</p>
                    <p class="text-sm mb-4">Your Gift Card membership will continue based on the lengths of the subscription option you choose. Remember, you need to have Internet access to use the Service.</p>
                    <p class="text-sm mb-4">Gift Card Subscriptions include:</p>
                    <p class="text-sm mb-4">a. 30 Day Subscription – Your Musora membership will be for thirty (30) days and will automatically terminate at the end of the thirty day period, unless otherwise extended by you.</p>
                    <p class="text-sm mb-4">b. 90 Day Subscription – Your Musora membership will be for ninety (90) days and will automatically terminate at the end of the ninety day period, unless otherwise extended by you.</p>
                    <p class="text-sm mb-4">c. Annual Subscription – Your Musora membership will be for three hundred and sixty-five (365) days and will automatically terminate at the end of the three hundred and sixty-five day period unless otherwise extended by you.</p>
                    <p class="text-sm mb-4">No refunds are provided for any part of a Gift Card subscription that you didn't use and the 90-day Guarantee is not applicable for the Gift Card or subscriptions purchased through a promotional code.</p>
                    <h4 class="font-bold mt-6 mb-2">License to Use the Services</h4>
                    <p class="text-sm mb-4">Upon sign-up and successful registration, subject to your continued compliance with these Terms, you are granted a non-exclusive, non-transferable, revocable license to access and use the Services solely for your personal and non-commercial use.</p>
                    <p class="text-sm mb-4">In using the Services, you agree that you may not: (i) sell, rent, or sub-license any material from the Services; (ii) re-publish material from the Services (including republication on another website); (iii) redistribute material from the Services (except for content specifically and expressly made available for redistribution); (iv) reproduce, duplicate, copy, or otherwise exploit material from the Services for any commercial purpose whatsoever; (v) edit or otherwise modify any material on the Musora website or other platforms; or (vi) exhibit any material from the Services in public.</p>
                    <h4 class="font-bold mt-6 mb-2">User Contributions and Social Media Boards, Forums and Chat Rooms</h4>
                    <p class="text-sm mb-4">If you post materials, messages, comments, opinions or other content to the Services (e.g. through bulletin boards, forum boards, message boards, chat rooms, comment feeds, etc.) (the “User Information”), you agree that any User Information you post, transmit, upload, distribute or otherwise publish, (i) will not be libelous, defamatory, obscene, pornographic, fraudulent, harmful, threatening, abusive, hateful or otherwise offensive or illegal; (ii) will not violate or infringe any copyright, trademark, patent, trade secret or other intellectual property rights, (iii) will not violate the privacy or publicity right  of others or other third party rights, (iv) will be free of viruses, adware, spyware, worms or other malicious code, and (v) not be in violation of any applicable laws, rules, or regulations.</p>
                    <p class="text-sm mb-4">The User Information included and/or expressed is not those of Musora or its content providers.  Musora does not undertake to monitor or review the User Information and assumes no responsibility whatsoever with respect to the User Information and any content contained therein.   However, you agree that Musora has the right from time to time to monitor the use of the Services, including the User Information, and to disclose any information necessary to: (i) satisfy any legal, regulatory or other government request; (ii) to operate the Services properly; or (iii) to protect itself, other visitors or users of the Services in accordance with the Privacy Policy.  Musora reserves the right to refuse to post or to edit or remove any User Information in whole or in part, that, in its sole discretion is unacceptable, or in violation of these Terms.  Musora is not responsible in any manner whatsoever for the loss of any User Information or data contained therein as a result of any system error, editing or otherwise.</p>
                    <p class="text-sm mb-4">By submitting the User Information, you hereby grant Musora a royalty-free, perpetual, irrevocable, non-exclusive worldwide license to use, reproduce, adapt, modify, create derivative works from, sub-license, transmit, distribute, publish, publicly perform, display or otherwise exploit any or all portions of such User Information in any manner and media and by means of any technology now known or hereinafter developed.  In addition, you hereby waive all moral rights in and to such User Information.</p>
                    <h4 class="font-bold mt-6 mb-2">Intellectual Property</h4>
                    <p class="text-sm mb-4">The Services, features and functionality are and will remain the sole and exclusive property of Musora and its licensors, as the case may be. The Services are protected by copyright, trademark, and other laws of Canada, the United States and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Musora.</p>
                    <p class="text-sm mb-4">Your use of any content within the Services is strictly prohibited unless expressly permitted by these Terms. Any unauthorized use may violate the copyright, trademark, and other proprietary rights of Musora and/or third parties, as well as the laws of privacy and publicity, and other applicable laws, rules and regulations. Nothing contained in this Agreement or in the Services shall be construed as granting, by implication or otherwise, any license or right to use any trademark, trade name or other proprietary information of Musora and its third party licensors without the express prior written consent of Musora or the applicable third-party owner.</p>
                    <p class="text-sm mb-4">We respect the copyright, trademark and all other intellectual property rights of others. We have the right, but not the obligation, to remove content and accounts containing materials that we deem, in our sole discretion, to be unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or that violates any party’s intellectual property or these Terms.</p>
                    <p class="text-sm mb-4">If you believe that your intellectual property rights are being violated and/or that any work belonging to you has been reproduced on the Services or in any content in any way, you may contact us at https://www.musora.com/contact.  Please provide your name and contact information, the nature of your work and how it is being violated, all relevant copyright and/or trademark registration information, the location/URL of the violation, and any other information you believe is relevant.</p>
                    <h4 class="font-bold mt-6 mb-2">Links to Other Web Sites</h4>
                    <p class="text-sm mb-4">We rely on third party licenses to maintain the Services, including, but not limited to, YouTube, Vimeo, SoundSlice and Hal Leonard.  In addition, our Services may contain links to third party websites or services that are not owned or controlled by us for convenience to you.</p>
                    <p class="text-sm mb-4">We have no control over, and assume no responsibility for, the content, privacy policies, operability or practices of any third-party websites or services. We make no endorsements, and do not warrant the offerings, of any of these entities/individuals or their websites and you access and use such sites, including information, materials, products and services therein, solely at your own risk.  You acknowledge and agree that Musora shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with your use of, or reliance on, any such content, products or services available on or through any such third-party websites or services.</p>
                    <p class="text-sm mb-4">We strongly advise you to read the terms and conditions and privacy policies of any third-party websites or services that you visit, including but not limited:</p>
                    <p class="text-sm mb-4">YouTube’s terms of service found here at:  YouTube Terms of Service</p>
                    <p class="text-sm mb-4">Vimeo’s terms of service found here at:  Vimeo Terms of Service</p>
                    <p class="text-sm mb-4">Soundslice’s terms of service found here at:  Soundslice Terms of Service</p>
                    <h4 class="font-bold mt-6 mb-2">Unauthorized Use and Termination</h4>
                    <p class="text-sm mb-4">You agree to use the Services only for authorized and legal activities.  We reserve the right, in our sole discretion, to suspend or terminate your access to all or part of the Services, including your account, with or without notice, and for any reason whatsoever, including, but not limited to, a breach of these Terms.  In such event, you can lose your account, benefits and privileges and we will be under no obligation to compensate you for any such losses or results.</p>
                    <p class="text-sm mb-4">In addition, we reserve the right to shut down and discontinue any Service at any time on the giving of written notice.  In such event, (i) if you are a Lifetime Member, we will use our reasonable best efforts to provide you the means necessary to download any original, available and cleared material on the Services as soon as reasonably practicable, but you will not be eligible for any refund or other compensation; (ii) if you are on plan for a specified period of time (e.g., monthly, annual, 5-year or other finite time period), you will lose access to the Services and you will not be eligible for any refund or other compensation; (iii) if you receive the Services by way of a gift card, promotion or other code-based access (e.g., via Alesis, Roland, Code Cards etc.), you will lose access to the Services and you will not be eligible for any refund or compensation from us.</p>
                    <p class="text-sm mb-4">All provisions of these Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>
                    <h4 class="font-bold mt-6 mb-2">Indemnification</h4>
                    <p class="text-sm mb-4">You agree to indemnify and hold harmless Musora and its subsidiaires, affiliates and related parties, including respective directors, officers, employees, partners, agents, consultants, licensors, and suppliers (the “Musora Group”), from and against any and all claims, damages, obligations, losses, liabilities, costs, debts, and expenses (including, but not limited to, reasonable legal fees), resulting from or arising out of (i) your use or misuse of the Service or (ii) a breach of these Terms.</p>
                    <h4 class="font-bold mt-6 mb-2">Limitation Of Liability</h4>
                    <p class="text-sm mb-4">ANY MEMBER OF THE MUSORA GROUP SHALL NOT BE LIABLE, WHETHER BASED IN CONTRACT OR TORT (INCLUDING NEGLIGENCE) FOR ANY LOSSES OR DAMAGES, INCLUDING, WITHOUT LIMITATION, DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR PUNITIVE DAMAGES THAT ARISE OR RESULT FROM (I) YOUR ACCESS TO, OR USE OF, OR INABILITY TO ACCESS OR USE, THE SERVICE; (II) ANY CONDUCT OR CONTENT OF ANY THIRD PARTY ON THE SERVICE; (III) ANY CONTENT OBTAINED FROM THE SERVICE; AND (IV) ANY UNAUTHORIZED ACCESS, USE OR ALTERATION OF YOUR TRANSMISSIONS OR CONTENT, REGARDLESS OF THE BASIS UPON WHICH LIABILITY IS CLAIMED OR EVEN IF A MEMBER OF THE MUSORA GROUP HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH LOSS OR DAMAGE.  YOU (AND NOT ANY MEMBER OF THE MUSORA GROUP) ASSUME THE ENTIRE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION IN THE EVENT OF ANY SUCH LOSS OR DAMAGE ARISING.  IF APPLICABLE LAW DOES NOT ALLOW ALL OR ANY PART OF THE ABOVE LIMITATION OF LIABILITY TO APPLY TO YOU, THE LIMITATIONS WILL APPLY TO YOU ONLY TO THE EXTENT PERMITTED BY APPLICABLE LAW.</p>
                    <h4 class="font-bold mt-6 mb-2">Disclaimer</h4>
                    <p class="text-sm mb-4">YOUR USE OF THE SERVICE IS AT YOUR SOLE RISK. THE SERVICE IS PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS, WITHOUT ANY WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON- INFRINGEMENT OF THIRD PARTY RIGHTS.  THE MUSORA GROUP DOES NOT WARRANT THAT (I) THE SERVICE WILL FUNCTION UNINTERRUPTED, ERROR-FREE, SECURE OR AVAILABLE AT ANY PARTICULAR TIME OR LOCATION; (II) ANY ERRORS OR DEFECTS WILL BE CORRECTED; (III) THE SERVICE OR THE SERVERS AND WEBSITES THAT MAKE THE SERVICE AVAILABLE IS FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS; OR (IV) THE USE OR RESULTS OF USING THE SERVICE WILL MEET YOUR REQUIREMENTS.</p>
                    <p class="text-sm mb-4">ALL INFORMATION (INCLUDING, WITHOUT LIMITATION, ADVICE, RECOMMENDATIONS, AND TIPS) ON THE SERVICES ARE INTENDED SOLELY AS A GENERAL EDUCATIONAL AID. MUSORA AND ITS AGENTS ASSUME NO RESPONSIBILITY OR LIABILITY WHATSOEVER FOR ANY CONSEQUENCE RELATING DIRECTLY OR INDIRECTLY TO ANY ACTION OR INACTION YOU TAKE BASED ON THE INFORMATION, SERVICES, ADVICE, RECOMMENDATIONS, TIPS OR MATERIALS ON THE SERVICES.</p>
                    <p class="text-sm mb-4">IF APPLICABLE LAW DOES NOT ALLOW THE EXCLUSION OF SOME OR ALL OF THE ABOVE IMPLIED WARRANTIES TO APPLY TO YOU, THE ABOVE EXCLUSIONS WILL APPLY TO YOU ONLY TO THE EXTENT PERMITTED BY APPLICABLE LAW</p>
                    <h4 class="font-bold mt-6 mb-2">Governing Law</h4>
                    <p class="text-sm mb-4">These Terms shall be governed and construed in accordance with the laws of British Columbia and the laws of Canada applicable therein.</p>
                    <h4 class="font-bold mt-6 mb-2">No Waiver</h4>
                    <p class="text-sm mb-4">Our failure to require or enforce the strict performance by you of any provision of these Terms or the Privacy Policy or failure to exercise any right under them shall not be construed as a waiver or relinquishment of our right to assert or rely upon any such provision or right in that or any other instance</p>
                    <h4 class="font-bold mt-6 mb-2">Integration and Severability</h4>
                    <p class="text-sm mb-4">If any provision of these Terms is held to be unlawful, void, invalid or unenforceable by a court or other applicable entity having jurisdiction, then that provision shall be deemed severable from these Terms and shall not affect the validity or enforceability of all  remaining provisions of these Terms, all of which will remain in full force and effect.   These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have had between us regarding the Service.</p>
                    <h4 class="font-bold mt-6 mb-2">Contact Us</h4>
                    <p class="text-sm mb-4">If you have any questions about these Terms or questions or complaints with respect to the Service, please contact us at https://www.musora.com/contact.</p>
                </div>
            @endslot
        @endcomponent
    @endif
@endsection
