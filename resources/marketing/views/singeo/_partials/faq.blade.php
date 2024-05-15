@php
    $faqs = [
        [
        "title" => "What is Singeo?",
        "desc" => "Singeo is an immersive online platform designed to help you unleash the full potential of your voice. It offers unlimited singing lessons, access to vocal coaches, and the support of a community. The method focuses on expression, technique, and performance, enabling you to find and refine your true voice. Whether you're starting out or already have experience, Singeo has the resources to elevate your singing​.",
        ],

        [
        "title" => "How can Singeo help me improve my voice?",
        "desc" => "Warm-ups are crucial for a great singing session. Singeo provides quick and effective warm-up routines, accessible at any time, to prepare your voice. These routines can fit any schedule, ensuring you\'re ready to sing confidently, whether you have 5 or 20 minutes to spare.",
        ],

        [
        "title" => "What can I expect from Singeo's lessons?",
        "desc" => "Singeo's lessons are designed to be practical and engaging. You'll find on-screen assignments, practice tools, and downloadable videos to guide your progress. With lessons crafted for every style, era, and skill level, you can develop your skills through guided practice sessions, song breakdowns, and techniques to improve your timing and note recognition.",
        ],

        [
        "title" => "Does Singeo offer support for intermediate and advanced singers?",
        "desc" => "Absolutely! For singers looking to dive deeper, Singeo offers courses that enhance vocal techniques like vibrato, falsetto, belting, and vocal runs. Advanced singers can also benefit from music theory lessons, ear training, and even songwriting guidance, all aimed at polishing your skills and style.",
        ],

        [
        "title" => "I'm interested in writing songs. Can Singeo help me with that?",
        "desc" => "Singeo not only helps you with your singing technique but also nurtures your songwriting skills. With specialized courses on composing lyrics, songwriting for singers, and recording your voice, you’ll gain the tools to start crafting your own songs and expressing your musical identity​.",
        ],

        [
        "title" => "How can I ensure continuous improvement with Singeo?",
        "desc" => "Singeo encourages building better habits with bite-sized sessions that make it easy to practice more often. You'll never practice alone as the platform offers guided sessions where you can learn and play along with your favorite singers and teachers",
        ],

        [
        "title" => "What does Singeo offer for singers who want to perform live?",
        "desc" => "When you're ready to step into the spotlight, Singeo has you covered. The platform includes resources that prepare you for live performances, helping you develop the confidence and skills needed to take your singing from the practice room to the stage​",
        ],
        [
            "title" => "Do I get free access to Drumeo, Pianote, and Guitareo with my Singeo Membership?",
            "desc" => "Absolutely! As a Singeo member, you'll receive free access to Pianote, Drumeo, and Guitareo as well. Elevate your musical journey with us by exploring additional instruments and expanding your musical horizons!",
        ],
        [
            "title" => "Am I too old to start singing lessons?",
            "desc" => "You’re never too old to start a musical journey. Singeo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with singers just like you who are learning and applying their skills to the songs they love. ",
        ],
    ]
@endphp


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
