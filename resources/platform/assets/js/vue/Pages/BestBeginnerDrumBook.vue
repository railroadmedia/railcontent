<template>
    <header id="bestBookHeader" class="tw-w-full tw-px-[10px] lg:tw-px-[15px] tw-py-[50px]">
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
            <div class="tw-flex tw-items-center">
                <div class="tw-px-[10px] lg:tw-px-[15px] tw-mb-[15px] sm:tw-w-2/3">
                    <h1 class="tw-font-bold tw-text-5xl tw-mb-[10px] tw-text-white tw-font-bebas-neue">The Best Beginner Drum Book</h1>
                    <p class="tw-mb-[15px] tw-text-white">
                        Here are some lessons and resources that were hand-picked from Drumeo because
                        they go great with The Best Beginner Drum Book material.
                        <template v-if="isDigital">
                            <template v-if="isUser">
                                <template v-if="!isMember && isPackOnlyOwner">
                                    <br><br>
                                    As a Best Beginner Drum Book owner, you're entitled to a free 7-day Drumeo
                                    Edge Trial Membership so that you can access all of the resources on this page.
                                    Click the Learn More button to get started.
                                </template>

                                <template v-if="!isPackOnlyOwner && isExpiredMember">
                                    <br><br>
                                    To access all of the resources on this page
                                    <a :href="renewUrl"
                                       class="tw-italic">
                                        renew your Drumeo Membership.
                                    </a>
                                </template>
                            </template>
                            <template v-else>
                                <br><br>
                                As a Best Beginner Drum Book owner you're entitled to a free 7-day Drumeo Trial
                                Membership so that you can access all of the resources on this page. Click the Learn
                                More button to check it out.
                            </template>
                        </template>
                        <template v-else>
                            <template v-if="isUser">
                                <br><br>
                                If you have a Drumeo redemption code from your copy of the book, be sure to
                                click the green button.
                            </template>
                            <template v-else>
                                <br><br>
                                To access all of the resources, create your free Drumeo account by clicking the
                                Redeem button below and use the One Month Access Pass you received with your purchase.
                            </template>
                        </template>
                    </p>

                    <div>
                        <template v-if="isDigital">
                            <a
                                v-if="!isUser || !isMember"
                                href="/bestbook-trial"
                                class="tw-btn-primary tw-max-w-[250px] tw-bg-[#4bb543] tw-text-white"
                            >
                                Learn More
                            </a>
                        </template>
                        <template v-else>
                            <button class="tw-btn-primary tw-max-w-[250px] tw-bg-[#4bb543]" @click="isRedeemModalOpen = true">
                                <span class="tw-text-white">
                                    <i class="fas fa-check-circle tw-mr-1"></i> Redeem Drumeo Code
                                </span>
                            </button>
                        </template>
                        <button
                            v-if="!isUser"
                            class="tw-btn-secondary tw-border-white tw-max-w-[200px] tw-ml-2"
                            @click="isLoginModalOpen = true"
                        >
                            <i class="fas fa-sign-in tw-mr-1"></i> Login To Drumeo
                        </button>
                    </div>
                </div>
                <div class="tw-w-1/3 tw-hidden sm:tw-block">
                    <img id="bestBookImage"
                         src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/best-beginner-drum-book.svg.gz"
                         alt="Best Beginner Drum Book">
                </div>
            </div>
        </div>
    </header>
    <div class="container tw-mx-auto tw-my-[30px] tw-px-[10px] lg:tw-px-[15px]">
        <div class="tw-shadow-[0_0px_5px_rgba(0,0,0,0.2)]">
            <DrumBookChapter
                v-for="(chapter, i) in chapters"
                :chapter-number="(i + 1)"
                :chapter="chapter"
                :has-access="i === 4 || i === 6 || i === 7 ? true : hasAccess"
                @open-login-modal="openLoginModal"
            />
            <div class="tw-grid sm:tw-grid-cols-3 sm:tw-gap-[10px] tw-border-t tw-border-[#e5e8e8] tw-p-[10px]">
                <a class="tw-w-full sm:tw-w-auto tw-p-[10px] tw-bg-drumeo tw-rounded-[3px] tw-text-white" href="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/drumeo-practice-routine-generator.pdf" target="_blank" download>
                    <p class="body tw-uppercase tw-tracking-widest">Practice Routine Generator</p>
                    <p class="tw-text-[13px] tw-italic tw-uppercase tw-tracking-widest">PDF Download</p>
                </a>
                <div class="tw-w-full sm:tw-w-auto tw-p-[10px] tw-bg-drumeo tw-rounded-[3px] tw-text-white" href="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/drumeo-notation-legend.pdf" target="_blank" download>
                    <p class="body tw-uppercase tw-tracking-widest">Drumeo Notation Legend</p>
                    <p class="tw-text-[13px] tw-italic tw-uppercase tw-tracking-widest">PDF Download</p>
                </div>
                <div class="tw-w-full sm:tw-w-auto tw-p-[10px] tw-bg-drumeo tw-rounded-[3px] tw-text-white" href="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/drumeo-cheat-sheet.pdf" target="_blank" download>
                    <p class="body tw-uppercase tw-tracking-widest">Drumeo Cheat Sheet</p>
                    <p class="tw-text-[13px] tw-italic tw-uppercase tw-tracking-widest">PDF Download</p>
                </div>
            </div>
        </div>
    </div>

    <RedeemModal v-if="isRedeemModalOpen" :api="redeemApi" :is-user="isUser" @close-modal="closeRedeemModal">
        <template #hidden-inputs>
            <input type="hidden" name="_method" value="POST" class="has-input">
            <input type="hidden" name="redirect" value="/drumeo/bestbook">

            <input type="hidden" name="book-title" value="Best Beginner Drum Book">
            <input type="hidden" name="context" value="best-book">
        </template>
    </RedeemModal>
    <LoginModal :api="loginApi" :is-modal-open="isLoginModalOpen" @open-redeem-modal="openRedeemModal" @close-modal="closeLoginModal"></LoginModal>
</template>
<script setup>
import { computed, ref } from "vue";
import DrumBookChapter from '../components/DrumBookChapter/DrumBookChapter';
import RedeemModal from '../components/Modal/RedeemModal';
import LoginModal from '../components/Modal/RedeemLoginModal';

const props = defineProps({
    redeemApi:{
        type: String,
        default: ''
    },
    loginApi:{
        type: String,
        default: ''
    },
    chapters: {
        type: Array,
        default: []
    },
    isDigital: {
        type: Boolean,
        default: true
    },
    user: {
        type: Object,
        default: {}
    },
    isMember: {
        type: Boolean,
        default: false
    },
    isPackOnlyOwner:{
        type: Boolean,
        default: false
    },
    isExpiredMember:{
        type: Boolean,
        default: false
    },
    hasAccess:{
        type: Boolean,
        default: false
    },
    renewUrl: {
        type: String,
        default: '',
    }
})

const isRedeemModalOpen = ref(false);
const isLoginModalOpen = ref(false);

const isUser = computed(() => {
    return Object.keys(props.user).length > 0;
})

const closeRedeemModal = () => {
    isRedeemModalOpen.value = false;
}

const closeLoginModal = () => {
    isLoginModalOpen.value = false;
}

const openLoginModal = () => {
    isLoginModalOpen.value = true;
}

const openRedeemModal = () => {
    isLoginModalOpen.value = false;
    setTimeout(()=>{
        isRedeemModalOpen.value = true;
    }, 500)
}
</script>
