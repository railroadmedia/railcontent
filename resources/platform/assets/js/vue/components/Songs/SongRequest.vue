<script setup>
import { ref } from 'vue';
import RequestSongModal from "./RequestSongModal.vue";

const showModal = ref(false);

const handleShowModal = () => {
    showModal.value = !showModal.value;
};

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    }
});
</script>
<template>
    <div class="tw-flex tw-items-center tw-justify-center">
        <button @click="handleShowModal"
            class="tw-flex tw-flex-col tw-justify-center tw-items-center lg:tw-ml-[64px] tw-ml-[12px] hover:tw-underline tw-text-white tw-text-[20px] tw-font-bebas-neue tw-border-2 tw-border-white tw-rounded-full tw-p-3 md:tw-p-4 tw-bg-[#00101D] lg:tw-border-none lg:tw-p-0 lg:tw-bg-transparent">
            <svg class="tw-h-[24px] lg:tw-h-[30px] tw-w-[24px] lg:tw-w-[30px]" id="music-icon-header" width="31" height="32" viewBox="0 0 31 32"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10.8982 0.20752C10.0509 0.20752 9.36416 0.914633 9.36416 1.78676V22.9346C8.44361 22.5329 7.38912 22.317 6.29616 22.317C4.76473 22.317 3.30891 22.7403 2.19113 23.5076C1.08408 24.2671 0.160156 25.4901 0.160156 27.0547C0.160156 28.6193 1.08408 29.8423 2.19113 30.6018C3.30891 31.3691 4.76473 31.7924 6.29616 31.7924C7.82758 31.7924 9.2834 31.3691 10.4012 30.6018C11.5082 29.8423 12.4322 28.6193 12.4322 27.0547V9.68299H27.7722V22.9346C26.8516 22.5329 25.7971 22.317 24.7042 22.317C23.1727 22.317 21.7169 22.7403 20.5991 23.5076C19.4921 24.2671 18.5682 25.4901 18.5682 27.0547C18.5682 28.6193 19.4921 29.8423 20.5991 30.6018C21.7169 31.3691 23.1727 31.7924 24.7042 31.7924C26.2356 31.7924 27.6914 31.3691 28.8092 30.6018C29.9162 29.8423 30.8402 28.6193 30.8402 27.0547V1.78676C30.8402 0.914633 30.1534 0.20752 29.3062 0.20752H10.8982ZM27.7722 6.5245V3.36601H12.4322V6.5245H27.7722ZM8.69935 26.1355C9.25789 26.5188 9.36416 26.875 9.36416 27.0547C9.36416 27.2344 9.25789 27.5906 8.69935 27.9739C8.15153 28.3502 7.30635 28.6339 6.29616 28.6339C5.28596 28.6339 4.44078 28.3502 3.89296 27.9739C3.33442 27.5906 3.22816 27.2344 3.22816 27.0547C3.22816 26.875 3.33442 26.5188 3.89296 26.1355C4.44078 25.7592 5.28596 25.4754 6.29616 25.4754C7.30635 25.4754 8.15153 25.7592 8.69935 26.1355ZM27.1074 26.1355C27.6659 26.5188 27.7722 26.875 27.7722 27.0547C27.7722 27.2344 27.6659 27.5906 27.1074 27.9739C26.5595 28.3502 25.7144 28.6339 24.7042 28.6339C23.694 28.6339 22.8488 28.3502 22.301 27.9739C21.7424 27.5906 21.6362 27.2344 21.6362 27.0547C21.6362 26.875 21.7424 26.5188 22.301 26.1355C22.8488 25.7592 23.694 25.4754 24.7042 25.4754C25.7144 25.4754 26.5595 25.7592 27.1074 26.1355Z"
                    fill="white" />
            </svg>
            <div class="tw-hidden lg:tw-block tw-pt-[10px] tw-text-xl">REQUEST A SONG</div>
        </button>
        <RequestSongModal v-if="showModal" :brand="props.brand" @onCloseModal="handleShowModal" />
    </div>
</template>
