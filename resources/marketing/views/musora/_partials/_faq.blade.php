@php
    $faqs = [
        [
        "title" => "What is Musora?",
        "desc" => "Musora is a dynamic online platform offering comprehensive music education across various instruments including piano, guitar, drums, and singing. It integrates world-class teaching with innovative practice tools and a supportive community to enhance musical skills at any level​!",
        ],
        [
        "title" => "What type of practice tools does Musora offer?",
        "desc" => "Musora enriches the learning experience with a suite of interactive practice tools, including exercises with speed control, looping options, and progress tracking. Additionally, students benefit from a vibrant community where they can interact with other learners and receive live feedback, further enhancing their practice and engagement. These tools are specifically designed to help students master musical concepts at their own pace and revisit challenging sections as needed, all while being part of a supportive and interactive musical environment​.",
        ],
        [
        "title" => "Can I learn different musical instruments with Musora?",
        "desc" => "Yes, Musora offers comprehensive lessons for a variety of instruments including piano, guitar, drums, and singing. The best part is you can choose where to start based on your current level. For total beginners, Musora provides step-by-step guidance to help you get started comfortably. If you're more advanced, you can select from a range of specialized workouts designed to help you perfect your craft. This flexibility allows every learner to tailor their education path to their specific needs and goals​.",
        ],
        [
        "title" => "How does Musora support a beginner's musical journey?",
        "desc" => "Musora supports beginners on piano, guitar, drums, and singing with an encouraging start that combines step-by-step guidance and live feedback, tailored to each instrument. By offering a mix of foundational lessons and live interactions, beginners can see progress quickly, overcome early challenges, and stay motivated. This approach ensures that every learner, regardless of their starting point, can fall in love with their instrument and enjoy their musical journey from day one​",
        ],
        [
        "title" => "What makes Musora’s platform unique?",
        "desc" => "Musora boasts a team of world-class instructors across all its musical disciplines. These instructors include Grammy Award winners and touring musicians, ensuring that students receive expert guidance and insight from some of the worlds most renowned musicians. This high level of expertise helps students of all skill levels—from beginners to advanced learners—achieve their musical goals with the most effective techniques and inspiring lessons​.",
        ],
        [
        "title" => "How flexible is learning with Musora?",
        "desc" => "Musora offers great flexibility in learning; students can stream lessons live or download them to practice offline at their convenience. The platform also features on-demand courses, allowing students to focus on specific skills or topics that interest them the most. This personalized approach helps students stay motivated and enjoy their learning process, as they can tailor their educational experience to match their personal interests and goals​.",
        ],
        [
        "title" => "What commitments does Musora require from its students?",
        "desc" => "Starting with Musora is a breeze and totally risk-free! When you sign up, you'll enjoy a free trial that lets you explore all that Musora has to offer. After the trial, you can choose to continue with a monthly or annual subscription. We understand the importance of a good fit, so if you find it's not quite right for you, there’s a 90-day money-back guarantee. We're here to make sure you love your musical journey and feel great about your progress every step of the way!",
        ],
        [
        "title" => "Does this include all instruments?",
        "desc" => "Yep! Every account has access to piano, guitar, drums, and singing – because learning is learning, and we don’t think you should pay more just because you want to play something else for a while.",
        ],
        [
            "title" => "Am I too old to start music lessons?",
            "desc" => "You’re never too old to start a musical journey. Musora has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with aspiring musicians just like you who are learning and applying their skills to music.",
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
