@php
    $faqs = [
        [
        "title" => "What is Guitareo?",
        "desc" => 'Guitareo is your personal guitar mentor online, offering a comprehensive learning experience with a step-by-step curriculum. Whether you are a beginner picking up the guitar for the first time or an advanced player looking to refine your skills, Guitareo provides tailored lessons to suit your level. With a supportive global community, direct access to real teachers, and over a thousand popular songs to learn, Guitareo is designed to make your musical journey enjoyable and successful. From reading tabs and mastering chords to exploring new styles and creating your own music, Guitareo is a full spectrum platform that grows with you as you progress on your guitar adventure​.',
        ],
        [
        "title" => "What makes Guitareo the perfect choice for someone who's never touched a guitar before?",
        "desc" => 'For beginners, Guitareo stands out with its foundational lessons that cater specifically to those picking up a guitar for the first time. With lessons like "Getting Started on the Acoustic Guitar" and "Electric Guitarists Start Here," you’ll find a nurturing environment that encourages and grows your natural talent.',
        ],
        [
        "title" => "What's the first milestone I can look forward to with Guitareo?",
        "desc" => 'As a Guitareo student, your first thrilling milestone will be mastering the basics of rhythm. You\'ll quickly learn essential strumming patterns that will enable you to turn chords into actual music. Expect to have this solid foundation within your first lessons, paving the way for your guitar journey.',
        ],
        [
        "title" => "Do I need any musical background to succeed with Guitareo?",
        "desc" => 'Not at all! Guitareo welcomes music lovers with open arms, no matter their starting point. You’ll be guided through a step-by-step curriculum designed to build your skills from the ground up. With a mix of theory and practical lessons, your lack of musical background won\'t hold you back.',
        ],
        [
        "title" => "Can Guitareo help me with finger placement and strumming techniques?",
        "desc" => 'Yes, Guitareo covers the essentials of finger placement and strumming techniques right from the start. You\'ll get detailed guidance on forming chords, developing a clean strum, and transitioning smoothly between chords. Plus, with exercises and challenges, you\'ll get plenty of practice.',
        ],
        [
        "title" => "What kind of support does Guitareo offer when I hit a roadblock?",
        "desc" => 'Whenever you face a challenge, Guitareo\'s community and instructors are there to support you through live Q&A sessions, direct feedback, and a treasure trove of resources. You\'re never alone on your guitar-playing journey with such an accessible and helpful community.',
        ],
        [
        "title" => "How does Guitareo keep me motivated during the learning process?",
        "desc" => 'Your motivation is fueled by Guitareo\'s engaging lesson structure, which includes practice challenges, the ability to learn iconic songs, and a platform that celebrates each step forward. Plus, you\'ll join a community of fellow students where you can share progress and inspiration.',
        ],
        [
        "title" => "How does Guitareo adapt to my pace of learning?",
        "desc" => 'Your pace sets the pace at Guitareo. With an on-demand lesson structure, you can repeat lessons as needed or skip ahead when you feel ready. Plus, the platform\'s interactive tools allow you to practice at the speed that\'s comfortable for you, ensuring that you learn at a pace that suits your lifestyle and abilities.',
        ],
        [
        "title" => "Does Guitareo offer resources for seasoned guitarists to advance further?",
        "desc" => 'Absolutely. Guitareo understands that mastery is an ongoing journey. That’s why we offer artist courses and specialized lessons aimed at experienced guitarists. Dive into advanced topics like soloing techniques, complex chord variations, and genre-specific styles to elevate your play. With access to lessons from Grammy Award winners and chart-topping artists, you can refine your skills, learn new ones, and stay inspired. Each course is designed to challenge and expand your musical vocabulary, ensuring there\'s always something new to discover, no matter how advanced you are',
        ],
        [
        "title" => "Do I get free access to Drumeo, Singeo, and Pianote with my Guitareo Membership?",
        "desc" => "Absolutely! As a Guitareo member, you'll receive free access to Pianote, Singeo, and Drumeo as well. Elevate your musical journey with us by exploring additional instruments and expanding your musical horizons!",
        ],
        [
            "title" => "Am I too old to start guitar lessons?",
            "desc" => 'You’re never too old to learn guitar. Guitareo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with aspiring guitarists just like you who are learning and applying their skills to music.',
        ],
    ]
@endphp
<div id="questions" class="anchor"></div>
<section class="py-12 md:py-20">
    <div class="container mx-auto max-w-5xl px-6">
        <h2 class="font-extrabold mb-10 text-center">Frequently Asked Questions</h2>
        @foreach($faqs as $faq)
            @include('_partials.components.question-dropdown', [
                'num' => '?',
                "title" => $faq['title'],
                "desc" => $faq['desc'],
            ])
        @endforeach
    </div>
</section>
