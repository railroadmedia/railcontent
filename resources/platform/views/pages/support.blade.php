@extends('partials.layout')

@section('meta')
    <title>Support | Musora</title>
@endsection

@section('content')

    {{--  SEARCH BAR  --}}
    <section class="tw-py-16 md:tw-py-20 tw-text-[#00101D] dark:tw-text-white tw-text-center tw-relative tw-bg-[#F9F9F9] dark:tw-bg-[#002039] tw-px-4 md:tw-px-0">
        <div class="tw-container tw-mx-auto tw-relative tw-z-0 tw-max-w-xl md:tw-max-w-none">
            <h3 class="tw-text-[32px]"><strong>Advice and answers from the Musora team</strong></h3>
            <p class="tw-mt-2 tw-mb-10 tw-text-lg">Find an answer on your own or get in touch with your dedicated Musora Mentor.</p>
            <div>
                <form onsubmit="handleSearch(event)">
                    <input class="tw-border tw-border-[#D1D5DB] tw-rounded-full tw-py-3 tw-pl-4 tw-text-black md:tw-max-w-lg tw-w-full tw-mr-2 md:tw-mr-0 tw-mb-2 md:tw-mb-0" placeholder="Search the knowledgebase" id="searchInput" /> <br class="md:tw-hidden">
                    <button type="submit" class="tw-btn-primary tw-bg-[#00101D]">Search</button>
                </form>
            </div>
        </div>
    </section>

    {{--  FAQ  --}}
    <section class="tw-py-12 md:tw-py-16 tw-bg-[#F4F4F5] dark:tw-bg-[#000C17]">
        <div class="tw-max-w-4xl tw-mx-auto tw-px-4">
            <h3 class="tw-text-center tw-mb-10 dark:tw-text-white"><strong>Frequently Asked Questions</strong></h3>
            <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-3 sm:tw-gap-4">
                <a href="https://help.musora.com/article/944-how-do-i-contact-an-instructor" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-regular fa-comments tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">Instructor Feedback</p>
                    <p class="tw-text-sm">How can I get personalized feedback from my instructor?</p>
                </a>
                <a href="https://help.musora.com/article/946-how-do-i-track-my-shipment" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-sharp fa-regular fa-truck-fast tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">Shipment Tracking</p>
                    <p class="tw-text-sm">I ordered a product from you, how can I track my shipment?</p>
                </a>
                <a href="https://help.musora.com/article/953-how-do-i-download-video-lessons-and-resources" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-sharp fa-regular fa-download tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">Download Lessons</p>
                    <p class="tw-text-sm">Can I download lessons and replay them later without using data?</p>
                </a>
                <a href="https://help.musora.com/article/945-how-do-i-download-sheet-music" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-regular fa-file-music tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">Downloading Sheet Music</p>
                    <p class="tw-text-sm">How do I download or print sheet music and chord charts?</p>
                </a>
                <a href="https://help.musora.com/article/980-how-can-i-determine-my-skill-level" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-solid fa-question tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">Determine skill level</p>
                    <p class="tw-text-sm">How do I know if I’m a beginner, intermediate, or advanced?</p>
                </a>
                <a href="https://help.musora.com/article/1064-where-do-i-find-my-billing-history-and-invoices" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-regular fa-file-invoice-dollar tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">Billing Information</p>
                    <p class="tw-text-sm">Where can I find my billing history and invoices?</p>
                </a>
                <a href="https://help.musora.com/article/377-how-do-i-cancel-my-membership" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-light fa-circle-xmark tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">End membership</p>
                    <p class="tw-text-sm">How can I make sure my subscription doesn't renew?</p>
                </a>
                <a href="https://help.musora.com/article/1062-what-are-the-terms-for-your-refund-policy" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fa-regular fa-circle-dollar tw-text-3xl md:tw-text-4xl tw-mb-3"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">Request a Refund</p>
                    <p class="tw-text-sm">I purchased less than 90 days ago and I would like a refund.</p>
                </a>
            </div>
        </div>
    </section>

    {{--  FORM  --}}
    <section class="tw-py-12 md:tw-py-16 tw-px-4 lg:tw-px-8 tw-bg-white dark:tw-bg-[#081825] dark:tw-text-white" id="contactPageApp">
        <div class="tw-container tw-max-w-3xl tw-mx-auto tw-text-center">
            <h3><strong>Reach Out Directly</strong></h3>
            <p class="tw-mt-4 tw-mb-5 tw-text-sm md:tw-text-base tw-max-w-3xl tw-mx-auto">
                Get in touch with your dedicated Musora Mentor!
            </p>
            <div class="tw-text-left">
                @include('partials.bladesora.members.partials._support', [
                    "themeColor" => $brand,
                    "brand" => $brand,
                    "internationalNumber" => "1-604-855-7605",
                    "tollFree" => "1-800-439-8921",
                    "emailRecipient" => $emailRecipient,
                    "emailSubject" => "Support Request from: " . user()->display_name . " (" . user()->email . ")",
                    "emailType" => "support-contact",
                    "emailInputLabel" => "Report your issue here..",
                    "emailEndpoint" => '/mailora/secure/send',
                    "emailLogo" => $logoLink,
                    "emailSuccessMessage" => "Your email has been sent!",
                    "emailAddress" => $emailRecipient
                ])
            </div>
        </div>
    </section>

    {{--  UERGEN REQUEST  --}}
    <section class="tw-bg-[#F4F4F5] dark:tw-bg-[#000C17] tw-py-12 md:tw-py-16 tw-px-4 dark:tw-text-white">
        <div class="tw-max-w-4xl tw-mx-auto">
            <h3 class="tw-text-center tw-mb-7"><strong>Have A More Urgent Request? Give Us A Shout.</strong></h3>
            <div class="md:tw-grid md:tw-grid-cols-3 md:tw-gap-6 tw-max-w-sm tw-mx-auto md:tw-max-w-none">
                <div class="md:tw-border md:tw-border-[#AAACAA] md:tw-rounded-xl tw-flex tw-items-center md:tw-justify-center tw-py-4 md:tw-py-6 tw-px-2">
                    <i class="fa-regular fa-phone-volume tw-text-3xl tw-mr-6"></i>
                    <div class="tw-text-sm">
                        <strong class="tw-font-bold">Toll Free:</strong> <br class="tw-hidden md:tw-inline">
                        1-800-439-8921
                    </div>
                </div>
                <div class="md:tw-border md:tw-border-[#AAACAA] md:tw-rounded-xl tw-flex tw-items-center md:tw-justify-center tw-py-4 md:tw-py-6 tw-px-2">
                    <i class="fa-regular fa-globe tw-text-3xl tw-mr-6"></i>
                    <div class="tw-text-sm">
                        <strong class="tw-font-bold">Direct/International:</strong> <br class="tw-hidden md:tw-inline">
                        1-604-855-7605
                    </div>
                </div>
                <div class="md:tw-border md:tw-border-[#AAACAA] md:tw-rounded-xl tw-flex tw-items-center md:tw-justify-center tw-py-4 md:tw-py-6 tw-px-2">
                    <i class="fa-regular fa-clock tw-text-3xl tw-mr-6"></i>
                    <div class="tw-text-sm">
                        <strong class="tw-font-bold">Office Hours:</strong> <br class="tw-hidden md:tw-inline">
                        Monday - Friday<br>
                        8AM - 4PM Pacific Time
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('layout-scripts')
    <script>
        function handleSearch(e) {
            e.preventDefault();
            const keyword = document.getElementById('searchInput').value;
            if(keyword){
                window.location = `https://help.{{ $brand }}.com/search?query=${keyword}`;
            }
        }
    </script>
@endsection
