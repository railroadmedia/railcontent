<template>
    <div class="tw-py-32 lg:tw-pt-40 tw-relative tw-px-4 xl:tw-px-0 tw-bg-white dark:tw-bg-[#000B17]">
        <div class="tw-absolute tw-w-full tw-h-1/2 tw-left-0 tw-top-0">
            <img class="tw-w-full tw-h-full tw-object-cover" src="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/header-bg.jpg" alt="header bg" />
        </div>
        <div class="tw-max-w-4xl tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3 tw-rounded-xl tw-bg-white tw-relative tw-z-30 dark:tw-bg-[#303030] dark:tw-text-white tw-pt-24 md:tw-pt-32 lg:tw-pt-40 tw-pb-16 tw-text-center" style="box-shadow: rgba(0, 0, 0, 0.25) 5px 5px 20px;">
            <div class="tw-absolute tw-w-full -tw-top-4 sm:-tw-top-6 md:-tw-top-8 tw-left-0">
                <img class="tw-w-full" src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/leaves.png" alt="leaves" />
            </div>
            <div class="tw-flex tw-justify-center tw-absolute -tw-top-24 sm:-tw-top-32 lg:-tw-top-40 tw-left-0 tw-w-full">
                <img class="tw-h-48 sm:tw-h-56 md:tw-h-64 lg:tw-h-80 tw-mx-auto tw-mb-6 tw-transition-opacity" src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/gift-card.png" alt="gift card" onload="this.classList.remove('tw-opacity-0')" loading="lazy">
            </div>
            <img class="tw-h-24 lg:tw-h-32 tw-inline-block tw-mb-4" src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/12-days-title.svg" alt="12 days title" />
            <h3 class="tw-font-normal tw-mb-4 "> Give your friends and family members <br class="tw-hidden sm:tw-inline" />a {{ brandName }} 30-day trial for a chance to<br /> <strong class="tw-font-extrabold">win a $100 Musora Gift Card.</strong>
            </h3>
            <p>
                Share the gift of {{ lessons }} this holiday season.
            </p>
            <p class="tw-mt-2">
                Every referral you make <strong>from December 11 to 22, 2023</strong><br class="tw-hidden sm:tw-inline" /> instantly gives you a chance to win one of 12 $100 Musora gift cards.
            </p>
            <p class="tw-mt-6 tw-mb-4">
                <a href="#terms" class="tw-underline tw-italic tw-text-black dark:tw-text-white">See Contest Details - Terms & Conditions*</a>
            </p>

            <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center">
                <div class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-lg md:tw-max-w-2xl tw-mx-auto">
                    <form id="invite-email-form" name="invite-email-form" @submit.prevent="sendPass" inspfaactive="true">
                        <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-2 tw-uppercase tw-text-sm tw-tracking-wide" for="email"><b>Invite via email</b></label>
                        <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                            <input type="hidden" name="_token" class="sort-input has-input" id="_token" value="8UVOL6wfWwdRywCAMgMQ1e9PmrA5HnZVqhRk7ezn"><input type="hidden" name="brand" class="sort-input has-input" id="brand" value="drumeo">
                            <input v-model="inviteeEmail" class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-2 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border" type="email" id="email" name="email" placeholder="Email address...">
                            <input name="button" type="submit" id="button" class="tw-btn-primary tw-bg-[#030814] tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52 has-input" value="SHARE 30-DAY TRIAL">
                        </div>
                    </form>
                    <hr class="tw-mt-6">
                    <form id="invite-link-form" name="invite-link-form" action="#" inspfaactive="true">
                        <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-2 tw-uppercase tw-text-sm tw-tracking-wide" for="email"><b>Share your link</b>
                        </label>
                        <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                            <input class="tw-text-black tw-inline-block tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-2 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border has-input" type="text" id="referral-link" readonly="" name="referral-link" placeholder="link" :value="userReferralLink">
                            <input @click="copyLink" name="button" id="sendButton" readonly="" class="tw-bg-[#030814] tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52 has-input" value="Copy Link">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="tw-bg-[#00101D] tw-py-10 lg:tw-py-20 tw-bg-cover tw-bg-[url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/info-section-bg.jpg')]">
        <div class="tw-max-w-5xl tw-mx-auto md:tw-flex md:tw-items-center md:tw-justify-center tw-px-4 sm:tw-px-6 xl:tw-px-0">
            <div class="tw-order-1 tw-relative md:tw-pl-5 lg:tw-pl-10 tw-mb-10 md:tw-mb-0">
                <img
                    class="tw-w-72 md:tw-w-96 tw-mx-auto"
                    src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/leaf-ring.png"
                    alt="leaf ring"
                />
            </div>
            <div class="tw-text-white tw-max-w-lg tw-mx-auto tw-text-center md:tw-text-left">
                <p class="tw-uppercase tw-text-sm tw-mb-2">Got more musical friends? </p>
                <h3 class="tw-leading-tight">
                    <strong>You can refer them to {{ !isDrumeo ? 'Drumeo, ' : '' }}{{ !isPianote ? 'Pianote, ' : '' }}{{ isSingeo ? 'and ' : '' }}{{ !isGuitareo ? 'Guitareo' : '' }}{{ !isSingeo && !isGuitareo ? ', ' : ''}}{{ !isSingeo ? 'and Singeo' : '' }} too.</strong>
                </h3>
                <div class="tw-flex tw-items-center tw-justify-center md:tw-justify-start tw-my-5 tw-text-sm md:tw-text-base tw-max-w-[410px] md:tw-max-w-none tw-mx-auto">
                    <i :class="`fa-light fa-calendar-days tw-text-${brand} tw-text-2xl tw-mr-4`"></i> <span>12 Days of Giving Referral Contest - <b>December 11 to 22, 2023</b></span>
                </div>
                <div class="tw-flex tw-items-center tw-justify-center md:tw-justify-start tw-my-5 tw-text-sm md:tw-text-base">
                    <i :class="`fa-regular fa-gift tw-text-${brand} tw-text-2xl tw-mr-4`"></i> <span>Refer & Enter to <b>Win one of 12 $100 Musora Gift Cards.</b></span>
                </div>
                <i class="tw-text-sm">
                    30-day trials are for new subscribers only and cannot be redeemed for renewals, extensions, or gift subscriptions.
                </i>
                <div class="tw-mt-6 tw-flex tw-flex-col md:tw-flex-row">
                    <a v-if="!isDrumeo" href="/drumeo/referral/invite-a-friend" class="tw-btn-secondary tw-text-drumeo tw-px-4 tw-mr-0 md:tw-mr-2 tw-mb-3 md:tw-mb-0 tw-text-base hover:tw-bg-drumeo hover:tw-text-white">Refer to Drumeo</a>
                    <a v-if="!isPianote" href="/pianote/referral/invite-a-friend" class="tw-btn-secondary tw-text-pianote tw-px-4 tw-mr-0 md:tw-mr-2 tw-mb-3 md:tw-mb-0 tw-text-base hover:tw-bg-pianote hover:tw-text-white">Refer to Pianote</a>
                    <a v-if="!isGuitareo" href="/guitareo/referral/invite-a-friend" :class="`tw-btn-secondary tw-text-guitareo tw-px-4 tw-mb-3 md:tw-mb-0 ${ !isSingeo ? 'tw-mr-0 md:tw-mr-2' : ''} tw-text-base hover:tw-bg-guitareo hover:tw-text-white`">Refer to Guitareo</a>
                    <a v-if="!isSingeo" href="/singeo/referral/invite-a-friend" class="tw-btn-secondary tw-text-singeo tw-px-4 tw-mb-0 tw-text-base hover:tw-bg-singeo hover:tw-text-white">Refer to Singeo</a>
                </div>
            </div>
        </div>
    </div>
    <div id="terms" class="tw-block tw-relative tw-invisible"></div>
    <div class="tw-py-12 lg:tw-py-20 tw-bg-[#F9F9F9] dark:tw-bg-[#000B17]">
        <div class="tw-max-w-6xl tw-mx-auto tw-px-6 2xl:tw-px-0 dark:tw-text-white">
            <h4 class="tw-mb-4"><strong>Terms and Conditions</strong></h4>
            <p>
                <strong>Eligibility:</strong> This contest is open to Musora students with an active, paid membership and newly referred students, 18 years or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.
                <br><br>
                <strong>How to Enter:</strong> Participants automatically receive an entry to the contest when a referred friend signs up for a membership with a 30-day trial from December 11 to 22, 2023. Participants may collect up to (5) contest entries for {{ brandName }} based on each referral sign-up during the contest period; for a total of (20) contest entries across all Musora brands. New students who sign up for {{ brandName }} will gain one contest entry. No purchase is necessary to enter or win.
                <br><br>
                <strong>Prize:</strong> Twelve students will win a $100 Musora gift card redeemable inside the Drumeo, Pianote, Guitareo, and Singeo shops. The prizes are non-transferable and cannot be exchanged for cash.
                <br><br>
                <strong>Winner Selection:</strong> The winner will be randomly selected from all eligible entries received during the contest period. The winner will be notified by email or direct message within 48 hours of the selection. If the winner does not respond within 48 hours, another winner will be selected.
                <br><br>
                <strong>Release:</strong> By entering the contest, participants release and hold harmless the sponsor, their affiliates, and their respective officers, directors, employees, and agents from any liability or any injury, loss, or damage of any kind arising from or in connection with the contest or any prize won.
                <br><br>
                <strong>General Conditions:</strong> The sponsor reserves the right to cancel, suspend, or modify the contest if fraud, technical failures, or any other factor beyond their control impairs the contest's integrity, as determined by the sponsor in their sole discretion. The sponsor reserves the right to disqualify any individual who violates these Terms and Conditions or interferes with the contest in any way.
                <br><br>
                <strong>Governing Law:</strong> The contest shall be governed by and construed by the laws of the country where the contest is held, without regard to conflicts of law principles.
                <br><br>
                <strong>Privacy:</strong> Personal information collected from participants will be used only to administer the contest and will not be shared with any third party except as necessary to fulfill the prize.
                <br><br>
                By participating in the contest, participants agree to be bound by these Terms and Conditions.
            </p>
        </div>
    </div>

    <ModalRenderer v-if="isModalOpen">
        <div class="tw-flex tw-justify-center tw-items-center" style="background:transparent!important;">
            <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-5 sm:tw-px-8 tw-py-6 sm:tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
                <div class="tw-text-2xl tw-font-bold">Thanks for sharing your love for music!</div>
                <p class="tw-mt-3 tw-mb-5 tw-max-w-md tw-mx-auto">
                    You've successfully sent <span id="modalEmail">{{ inviteeEmail }}</span>
                    <br class="tw-hidden sm:tw-inline-block"> a 30-Day Trial to {{ brandName }}.
                </p>
                <div>
                    <span @click="closeModal"  class="tw-btn-primary tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white dark:tw-bg-[#000C17] dark:tw-border-white dark:tw-text-white tw-mr-2 dark:hover:tw-bg-white dark:hover:tw-text-[#000C17]">Close</span>
                </div>
            </div>
        </div>
    </ModalRenderer>
</template>

<script setup>
import {computed, inject, ref} from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "../../stores/user";
import ModalRenderer from "../components/Modal/ModalRenderer";

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const token = inject('csrf_token');

const props = defineProps({
    userReferralLink: {
        type: String,
        required: true,
    },
    emailInviteUrl: {
        type: String,
        required: true,
    },
});

const isModalOpen = ref(false);
const inviteeEmail = ref('');

const brandName = computed(() => {
    return brand.value.charAt(0).toUpperCase() + brand.value.slice(1);
})

const isDrumeo = computed(() => {
    return brand.value === 'drumeo';
})

const isPianote = computed(() => {
    return brand.value === 'pianote';
})

const isGuitareo = computed(() => {
    return brand.value === 'guitareo';
})

const isSingeo = computed(() => {
    return brand.value === 'singeo';
})

const lessons = computed(() => {
    const lessons = {
        drumeo: 'playing drums',
        pianote: 'playing piano',
        guitareo: 'playing guitar',
        singeo: 'singing',
    }

    return lessons[brand.value];
})

const closeModal = () => {
    //close modal
    isModalOpen.value = false;

    //blank input
    inviteeEmail.value = '';

    //remove red background
    email.classList.remove('tw-bg-red-200');
}

const copyLink = () => {
    let link = document.getElementById("referral-link");
    navigator.clipboard.writeText(link.value);
    window.shownotification({
        icon: 'fa-file-import',
        text: `Link copied to clipboard.`
    });
}

const sendPass = () => {
    let email = document.getElementById('email');
    const emailFormat = /^\w+([\.-^+]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    let data = {
        _token: token,
        brand: brand.value,
        email: inviteeEmail.value,
    };

    if(inviteeEmail.value.match(emailFormat)){
        fetch(props.emailInviteUrl, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then((res) => {
            //open modal
            isModalOpen.value = true;
        })
    }
    else {
        email.classList.add('tw-bg-red-200');
    }
}
</script>
