@php
    $faqs = [
        [
        "title" => "Does this include all instruments?",
        "desc" => "Yep! Every account has access to piano, guitar, drums, and singing – because learning is learning, and we don’t think you should pay more just because you want to play something else for a while.",
        ],
        [
        "title" => "How much practice time is required?",
        "desc" => "Everybody’s different. We’re not here to say you’re going to become Jimmy Hendrix overnight!<br><br>Practice matters – and in as little as 10 minutes a day, you’re going to gain momentum that can never be taken away. We’ll help you build good habits and learn the essential skills and techniques – and sooner than you think, you will be able to play the songs you love.<br><br>Got more time? Even better :)",
        ],
        [
        "title" => "Why are you better than other lessons?",
        "desc" => 'We’re big believers in a holistic approach: learn, practice, play, and connect. (Great lessons, engaging practice tools, tons of songs, and an engaging community.)<br><br>We’re unique because we value student connection – and you’ll always have access to real teachers, live events, and like-minded students to support you along the way.',
        ],
        [
        "title" => "What’s with the trial and guarantee?",
        "desc" => 'The 7-day trial is meant to let you ‘check under the hood’ and make sure the website, apps, and technology all fits your style.<br><br>The 90-day guarantee is there to make sure you actually love your lessons, practice tools, songs, and PROGRESS. We only want you to pay if you’re actually happy with the results!',
        ],
        [
        "title" => "Is this right for beginners? Intermediates? Advanced?",
        "desc" => 'Yes, yes, and yes! While beginners and intermediates will get the most from our lessons and practice tools – advanced musicians will love the songs tools and community. No matter your age or skill level, there’s something for you. (And hey, if you’re not sure – just try! You’ll see for yourself.)',
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
