@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Rock Drumming Masterclass | Drumeo</title>
    <meta name="description"
            content="Unlock your rock drumming potential in this exclusive 26-week masterclass with Todd Sucherman.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/og-image.jpg"
            style="display: none;">
    <meta property="og:description"
            content="Unlock your rock drumming potential in this exclusive 26-week masterclass with Todd Sucherman.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/rock-drumming-masterclass/">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-rdm.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('rock-drumming-masterclass'); ?>
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
                var coaching = $('#coaching').offset().top - 50;
                var skills = $('#skills').offset().top - 150;
                var obstacles = $('#obstacles').offset().top - 150;
                var rock = $('#rock').offset().top - 150;
                var order = $('.final').offset().top - 150;

                if ($(this).scrollTop() > (header - 50)) {
                    navigation.addClass('stick-to-top');
                    navigationLinks.removeClass('active');
                    $(".topic-link.features").addClass('active');
                } else {
                    navigationLinks.removeClass('active');
                    navigation.removeClass('stick-to-top');
                }

                if ($(this).scrollTop() > coaching && $(this).scrollTop() < skills) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.coaching").addClass('active');
                }

                if ($(this).scrollTop() > skills && $(this).scrollTop() < obstacles) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.skills").addClass('active');
                }

                if ($(this).scrollTop() > obstacles && $(this).scrollTop() < rock) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.obstacles").addClass('active');
                }

                if ($(this).scrollTop() > rock && $(this).scrollTop() < order) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.rock").addClass('active');
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
                    <p><em>What past students are saying about...</em></p>
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/logo.png">
                </div>
                <div class="columns topic-link-wrap-shim show-for-medium"></div>
                <div class="columns topic-link-wrap">
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link coaching" href="#coaching">Personal<br
                                    class="show-for-medium hide-for-large"> Coaching</a>
                    </div>
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link skills" href="#skills">Lasting<br
                                    class="show-for-medium hide-for-large"> Skills</a>
                    </div>
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link obstacles" href="#obstacles">Overcome<br
                                    class="show-for-medium hide-for-large"> Obstacles</a>
                    </div>
                    <div class="columns half-padding medium-3">
                        <a class="join outline black anchor-slide topic-link rock" href="#rock">Rock<br
                                    class="show-for-medium hide-for-large"> Out</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial-section">
            <div id="coaching" class="anchor"></div>
            <div class="row">
                <h1>Personal Coaching <br class="hide-for-medium"> From A Legend</h1>

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Vincent-Squitieri.jpg",
                "testimonialHighlight" => "Todd always takes the time to respond.",
                "fullTestimonial" => "I’ve struggled with playing the drums and improving. Todd said a few things throughout the master classes that have really stuck with me, such as &quot;learning to enjoy the process of improving&quot;. The guy is amazing. He always takes the time to write back to you when you message him. Father, husband, and one of the top drummers in the world, and he always finds time to respond to his fans. Unbelievable! I wish I was one tenth as good as he is as a drummer and a person. <br><br> The way Todd explains things eases my stress and self doubt. He makes me believe in myself more and gives me hope that I can even improve in areas I’m afraid to touch. I feel like with the right direction from the right teacher, getting better really is possible. Thank you, Todd!",
                "name" => "Vince Squitieri",
                "location" => "Maryland, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Fred-Rose.jpg",
                "credit" => "Photo Cred: <br> Frank Rodrick",
                "testimonialHighlight" => "I felt like I was taking one-on-one lessons with THE Todd Sucherman.",
                "fullTestimonial" => "I kept thinking there might be something different about me. That maybe my hands were different and I just wasn't able to hold sticks the &quot;right&quot; way and that it would hold me back as a drummer. But with Todd’s instruction I was able to modify my grip and open up my playing to new techniques, and speed.  Also, some instructors just dazzle you with their licks then say, &quot;Now you do it&quot; and it can be demoralizing. But Todd's explanation of things was always very clear, practical, and extremely motivating. I also like how lessons were often tied to a song where you could apply the skills you’re developing. <br><br> By week 3 or 4, my bandmates, without knowing I was involved with the Rock Drumming Masterclass, made comments about a noticeable difference in my playing - timing, confidence, and technique. I attribute it all to the Rock Drumming Masterclass as it was the only work outside of band material I was doing. RDM is one of, if not THE best package Drumeo offers. This was an amazing experience - I felt like I was taking one-on-one lessons with THE Todd Sucherman.",
                "name" => "Fred Rose",
                "location" => "California, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Jay-Harper.jpg",
                "testimonialHighlight" => "I’ve fallen in love with playing drums all over again.",
                "fullTestimonial" => "Decades of improper technique lead to the last few years of trying to recover and learn. Todd's killer teaching method turned on the light bulbs. He brings so much to the course, which covers essential skills for playing rock. Each week is crammed full of ideas and practice material. The magic sauce, in my humble opinion, are the play-alongs sprinkled throughout the course. They are not only fun to play, they help solidify the material into music, which is the whole purpose for wanting to play this fantastic instrument!<br><br>After posting a practice session video in week 5, Todd gave me some feedback regarding my right hand technique which brought to the forefront a bad habit that I had never noticed before. Ever since then, I've remained aware of this habit and consciously change my technique to avoid it. It's even worked its way into my subconscious now.<br><br>Man, I'm so motivated every morning to get out and practice the current week's material. Each morning my routine is set up to allow me to practice for an hour before I leave for work. After four decades of playing, it's like I've fallen in love with playing drums all over again. The hour's practice session is over before I'm ready to leave the kit. Every day these lyrics pop into my head: &quot;I don't wanna work. I just want to bang on the drums all day!&quot; Seriously, this is a lifelong pursuit. Regardless of skill level, Rock Drumming Masterclass has something challenging and exciting for everyone. It's the total package.",
                "name" => "Jay Harper",
                "location" => "North Carolina, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/James-Gettys.jpg",
                "testimonialHighlight" => "Todd is so personable, you feel like you’ve known him all your life.",
                "fullTestimonial" => "Todd is so personable, you feel like you've known him all your life. He makes it comfortable to learn quickly. Once I started getting the hang of slowing it down and reviewing the classes, my focus improved and the process became easier. I find myself relaxed and in the groove more often than not, and my fellow musicians get excited about it as well. Thank you for thinking everything through and breaking it down.",
                "name" => "James Gettys",
                "location" => "Texas, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Sandy-Wisneski.jpg",
                "testimonialHighlight" => "Todd responded to all of my questions!",
                "fullTestimonial" => "I was self-taught and needed encouragement to get through my struggles with fills and kick technique. This course broke everything down into manageable steps. Even though it’s video-based, it still felt personal. Todd would respond to all my questions, even with his busy schedule. Every lesson is catered to your level, and he presents the material with energy and passion that will transfer to your own playing. <br><br> I still have so much to learn. As a beginner, I now have this as a resource to keep going back and challenging myself to grow daily. I have gained confidence in my playing, both because of Todd’s techniques and his powerful drumming philosophy. RDM is an amazing course. Don’t hesitate to take it, even if you are a beginner!",
                "name" => "Sandy Wisneski",
                "location" => "Wisconsin, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Jim-Stuart.jpg",
                "testimonialHighlight" => "I feel so much joy and happiness practicing now!",
                "fullTestimonial" => "This course is laid out so perfectly, I absolutely cannot wait to get home to practice and get to the next week’s lesson. Having the ability to practice with the click tracks is tremendously beneficial and helps me better gauge if I am actually getting the pattern right. <br><br> I attended Mr. Suchermans live masterclass in Austin, Texas and I told him this course was life-changing for me. I absolutely stand by that statement. I saw an immediate improvement in my skill level by practicing every day with a focus on detail. I feel so much joy and happiness practicing now because I can see this course will make me more than just a person who has drums; it will make me a musician. <br><br> I would highly encourage every drummer to take a Masterclass like this one. You definitely get more from it than what it costs to take the course. This is one of the most amazing and beneficial projects I have ever had in my life.",
                "name" => "Jim Stuart",
                "location" => "Texas, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Mark-Wiser.jpg",
                "testimonialHighlight" => "There are lots of teaching options, but Todd’s are always the best.",
                "fullTestimonial" => "This course exceeded my expectations. While many clinicians have trouble relating their high level of skill in a way that resonates with most people, Todd has a very humanistic, &quot;I just love to play the drums&quot; style. He also has a very clear way of demonstrating and teaching. My drumming is much more fluid now. Even if only 25% of the program material winds up being relevant to your playing, it’s a no-brainer. I am aware of many other teaching options and Todd’s are always the best.",
                "name" => "Mark Wiser",
                "location" => "North Carolina, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Christian-Hite.jpg",
                "testimonialHighlight" => "One of the best ways to advance your drumming.",
                "fullTestimonial" => "Rock Drumming Masterclass has been a game changer for me. Todd’s explanations and the way he plays each exercise really makes it easy and enjoyable to learn. I have totally grown a new respect for him and the level of drummer he is. He's an absolute monster. Because of him, I now look at drumming from a much more methodical perspective. RDM is one of the best things you can do to advance your development on the drums. The course has been even better than I expected.",
                "name" => "Christian Hite",
                "location" => "Arkansas, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Christopher-Davidson.jpg",
                "testimonialHighlight" => "Todd explains everything with complete clarity.",
                "fullTestimonial" => "Todd Sucherman is not only a master musician, but he is a true professor of music and drumming. He explains everything with complete clarity and is a consummate professional. Rock Drumming Masterclass has been a journey of new discoveries from day one. After many years of drumming, my whole approach has changed. I can't wait to practice, and there is never a shortage of material because Todd's lessons don't have an endpoint. They are meant to be a lifestyle. Sign up, participate, and get ready to change your musical drumming life for the better!",
                "name" => "Christopher Davidson",
                "location" => "Arizona, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Bobbi-Gibson.jpg",
                "testimonialHighlight" => "I feel inspired, motivated, and successful.",
                "fullTestimonial" => "Buckle your seatbelt and stick with it...you will be happy you did. What a privilege to have such easy access to such a highly skilled, successful, and excellent teacher as Todd Sucherman. You could tell right away this was going to be high quality, fast paced, and a don’t-want-to-miss-a-single-teaching-moment course. <br><br> No stone in technique was left unturned. Rock Drumming Masterclass lifted my drive and motivation to keep progressing. I feel inspired, motivated, and successful. The course has provided enough tools, teaching, and information for me to return to often for review. It will be a lifelong support. <br><br> What I really liked was Todd being very active responding to people in the comments of each lesson, and he was great at answering questions. That really helped with motivation, feeling a connection, and knowing that he cared!",
                "name" => "Bobbi Gibson",
                "location" => "Arizona, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Will-Morris.jpg",
                "testimonialHighlight" => "Todd is one of the most available teachers I’ve encountered.",
                "fullTestimonial" => "Not only is Todd brilliant at structuring the sequence of learning moments, but he is also one of the most available teachers I have encountered. He’s a master at teaching and possesses the technical skills to make it happen. Combined with Drumeo’s amazing production and organization, I’ve felt on track with my purpose and creativity since the very first class.",
                "name" => "Will Morris",
                "location" => "British Columbia, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Gail-Seno.jpg",
                "testimonialHighlight" => "Where else could you get a world class teacher giving you personal attention weekly?",
                "fullTestimonial" => "The detail in the first few classes alone pays for itself. If you want a highly skilled and positive teacher, you couldn't find a better one than Todd Sucherman. This is a course for all levels of drummers, guaranteed to last your lifetime. It will inform more than just rock drumming - these are techniques for any style. I don't know where you could get a world class drummer such as Todd giving you personal attention weekly in your learning as a drummer. It has completely sped up the learning curve for me as a relatively new drummer, and I don’t feel as lost.<br><br>I now have more confidence in my ability to get to the next level. I feel more connected to other drummers and the music world in general, and it’s nice to know you’re not alone. I have really developed some good technical ability. I can hear things in songs I didn't know how to get to before. Rock Drumming Masterclass is worth every penny! ",
                "name" => "Gail Seno",
                "location" => "Illinios, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Moritz-Kick.jpg",
                "testimonialHighlight" => "This led to a huge motivation boost.",
                "fullTestimonial" => "I’ve played the drums since I was 9 years old, so it's 21 years of drumming until now. But taking into account this long time, my drumming skills were very limited. I stopped developing more control and speed years ago and I didn't really understand why.<br><br>When I heard about the Rock Drumming Masterclass with Todd, I immediately knew that I wanted to take part. The weekly videos are well made and Todd provides you with enough information to study and practice your whole life. Every lesson gives you new insights and you slowly begin to understand how to achieve your goals and what kept you from improving. For me, this led to a huge motivation boost. I played every single day and I felt the difference. I'm still not where I want to be some day, but I see progress and, most importantly, I know what to practice! And if you have any doubts, you can ask Todd and he replies with the most helpful answers.<br><br>I was very happy with this course, and when I had my first gig with my band after joining RDM, the feedback confirmed my feelings. I am now able to play more confident and more consistent and this helps so much when you're playing with others. The feedback I received gave me even more motivation to follow this path. I never invested my money better than in this course. I am deeply thankful for this opportunity. Thanks Drumeo, and thanks Todd!",
                "name" => "Moritz Kick",
                "location" => "Germany"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Alvaro-Gomez.jpg",
                "testimonialHighlight" => "Grab your drumsticks & chase your goals!",
                "fullTestimonial" => "I decided to join the Rock Drumming Masterclass because I wanted to learn from a humble teacher with many years of experience. Todd’s encouragement and simple explanations are inspiring and make you feel like anything’s possible. If you like fluency between the teacher and the student, a didactic way to learn, and you consider music (and drums) your passion, then leave the excuses behind, grab your drumsticks, and chase your goals. Move your ass - this is your thing!",
                "name" => "Alvaro Gomez",
                "location" => "Spain"
                ])
            </div>
        </section>

        @include('drumeo.lead-gen.partials._testimonial-pitch', [
            "descriptiveText" => "Rock Drumming Masterclass is a 26-week online course with Todd Sucherman."
        ])

        <section class="testimonial-section">
            <div id="skills" class="anchor"></div>
            <div class="row">
                <h1>Skills That Last <br class="hide-for-medium">A Lifetime</h1>

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Deborah-Palmer2.jpg",
                "testimonialHighlight" => "I never sat behind the drums before and now I’m playing like an old pro!",
                "fullTestimonial" => "Drumeo has so many course offerings and I am so glad I ran across this site. I lost my husband in May of 2018 and needed an outlet to express myself via music. I purchased an electronic Roland drum set that December and signed up for the Rock Drumming Masterclass in January 2019. The timing of the class offering was perfect. I never sat behind a drum set before and now I'm playing drums in my 20th week like I’m an old pro (albeit beginner). <br><br> I am certain I would not have made it this far without this class and all it has to offer. I look forward to Mondays when the next lesson is presented. The online visuals are extremely helpful, and having the PDF files and downloadable song files is spectacular. There are also so many other courses of interest on Drumeo that I'll never run out of music to play. Eventually, I'd like to join a lesson group in person as well as be in a local band some day. Thank you Drumeo and Todd Sucherman!",
                "name" => "Deborah Palmer",
                "location" => "Maryland, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Alan-Shaffer.jpg",
                "testimonialHighlight" => "If you’ve ever wondered “how do they do THAT?!”",
                "fullTestimonial" => "If you've seen a drummer live, or have heard fills or drum parts and wondered, &quot;How the hell does he do that?&quot;, well, it's explained in Rock Drumming Masterclass. You'll find out it's easier than you think. <br><br> Every week there's an &quot;ah-ha!&quot; moment to learn from. Todd shares 40 years of drumming expertise within a few months of lessons. There's nothing you can't practice or work on for the rest of your life. If there's a drum fill or phrase I need to work out and learn, I know where to go in the lessons. The information is there, word for word from Todd himself. <br><br> Todd will tell you point-blank what you've probably been doing wrong, and then show you how to correct it. There are several instances when he says, &quot;This is the only way to do it properly&quot;, and I wish someone had shown me these things years ago.",
                "name" => "Alan Shaffer",
                "location" => "Texas, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Jesper-Lagstrom.jpg",
                "testimonialHighlight" => "It has boosted my dreams of playing with other musicians!",
                "fullTestimonial" => "Getting access to Todd’s expertise and experience has been very inspiring. To experience him as a teacher during the course has been equally inspiring! Besides being encouraging and supportive, Todd has shown interest in us, his students, in an engaging way. <br><br> All in all it has boosted my dreams of playing music with other musicians and solidified my ambitions in my work as a percussion teacher. For me, these are some of the greatest things one could ever hope to give anyone! Thank you!",
                "name" => "Jesper Lagström",
                "location" => "Sweden"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Pamm-Cobo.jpg",
                "testimonialHighlight" => "My drumming and musicianship is finally unlocked!",
                "fullTestimonial" => "It feels like life is now unlocked for all that it has to offer musically. It’s amazing to realize all the possibilities we have when playing the drums! Todd gave interesting tips that helped me understand how my body works, particularly when I learned that the moment we change the sticking, we change the melody. You will enjoy the ride with Todd. With his help, reaching your goals will be easier.",
                "name" => "Pamm Cobo",
                "location" => "Mexico"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Leonard-Achiron.jpg",
                "testimonialHighlight" => "The best investment I’ve made in my drumming career.",
                "fullTestimonial" => "Rock Drumming Masterclass is the best instruction for the money, presented in a clear and progressive manner! At first I was skeptical about online education, but the camera angles, the play-alongs, and practice PDFs with the metronome were extremely helpful. Todd was also great in giving feedback on my videos. Absolutely the best investment I’ve made in my drumming career.",
                "name" => "Leonard Achiron",
                "location" => "Georgia, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Michael-Gregory.jpg",
                "testimonialHighlight" => "I’m having more fun!",
                "fullTestimonial" => "As a rookie drummer in my 40s, I can’t always play what I want to play, when I want to play it. Music is something I had a desire to get in to, but never really did until now. I am working on things that are important to my soul. I still consider myself a novice but I’m having more fun, and I am better than I used to be. Rock Drumming Masterclass is helping me to just do something, to PROGRESS, and FEEL the music more, and have a better understanding about the instrument, the music, and most importantly helping me focus on progress, not perfection. <br><br> Todd is fun, and so kind to get back to his students quickly with concise and wise advice. He is able to be at his level while relating to all students in an intelligent and helpful manner. The one email message I had with him stayed with me and has helped me progress. That’s what it’s all about, right? RIGHT!",
                "name" => "Michael Gregory",
                "location" => "Pennsylvania, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Rob-Scalici.jpg",
                "testimonialHighlight" => "I was skeptical about online instruction.",
                "fullTestimonial" => "I was skeptical about online instruction, but this has made me a believer. I’m now looking at drumming as a continuous learning journey as opposed to an ‘instant cure.’ Todd takes a no fluff, straight-to-the-point, no-magic-pill approach, which I really appreciate! I love the fact that you can continuously reference previous lessons, slow or speed up tempos, and see the instructor break it all down.",
                "name" => "Rob Scalici",
                "location" => "Michigan, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Michael-Squeak-Melusky.jpg",
                "testimonialHighlight" => "I feel like I did when I was younger: excited about the future.",
                "fullTestimonial" => "Rock Drumming Masterclass is a must if you are serious about drumming. Though we are following a weekly structure, I like being able to work at my own pace. <br><br> A ‘goosebumps’ moment happened when rehearsing with a choral group. I could see my reflection in the piano, and during an uptempo 16th note section, I saw myself doing a tip-shank motion on the hi-hat without thinking about it. It came naturally. My grip has stayed loose and my performances are feeling more relaxed. <br><br> This has been life changing in such a positive way for me. I have found that I really enjoy practicing and that I wish I could practice more. I keep sticks and a pad with me everywhere I go. I exercise, go for walks/runs, and eat better. I've been reading books about overcoming common mental barriers in drumming, such as Mind Matters by Bernie Schallen. I’ve been going to shows. I've simply tried to be more positive. I feel like I did when I was a younger musician: excited about the future.",
                "name" => "Michael “Squeak” Melusky",
                "location" => "Pennsylvania, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Chad-Hawkins.jpg",
                "testimonialHighlight" => "I learned how to make music, not just play an instrument.",
                "fullTestimonial" => "Having 4 kids and a business, my life is always busy. Since this class is yours to access for life once you buy it, I can't think of a better way to take drum lessons. I really related to Todd. He not only taught technique, but placed an importance on feeling and emotion. He walked you through the storyline of a song and encouraged you to make music, not just play an instrument. <br><br> I think that many of the lessons over the weeks added little changes that I didn’t notice at first. I really see it and feel it when I go back and play songs that I have been playing for years. I feel much more relaxed now. You don't need to be able to read sheet music to take this course, but another huge surprise was how much I actually CAN read music now. I value the knowledge and skills that Todd has acquired (the hard way) and I'm simply excited that I can just punch a button and have all of his knowledge right here in my own home.",
                "name" => "Chad Hawkins",
                "location" => "California, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Craig-Bagby.jpg",
                "testimonialHighlight" => "It’s more than 26-weeks, you’ll improve your playing for the rest of your career.",
                "fullTestimonial" => "I’m a self-taught drummer. When you've never taken a class before, it can be overwhelming to figure out what you need to practice. Now I have a library of exercises to visit. No more listening to a drum part and trying to make yours sound similar. My &quot;how is he doing that?&quot; thoughts are now mostly &quot;oh, he's playing a ______.&quot; For me, the difference was having a weekly goal. Rock Drumming Masterclass was the first time I had an assignment to address every week. As I worked through the course, the sensation of &quot;this is about to be a train wreck&quot; changed to &quot;I can do this all day.&quot; <br><br> Todd Sucherman isn't just teaching a 26 week course. He's giving you the tools needed to improve your playing for the rest of your career. I wouldn’t change a thing about it. I’m totally sold.",
                "name" => "Craig Bagby",
                "location" => "Texas, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Robert-Abraham.jpg",
                "testimonialHighlight" => "This is my road map for getting better.",
                "fullTestimonial" => "Step by step, Todd ‘peels the onion’. Step by step, each week builds on the prior week. He comes off as a relatable teacher who's been where we are and remembers that - not someone who’s looking down his nose at us. I now have a road map to follow to get better. That's the simple truth. Rock Drumming Masterclass is the gift that will keep on giving.",
                "name" => "Robert Abraham",
                "location" => "California, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Hank-Bryant.jpg",
                "testimonialHighlight" => "You WILL be enlightened and pumped.",
                "fullTestimonial" => "I was taking lessons from a guy at $60 per hour but was not retaining a lot. With Rock Drumming Masterclass, I can watch it, see it, read the music and ask questions if needed. I can also go back and go over things as much as I want. Todd shows us how to build speed with the proper institution of rudiments, and he helped me fix my stick grip problem. I realized I was (and still am) getting better and faster.<br><br>The future is very bright and I feel like I am accomplishing something. For the investment of time and money, Rock Drumming Masterclass can't be beat. In my past, I have had long periods of being uninspired. No more of that...the new mantra is to get as good as I can before I leave this life! You WILL be enlightened and so pumped. AND you get to learn from the best with other cool students. This journey together is killer.",
                "name" => "Hank Bryant",
                "location" => "North Carolina, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Jerry-King.jpg",
                "testimonialHighlight" => "I have an enthusiasm for my craft that I haven’t had for a long time.",
                "fullTestimonial" => "Quite often I would have to simplify or &quot;dumb down&quot; my parts when presented with a challenge, which would leave me feeling that I wasn't playing up to my true potential. As a mature musician, this is frustrating and can lead you to doubt yourself in the worst ways.<br><br>Unlike so many instructional courses and DVDs, Rock Drumming Masterclass gives you direct access to the person doing the teaching: Todd! If you have a question, he actually follows up with you. This course is not just another source of &quot;licks&quot; to try out. Todd's approach addresses principles of drumming that I find receive little focus or explanation from other experts and instructors.<br><br>I’ve noticed that my abilities have increased in terms of executing difficult musical passages and articulations while staying relaxed and creative. I have an enthusiasm for my craft that I haven't had for a long time, not only as a performer, but also as a teacher. That enthusiasm is infectious. There is a great feeling knowing you've have the ability to confidently take on challenges you otherwise would have avoided. The knowledge that is presented in this course is priceless.",
                "name" => "Jerry King",
                "location" => "Illinois, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/David-James.jpg",
                "testimonialHighlight" => "It has opened up avenues that I never knew existed!",
                "fullTestimonial" => "There is a saying that if you want to feed someone, give them a fish, but if you want to feed them forever, give them a fishing rod and show them how to fish. Rock Drumming Masterclass has taught us not only drum technique but how to create and expand musically, and that has opened up new avenues that I never knew existed or were even possible.",
                "name" => "David James",
                "location" => "United Kingdom"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Bill-Bigler.jpg",
                "testimonialHighlight" => "I will never get bored playing the drums again.",
                "fullTestimonial" => "This entire course hit me at the exact correct time in my drumming journey. I would say I am an &quot;advanced beginner&quot; or a &quot;blossoming intermediate&quot;. I have much more confidence and can &quot;see&quot; the entire piece of music in my mind's eye. I feel like a drummer, and not just a person holding sticks. I feel I have a much better basis for continual learning on our instrument. This is the most fun aspect of this for me. I will never get bored playing the drums again.<br><br>The way the lessons build on each other, and the ability to slow down the tempo in each exercise is just super. The two lessons titled ‘The Rosetta Stone’ actually helped me solve a problem I was having in my right foot that was caused by an old sports injury. This course sets the foundation for continued life-long learning and fun. Don't let this opportunity pass you by: take this course!",
                "name" => "Bill Bigler",
                "location" => "Louisiana, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/William-Dilla.jpg",
                "testimonialHighlight" => "This course changes the way you think and play.",
                "fullTestimonial" => "This course changes the way you think and play. It’s the best weekly drum lesson program out there. With Rock Drumming Masterclass, it gives you useful and versatile tools you can apply to everyday playing. Being able to stop, rewind, and SLOW down the class was a big help! Now I set time aside every day to focus on playing and improving.",
                "name" => "William Dilla",
                "location" => "Pennsylvania, USA"
                ])
            </div>
        </section>

        @include('drumeo.lead-gen.partials._testimonial-pitch', [
        "descriptiveText" => "Rock Drumming Masterclass is a 26-week online course with Todd Sucherman."
        ])

        <section class="testimonial-section">
            <div id="obstacles" class="anchor"></div>
            <div class="row">
                <h1>Overcome Your <br class="hide-for-medium">Biggest Obstacles</h1>

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Andrew-Matthews.jpg",
                "testimonialHighlight" => "You’ll never not know what to play again!",
                "fullTestimonial" => "Rock Drumming Masterclass has given me so much pleasure and will continue to do so forever. This is a life changing course. Todd Sucherman is giving you a lifetime of experience and expertise for just a few dollars a week. The format and learning tools are superb. You'll never not know what to play again! Do it, do it, do it!",
                "name" => "Andrew Matthews",
                "location" => "England"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Mike-Ritter.jpg",
                "testimonialHighlight" => "I wanted to quit and sell my drums!",
                "fullTestimonial" => "As a new drummer at the age of 52, everything was overwhelming. Every time I sat down at my drums, I wondered why I couldn’t learn to play. Drumming is supposed to be easy, right? Wrong! I would get so frustrated that I wanted to quit and sell my drums. Enter the Rock Drumming Masterclass. <br><br> With every lesson, came words of inspiration and encouragement from Todd that kept me going. I began to believe that I COULD actually learn to play the drums. And with every lesson, I noticed I was getting a little better. And then, I started getting a lot better. <br><br> While learning to play, “Melody”, the first song in the course, I began to think musically. I felt a connection with the song in my heart and that was a pivotal moment for me. The space between the notes became just as important as the notes themselves. The concept of allowing the music to breathe was totally new to me. What I felt about the lyrics, I was able to express with my hands and feet. It was nothing short of magic. <br><br> The most important takeaway from the Rock Drumming Masterclass experience is Todd’s passion for teaching and constant encouragement. He truly wants his students to become the player they have always wanted to be. No shortcuts. This is tough stuff. You can do this. <br><br> No matter your skill level, you will find RDM to be one of the most challenging and rewarding chapters of your life as a musician. I strongly encourage anyone who wants to improve their drumming skills to sign up for this course without hesitation. You will be so glad you did.",
                "name" => "Mike Ritter",
                "location" => "Missouri, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Mark-Pungercar.jpg",
                "testimonialHighlight" => "Changing my grip after 45 years is a big undertaking, but the payoff has been even greater.",
                "fullTestimonial" => "My playing had become stagnant and my practice routine was non-existent. The course has definitely revealed some &quot;holes&quot; in my technique that I wasn't aware of, and it has given me the tools to work on those things. Changing my grip after 45+ years of playing is a big undertaking, but the payoff has been even greater. <br><br> Having a weekly class has given me a reason to practice again, and something to work against. There is value in every lesson!",
                "name" => "Mark Pungercar",
                "location" => "Tennessee, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Austin-Rossi.jpg",
                "testimonialHighlight" => "I didn’t have freedom in my left foot.",
                "fullTestimonial" => "Instead of Googling ways to practice technique, I found Rock Drumming Masterclass to be an organised and streamlined course that shows you how to apply techniques into playing. Whatever your skill level, it’s a great way to improve your drumming and ensure that you’re playing cleanly. <br><br> I used to not have freedom in my left foot. I would often have to stop and practice the pattern in whatever song I was learning. But less than a week after I added “Rosetta Stone of 2 & 4” to my daily practice, I was at a blues jam with some people I’d never played with before. I was consciously trying to have my hi-hat pedal on the 2 & 4 with whatever bass pattern I was doing at the time, and it seemed to come completely effortlessly.",
                "name" => "Austin Rossi",
                "location" => "Quebec, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Ralph-Ullmann.jpg",
                "testimonialHighlight" => "A great weight has been lifted off my shoulders",
                "fullTestimonial" => "I would highly recommend the Rock Drumming Masterclass with Todd Sucherman. The exercises in each lesson are structured to allow you play patterns you may have thought impossible. The interaction in the forum and option to email Todd is awesome, and the ability to slow or increase the tempo in each exercise makes a big difference. <br><br> RDM has been a game changer for me. I feel like a great weight has been lifted off my shoulders. I’m more confident not only as a drummer, but also in other areas of my life such as work and sports. My playing level has risen substantially and I now feel confident playing with any level of musician. I played a gig a month after implementing the pedal exercises in my regular warmups, and received compliments on how relaxed and confident I was while playing. Overall, the course was a grand slam.",
                "name" => "Ralph Ullmann",
                "location" => "Ontario, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Trevor-Klopp.jpg",
                "testimonialHighlight" => "I haven’t dropped a stick for the past 4 live shows!",
                "fullTestimonial" => "If you're serious about improving technique and adding tons of new licks to your rock drumming vocabulary - this is a safe bet. It was freeing and empowering when I started seeing small improvements to my playing. The program Drumeo uses for playback notation and how it’s synced with videos is great. Real easy to loop, slow down and study parts and assignments. <br><br> I was gigging at The Varsity Theatre in Minneapolis and right before we went on I realized I hadn't dropped a stick in the past 4+ live shows. No pressure, right? Made it through without issue. My forearms don't lock up during long jams and I drop sticks far less often. Wallet's lighter, chops are tastier. A fair trade.",
                "name" => "Trevor Klopp",
                "location" => "Minnesota, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Brian-Christensen.jpg",
                "testimonialHighlight" => "Todd gave me the building blocks to overcome the challenges.",
                "fullTestimonial" => "I'm 60 and recently retired. I hadn't played much for years or had a teacher in decades, so this course provided a systematic approach that I was lacking. Todd provided a plan I could use to improve my drumming skills, and his encouraging attitude helped me realize I could improve with practice. And I did. His exercises gave me the building blocks to overcome the challenges. <br><br> I'm actually a jazz drummer, but when I saw Todd teach and his approach to the instrument, I knew I could learn from him. I wanted him to be my teacher, even though we play different genres of music. I'm very happy with the direction in which I am headed. Rock Drumming Masterclass will definitely improve your technique, raise your confidence as a musician, and take your musicianship to the next level. It has opened up lots of new possibilities for me, and it is one of the most valuable investments I have made.",
                "name" => "Brian Christensen",
                "location" => "Utah, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Shawn-Preston.jpg",
                "testimonialHighlight" => "I was squeezing my drum sticks too much.",
                "fullTestimonial" => "Rock Drumming Masterclass was a breath of fresh air. I was squeezing too much on the sticks before, and fixing that has made such a difference. After 25 years as a full time drumming professional, I’m already using the techniques learned here with my own students. The course is wonderfully conceived, well produced, and highly informative. It’s given me a new perspective!",
                "name" => "Shawn Preston",
                "location" => "Pennsylvania, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Joseph-Hopkins.jpg",
                "testimonialHighlight" => "Songs are much easier to learn now.",
                "fullTestimonial" => "This course gives you drills that translate to the kit better than other lessons I’ve taken online (which usually just give you specific fills/grooves). Before Rock Drumming Masterclass, there was this one song where I could never play the groove. After the course, I went back to it and played it with ease. Songs are much easier to learn now. <br><br> If you want to learn techniques and concepts that will immediately improve your playing, RDM is for you. I’m very excited about my drumming future.",
                "name" => "Joseph Hopkins",
                "location" => "South Carolina, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Peter-Reslinski.jpg",
                "credit" => "Photo Cred: <br> Keegan Richard",
                "testimonialHighlight" => "My wrist pain is gone and my hands don’t get numb anymore!",
                "fullTestimonial" => "I used to have a ‘death grip’ on the sticks that resulted in wrist pain and hand numbness. With the Rock Drumming Masterclass, I had the ability to email Todd and ask questions, and I would receive a reply from him in minutes sometimes. By my third gig after receiving advice from Todd, I noticed my wrist pain was gone and my hands didn’t get numb anymore. I can now play longer without feeling like I’m choking my hands or pushing through pain.",
                "name" => "Peter Reslinski",
                "location" => "Ontario, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Matthew-Breakey.jpg",
                "testimonialHighlight" => "I’ve improved more in 3 months than my entire career.",
                "fullTestimonial" => "Because of Rock Drumming Masterclass, I have improved more in the past 3 months than I probably have in my entire career, and I'm having fun playing. The next challenge is figuring out how to incorporate what I'm learning into the songs that I play with my band. Sign up. You won't regret it.",
                "name" => "Matthew Breakey",
                "location" => "Ohio, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/James-Fuller.jpg",
                "testimonialHighlight" => "I considered selling my drums.",
                "fullTestimonial" => "I used to struggle so much with speed and endurance that I considered selling my drums. Todd's easygoing teaching style gave me confidence, and this course changed my playing forever! Todd is a fantastic professional who is willing to share everything to help us improve. He makes even a beginner like me feel like we’re good buds just hangin' out! In fact, the whole team at Drumeo is great. Everyone is willing to help!<br><br>I'll have these lessons forever. I’ve seen a real improvement in my playing, especially compared to videos I took of myself a year and a half ago. My goal is to retire from my present job as drywall contractor and play music. I feel that RDM will help me do that. Take the course! Worth every penny!",
                "name" => "James Fuller",
                "location" => "Georgia, USA"
                ])
            </div>
        </section>

        @include('drumeo.lead-gen.partials._testimonial-pitch', [
        "descriptiveText" => "Rock Drumming Masterclass is a 26-week online course with Todd Sucherman."
        ])

        <section class="testimonial-section">
            <div id="rock" class="anchor"></div>
            <div class="row">
                <h1>Rock Like You’ve <br class="hide-for-medium">Never Rocked Before! </h1>

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Mark-Pappalardo.jpg",
                "testimonialHighlight" => "I could feel the band pumping and breathing for the first time!",
                "fullTestimonial" => "About 6-8 weeks into the course, I was at a rehearsal with one of the projects I work with. About halfway through the set, the guys turned to me and said, &quot;Man, everything is really sounding great tonight&quot; and I could feel the band pumping and breathing for the first time. What a breakthrough! The way Todd allowed us into his head - the thought process of what he was doing and where - has made the biggest difference in my playing. Some of the best money I ever spent on my career!",
                "name" => "Mark “Boomer” Pappalardo",
                "location" => "Missouri, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Jeff-Stine.jpg",
                "testimonialHighlight" => "Songs that were difficult have become easier.",
                "fullTestimonial" => "This is the course that I wish I’d had access to when I began drumming 13 years ago. You build a foundation and then add layers to it. It’s the most organized and logical class I have ever taken. I would say that the proof is when I am playing with my band: parts of songs that were difficult for me have become easier. I’m now able to dissect a song and figure out what is going on. <br><br> It is great knowing that I have Rock Drumming Masterclass as a reference for the future. I have already told many people how great it is. It is a bargain for all the info you receive and for all the work that has gone into it. It’s the most well thought out, planned and executed drum course I have ever taken. It should be a blueprint for drum instructors, regardless of style. Todd and Drumeo have done a great job!",
                "name" => "Jeff Stine",
                "location" => "California, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Jeff-Marlon.jpg",
                "testimonialHighlight" => "I play gigs with more confidence than ever before.",
                "fullTestimonial" => "If you have the time and want to get better, learn from the master: Todd Sucherman. He knows drum techniques and grooves ranging from basic to sophisticated, and holds back nothing in sharing these with his students. You can learn to develop into a better drummer with hard, constant work and a little bit of an investment. I’ve been playing drums off and on for more than 50 years, and I’m feeling much more positive about practicing while watching reruns of Todd's lessons. I expect this to go on indefinitely when I get the urge to improve my chops. Already my drumming has improved and I play gigs with more confidence than ever before. <br><br> Todd is a great motivator in addition to being a great player. It’s well worth the time, effort and expense to learn from one of the most professional, caring people playing music today.",
                "name" => "Jeff Marlon",
                "location" => "Florida, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Matt-Kretzer.jpg",
                "testimonialHighlight" => "I have more confidence and ability -- and no longer need to ‘water down’ drum parts!",
                "fullTestimonial" => "I play in a weekend cover band and there were always certain parts of a few songs that gave me trouble. Sometimes I would water down certain passages in ` to lessen my mistakes. After a few months of working through the Rock Drumming Masterclass, I had much more confidence and ability, and I no longer need to water down any parts. <br><br> I have more confidence in my playing and I believe I am a more musical drummer. I have a renewed excitement to play and have probably never been more motivated to practice. <br><br> This is the best investment you can make toward your musical journey. I wish I’d found this 20 years ago! You will develop technique, creative ideas, and exercises that you will be able to work on for the rest of your life.",
                "name" => "Matt Kretzer",
                "location" => "Ohio, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Petrina-Tonkin.jpg",
                "testimonialHighlight" => "I’m really enjoying the art of drumming and the confidence this course has given me.",
                "fullTestimonial" => "I used to struggle when playing rudiments and having my hi-hat foot keep time. Well, this course opened up a whole new world for me. Todd’s teaching skills are fantastic, and the amount of course material is unbelievable and so clearly explained. <br><br> Todd was very quick to reply to my questions. One piece of advice was like gold to me, and it will stay with me for the rest of my life: “You can play ANYTHING if you slow it down and work it out!” I feel really positive about my abilities now, and I am really enjoying the art of drumming and the confidence this course has given me. <br><br> Rock Drumming Masterclass is one of the best things you will ever do! You will have this incredible information from an incredible drummer and teacher for life! Thank you from my heart.",
                "name" => "Petrina Tonkin",
                "location" => "Gold Coast, Australia"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Michael-Malo.jpg",
                "testimonialHighlight" => "I can play just about anything on the fly!",
                "fullTestimonial" => "The really powerful thing about Rock Drumming Masterclass is that while each lesson focuses on very specific things, you’ll notice how they’re all connected as your playing evolves. Now when I start jamming along to a song, I can play just about any sticking or fills on the fly. My hands seem to know how to resolve patterns without thinking. This course proves that with the right material and some honest work and discipline, you can vastly improve your musicianship! <br><br> Dear future students: if you choose RDM, you will be given the keys to open some very important doors in your musical career. It will not only change how you play, but how you learn, too! I can’t think of another class that offers you as many crucial tools to become a seriously great drummer. Don’t pass up this chance!",
                "name" => "Michael Malo",
                "location" => "Quebec, Canada"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Pat-Lindsley.jpg",
                "testimonialHighlight" => "My playing is more solid and confident than before!",
                "fullTestimonial" => "Wish I could’ve done this 18 years ago! Rock Drumming Masterclass has been really helpful to have the practice exercises, even though I sometimes have to slow them down to a “snail’s pace”. As I’m practicing with the band, my playing is much more solid and my confidence level has improved! If you want to play the drums and you’re serious about it, arm yourself with the discipline to practice regularly and spend the money! This course is a bargain!",
                "name" => "Pat Lindsley",
                "location" => "Texas, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/HenkJan-Wormgoor.jpg",
                "testimonialHighlight" => "I’m playing in more bands and people have praised my drumming!",
                "fullTestimonial" => "Todd knows what works best for him, and he doesn’t present any fancy or extraordinary techniques: only what you really have to know! The exercises are more extensive than anything you’ll see in any clinic or lesson from other top drummers, and the sheet music is notated so well. <br><br> I am asked more often to play in bands these days, and people have praised my drumming. Overall, a big compliment for Todd Sucherman and Drumeo. I feel 100% supported to reach what is within my capabilities. You have to put in the work. It really is worth the effort.",
                "name" => "Henk-Jan Wormgoor",
                "location" => "The Netherlands"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Mike-Arturi.jpg",
                "testimonialHighlight" => "My drumming is revitalized and inspired.",
                "fullTestimonial" => "I am the long-time drummer for Rock and Roll Hall of Fame inductees The Lovin' Spoonful. I've been a fan of Todd's for many years. Since joining Rock Drumming Masterclass, my drumming life is revitalized and inspired. Todd begins by demonstrating rudimental, single and double stroke combinations on the snare at a digestible tempo, then advances across the kit at performance tempos (and then some!). <br><br> For me, this process brings these applications into a 'do-able' focus. After Todd’s third lesson or so, my &quot;moment&quot; happened on stage with the Spoonful. The hand exercises and grip lesson advanced my agility, control and clarity to a marked degree. I am VERY happy I subscribed to this series and I am grateful for the inspiration it has provided. I am an ‘old dog’ and RDM is teaching me new tricks. I have shared this sentiment regarding RDM with many, many drummers so far: DO IT, you won't be sorry.",
                "name" => "Mike Arturi",
                "location" => "Minnesota, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Aaron-Levy.jpg",
                "testimonialHighlight" => "My drumming vocabulary has expanded beyond my wildest dreams.",
                "fullTestimonial" => "Before Rock Drumming Masterclass, my playing felt stiff and unlively. Todd expressed and taught lessons with detail and gave us the tools to become the best rock drummers possible! This class opened new doors to new concepts for me. <br><br> On the weekends, I play at a church performing modern contemporary Christian music, most of which is rock-based. In my playing, I felt more relaxed and free, I could go longer without getting exhausted, and my drumming vocabulary has expanded beyond my wildest dreams. <br><br> There is no better time than the present to take advantage of the material and lessons Todd Sucherman gives in this masterclass. One of a kind experience!",
                "name" => "Aaron Levy",
                "location" => "Louisiana, USA"
                ])

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Christian-Macchion.jpg",
                "testimonialHighlight" => "My bandmates can feel the difference.",
                "fullTestimonial" => "My drumming life has been transformed. Even if I'm late because of other things in life, I now have a framework, and my bandmates and I feel the difference.<br><br>I was dominated by impatience and wasn’t making any progress. But with Todd’s advice, it became a joy to sit behind the drums. The fear of ‘not being able’ disappeared, and the progress came! The change of grip gave me a lot more freedom and fluidity. My right foot control increased quite a bit, and I practice this as often as I can.<br><br>If you’re considering this course, I would say do it, without any doubt. The quality of the lessons, Todd's teaching and musical skills - along with his advice and approach to music - are priceless.",
                "name" => "Christian Macchion",
                "location" => "France"
                ])
            </div>
        </section>
    </div>

    @yield('final-banner')

    <section class="final">
        <div class="row">
            <div class="columns logo"><img
                        src="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/logo-white.png"></div>

            <h1 class="columns">
                Todd Sucherman’s 26-Week Online <br class="hide-for-large"> Course For Just @yield('pricing') Per Week
            </h1>
            <h2 class="columns"><em>(@yield('pricing2') one-time payment. Or choose a <br
                            class="hide-for-medium"> 2-pay or 5-pay plan on the next page.)</em></h2>
            {{--<div class="columns"><a class="join sold-out">Closed</a></div>--}}
            <div class="columns"><a href="@yield('order-link')" class="join">Get Started &raquo;</a></div>
            <div class="columns cards">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i> <i
                        class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <p class="columns final-questions">
                <span><strong>Any questions?</strong></span> You can also call us or order by phone<br
                        class="hide-for-large"> toll-free at <a href="tel:1-800-439-8921">1-800-439-8921</a><br
                        class="hide-for-medium"> or directly at <a
                        href="tel:1-604-855-7605">1-604-855-7605</a>.<br> All prices listed in USD.</p>
        </div>
    </section>
@stop
