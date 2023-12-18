<template>
    <!-- SEARCH BAR -->
    <section class="tw-py-16 md:tw-py-20 tw-text-[#00101D] dark:tw-text-white tw-text-center tw-relative tw-bg-[#F9F9F9] dark:tw-bg-[#002039] tw-px-4 md:tw-px-0">
        <div class="tw-container tw-mx-auto tw-relative tw-z-0 tw-max-w-xl md:tw-max-w-none">
            <h3 class="tw-text-[32px]"><strong>Advice and answers from the Musora team</strong></h3>
            <p class="tw-mt-2 tw-mb-10 tw-text-lg">Find an answer on your own or get in touch with our support team.</p>
            <div>
                <form @submit.prevent="handleSearch">
                    <input class="tw-border tw-border-[#D1D5DB] tw-rounded-full tw-py-3 tw-pl-4 tw-text-black md:tw-max-w-lg tw-w-full tw-mr-2 md:tw-mr-0 tw-mb-2 md:tw-mb-0" placeholder="Search the knowledgebase" id="searchInput" /> <br class="md:tw-hidden">
                    <button type="submit" class="tw-btn-primary tw-bg-[#00101D]">Search</button>
                </form>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="tw-py-12 md:tw-py-16 tw-bg-[#F4F4F5] dark:tw-bg-[#000C17]">
        <div class="tw-max-w-4xl tw-mx-auto tw-px-4">
            <h3 class="tw-text-center tw-mb-10 dark:tw-text-white"><strong>Frequently Asked Questions</strong></h3>
            <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-3 sm:tw-gap-4">
                <div v-for="question in questions" class="tw-bg-[#030814] dark:tw-bg-white tw-text-white dark:tw-text-[#000C17] tw-text-center tw-rounded-xl tw-px-3 tw-py-6 sm:tw-py-9 tw-relative" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i :class="`tw-text-3xl md:tw-text-4xl tw-mb-3 ${question.icon}`"></i>
                    <p class="tw-font-bold tw-mb-1 tw-text-sm">{{ question.title }}</p>
                    <p class="tw-text-sm">{{ question.question }}</p>
                    <a href="#" :data-beacon-article-sidebar="question.beacon" class="tw-absolute tw-inset-0" :aria-label="question.title"></a>
                </div>
            </div>
        </div>
    </section>

    <!-- FORM -->
    <section class="tw-py-12 md:tw-py-16 tw-px-4 lg:tw-px-8 tw-bg-white dark:tw-bg-[#081825] dark:tw-text-white" id="contactPageApp">
        <div class="tw-container tw-max-w-3xl tw-mx-auto tw-text-center">
            <h3><strong>Reach Out Directly</strong></h3>
            <p class="tw-mt-4 tw-mb-5 tw-text-sm md:tw-text-base tw-max-w-3xl tw-mx-auto">
                Get in touch with our support team!
            </p>
            <div class="tw-text-left">
                <div class="tw-flex tw-flex-col tw-max-w-3xl tw-mx-auto tw-px-4">
                    <section class="tw-flex tw-flex-row tw-flex-wrap tw-my-[30px] tw-w-full">
                        <div class="tw-flex tw-flex-col tw-w-full">
                            <ContactMemberEmailForm
                                :brand="brand"
                                :email-subject="emailSubject"
                                :email-type="emailType"
                                :email-endpoint="emailEndpoint"
                                :email-logo="emailLogo"
                                :email-alert="emailSubject"
                                input-label="Report your issue here.."
                                :lesson-page="false"
                                :recipient="emailRecipient"
                                :success-message="emailSuccessMessage "
                            />
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <!-- URGENT REQUEST -->
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
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../stores/user";
import ContactMemberEmailForm from "../vuesora/components/ContactMemberEmailForm/ContactMemberEmailForm";

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    emailRecipient: {
        type: String,
        default: null
    },
    emailLogo: {
        type: String,
        default: null
    },
    emailSubject: {
        type: String,
        default: () => '',
    },
    emailType: {
        type: String,
        default: () => '',
    },
    emailEndpoint: {
        type: String,
        default: () => '',
    },
    emailSuccessMessage: {
        type: String,
        default: () => '',
    },
})

const handleSearch = () => {
    const keyword = document.getElementById('searchInput').value;
    if(keyword){
        window.location = `https://help.musora.com/search?query=${keyword}`;
    }
}

const questions = [
    {
        title: 'Instructor Feedback',
        question: 'How can I get personalized feedback from my instructor?',
        beacon: '634b281d4d805871ceaa3acb',
        icon: 'fa-regular fa-comments',
    },
    {
        title: 'Shipment Tracking',
        question: 'I ordered a product from you, how can I track my shipment?',
        beacon: '634b2901927a2c1634dfac43',
        icon: 'fa-sharp fa-regular fa-truck-fast',
    },
    {
        title: 'Download Lessons',
        question: 'How do I download or print sheet music and chord charts?',
        beacon: '636ed0fe190e8f786b443e0f',
        icon: 'fa-sharp fa-regular fa-download',
    },
    {
        title: 'Downloading Sheet Music',
        question: 'How do I download or print sheet music and chord charts?',
        beacon: '634b2887de258f5018eb4af3',
        icon: 'fa-regular fa-file-music',
    },
    {
        title: 'Determine skill level',
        question: 'How do I know if I’m a beginner, intermediate, or advanced?',
        beacon: '637fdfec9d8f1448fb81874e',
        icon: 'fa-solid fa-question',
    },
    {
        title: 'Billing Information',
        question: 'Where can I find my billing history and invoices?',
        beacon: '6467ba0017da4d6b8d6f0963',
        icon: 'fa-regular fa-file-invoice-dollar',
    },
    {
        title: 'End membership',
        question: 'How can I make sure my subscription doesn\'t renew?',
        beacon: '6080966ae0324b5fdfd0d608',
        icon: 'fa-light fa-circle-xmark',
    },
    {
        title: 'Request a Refund',
        question: 'I purchased less than 90 days ago and I would like a refund.',
        beacon: '6467b2256413a34741154344',
        icon: 'fa-regular fa-circle-dollar',
    },
];
</script>
