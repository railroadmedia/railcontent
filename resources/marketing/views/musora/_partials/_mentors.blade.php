<style>
    .flip-div .back,
    .flip-div .back {
        -ms-transform: rotateY(-180deg)!important;
        -webkit-transform: rotateY(-180deg)!important;
        transform: rotateY(-180deg)!important;
    }
    .flip-div .front,
    .flip-div .back {
        -ms-transition: transform 0.8s!important;
        -webkit-transition: transform 0.8s!important;
        transition: transform 0.8s!important;
        -ms-backface-visibility: hidden!important;
        -webkit-backface-visibility: hidden!important;
        backface-visibility: hidden!important;
    }
    .flip-div.flipped .front,
    .flip-div.flipped .front {
        -ms-transform: rotateY(180deg)!important;
        -webkit-transform: rotateY(180deg)!important;
        transform: rotateY(180deg)!important;
    }
    .flip-div.flipped .back,
    .flip-div.flipped .back {
        -ms-transform: rotateY(0deg)!important;
        -webkit-transform: rotateY(0deg)!important;
        transform: rotateY(0deg)!important;
    }
</style>
<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f9f9fb;">
    <div class="container max-w-4xl mx-auto">
        <img class="h-16 sm:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=720,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/musora_mentors_logo.png">
        <p class="mt-1 tracking-wider"><strong>MUSICIANS HELPING MUSICIANS</strong></p>
        <p class="max-w-2xl my-5 mx-auto">Our music lesson communities have always valued relationships before technology.
            <br><br>
            So we're doubling down on the personal touch with Musora Mentors – where you’ll get direct access to a Mentor that aligns with your musical experience and goals.</p>
        <div class="flex flex-wrap items-center">
            <div class="w-1/2 flex-grow md:order-1 mb-5 sm:mb-0"><img src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/features.png"></div>
            <div class="w-full sm:w-5/12 text-left py-7 px-6 sm:px-9 sm:mr-5 rounded-xl bg-white border border-gray-300">
                <p><strong>You’ll get personal guidance for a better music lessons experience, including:</strong></p>
                <ul class="fa-ul mt-2 ml-6">
                    <li class="mb-1.5"><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Finding the right lesson</li>
                    <li class="mb-1.5"><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Troubleshooting the tech</li>
                    <li class="mb-1.5"><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Choosing songs to play next</li>
                    <li class="mb-1.5"><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Answering music-related questions</li>
                    <li><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Or… whatever else gets in the way.</li>
                </ul>
            </div>
        </div>
        <p class="my-8 sm:my-10">Mentors understand the musical journey you’re on personally. We’ll be choosing a <br class="hidden md:inline-block">
            Mentor that suits you best soon – and they’ll be in touch to introduce themselves.</p>

        <div style="font-size: 0;">
            @php
                $bonuses = [
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/jenn.jpg',
                    'first' => 'Jenn ',
                    'last' => 'vO',
                    'drumeo' => true,
                    'pianote' => true,
                    'description' => 'Jenn vO grew up in a musical family with piano playing in the background and songs sung around the dinner table. She took piano, trumpet, and guitar lessons, and sang in a concert choir for 8 years! When she’s not working, she adores hanging out with her husband and kids and cooking good food for friends. ',
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/hannah2.jpg',
                    'first' => 'Hannah ',
                    'last' => 'D',
                    'pianote' => true,
                    'guitareo' => true,
                    'description' => 'Hannah is a lifelong music lover who dabbles in piano, singing, guitar, and occasionally ukulele! She loves to see students realize the joy music can bring to their lives. In her free time, she loves finding new music to listen to, spending time with her partner and two devious cats, and pursuing various other artistic interests.',
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/jorge.jpg',
                    'first' => 'Jorge ',
                    'last' => 'B',
                    'drumeo' => true,
                    'pianote' => true,
                    'description' => 'Jorge always dreamed of becoming a musician. At 16, he discovered Drumeo and began to learn the drums, even though he didn’t have a drum kit, practicing by air drumming and memorizing patterns. Jorge lives in Madrid, where he works with local artists as a session drummer. He is also a drum teacher, music producer, and soon-to-be audio engineer.',
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/joy2.jpg',
                    'first' => 'Joy ',
                    'last' => 'B',
                    'drumeo' => true,
                    'pianote' => true,
                    'description' => 'Joy is passionate about everything music and loves helping people find their unique rhythm and style.  She plays drums, dabbles at the piano, and is learning bass. Sax was her first instrument, but the drums are what feed her soul. Joy has been a die-hard Raptors fan since Day 1, screaming her coaching advice at the TV! ',
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/carlos.jpg',
                    'first' => 'Carlos ',
                    'last' => 'B',
                    'drumeo' => true,
                    'guitareo' => true,
                    'description' => 'Carlos began classical guitar studies through a conservatory in Venezuela. At 11, he learned to hold the drumsticks and play his first beat using Drumeo! Aside from spending time with friends and family, personal training, and traveling, Carlos will soon release his debut album: Inner Child, featuring drummer Matt Garstka. ',
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/emily.jpg',
                    'first' => 'Emily ',
                    'last' => 'J',
                    'pianote' => true,
                    'singeo' => true,
                    'description' => 'Emily’s #1 passion in life is music! She’s toured across six countries with her all-female rock’n’roll band and has released three albums, with a fourth on the way! While her primary focus has always been songwriting, singing, and playing the guitar, she also has a passion for the drums, bass, ukulele & piano!',
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/kates.jpg',
                    'first' => 'Kates ',
                    'last' => 'E',
                    'drumeo' => true,
                    'pianote' => true,
                    'description' => "Kates is a self-taught musician with a lifelong passion for music. She studied at Berklee College of Music and has collaborated with music management companies. Kates currently collaborates with other artists, showcasing her songwriting skills and adding harmonies to her repertoire. With influences from soulful R&B, intimate folk, and heartfelt country, Kates explores new sonic horizons and leaves her mark on the music world with her radiant spirit and unwavering love for her craft.",
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/ale.jpg',
                    'first' => 'Ale ',
                    'last' => 'S',
                    'drumeo' => true,
                    'pianote' => true,
                    'description' => "Ale has been playing the drums for almost 25 years now! He's been fortunate enough to travel, tour and jam with some big names in the music biz. Right now, he's rockin' out with two international bands that keep him busy on the road. On top of all that, Ale has a degree in sound engineering, music, and video production. He just loves music, and nothing makes him happier than helping others find their own groove.",
                    ],
                    [
                    'image' => 'https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/jessica.jpg',
                    'first' => 'Jessica ',
                    'last' => 'C',
                    'drumeo' => true,
                    'pianote' => true,
                    'description' => "Jessica is extremely passionate about music having grown up in a household of professional musicians! She is a trained vocalist with experience playing piano, and she absolutely loves performing songs from musicals. In her free time, Jessica doubles as a Film & TV actor,  so you just might see her pop up on your TV screen one of these days!",
                    ],
                ]
            @endphp
            @foreach($bonuses as $bonus)
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-3 sm:px-1.5 w-full sm:w-1/3" style="max-width:250px;">
                    <div class="flip-div inline-block relative w-full group" style="padding-bottom: 120%; perspective: 1000px;" onclick="this.classList.toggle('flipped')">
                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                            <div class="shadow-sm front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                <div class="pb-3 flex flex-wrap content-end justify-center absolute z-30 text-center inset-0 text-white visible text-shadow-2" style="background:linear-gradient(to bottom, transparent 70%, black);">
                                    <h4 class="w-full uppercase font-bebas leading-normal mx-auto"><strong>{!! $bonus['first'] !!}</strong> {!! $bonus['last'] !!}</h4>
                                    <img class="inline-block h-3 mr-1.5 @if(empty($bonus['drumeo'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
                                    <img class="inline-block h-3 mr-1.5 @if(empty($bonus['pianote'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png">
                                    <img class="inline-block h-3 mr-1.5 @if(empty($bonus['guitareo'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png">
                                    <img class="inline-block h-3 @if(empty($bonus['singeo'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png">
                                </div>
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }})"></div>
                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                    <i class="fas fa-repeat text-4xl"></i><br>
                                    <p class="text-sm"><strong>LEARN MORE</strong></p>
                                </div>
                            </div>
                            <div class="shadow-sm back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                    <p class="leading-normal mx-auto text-xs lg:text-sm">{!! $bonus['description'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
