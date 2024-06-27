<template>
    <header id="bestBookHeader" class="tw-w-full tw-px-[10px] lg:tw-px-[15px] tw-py-[50px]">
        <div class="tw-w-full tw-container tw-mx-auto tw-pt-4 md:tw-pt-0 tw-px-4 md:tw-px-8">
            <div class="tw-flex tw-items-center">
                <div class="tw-px-[10px] lg:tw-px-[15px] tw-mb-[15px] sm:tw-w-2/3">
                    <h1 class="tw-font-bold tw-text-5xl tw-mb-[10px] tw-text-white tw-font-bebas-neue">The Drummer's Toolbox</h1>
                    <p class="tw-mb-[15px] tw-text-white">
                        Here you will find all the digital resources that pair with the material in The Drummer’s
                        Toolbox. These include pre-built Recommended Listening playlists, drumless play-along
                        tracks, and tons of Drumeo resources.

                        <template v-if="isDigital">
                            <template v-if="isUser">
                                <template v-if="!isEdge && isPackOwner">
                                    <br><br>
                                    As an owner of The Drummer’s Toolbox, we’re granting you free access to Drumeo
                                    Edge for 30 days so you can access all of the resources on this page. Click the
                                    “Learn More” button below to get started!
                                </template>
                            </template>
                            <template v-else>
                                <br><br>
                                As an owner of The Drummer’s Toolbox, we’re granting you free access to Drumeo
                                Edge for 30 days so you can access all of the resources on this page. Click the
                                “Learn More” button below to get started!
                            </template>
                        </template>
                        <template v-else>
                            <template v-if="isUser">
                                <br><br>
                                If you have a Drumeo Access Pass with a redemption code from your copy of the
                                book, be sure to click the green button.
                            </template>
                            <template v-else>
                                <br><br>
                                To access all of the resources, create your free Drumeo account by clicking the
                                Redeem button below and use the One Month Access Pass you received with your purchase.
                            </template>
                        </template>
                    </p>

                    <div >
                        <template v-if="isDigital">
                            <a v-if="!isUser || !isEdge" :href="trialUrl"
                               class="tw-btn-primary tw-max-w-[250px] tw-bg-[#4bb543] tw-text-white">
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

                        <button v-if="!isUser" class="tw-btn-secondary tw-border-white tw-max-w-[200px] tw-ml-2" @click="isLoginModalOpen = true">
                            <i class="fas fa-sign-in tw-mr-1"></i> Login To Drumeo
                        </button>
                    </div>
                </div>

                <div class="tw-w-1/3 tw-hidden sm:tw-block">
                    <img id="bestBookImage"
                         src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/drummers-toolbox.png"
                         alt="Drummer's Toolbox">
                </div>
            </div>
        </div>
    </header>

    <section class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 4xl:tw-grid-cols-6 tw-mb-8">
            <DrummersToolChapter v-for="chapter in chapters" :chapter="chapter" :is-digital="isDigital" />
        </div>
    </section>

    <RedeemModal :api="redeemApi" :is-user="isUser" :is-modal-open="isRedeemModalOpen" :user="user" @close-modal="closeRedeemModal">
        <template #hidden-inputs>
            <input type="hidden" name="redirect" value="/drumeo/drummers-toolbox">

            <input type="hidden" name="book-title" value="The Drummer's Toolbox">
            <input type="hidden" name="context" value="drummers-toolbox">
        </template>
    </RedeemModal>
    <LoginModal :api="loginApi" :is-modal-open="isLoginModalOpen" @open-redeem-modal="openRedeemModal" @close-modal="closeLoginModal"></LoginModal>
</template>
<script setup>
import {computed, ref} from "vue";
import DrummersToolChapter from '../components/DrummersToolChapter/DrummersToolChapter';
import RedeemModal from '../components/Modal/RedeemModal';
import LoginModal from '../components/Modal/RedeemLoginModal';

const props = defineProps({
    chapters: {
        type: Array,
        default: []
    },
    isDigital: {
        type: Boolean,
        default: true
    },
    isPackOwner:{
        type: Boolean,
        default: false
    },
    isEdge:{
        type: Boolean,
        default: false
    },
    user: {
        type: Object,
        default: {}
    },
    redeemApi:{
        type: String,
        default: ''
    },
    trialUrl: {
        type: String,
        default: ''
    },
    loginApi:{
        type: String,
        default: ''
    },
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

const openRedeemModal = () => {
    isLoginModalOpen.value = false;
    setTimeout(()=>{
        isRedeemModalOpen.value = true;
    }, 500)
}
</script>
