@php
    $faqs = [
        [
            "title" => "What is Pianote?",
            "desc" => 'Pianote is an online platform that offers an organized piano lesson curriculum, artist courses on popular topics, 1000+ songs transcribed note-for-note, and a supportive global community of students and teachers.',
        ],
        [
            "title" => "Is Pianote good for beginners?",
            "desc" => 'Yes! You’ll always know what to practice with step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
        ],
        [
            "title" => "Does Pianote have anything for advanced pianists?",
            "desc" => 'Pianote is the perfect companion for advanced pianists, giving you access to artist courses so you can gain insights and inspiration from professionals. Plus, you’ll get note-for-note sheet music for thousands of songs and practical playback tools, so you can take on any new challenge with confidence.',
        ],
        [
            "title" => "Am I too old to learn piano?",
            "desc" => 'You’re never too old to learn piano. Pianote has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with aspiring pianists just like you who are learning and applying their skills to music.',
        ],
        [
            "title" => "Do I need to be tech-savvy to learn through your app?",
            "desc" => 'Not at all! Technology is here to make your life easier, and Pianote is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support.',
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
