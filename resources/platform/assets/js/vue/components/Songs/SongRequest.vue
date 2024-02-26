<script setup>
import { ref } from 'vue';
import RequestSongModal from "./RequestSongModal.vue";

const showModal = ref(false);

const handleShowModal = () => {
    showModal.value = !showModal.value;
};

</script>
<template>
    <div class="tw-flex tw-items-center tw-justify-center">
        <button @click="handleShowModal"
            class="tw-rounded-[25px] tw-h-[40px] tw-px-[25px] dark:tw-bg-white tw-bg-black tw-flex tw-justify-center tw-items-center dark:tw-text-black tw-text-white tw-text-[20px] tw-font-bebas-neue">
            <svg width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.4004 3.13364C10.4004 2.44445 10.9824 1.88574 11.7004 1.88574H20.8004C21.5184 1.88574 22.1004 2.44445 22.1004 3.13364V8.12524C22.1004 8.81443 21.5184 9.37314 20.8004 9.37314H17.5504L14.3004 12.4929V9.37314H11.7004C10.9824 9.37314 10.4004 8.81443 10.4004 8.12524V3.13364Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M17.9876 5.1815C18.3293 5.37226 18.3293 5.86387 17.9876 6.05463L15.6742 7.34624C15.3409 7.53231 14.9305 7.29138 14.9305 6.90967L14.9305 4.32646C14.9305 3.94475 15.3409 3.70382 15.6742 3.8899L17.9876 5.1815Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.09912 5.0625C6.99011 5.2232 5.28203 6.93616 5.28203 9.08827C5.28203 11.3498 7.16818 13.1264 9.4237 13.1264C10.9317 13.1264 12.2747 12.3322 12.9991 11.1299V10.6305H10.8242C10.4532 10.9374 9.96725 11.1264 9.4237 11.1264C8.20903 11.1264 7.28203 10.1825 7.28203 9.08827C7.28203 8.09376 8.0477 7.22353 9.09912 7.07311V5.0625ZM9.4237 15.4049C11.5726 15.4049 13.332 16.8377 13.7996 18.7216H5.04784C5.51544 16.8377 7.27477 15.4049 9.4237 15.4049ZM9.4237 13.4049C5.86686 13.4049 2.92578 16.2017 2.92578 19.7216C2.92578 20.2739 3.3735 20.7216 3.92578 20.7216H14.9216C15.4739 20.7216 15.9216 20.2739 15.9216 19.7216C15.9216 16.2017 12.9805 13.4049 9.4237 13.4049Z" fill="currentColor"/>
            </svg>
            <div class="tw-ml-[5px] tw-text-[16px] tw-leading-[24px]">REQUEST A SONG</div>
        </button>
        <RequestSongModal v-if="showModal" @onCloseModal="handleShowModal" />
    </div>
</template>
