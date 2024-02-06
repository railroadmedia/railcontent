<template>
    <a
        class="tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-flex-nowrap tw-py-5 tw-px-4 lg:tw-px-5 xl:tw-px-7 tw-relative dark:tw-bg-[#001729] tw-rounded-xl tw-mb-[15px] tw-border dark:tw-border-[#223F57] tw-group hover:dark:tw-bg-[#002039]"
        :href="pack.primary_cta_url"
    >
        <a class="sm:tw-flex-shrink-0 tw-w-full sm:tw-w-[150px] md:tw-w-[200px] xl:tw-w-[310px] tw-rounded-xl tw-overflow-hidden tw-relative tw-group sm:tw-pb-0 tw-mb-4 sm:tw-mb-0 tw-aspect-video">
            <!-- Thumbnail -->
            <img
                class="tw-transition-opacity tw-opacity-0 tw-absolute tw-inset-0 tw-object-cover tw-object-center"
                :src="`https://www.musora.com/musora-cdn/image/width=280,height=280,quality=95/${thumbnail}`"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
                :alt="`${title} thumbnail`"
            />
            <!-- Logo -->
            <div :class="`tw-absolute tw-w-full tw-p-[10px] tw-pt-[30px] tw-flex tw-justify-center`" style="background:linear-gradient(to bottom, transparent 0%, #000 100%);" :style="`bottom: ${hasStarted ? '6px' : '0'}`">
                <img
                    class="tw-max-h-[70px] sm:tw-max-h-[40px] lg:tw-max-h-[70px]"
                    :src="`https://www.musora.com/musora-cdn/image/width=280,height=280,quality=95/${logo}`"
                    loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')"
                    :alt="`${title} logo`"
                />
            </div>
            <!-- Arrow -->
            <div class="tw-absolute tw-inset-0 tw-bg-[rgba(0,0,0,0.4)] tw-text-white tw-justify-center tw-items-center tw-text-[32px] tw-hidden group-hover:tw-flex">
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </div>
            <!-- Progress bar -->
            <template v-if="progressPercent > 0">
                <div class="tw-absolute tw-w-full tw-bottom-0 tw-left-0 tw-h-[6px] tw-bg-[#E7EFF6]"></div>
                <div :class="`tw-absolute tw-left-0 tw-bottom-0 tw-h-[6px] tw-rounded-full tw-bg-${brand}`" :style="`width: ${progressPercent}%`"></div>
            </template>

        </a>
        <div class="sm:tw-flex tw-grow tw-items-center tw-w-full">
            <div class="sm:tw-px-4 tw-grow tw-mb-3 sm:tw-mb-0">
                <div class="tw-flex tw-flex-col lg:tw-flex-row tw-items-start tw-mb-2 lg:tw-mb-0">
                    <!-- Enrollment Label -->
                    <div v-if="enrollmentOpen" class="tw-bg-[#FFAE00] tw-px-3 tw-py-1 tw-rounded-lg tw-font-semibold tw-text-xs lg:tw-text-sm lg:tw-order-1 tw-mb-2 lg:tw-mb-0">Enrollment Now Open!</div>
                    <div class="tw-flex tw-justify-between tw-w-full sm:tw-w-auto">
                        <!-- Title -->
                        <div class="tw-font-extrabold tw-text-[#00101D] dark:tw-text-white tw-text-xl sm:tw-mr-4">
                            {{ title }}
                        </div>
                        <!-- Add to playlist on mobile -->
                        <button class="dark:tw-bg-[#00101D] dark:tw-text-white tw-border dark:tw-border-white tw-rounded-full tw-flex tw-justify-center tw-items-center sm:tw-hidden tw-p-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" @click="addToPlaylist">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Description -->
                <div class="tw-hidden xl:tw-block dark:tw-text-[#E7EFF6] lg:tw-mr-14 tw-mt-2 tw-mb-2" v-html="description"></div>
                <!-- Artist -->
                <div class="tw-uppercase dark:tw-text-[#9EC0DC] tw-text-sm tw-mb-2">Jared Falk</div>
                <!-- Info -->
                <div class="dark:tw-text-[#9EC0DC] tw-text-sm tw-flex tw-items-center">
                    <DifficultyLabel class="tw-text-sm" :difficultyValue="'novice'" textCase="capitalize" /> <span class="tw-mx-2">•</span>{{pack.lesson_count}} Lessons <span class="tw-mx-2">•</span>{{ pack.total_xp }} XP <span class="tw-mx-2" v-if="pack.launch_date">•</span>  {{pack.launch_date}}
                </div>
            </div>
            <div class="sm:tw-flex tw-flex-shrink-0">
                <!-- Add to playlist -->
                <button class="tw-mr-4 dark:tw-bg-[#00101D] dark:tw-text-white tw-border dark:tw-border-white tw-rounded-full sm:tw-flex tw-justify-center tw-items-center tw-w-[45px] tw-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" @click="addToPlaylist">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <!-- Action button  -->
                <a class="tw-btn-primary tw-items-center tw-px-6 lg:tw-px-10 tw-w-full sm:tw-w-auto" :class="progressButtonColor">
                    <i class="fas tw-mr-2 tw-mb-0.5" :class="progressIcon"></i> {{ progressText }}
                </a>
            </div>
        </div>
    </a>
</template>
<script setup>
import {storeToRefs} from "pinia/dist/pinia";
import { useUserStore } from '../../../stores/user';
import {computed, onMounted} from "vue";
import { DateTime } from 'luxon';
import DifficultyLabel from '../DifficultyLabel/DifficultyLabel';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    pack: {
        type: Object,
        default: {},
    }
})

const isReleased = computed(() => {
    return DateTime.fromSQL(props.pack.published_on_in_timezone).toISO() < DateTime.now().toISO();
})

const thumbnail = computed(() => {
    const url = props.pack.data && props.pack.data.find((d) => d.key === 'thumbnail_url');
    return url && url.value;
})

const logo = computed(() => {
    const url = props.pack.data && props.pack.data.find((d) => d.key === 'logo_image_url');
    return url && url.value;
})

const title = computed(() => {
    const text = props.pack.data && props.pack.fields.find((d) => d.key === 'title');
    return text && text.value;
})

const description = computed(() => {
    const text = props.pack.data && props.pack.data.find((d) => d.key === 'description');
    return text && text.value;
})

const progressPercent = computed(() => {
    return props.pack.progress_percent;
})

const hasStarted = computed(() => {
    return progressPercent.value > 0;
})

const enrollmentOpen = computed(() => {
    return props.pack.enrollment_state === 'open';
})

const progressText = computed(() => {
    return props.pack.primary_cta_text;
})

const progressIcon = computed(() => {
    if (progressText.value === 'Continue'){
        return `fa-adjust`;
    } else if(progressText.value === 'Completed'){
        return `fa-check-circle`;
    } else {
        return 'fa-play';
    }

//   fa-solid fa-graduation-cap  --> enrollment icon
})

const progressButtonColor = computed(() => {
    if(progressText.value === 'Start'){
        return 'dark:tw-bg-[#00101D] dark:tw-text-white dark:tw-border dark:tw-border-white';
    } else {
        return 'dark:tw-bg-white dark:tw-text-[#00101D]';
    }
})

const addToPlaylist = () => {
    const content = {
        content_id: props.pack.id,
        type: props.pack.type,
        name: title.value,
        thumbnail_url: thumbnail.value,
        description: description.value,
    }

    window.openplaylistmodal({ modalType: 'addItem', content });
}
</script>
