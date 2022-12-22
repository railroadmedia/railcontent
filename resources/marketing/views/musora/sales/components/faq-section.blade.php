<section class="text-center py-10 md:py-20 lg:py-24 px-4 sm:px-6">
    <div class="container mx-auto max-w-6xl">
        <h2><strong>Frequently Asked Questions</strong></h2>
        <div class="dropdowns my-5 sm:my-10">

            @foreach($faqs as $faq)
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
        </div>
        <p class="leading-tight"><strong>Still have questions?</strong> Call us toll-free at 1-800-439-8921, directly at<br class="hidden sm:inline">
            1-604-855-7605 or start a chat with us in the bottom right corner of any page!</p>
    </div>
</section>
