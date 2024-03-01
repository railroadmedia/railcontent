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
            class="tw-flex tw-flex-col tw-justify-center tw-items-center lg:tw-ml-[64px] tw-ml-[12px] hover:tw-underline tw-text-white tw-text-[20px] tw-font-bebas-neue tw-border-2 tw-border-white tw-rounded-full tw-px-3 tw-pt-3 md:tw-px-4 md:tw-pt-4 tw-bg-[#00101D] lg:tw-border-none lg:tw-px-0 lg:tw-pt-0 lg:tw-bg-transparent">
            <svg width="51" height="44" viewBox="0 0 51 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.4004 6.26728C20.4004 4.88889 21.5421 3.77148 22.9504 3.77148H40.8004C42.2087 3.77148 43.3504 4.88889 43.3504 6.26728V16.2505C43.3504 17.6289 42.2087 18.7463 40.8004 18.7463H34.4254L28.0504 24.9858V18.7463H22.9504C21.5421 18.7463 20.4004 17.6289 20.4004 16.2505V6.26728Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M36.0531 10.8011C36.3899 10.9929 36.3899 11.4784 36.0531 11.6702L30.0333 15.097C29.7 15.2868 29.2859 15.046 29.2859 14.6625L29.2859 7.80879C29.2859 7.42524 29.7 7.18451 30.0333 7.37426L36.0531 10.8011Z" fill="white"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8508 11.1274C14.2042 11.4454 11.325 14.468 11.325 18.176C11.325 22.0973 14.5451 25.2522 18.4875 25.2522C21.3168 25.2522 23.7741 23.6273 24.9361 21.2604H22.5876C21.6464 22.4692 20.164 23.2522 18.4875 23.2522C15.623 23.2522 13.325 20.9663 13.325 18.176C13.325 15.5958 15.29 13.4469 17.8508 13.1379V11.1274ZM18.4875 29.8093C23.56 29.8093 27.712 33.6027 28.2197 38.4427H8.75529C9.26299 33.6027 13.415 29.8093 18.4875 29.8093ZM18.4875 27.8093C11.9925 27.8093 6.70312 33.0045 6.70312 39.4427C6.70312 39.995 7.15084 40.4427 7.70312 40.4427H29.2719C29.8242 40.4427 30.2719 39.995 30.2719 39.4427C30.2719 33.0045 24.9825 27.8093 18.4875 27.8093Z" fill="white"/>
            </svg>

            <div class="tw-hidden lg:tw-block tw-pt-[10px] tw-text-[18px] tw-leading-0">REQUEST A SONG</div>
        </button>
        <RequestSongModal v-if="showModal" :brand="props.brand" @onCloseModal="handleShowModal" />
    </div>
</template>
