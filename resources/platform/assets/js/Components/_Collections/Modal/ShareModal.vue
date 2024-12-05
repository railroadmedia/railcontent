<template>
    <InfoModal
        :selfContained="true"
        class-override="tw-max-w-[593px] tw-w-full"
        title="Share"
        @onClose="() => $emit('closeModal')"
    >
        <div class="tw-grid tw-grid-cols-5 tw-gap-2 sm:tw-gap-4 dark:tw-text-white sm:tw-text-xs">
            <div class="tw-text-center">
                <button class="tw-w-full tw-bg-[#F9F9F9] dark:tw-bg-[#223F57] tw-rounded-full tw-aspect-square tw-flex tw-justify-center tw-items-center tw-mb-2" @click="shareSource('facebook')">
                    <i class="fa-brands fa-facebook tw-text-xl sm:tw-text-2xl"></i>
                </button>
                <span class="tw-hidden sm:tw-inline">Facebook</span>
            </div>
            <div class="tw-text-center">
                <button class="tw-w-full tw-bg-[#F9F9F9] dark:tw-bg-[#223F57] tw-rounded-full tw-aspect-square tw-flex tw-justify-center tw-items-center tw-mb-2" @click="shareSource('whatsapp')">
                    <i class="fa-brands fa-whatsapp tw-text-xl sm:tw-text-2xl"></i>
                </button>
                <span class="tw-hidden sm:tw-inline">Whatsapp</span>
            </div>
            <div class="tw-text-center">
                <button class="tw-w-full tw-bg-[#F9F9F9] dark:tw-bg-[#223F57] tw-rounded-full tw-aspect-square tw-flex tw-justify-center tw-items-center tw-mb-2" @click="shareSource('linkedin')">
                    <i class="fa-brands fa-linkedin-in tw-text-xl sm:tw-text-2xl"></i>
                </button>
                <span class="tw-hidden sm:tw-inline">LinkedIn</span>
            </div>
            <div class="tw-text-center">
                <button class="tw-w-full tw-bg-[#F9F9F9] dark:tw-bg-[#223F57] tw-rounded-full tw-aspect-square tw-flex tw-justify-center tw-items-center tw-mb-2" @click="shareSource('twitter')">
                    <i class="fa-brands fa-x-twitter tw-text-xl sm:tw-text-2xl"></i>
                </button>
                <span class="tw-hidden sm:tw-inline">X</span>
            </div>
            <div class="tw-text-center">
                <button class="tw-w-full tw-bg-[#F9F9F9] dark:tw-bg-[#223F57] tw-rounded-full tw-aspect-square tw-flex tw-justify-center tw-items-center tw-mb-2" @click="shareSource('email')">
                    <i class="fa-solid fa-envelope tw-text-xl sm:tw-text-2xl"></i>
                </button>
                <span class="tw-hidden sm:tw-inline">E-mail</span>
            </div>
        </div>
        <div class="tw-my-5 tw-text-center dark:tw-text-white tw-text-xs">
            Or share with link
        </div>
        <div class="tw-relative dark:tw-text-white tw-mb-5">
            <div class="tw-h-full tw-flex tw-justify-center tw-items-center tw-absolute tw-right-[15px] tw-top-0 tw-z-[5]">
                <i class="fa-regular fa-copy tw-text-xl"></i>
            </div>
            <input id="share-link" class="tw-relative tw-outline-offset-0 tw-relative tw-w-full tw-h-10 sm:tw-h-[45px] tw-border-[#CBCBCD] dark:tw-border-[#445F74] tw-text-xs sm:tw-text-sm tw-rounded-[63px] tw-transition-color dark:tw-bg-black tw-bg-transparent tw-shadow-none tw-pl-[15px] tw-pr-20 tw-ring-transparent" :value="source" />
        </div>
        <div class="tw-flex tw-justify-end">
            <MuButton @click="copyLink"><i class="fa-regular fa-copy tw-mr-1 -mt-1"></i> Copy Link</MuButton>
        </div>
    </InfoModal>
</template>
<script setup>
import { computed } from "vue";
import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    source: String,
    title: String,
});

const copyLink = () => {
    const copyText = document.getElementById("share-link");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(props.source);

    window.shownotification({
        icon: 'fa-regular fa-copy',
        text: `Link copied to clipboard`,
    })
}

const shareUrls = computed(() => {
    return {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(props.source)}`,
        twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(props.source)}&text=${encodeURIComponent(props.title)}`,
        whatsapp: `https://api.whatsapp.com/send?text=${encodeURIComponent(props.title)}%20${encodeURIComponent(props.source)}`,
        linkedin: `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(props.source)}`,
        email: `mailto:&body=${encodeURIComponent(props.source)}`
    }
})

const shareSource = async (type) => {
    window.open(shareUrls.value[type], '_blank')
}



</script>
