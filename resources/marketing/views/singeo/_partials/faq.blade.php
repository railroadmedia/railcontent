@php
    $faqs = [
        [
            "title" => "What is Singeo?",
            "desc" => 'Singeo is an online platform that offers an organized vocal curriculum, artist courses on popular topics, 1000+ songs with sheet music, and a supportive global community of students and teachers.',
        ],
        [
            "title" => "Is Singeo good for beginners?",
            "desc" => 'Yes! You’ll always know what to work on with step-by-step video lessons – plus have fun applying your new skills to your favorite songs. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community.',
        ],
        [
            "title" => "Does Singeo have anything for advanced singers?",
            "desc" => 'Singeo is the perfect companion for advanced singers, giving you access to artist courses so you can gain insights and inspiration from Grammy Award winners, chart-topping performers, and trending vocalists – with a growing library of artist courses on a variety of topics.',
        ],
        [
            "title" => "Am I too old to start singing lessons?",
            "desc" => 'You’re never too old to start a musical journey. Singeo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with singers just like you who are learning and applying their skills to the songs they love. ',
        ],
        [
            "title" => "Do I need to be tech-savvy to learn through your app?",
            "desc" => 'Not at all! Technology is here to make your life easier, and Singeo is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support. ',
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
