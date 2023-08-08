@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Drumeo PRO</title>
    <meta name="description" content="The easier way to sell drum lessons.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Drumeo PRO">
    <meta property="og:description" content="The easier way to sell drum lessons.">
    <meta property="og:url" content="https://www.drumeo.com/pro/">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/pro.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
@stop()

@section('scripts')
    @parent

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop()

@section('body-data')
    x-data="{ trailer: false, contact: false }"
@endsection

@section('content')
    @if(strpos(url()->full(), 'error'))
        <div class="thank-you-banner error text-center">
            <h3><strong>Oops!</strong></h3>
            <p>Please go back and make sure you check the security CAPTCHA box.<br>
                <a @click="contact = true;" style="color:inherit"><u>Retry &raquo;</u></a></p>
        </div>
    @endif
    @if(strpos(url()->full(), 'sent'))
        <div class="thank-you-banner text-center">
            <h3><strong>Thank you</strong></h3>
            <p>We’ve received your message and will respond as soon as possible!</p>
        </div>
    @endif

    <header class="header text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/header.jpg);">
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/drumeo-pro-logo.png">
            <br>
            <div class="watch-badge">
                <span>LEARN<br> MORE</span>
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png">
            </div>
            <img @click="trailer = true;" class="play-button autoplay-video animated infinite pulse delay-2s slower" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png">
            <h1><strong>The easier way to sell<br class="hide-for-medium">  drum lessons.</strong></h1>
            <h4>We’re partnering with drum teachers and content creators to bring your ideas to life — giving you<br class="show-for-large">
                access to a global audience of drum students who already know and love digital lessons. </h4>
            <a href="https://musora.typeform.com/to/WjlCOG" class="join blue">Apply Now &raquo;</a><br>
            <a @click="contact = true;" class="join blue smaller outline">Contact Us</a>
        </div>
    </header>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '425675984',
        'vimeo' => true,
    ])

    @component('_partials.components.modal',[
        'name' => 'contact',
    ])
        @slot('content')
            <div class="relative overflow-y-visible max-w-3xl px-4 md:px-5 lg:px-7 py-5 md:py-7 lg:py-10 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                <img class="logo h-7 md:h-12 lg:h-14" src="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/drumeo-pro-logo-black.png">
                <p class="my-4 md:my-5 lg:my-6 text-sm md:text-base">If you’re interested in Drumeo Pro but have questions, <br class="show-for-medium">
                    please use the form below to send a detailed message to our team.</p>
                <form id="ajaxForm" class="ajax-form" name="drumeo" method="post" action="/form-mail/drumeo-pro.php">
                    <input type="hidden" name="subject" value="Drumeo Pro Contact"/>
                    <input type="hidden" name="redirect" value="/pro?sent"/>
                    <input class="rounded-full text-center" name="name" type="text" placeholder="Name"/>
                    <input class="rounded-full text-center" name="email" type="email" placeholder="Email Address" required/>
                    <input class="rounded-full text-center" name="phone" type="tel" placeholder="Phone Number"/>
                    <div class="mb-4 text-left py-2 px-4 rounded-xl" style="background:#e3effa;">
                        <p><strong>Select the topic that relates to you:</strong></p>
                        <label for="productReady"><input type="radio" name="topic" id="productReady" value="Product Ready">
                            I have a product ready that I’d like to sell through Drumeo PRO</label>

                        <label for="productIdea"><input type="radio" name="topic" id="productIdea" value="Product Idea">
                            I have a product idea that I’d like to create for Drumeo PRO</label>

                        <label for="general"><input type="radio" name="topic" id="general" value="General Question">
                            I’m interested in Drumeo PRO but have some questions</label>

                        <label for="other"><input type="radio" name="topic" id="other" value="Other">
                            Other</label>
                    </div>
                    <textarea class="rounded-full text-center mb-4" name="message" placeholder="How can we help you?" rows="3"></textarea>
                    <div class="g-recaptcha" data-sitekey="6LcBSxYUAAAAANEVgiFM3kmHOjzbcrkspWBtQd9n"></div>
                    <button class="button join blue w-full h-12 justify-center items-center" type="submit" style="display: flex;">
                        <span class="pre-add"><i class="fad fa-paper-plane"></i> Send</span>
                        <span class="pending hide"><i class="fad fa-spinner-third fa-spin"></i> Sending</span>
                        <span class="success hide"><i class="fad fa-thumbs-up"></i> Sent</span>
                        <span class="fail hide"><i class="fad fa-exclamation-triangle"></i> Oops</span>
                    </button>
                </form>
                @include('drumeo.lead-gen.partials.thank-you-box', [
                    "headline" => "SENT",
                    "body" => "We’ve received your message and will respond as soon as possible!",
                    "noSocial" => true
                ])
            </div>
        @endslot
    @endcomponent


    <section class="better-way" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/just-teach-background.jpg);">
        <div class="row">
            <div class="columns large-6 medium-8">
                <h2><strong>Create.</strong></h2>
                <h3 class="text-yellow"><em>(We’ll take care of the rest.)</em></h3>
                <p>You love playing drums and teaching students. But when it comes to creating video drum lessons, everything after that becomes so complicated. Video hosting, content management, sales pages, order forms, marketing, customer support… it adds up.
                    <br><br>
                    And even when you finally figure it out — you end up spending too much time editing your website, troubleshooting video glitches, or sorting through login issues and payment problems. Unless it’s your full-time job, it’s just not worth it. And many teachers end up putting their hands in the air and giving up.
                    <br><br>
                    <strong>But there’s a better way.</strong>
                    <br><br>
                    At Drumeo, we’ve been creating online drum lessons since 2003 (long before we were ever known as Drumeo). We’ve built the technology, systems, and staffing infrastructure that can support content creators to… well, create!
                    <br><br>
                    And we’ll take care of the rest.</p>
            </div>
        </div>
    </section>

    <section class="reach-everywhere text-center">
        <div class="row">
            <h2><strong>Reach Drummers<br class="hide-for-medium"> Everywhere.</strong></h2>
            <h3 class="text-yellow"><em>Drumeo + You. A match made in heaven.</em></h3>
            <div class="clearfix">
                <div class="columns no-padding small-6 medium-12">
                    <div class="columns no-padding medium-4">
                        <div class="social-platform youtube">
                            <a href="https://www.youtube.com/freedrumlessons/" target="_blank"> <i class="fab fa-youtube"></i>
                            </a>
                            <h1 class="count" id="youtube-count">2.34M</h1>
                            <p>Subs<span class="show-for-medium">cribers</span></p>
                        </div>
                    </div>
                    <div class="columns no-padding medium-4">
                        <div class="social-platform facebook">
                            <a href="https://facebook.com/drumeo/" target="_blank"> <i class="fab fa-facebook-f"></i> </a>
                            <h1 class="count" id="likes-count">1.17M</h1>
                            <p>Likes</p>
                        </div>
                    </div>
                    <div class="columns no-padding medium-4">
                        <div class="social-platform instagram">
                            <a href="https://instagram.com/drumeoofficial/" target="_blank"> <i class="fab fa-instagram"></i>
                            </a>
                            <h1 class="count" id="follower-count">914K</h1>
                            <p>Followers</p>
                        </div>
                    </div>
                </div>
                <div class="columns no-padding small-6 medium-12">
                    <div class="columns no-padding medium-4">
                        <div class="social-platform image-badge">
                            <img src="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/modern-drummer.png">
                            <p>Best Educational<br> Drum Product</p>
                        </div>
                    </div>
                    <div class="columns no-padding medium-4">
                        <div class="social-platform image-badge">
                            <img src="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/shopper-approved.png">
                            <p>Rated 5-Stars For Price,<br>
                                Satisfaction & Service</p>
                        </div>
                    </div>
                    <div class="columns no-padding medium-4">
                        <div class="social-platform image-badge">
                            <img src="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/drummies.png">
                            <p>Best Educational<br>
                                Drum Website</p>
                        </div>
                    </div>
                </div>
            </div>
            <h4>By partnering with us, you’ll gain access to our award-winning<br class="show-for-medium">
                platform and flourishing student communities.</h4>
        </div>
    </section>

    <section class="platform-wrap text-center">
        <div class="row">
            <h2><strong>Bring your products<br class="hide-for-medium"> to life.</strong></h2>

            <div class="device-spread">
                <div class="text-arrow desktop">
                    <span>Create<br> your<br> lessons.</span><br>
                    <img class="arrow" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-right-blue.png">
                </div>
                <div class="text-arrow macbook">
                    <span>Sell<br> your<br> product.</span><br>
                    <img class="arrow" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-right-alt-blue.png">
                </div>
                <div class="text-arrow ipad">
                    <span>Reach<br> more<br> students.</span><br>
                    <img class="arrow vertical" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-down-blue.png">
                </div>
                <div class="text-arrow iphone">
                    <span>Available<br> everywhere.</span><br>
                    <img class="arrow" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-blue.png">
                </div>
                <img class="spread" src="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/spread.png">
            </div>
            <h4>We’re looking for content creators who are highly qualified, capable of creating organized<br class="show-for-large">
                content, and able to solve student problems effectively through video lessons and exercises.
                <br><br>
                <em class="text-blue">Your application must be approved<br class="hide-for-medium"> to be eligible for Drumeo PRO.</em></h4>
        </div>
    </section>

    <section class="three-steps text-center">
        <div class="row">
            <div class="columns medium-4">
                <div class="icon-step text-yellow">
                    <h2 class="animated infinite pulse"><strong>1</strong></h2>
                    <i class="fa-light fa-camera-movie"></i>
                </div>
                <h2><strong>Create</strong></h2>
                <p>You’re the teacher & product creator. Simply organize, film, and edit your video lessons. If you’ve already created a drum lessons course or have an idea that you’d love to create, then we’re looking to partner!</p>
            </div>
            <div class="columns medium-4">
                <div class="icon-step text-yellow">
                    <h2 class="animated infinite pulse delay-1s"><strong>2</strong></h2>
                    <i class="fa-light fa-rocket-launch"></i>
                </div>
                <h2><strong>Launch</strong></h2>
                <p>We’ll host your videos, manage the content, create the sales page, handle payments, and respond to student questions. Your product will be added to the Drumeo Drum Shop — giving you access to our audience of drummers and students around the world.</p>
            </div>
            <div class="columns medium-4">
                <div class="icon-step text-yellow">
                    <h2 class="animated infinite pulse delay-2s"><strong>3</strong></h2>
                    <i class="fa-light fa-hand-holding-usd"></i>
                </div>
                <h2><strong>Earn</strong></h2>
                <p>There are two revenue-sharing options: you’ll get 90% of product sales when allowing free access to Drumeo members, or you’ll get 70% of product sales when hosting your product exclusively as a training pack.</p>
            </div>
        </div>
    </section>

    <section class="final" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/order-background.jpg);">
        <div id="customize-anchor" class="anchor"></div>
        <div class="row">
            <div class="columns logo"><img src="https://dpwjbsxqtam5n.cloudfront.net/drumeo-pro/drumeo-pro-logo.png"></div>
            <h2 class="columns"><strong>Interested? The first step is one click away...</strong></h2>
            <a href="https://musora.typeform.com/to/WjlCOG" class="join blue">Apply Now &raquo;</a><br>
            <a @click="contact = true;" class="join blue smaller outline">Contact Us</a>
            <div class="columns questions">
                <p><strong>Any questions?</strong><br class="hide-for-medium"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="hide-for-medium"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>. </p>
            </div>
        </div>
    </section>
@stop
