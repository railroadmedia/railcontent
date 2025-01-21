<template>
    <div class="
          tw-animate-pulse
          tw-flex
          tw-flex-row
          tw-relative
          tw-text-[#3F3F46]
          dark:tw-text-[#9EC0DC]
          tw-border-b
          tw-border-[#E4E4E7]
          dark:tw-border-[#223457]
          tw-no-underline
        "
       :class="[class_object]"
    >
        <!-- THUMBNAIL COLUMN -->
        <div v-if="!showStudentReviewThumbsAsAvatar" class="tw-flex tw-flex-col tw-justify-center tw-flex-shrink-0"
             :class="[thumbnailColumnClass]">
            <div class="thumb-wrap corners-10">
                <div class="thumb-img corners-10 thumb-wrap corners-10 bg-grey-2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039]" :class="thumbnailType"></div>
            </div>
        </div>

        <!-- TITLES AND COLUMN DATA (on mobile) -->
        <div class="tw-flex tw-flex-col tw-justify-center tw-mr-auto title-column tw-flex-grow overflow">
            <p class="tw-text-xs font-compressed tw-uppercase text-truncate tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]">
            </p>

            <!-- Title -->
            <p class="tw-w-1/2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-mb-2" :class="[overview ? 'tw-h-[30px] lg:tw-h-[40px]' : 'tw-h-5']"></p>

            <!-- Artist -->
            <p v-if="overview && isLearningPathLevel" class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-[120px] tw-h-6 tw-mb-4"></p>

            <!-- Description -->
            <p v-if="overview" class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-full tw-h-6 mb-1"></p>
            <p v-if="overview" class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-full tw-h-6 mb-1"></p>
            <p v-if="overview && isLearningPathLevel" class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-full tw-h-6 mb-1"></p>

            <!-- Info -->
            <p class="xl:tw-hidden tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-[200px] tw-h-4" :class="[`${overview ? 'tw-mt-4' : ''}`]"></p>
        </div>

        <!-- SHOW ALL OF THE DATA COLUMNS FROM THE DATA MAPPER -->
        <div
            v-for="i in 3"
            :key="`skeleton-mappedData-${i}`"
            class="
              tw-hidden
              xl:tw-flex
              tw-items-center
              tw-justify-center
              sm:tw-w-[110px] xl:tw-flex-shrink-0
            "
        >
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-1/2 tw-h-4"></div>
        </div>

        <!-- ADD TO LIST OR RESET PROGRESS BUTTONS -->
        <div class="flex tw-flex-col icon-col tw-justify-center">
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-7 tw-h-7"></div>
        </div>

        <!-- PROGRESS INDICATOR OR LOCK ICON -->
        <div class="flex tw-flex-col icon-col tw-justify-center" :class="overview ? 'hide-xs-only' : ''">
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-7 tw-h-7"></div>
        </div>
    </div>
</template>

<script setup>
import {computed} from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";

const props = defineProps({
    isCoach: {
        type: Boolean,
        default: () => false,
    },
    contentTypeOverride: {
        type: String,
        default: '',
    },
    forceWideThumbs: {
        type: Boolean,
        default: () => false,
    },
    overview: {
        type: Boolean,
        default: () => false,
    },
    showNumbers: {
        type: Boolean,
        default: () => false,
    },
    contentType: {
        type: String,
        default: () => 'drumeo',
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

//Computed
const class_object = computed(() => {
    return {
        active: props.active,
        "content-overview pv-2": props.overview,
        "content-table-row pv-1": !props.overview,
        'tw-flex-nowrap': props.isNextLesson,
        compact: props.compactLayout,
        "start-learning-path":
            props.contentTypeOverride === "learning-path-part",
    };
})

const disableAddToListForMethods = computed(() => {
    if(props.contentType === 'learning-path-level') {
        return brand.value === 'drumeo' || brand.value === 'pianote';
    }

    return false;
})

const showStudentReviewThumbsAsAvatar = computed(() => {
    return props.contentType === "student-review" && !props.forceWideThumbs;
})

const thumbnailColumnClass = computed(() => {
    return {
        "large-thumbnail": props.overview && !props.isNextLesson,
        "tw-w-[110px] sm:tw-w-[142px]": !props.overview,
        "tw-w-[115px] sm:tw-w-[220px] lg:tw-w-[280px]": props.isNextLesson,
        active: props.active,
        "background-cards tw-mt-3":
            props.contentType === "learning-path" ||
            props.contentType === "learning-path-course",
    };
})

const thumbnailType = computed(() => {
    if (props.forceWideThumbs) {
        return 'widescreen';
    }

    return {
        drumeo: ['song', 'learning-path-level'],
        guitareo: ['song', 'chord-and-scale', 'learning-path-level'],
        pianote: ['song', 'unit', 'learning-path-level'],
        singeo: ['song', 'unit', 'learning-path-level'],
    }[brand.value].indexOf(props.contentType) !== -1 ? 'square' : 'widescreen';
});

const isLearningPathLevel = computed(() => {
    return props.contentType === "learning-path-level";
})

</script>

