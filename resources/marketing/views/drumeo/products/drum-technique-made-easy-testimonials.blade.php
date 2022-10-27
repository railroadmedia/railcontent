@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Drum Technique Made Easy | Drumeo</title>
    <meta name="description" content="Drum Technique Made Easy is a 26-week online course with Bruce Becker.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/og-image.jpg" style="display: none;">
    <meta property="og:description" content="Drum Technique Made Easy is a 26-week online course with Bruce Becker.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/drum-technique-made-easy/">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-dtme.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('drum-technique-made-easy'); ?>
@stop()

@section('scripts')
    @parent
    <script src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //sub nav sticky function
            var navigation = $(".topic-link-wrap");
            var navigationLinks = $(".topic-link");

            $(window).scroll(function () {
                var header = $(".topic-link-wrap-shim").offset().top;
                var better = $('#better').offset().top - 50;
                var habits = $('#habits').offset().top - 150;
                var injuries = $('#injuries').offset().top - 150;
                var bandmates = $('#bandmates').offset().top - 150;
                var order = $('.final').offset().top - 150;

                if ($(this).scrollTop() > (header - 50)) {
                    navigation.addClass('stick-to-top');
                    navigationLinks.removeClass('active');
                    $(".topic-link.features").addClass('active');
                } else {
                    navigationLinks.removeClass('active');
                    navigation.removeClass('stick-to-top');
                }

                if ($(this).scrollTop() > better && $(this).scrollTop() < habits) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.better").addClass('active');
                }

                if ($(this).scrollTop() > habits && $(this).scrollTop() < injuries) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.habits").addClass('active');
                }

                if ($(this).scrollTop() > injuries && $(this).scrollTop() < bandmates) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.injuries").addClass('active');
                }

                if ($(this).scrollTop() > bandmates && $(this).scrollTop() < order) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.bandmates").addClass('active');
                }

                if ($(this).scrollTop() > order) {
                    navigationLinks.removeClass('active');
                    navigation.removeClass('stick-to-top');
                }
            });

        });
    </script>
@stop()

@section('content')
    <header class="header">
        <div class="row"></div>
    </header>

    <div class="gray-bg">
        <section class="topic-linker">
            <div class="row">
                <div class="columns">
                    <p><em>What real students are saying about...</em></p>
                    <img src="{{ cdn('drum-technique-made-easy/logo-black.png') }}">
                </div>
                <div class="columns topic-link-wrap-shim show-for-medium"></div>
                <div class="columns topic-link-wrap">
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link better" href="#better">Better<br class="show-for-medium hide-for-large"> Drumming</a>
                    </div>
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link habits" href="#habits">Fix Bad<br class="show-for-medium hide-for-large"> Habits</a>
                    </div>
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link injuries" href="#injuries">Avoid<br class="show-for-medium hide-for-large"> Injuries</a>
                    </div>
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link bandmates" href="#bandmates">Bandmates<br class="show-for-medium hide-for-large"> Love You</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial-section">
            <div id="better" class="anchor"></div>
            <div class="row">
                <h1>The Missing Link <br class="hide-for-medium"> For Better Drumming</h1>
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/DavidSeipp.jpg",
                "testimonialHighlight" => "The speed started to come naturally.",
                "fullTestimonial" => "Before DTME, I felt like maybe I didn’t have what it takes to be a drummer. I felt like I wasn’t able to keep my accents and patterns consistent when picking up speed. With this course, learning where to put the down-taps or up-taps made it easier to master patterns, and I found the speed started to come naturally.<br><br> I realized I was improving when playing with friends, and I was able to do what I wanted without it all falling apart. This is a game changer.",
                "name" => "David Seipp",
                "location" => "Illinois, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/ElizaGagnon.jpg",
                "testimonialHighlight" => "It gave me a new fluency and fluidity for playing grooves!",
                "fullTestimonial" => "I was a beginner and had very little technique at all, so everything was new. Bruce broke things down very clearly and all of the exercises progressed logically and smoothly -- and they weren’t boring to practice!<br><br> Drum Technique Made Easy helped me get in the habit of having the sticks in my hands every day and to be satisfied with slow and steady progress. It gave me a new fluency and fluidity for playing grooves. My partner actually noticed it before I did and commented on how much better my playing sounded.",
                "name" => "Eliza Gagnon",
                "location" => "Massachusetts, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/AlvaroRuben2.jpg",
                "testimonialHighlight" => "I struggled with hand speed and finger control, but I’m in control now!",
                "fullTestimonial" => "The biggest thing that makes Drum Technique Made Easy different is the HUGE quality of the instructor and his patience and calm method to teach step-by-step. I struggled with hand speed and finger control - but I’m in control now! I feel like I can beat any drum challenge I have in front of me if I take my time to break it down, solve it, and practice it. Take this course. You won’t regret it.",
                "name" => "Alvaro Ruben",
                "location" => "Valencia, Venezuela"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/BlakeBrueggeman.jpg",
                "testimonialHighlight" => "Trying to fill missing holes in my drumming has been my biggest nemesis.",
                "fullTestimonial" => "Since I hadn't had any formal lessons when I began playing drums 40 years ago, I was underdeveloped in MANY areas and had overdeveloped many bad habits.   Trying to fill in all these &quot;missing holes&quot; has been my biggest nemesis.<br><br> But improving my technique has helped me fill those holes. Bruce was there to answer questions I would NEVER ask with people around. His patience and understanding were priceless and he explained things in a way that made sense to me.<br><br> I’d encourage other students to try it out. If you only learn ONE thing and learn it well, it will open the door in your mind to how many OTHER things you could learn, but may not even know it, yet.",
                "name" => "Blake Brueggeman",
                "location" => "Colorado, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/WilliamHoyt.jpg",
                "testimonialHighlight" => "The drum set has become much more fun!",
                "fullTestimonial" => "It’s just amazing to feel the difference in playing things that were difficult before Drum Technique Made Easy. It almost seemed to sneak up on me from nowhere. Bruce is such a brilliant musician and teacher. It was a pleasure to get new great lessons every week that were explained so well.<br><br> The drum set has become much more fun, with ease and fluidity naturally coming through my motions. Take the course! If you stick with it, it will forever change your playing for the better!",
                "name" => "C. William Hoyt",
                "location" => "New Hampshire, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/DrewSmith.jpg",
                "testimonialHighlight" => "One of the most effective uses of my time, ever.",
                "fullTestimonial" => "Bruce Becker helped me focus on the proper movements and mechanics of drumming, rather than the result of those movements -- and the benefits of feeling and sounding better revealed themselves as the skills improved. The exercises in the very first week showed me that I was on the right track. Flow and awareness were at an all-time high.<br><br> Taking DTME has enabled me to play with even more feeling and groove, and the course has also helped me identify what movements may be incorporated into my playing in order to facilitate learning new stickings, grooves, and fills. This course remains as one of the most important and effective uses of my time ever.",
                "name" => "Drew Smith",
                "location" => "Virginia, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/KenTucker.jpg",
                "testimonialHighlight" => "Bruce is the guy when it comes to technique.",
                "fullTestimonial" => "Bruce presented subtleties that made me realize that there are so many layers to improving and understanding. He has built a structured technical system that works. For example, he put together some of George Lawrence Stone’s sticking exercises in a creative way, which then allowed me to think &quot;hey, I can create my own patterns as long as they fit into time&quot;.<br><br> In my mind, Bruce is the guy when it comes to technique...and if you look at any drummers who have made it, they are all working on similar things and many of them have stopped by Bruce's academy. Two words: &quot;I'm inspired&quot;. For anyone thinking about taking this course, do it...and do it sooner than later, because it will change your approach to drumming and music.",
                "name" => "Ken Tucker",
                "location" => "British Columbia, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/DanielBarrett.jpg",
                "testimonialHighlight" => "I became more efficient and purposeful with my movements.",
                "fullTestimonial" => "During the class, as I followed the instruction from Bruce, I felt more confident in my playing and I gained the tools to become more efficient and purposeful with my movements. I enjoyed the feedback from Bruce so I could address concerns during the same week, and I enjoyed his motivating tips that keep me pushing even when I’m frustrated.",
                "name" => "Daniel Barrett",
                "location" => "Michigan, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/BarryTrickett.jpg",
                "testimonialHighlight" => "There was always something that didn’t feel right.",
                "fullTestimonial" => "While I have studied for many years, there was always something that didn't feel right. This course was the missing link. Now all the dots are joined up and it was money well spent. Since the lessons are accessible after DTME, I can go back to the course pack forever. My drumming has become more musical, my playing has improved, and my technique has become more refined.",
                "name" => "Barry Trickett",
                "location" => "Bournemouth, United Kingdom"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/RicardoCarranza.jpg",
                "testimonialHighlight" => "After the first week, I started to notice changes in my playing.",
                "fullTestimonial" => "I can’t believe it - I was able to see results right away. Bruce is an incredible teacher. The information, explanations, exercises, and tasks are all so clear and useful. After the first week, I started to notice changes in my playing. My sound on the hi-hats was more musical and relaxed. The course has changed the way I practice and study. It is worth every penny. Definitely one of the best investments that you can make for your journey to become a better drummer.",
                "name" => "Ricardo Carranza",
                "location" => "Mexico City, Mexico"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/OscarOlivares.jpg",
                "testimonialHighlight" => "I struggled with speed and precision.",
                "fullTestimonial" => "Before the course, I couldn’t understand how to gain speed and precision in my technique routines. It was very discouraging. The way Bruce explained himself, the choice of camera angles to show us the motions and the precise order of the lessons were the key for me.<br><br> No matter what your playing level is, this course will help you improve!",
                "name" => "Oscar Olivares",
                "location" => "Spain"
                ])
            </div>
        </section>

        @include('drumeo.lead-gen.partials._testimonial-pitch', [
            "descriptiveText" => "Drum Technique Made Easy is a 26-week online course with Bruce Becker.",
            "detailsLink" => "/drumshop/drum-technique-made-easy",
        ])

        <section class="testimonial-section">
            <div id="habits" class="anchor"></div>
            <div class="row">
                <h1>Fix Your Bad <br class="hide-for-medium">Habits (Finally!)</h1>
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/ZoltanWagner.jpg",
                "testimonialHighlight" => "I’m getting over technique problems that I hadn’t solved in 10+ years!",
                "fullTestimonial" => "The way Bruce explains there is NO WAY that someone would not understand what he is talking about! It was detailed, comprehensive and crystal clear (If it ever wasn’t, he made it clear via the private message feature).<br><br> Before this course, I had a notion that great technique is the privilege of the drumming greats. But Bruce helped me uncover the biggest flaw in my technique -- and I realized that it is achievable for me to get solid hand technique, and it gave me a plan to get there. I’m getting over technique problems that I didn’t manage to solve in the past 10-15 years! I would recommend it as a must for everyone, especially for beginners as it demystifies technique in a good way!",
                "name" => "Zoltan Wagner",
                "location" => "Budapest, Hungary"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/PaulSquires.jpg",
                "testimonialHighlight" => "I was trying to take shortcuts, but they weren’t working.",
                "fullTestimonial" => "This is my technique bible. I took up the drums again at 56 years old and for the past six years I was trying to take shortcuts, but they weren’t working. This course basically taught me drum technique from scratch. It has helped immensely and now I’m much more relaxed while drumming, more confident in my abilities, and my band is playing more gigs while growing our following!",
                "name" => "Paul Squires",
                "location" => "London, United Kingdom"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/NormHawkins.jpg",
                "testimonialHighlight" => "I was not improving fast enough...",
                "fullTestimonial" => "This course will make your drumming smoother, faster, safer, and much more enjoyable. I spent a lot of time trying to learn technique, but I didn't understand the motions and I was not improving fast enough. I gained a tremendous amount of knowledge from Bruce and am much more confident with my drumming now. Best damn money I ever spent. Thanks, Bruce!",
                "name" => "Norm Hawkins",
                "location" => "Ontario, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/WesleyOkada.jpg",
                "testimonialHighlight" => "I had basically given up on push-pull technique.",
                "fullTestimonial" => "I had basically given up on push-pull technique. I wasn’t sure how to perform it and didn’t think I was doing it right. Bruce went through every detail and clearly demonstrated how to perform the technique -- and I did it! If you want to learn new techniques and make sure you’re doing things right, then take Drum Technique Made Easy.",
                "name" => "Wesley Okada",
                "location" => "California, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/RyanPierson.jpg",
                "testimonialHighlight" => "Bruce is passionate about helping others.",
                "fullTestimonial" => "I still recall Bruce's cadence: &quot;bounce tap AAAAUUUPP!&quot; Makes me smile every time. I try to find new ways to make up my own cadence to beats. It really helps me get the beat down, especially when I'm not at the kit. If you're serious about drumming, this course is worth it. I still go back through the lessons to practice the techniques. Bruce is an excellent teacher that is easy to follow along and is passionate about helping others.",
                "name" => "Ryan Pierson",
                "location" => "Oregon, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/KenBrashear.jpg",
                "testimonialHighlight" => "I broke through a 5-year impasse!",
                "fullTestimonial" => "As a self-taught drummer, I was struggling for years to achieve the speed and precision I wanted on the drums. Bruce helped me modify my finger positioning and hand technique -- it felt like I’d broke through a 5-year impasse! Regardless of your skill level, if you have issues playing what you want to play and getting that onto the kit, this course is for you!",
                "name" => "Ken Brashear",
                "location" => "North Carolina, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/JeremyDilger.jpg",
                "testimonialHighlight" => "It breaks everything down to basics.",
                "fullTestimonial" => "As an early player, it’s easy to form bad habits with technique and the only way to overcome these is breaking everything back down to basics, to focus on form. DTME does exactly that and in a step by step, week by week fashion which helps you stay focused, on track and seeing real results.",
                "name" => "Jeremy Dilger",
                "location" => "Brisbane, Australia"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/GordonFolka.jpg",
                "testimonialHighlight" => "I fixed some serious bad habits and improved my drumming tenfold!",
                "fullTestimonial" => "Bruce’s ability to demonstrate proper drum technique is second to none. He was patient and did not miss any crucial steps in the entire process. By following his lessons each week, I was able to improve my drumming tenfold! I had developed some serious bad habits - like jerky arm movements - but thanks to Bruce I feel more fluid and free.<br><br> I now realize there isn't anything I can't accomplish. Just having someone show me the way has opened up new paths and a real enjoyment on the journey. If you want to grow as a drummer (or anything for that matter), develop good habits. Drum Technique Made Easy is just that: it's easy, necessary, and you will be glad you signed on!",
                "name" => "Gordon Folka",
                "location" => "British Columbia, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/HarryHopkins.jpg",
                "testimonialHighlight" => "Playing paradiddles have never been the same for me since!",
                "fullTestimonial" => "Bruce presented to us step by step exercises and visuals to model, which all began to fit together.  His demonstration of the upstroke and downstroke was invaluable - and playing paradiddles have never been the same for me since! If you are serious about becoming the best drummer you can be no matter what your level...this program is imperative.",
                "name" => "Harry Hopkins III",
                "location" => "Pennsylvania, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/TitoMartinez.jpg",
                "testimonialHighlight" => "This is the best explanation of technique I’ve seen in my 40+ years of drumming.",
                "fullTestimonial" => "My drumming speed and fluidity was hitting a wall and I just couldn’t break through. Drum Technique Made Easy gave me the tools to start working out my problems and develop those skills. I’m still not exactly where I’d like to be, but my technique has improved significantly and I have a pathway to get there through application and practice. This is the best explanation of technique I’ve seen in my 40+ years of drumming. I highly recommend it.",
                "name" => "Tito Martinez",
                "location" => "Arizona, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/JasonSullivan.jpg",
                "testimonialHighlight" => "My playing was very plain and almost unnatural.",
                "fullTestimonial" => "My drumming didn't have a good flow to it. My playing was very plain and almost unnatural. Bruce Becker helped me become much more comfortable with my playing as a drummer not like a robot. To me, this is the nuts and bolts of the drumming machine and I go back to this course whenever I’m not feeling what I’m trying to play. This course added a lot of color to my drumming!",
                "name" => "Jason Sullivan",
                "location" => "Maine, USA"
                ])
            </div>
        </section>

        @include('drumeo.lead-gen.partials._testimonial-pitch', [
            "descriptiveText" => "Drum Technique Made Easy is a 26-week online course with Bruce Becker.",
            "detailsLink" => "/drumshop/drum-technique-made-easy",
        ])

        <section class="testimonial-section">
            <div id="injuries" class="anchor"></div>
            <div class="row">
                <h1>Avoid Injuries & <br class="hide-for-medium">Play Drums Longer</h1>
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/DeePotter.jpg",
                "testimonialHighlight" => "My right hand used to fall asleep during songs.",
                "fullTestimonial" => "After many years of performing and recording, I developed a weird issue where my right hand would fall asleep during high tempo songs. It often made me anxious before a gig because I knew there’d be parts of the show where I’d need to make adjustments and compromise my sticking technique to give my right hand a break.<br><br> Bruce Becker re-introduced me to the “anatomy of a stroke” and helped me reset my grip for fluidity of movement after so many years of “bashing through the pain”. By lesson two, I realized my hand hadn’t gone to sleep at all since I started the exercises. My movements had become fluid again and I was no longer “hitting” the drums like they’re an opponent, but rather playing them in harmony with the sticks.",
                "name" => "Dee Potter",
                "location" => "Ontario, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/Henk-JanWormgoor.jpg",
                "testimonialHighlight" => "I want to play until I’m 85 and older.",
                "fullTestimonial" => "Due to injuries, I was coming close to a final stop in my drumming. I had to find a way to relax my playing and get new techniques because I want to play until I’m 85 and older. Drum Technique Made Easy was an investment for my drumming life: a world-class instructor with 26-weeks of detailed instruction. If you are young, you can grow to new heights you never imagined -- and if you are 50+ you can extend your drumming career or hobby. Thanks and compliments to Drumeo for the great and inspiring drum lessons.",
                "name" => "Henk-Jan Wormgoor",
                "location" => "Netherlands"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/ScottGeorge.jpg",
                "testimonialHighlight" => "I was constantly injuring my wrists...",
                "fullTestimonial" => "Until Bruce came along, I was constantly injuring my wrists. Drum Technique Made Easy gave me a way to play the drums so it was easy to do accents and keep time without hurting myself. I started to feel like I was playing the drums, not that they were playing me.<br><br> I am actually going through this course again and getting more out of it the second time through. I am no longer in search of the silver bullet - I have found it. No more countless hours scouring the internet in search of proper technique.",
                "name" => "Scott George",
                "location" => "California, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/NeilMacDonald.jpg",
                "testimonialHighlight" => "I don’t experience cramps or blisters anymore.",
                "fullTestimonial" => "The course was a genuinely life-changing experience. I'm far more relaxed, I don't experience cramps or blisters anymore, I have greater stamina, my touch continues to improve, and my approach to drumming is completely different.<br><br> As a self-taught drummer, it was a brilliant back-to-basics journey. I re-learned how to hold the sticks, wrist action, finger technique...everything I lacked!",
                "name" => "Neil MacDonald",
                "location" => "Hamilton, United Kingdom"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/TimSimpson.jpg",
                "testimonialHighlight" => "My wrist wasn’t hurting anymore.",
                "fullTestimonial" => "Before DTME, I was actually hurting my right wrist with the technique I was using. By the end of the 2nd week of the course, my wrist wasn't hurting anymore and each stroke felt more natural. Life is now more productive and that makes me really happy. Give yourself the gift of drumming more efficiently through time tested technique instructions. You will be using less energy to play while avoiding injury.",
                "name" => "Tim Simpson",
                "location" => "Utah, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/LarryRice.jpg",
                "testimonialHighlight" => "I would have thoughts like “maybe I’m too old?”.",
                "fullTestimonial" => "I used to get frustrated about my drumming. I would have thoughts like “maybe I’m too old”, or “maybe there’s a secret technique that I don’t know about”. But while going through DTME, I was tracking my practice and could see the improvement. Bruce is very direct in his instruction. There are so many ways this course can help you improve your drumming experience. Jump in!",
                "name" => "Larry Rice",
                "location" => "California, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/JeffTendam.jpg",
                "testimonialHighlight" => "I was able to increase my speed without increasing my effort.",
                "fullTestimonial" => "I’m a beginner drummer, so all of the techniques are a bit frustrating. Probably my biggest frustration was with some of the explanations available online - many of them just didn’t explain or demonstrate techniques very well. Bruce is excellent at explaining things in an understandable way and has the patience to answer questions no matter how simplistic they may be.  He realizes not everyone is at the same level, but treats everyone with respect, without making them feel like they have no talent.<br><br> I don't plan on being the next Neil Peart or Cozy Powell, but I am enjoying learning new grooves and don't mind putting in the practice now that my arms don't get as tired and I don't have as much problem with tendinitis in my elbows. There is not one single moment that really sticks out in my mind as THE pivotal moment where it all started to click. Things just started to become easier and I was able to increase my speed, without feeling like I was increasing my effort.",
                "name" => "Jeff Tendam",
                "location" => "Ohio, USA"
                ])
            </div>
        </section>

        @include('drumeo.lead-gen.partials._testimonial-pitch', [
            "descriptiveText" => "Drum Technique Made Easy is a 26-week online course with Bruce Becker.",
            "detailsLink" => "/drumshop/drum-technique-made-easy",
        ])

        <section class="testimonial-section">
            <div id="bandmates" class="anchor"></div>
            <div class="row">
                <h1>Your Bandmates <br class="hide-for-medium">Will Thank You! </h1>
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/AlanShaffer.jpg",
                "testimonialHighlight" => "You’ll see years of improvement in just a few months.",
                "fullTestimonial" => "After a few weeks developing a good foundation, Bruce went over the concept that had been my biggest frustration: how the rudiments worked on the drum set. I had always been told &quot;this is how it's done&quot;, but no one showed how easy it should be. Counting out and “saying” what I was playing really helped, and I will use this trick forever.<br><br> The way the course is laid out, I can go right to my PDF printouts to find what I need to practice. If you put in the time and follow Bruce’s instruction, your drumming will show years of improvement in just a few short months. Your bandmates will notice the difference and thank you!",
                "name" => "Alan Shaffer",
                "location" => "Texas, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/OwenBrown.jpg",
                "testimonialHighlight" => "It felt so good to have the audience applauding!",
                "fullTestimonial" => "I was one of those drummers who was just okay but had barriers that I could not break through -- and I could see certain things that I needed to improve in. I hoped Drum Technique Made Easy would be a part of the “open sesame” to some of the specialist techniques that professional drummers had been taught to raise them above the crowd. This proved to be the case.<br><br> The course was full on and I did struggle at times, but always managed to do most of what was shown. Most importantly, I improved my playing. I’m now able to do more, play smoother, and faster, and more articulately. My band members never said anything until one time we played Black Magic Woman. Santana often has two drummers plus at least two percussionists which I had to emulate. It felt so good to knock their socks off and have the audience applauding!<br><br> Any level player below advanced, professionally gigging & acclaimed, would find this course valuable, would see an almost instant improvement in aspects of their playing and would find it was really great value money wise.",
                "name" => "Owen Brown",
                "location" => "Melbourne, Australia"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/JayCookson.jpg",
                "testimonialHighlight" => "Musician friends immediately noticed the difference in my playing.",
                "fullTestimonial" => "Even though I am blind, Bruce was able to demonstrate and describe proper technique in a very clear, precise way that made understanding technique very easy. It allowed me to progress very quickly over 26 weeks in a way that I had never experienced before in over 20 years of playing.<br><br> My accuracy, clarity, and speed have all improved, and I am able to play things that I was never able to before doing DTME. The frustration used to often be overwhelming and demotivating as I felt I was not progressing despite many hours of practice. Musician friends commented very early on in the course that they could notice the difference in my playing. The structure of DTME facilitates steady progression throughout - and when you get to the end and realise how much progress you have made, you just want to play more and more!",
                "name" => "Jay Cookson",
                "location" => "Southampton, United Kingdom"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/MichaelBalfe.jpg",
                "testimonialHighlight" => "Easily the best money I ever spent on lessons.",
                "fullTestimonial" => "Drum Technique Made Easy was easily the best money I ever spent on lessons. My playing is now much more relaxed, fluid, and controlled, allowing me to be much more musical. My bandmates noticed a marked improvement and confidence. Bruce is such a great teacher and his method of showing students how to execute the choreography as he calls it, combined with the way he layers his lessons is deceptively effective. If you spend the time and sweat you can’t help but improve.",
                "name" => "Michael Balfe",
                "location" => "Ontario, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/RobJames.jpg",
                "testimonialHighlight" => "I hadn’t played in a band for 3 years due to a lack of confidence...",
                "fullTestimonial" => "Bruce’s exercises really helped me to loosen up, feel free and improve my flow! The course offers a very clear and concise breakdown for improving my technique. All the info is in one place instead of having to pick bits and pieces from 100 different videos. As Bruce mentioned, you can’t just loosen up because someone tells you to. You need to break it down and go through the motions.<br><br> I hadn’t played in a band for at least 3 years due to not being confident enough about my technique and expression behind the kit. In the last year I have been in 3 bands, gigged, and found some groups to jam with. This really boosted my passion for drumming!",
                "name" => "Rob James",
                "location" => "Bristol, United Kingdom"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/LeeKelley.jpg",
                "testimonialHighlight" => "My guitarist mentioned how relaxed I seemed on the drums.",
                "fullTestimonial" => "After taking this course, I was jamming with my band and my guitarist mentioned how relaxed I seemed on the drums! Bruce is like a guru - and as a long time meditator, I LOVE how he integrates mindfulness into drumming. I used to get too much “in my head”, but now I feel more knowledgeable and comfortable just being present and relaxed and creative behind the drums.",
                "name" => "Lee Kelley",
                "location" => "Utah, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/AsleBrudvikArntzen.jpg",
                "testimonialHighlight" => "I am more confident in the bands I play in.",
                "fullTestimonial" => "When I realized how important the up strokes are, I began to truly feel the space between the notes and this improved my time and feel. Now I am more confident in the bands I play in. If you’re considering Drum Technique Made Easy, take the opportunity. It will make you a better drummer. You'll get direct contact with the guru Bruce Becker. He is so good at explaining drumming and he will absolutely motivate you.",
                "name" => "Asle Brudvik Arntzen",
                "location" => "Norway"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/MichaelPersad.jpg",
                "testimonialHighlight" => "The musicians were soloing one by one. When my turn came around, it felt so effortless.",
                "fullTestimonial" => "One night at a rehearsal, the musicians were soloing one by one. When my turn came around, it felt so effortless because I was applying the right strokes in the right place at the right time. I felt like my sticks were floating above the heads as I was working “with” the head and sticks, rather than applying strokes “against” the head with the stick. Bruce’s detailed explanations in this course, as well as his ability to identify common mistakes and expected challenges, helped me improve my efficiency in getting around the kit.<br><br> As a drum teacher, I incorporate a lot of Bruce’s teachings when I work with students. Do this course. Don’t think about it, just do it...it is essential for ALL drummers to revisit and refine these techniques.",
                "name" => "Michael Persad",
                "location" => "Trinidad and Tobago"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/MagnusSkarstedt.jpg",
                "testimonialHighlight" => "I started playing more musically with the band.",
                "fullTestimonial" => "The 26 weeks made me take the time to actually work in a structured way to take me from point a-b-c-d. And I realized Drum Technique Made Easy was working when I started playing more musically with the band. I had more self-confidence and played more relaxed. This comes slowly, it doesn't happen suddenly. It is small steps and it takes the time it needs to change the way you are used to playing.<br><br> No matter how good a player you are today, you will be even better after a course like this. It is definitely worth the money if you are willing to put in the time.",
                "name" => "Magnus Skarstedt",
                "location" => "Sweden"
                ])
            </div>
        </section>
    </div>

    @yield('final-banner')
    <section class="final">
        <div class="row">
            <div class="columns logo"><img src="{{ cdn('drum-technique-made-easy/logo-white.png') }}"></div>
            <h1 class="columns">26-Week Online Course <br class="hide-for-medium"> For Just @yield('pricing') Per Week
            </h1>
            <h2 class="columns">(@yield('pricing2') one-time payment. Or choose a<br class="hide-for-medium"> 2-pay or 5-pay plan on the next page.)
            </h2>
            <div class="columns"><a href="@yield('order-link')" class="join">Get Started &raquo;</a></div>
            {{--<div class="columns"><a class="join sold-out">Closed</a></div>--}}
            {{--<h2 class="columns yellow">Registration Extended Until <strong>May 6th At Midnight</strong>.</h2>--}}
            <div class="columns cards">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <p class="columns final-questions">
                <span><strong>Any questions?</strong></span> You can also call us or order by phone<br class="hide-for-large"> toll-free at
                <a href="tel:1-800-439-8921">1-800-439-8921</a><br class="hide-for-medium"> or directly at
                <a href="tel:1-604-855-7605">1-604-855-7605</a>.<br> All prices listed in USD.</p>
        </div>
    </section>
@stop
