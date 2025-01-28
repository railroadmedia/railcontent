<script setup>
import { ref, onMounted, nextTick } from "vue";

import RedeemModal from "@collections/Modal/RedeemModal";
import LoginModal from "@collections/Modal/RedeemLoginModal";

const props = defineProps({
    isDigital: {
        type: Boolean,
        default: true,
    },
    isUser: {
        type: Boolean,
        default: false,
    },
    isMember: {
        type: Boolean,
        default: false,
    },
    redeemApi: {
        type: String,
        default: "",
    },
    bookTitle: {
        type: String,
        default: "",
    },
    bookContext: {
        type: String,
        default: "",
    },
});

const isRedeemModalOpen = ref(false);
const isLoginModalOpen = ref(false);

const closeRedeemModal = () => {
    isRedeemModalOpen.value = false;
};

const closeLoginModal = () => {
    isLoginModalOpen.value = false;
};

const openLoginModal = () => {
    isLoginModalOpen.value = true;
};

async function openRedeemModal(){
    isLoginModalOpen.value = false;

    await nextTick();
    isRedeemModalOpen.value = true;
};

const windowLocationHref = window.location.href;

onMounted(() => {
    // we need to open from blade templates that we will not transform to vue
    window.openloginmodal = openLoginModal;
});
</script>

<template>
    <div class="flex flex-row flex-wrap align-center">
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
            <button
                class="tw-btn-primary tw-max-w-[250px] tw-bg-[#4bb543]"
                @click="isRedeemModalOpen = true"
            >
                <span class="tw-text-white">
                    <i class="fas fa-check-circle tw-mr-1"></i> Redeem Drumeo
                    Code
                </span>
            </button>
        </template>
        <button
            v-if="!isUser"
            class="tw-btn-secondary tw-ml-2 tw-max-w-[200px] tw-border-white"
            @click="isLoginModalOpen = true"
        >
            <i class="fas fa-sign-in tw-mr-1"></i> Login To Drumeo
        </button>

        <RedeemModal
            v-if="isRedeemModalOpen"
            :api="redeemApi"
            :is-user="isUser"
            @close-modal="closeRedeemModal"
        >
            <template #hidden-inputs>
                <input
                    type="hidden"
                    name="_method"
                    value="POST"
                    class="has-input"
                />
                <input type="hidden" name="redirect" :value="windowLocationHref" />

                <input
                    type="hidden"
                    name="book-title"
                    :value="bookTitle"
                />
                <input type="hidden" name="context" :value="bookContext" />
            </template>
        </RedeemModal>
        <LoginModal
            :is-modal-open="isLoginModalOpen"
            @open-redeem-modal="openRedeemModal"
            @close-modal="closeLoginModal"
        ></LoginModal>
    </div>
</template>
