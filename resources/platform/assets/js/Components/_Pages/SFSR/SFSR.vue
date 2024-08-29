<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <PageHeader
            :page-type="pageData.type"
            :title="pageData.name"
            icon-name="person-plus"
            :description="headerDescription"
        />

        <div class="tw-mt-[30px] tw-text-primary-1 2xl:tw-flex lg:tw-justify-between ">
            <div class="tw-shrink">
                <h1 class="tw-text-3xl tw-font-bold">Welcome to {{ capitalBrand }} Student Focus!</h1>
                <p class="tw-my-[30px]">Submit your performance for review and get personalized feedback from our mentors.</p>
                <ul class="tw-list-disc tw-mb-[30px] tw-pl-5">
                    <li>Personalized and targeted practice plan.</li>
                    <li>Lessons and workouts to take your artistry to the next level.</li>
                    <li>An incredible team of knowledgeable reviewers help you get the most out of your learning journey!</li>
                </ul>

                <div class="tw-flex">
                    <MuButton v-if="showHowToApply" variant="secondary" class="tw-mr-[10px]" @click="toggleModal('HowToApply')"><musora-icon class="tw-w-5 tw-h-5 tw-mr-1" icon-name="play"></musora-icon>How To Apply</MuButton>
                    <MuButton variant="secondary" @click="toggleModal('ApplyNow')">Apply Now <i class="fas fa-chevrons-right tw-w-5 tw-ml-1 tw-mt-0.5" aria-hidden="true"></i></MuButton>
                </div>
            </div>
            <div class="tw-mb-[30px] tw-mt-16 2xl:tw-mt-0 tw-flex tw-justify-center 2xl:tw-flex-none">
                <img class="tw-ml-8 tw-max-w-[550px] 3xl:tw-max-w-[800px] tw-w-full " :src="`https://www.musora.com/musora-cdn/image/width=800,quality=95/${images[brand]}`" alt="Student Focus image" />
            </div>
        </div>

        <InfoModal
            v-if="modalType"
            :classOverride="'tw-max-w-[654px]'"
            :modalId="`${modalType}-${brand}`" :selfContained="true" @onClose="closeModal"
            :title="isApplyNow ? 'Student Review Application' : ''"
        >
            <div v-if="isHowToApply" class="flex flex-column corners-10">
                <div class="video-wrap">
                    <div class="widescreen">
                        <div class="flex flex-column video-player user-active">
                            <iframe
                                style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;"
                                :src="iframeSrc[brand]" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else-if="isApplyNow" class="tw-rounded-[10px] tw-shadow tw-p-[30px] tw-px-5 tw-pt-8 tw-bg-white">
                <StudentReviewForm :url="forms[brand]" height="600" />
            </div>
        </InfoModal>
    </div>
</template>
<script setup>
import { computed, ref } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";

import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader.vue';
import MuButton from "@units/Button/MuButton.vue";
import InfoModal from '@collections/Modal/InfoModal.vue';
import StudentReviewForm from '@collections/IFrames/StudentReviewForm';

const props = defineProps({
    pageData: {
        type: Object,
        default: {
            type: 'student-focus',
            name: 'Student Focus',
        },
    }
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const modalType = ref('');

const headerDescription = computed(() => {
    if (brand.value === 'drumeo') {
        return "Submit your playing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.";
    }

    return '';
});

const capitalBrand = computed(() => {
    return brand.value.charAt(0).toUpperCase() + brand.value.slice(1);
})

const showHowToApply = computed(() => {
    return brand.value !== 'pianote';
})

const isHowToApply = computed(() => {
    return modalType.value === 'HowToApply';
})

const isApplyNow = computed(() => {
    return modalType.value === 'ApplyNow';
})

const toggleModal = (type) => {
    modalType.value = type;
}

const closeModal = () => {
    modalType.value = '';
}

const breadcrumbs = [
    {
        title: 'Student Focus',
    },
];

const iframeSrc = {
    drumeo: '//player.vimeo.com/video/450152568',
    guitareo: '//player.vimeo.com/video/642900215',
    singeo: '//player.vimeo.com/video/712150351',
}

const images = {
    drumeo: 'https://d3fzm1tzeyr5n3.cloudfront.net/student-focus/drumeo_img.png',
    pianote: 'https://d3fzm1tzeyr5n3.cloudfront.net/student-focus/pianote_img.png',
    guitareo: 'https://d3fzm1tzeyr5n3.cloudfront.net/student-focus/guitareo_img.png',
    singeo: 'https://d3fzm1tzeyr5n3.cloudfront.net/student-focus/singeo_img.png',
}

const forms = {
    drumeo: 'https://docs.google.com/forms/d/e/1FAIpQLSdRzf0Wg4meObJi0ovKlUDgbBDYDpJP7MCguIDmPFDybchViQ/viewform?embedded=true',
    pianote: 'https://docs.google.com/forms/d/e/1FAIpQLSe4Soy7CDxk9Aw9_kuJvK9f3FyojMfLkuqezIsvKNUFQPD51w/viewform?embedded=true',
    guitareo: 'https://docs.google.com/forms/d/e/1FAIpQLSfqS5HTrmln2sd7QaNt9Er31fY2becXt4n6isN57HbGwVPHFg/viewform?embedded=true',
    singeo: 'https://docs.google.com/forms/d/e/1FAIpQLSeWyMtqVuQjMdA7rrZMK2jCkAIaPLeycTr0zXUE6LEaD6OmyQ/viewform?embedded=true',
}
</script>
