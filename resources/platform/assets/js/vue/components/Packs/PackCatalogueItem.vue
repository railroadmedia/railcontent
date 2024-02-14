<template>
    <div
        class="tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-flex-nowrap tw-py-5 tw-px-4 xl:tw-px-7 tw-relative tw-bg-white dark:tw-bg-[#001729] tw-rounded-xl tw-mb-[15px] tw-border tw-border-[#E0E0E1] hover:tw-border-[#CBCBCD] dark:tw-border-[#162939] hover:dark:tw-border-[#223F57] tw-group hover:dark:tw-bg-[#002039] hover:tw-bg-[#F4FAFF] tw-cursor-pointer"
    >
        <a :href="packURL" class="sm:tw-flex-shrink-0 tw-w-full sm:tw-w-[150px] md:tw-w-[200px] xl:tw-w-[310px] tw-rounded-xl tw-overflow-hidden tw-relative tw-group sm:tw-pb-0 tw-mb-4 sm:tw-mb-0 tw-aspect-video">
            <!-- Thumbnail -->
            <img
                class="tw-transition-opacity tw-opacity-0 tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover tw-object-top"
                :src="`https://www.musora.com/musora-cdn/image/width=280,height=280,quality=95/${thumbnail}`"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
                :alt="`${title} thumbnail`"
            />
            <!-- Logo -->
            <div :class="`tw-absolute tw-w-full tw-p-[10px] tw-pt-[30px] tw-flex tw-justify-center`" style="background:linear-gradient(to bottom, transparent 0%, #000 100%);" :style="`bottom: ${hasStarted ? '6px' : '0'}`">
                <img
                    class="tw-max-h-[70px] sm:tw-max-h-[40px]"
                    :class="`${logoStyle ? logoStyle : 'lg:tw-max-h-[50px] xl:tw-max-h-[70px]'}`"
                    :src="`https://www.musora.com/musora-cdn/image/width=280,height=280,quality=95/${logo}`"
                    loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')"
                    :alt="`${title} logo`"
                />
            </div>
            <!-- Arrow -->
            <div class="tw-absolute tw-inset-0 tw-bg-[rgba(0,0,0,0.4)] tw-text-white tw-justify-center tw-items-center tw-text-[32px] tw-hidden group-hover:tw-flex">
                <svg v-if="enrollmentOpen" class="tw-w-[40px] lg:tw-w-[52px] tw-h-[40px] lg:tw-h-[52px]" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 20.4166L30.625 13.1249L17.5 5.83325L4.375 13.1249L17.5 20.4166ZM17.5 20.4166L26.482 15.4265C27.2734 17.422 27.7083 19.5976 27.7083 21.8748C27.7083 22.8976 27.6206 23.8998 27.4522 24.8745C23.6458 25.2446 20.1965 26.8342 17.5 29.2476C14.8035 26.8342 11.3542 25.2446 7.54778 24.8745C7.37941 23.8998 7.29167 22.8975 7.29167 21.8747C7.29167 19.5976 7.72661 17.422 8.51794 15.4265L17.5 20.4166ZM11.6667 29.1665V18.2291L17.5 14.9883" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <i v-else class="fas fa-arrow-right" aria-hidden="true"></i>
            </div>
            <!-- Progress bar -->
            <template v-if="progressPercent > 0">
                <div class="tw-absolute tw-w-full tw-bottom-0 tw-left-0 tw-h-[6px] tw-bg-[#E7EFF6]"></div>
                <div :class="`tw-absolute tw-left-0 tw-bottom-0 tw-h-[6px] tw-rounded-full tw-bg-${brand}`" :style="`width: ${progressPercent}%`"></div>
            </template>

        </a>
        <div class="sm:tw-flex tw-grow tw-items-center tw-w-full">
            <a :href="packURL" class="sm:tw-px-4 tw-grow tw-mb-3 sm:tw-mb-0">
                <div class="tw-flex tw-flex-col lg:tw-flex-row tw-items-start tw-mb-2">
                    <div v-if="showEnrollmentLabel" class="tw-flex tw-justify-between tw-w-full sm:tw-w-auto tw-items-start lg:tw-order-1 tw-flex-shrink-0">
                        <!-- Enrollment Label -->
                        <div class="tw-bg-[#FFAE00] tw-text-[#000C17] tw-px-3 tw-py-0.5 tw-rounded-lg tw-font-semibold tw-text-xs lg:tw-text-sm tw-mb-2 lg:tw-mb-0">{{pack.badge_text}}</div>
                        <!-- Add to playlist on mobile -->
                        <button class="dark:tw-bg-[#00101D] tw-text-[#00101D] dark:tw-text-white tw-border tw-border-[#00101D] dark:tw-border-white tw-rounded-full tw-flex tw-justify-center tw-items-center sm:tw-hidden tw-p-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" @click="addToPlaylist">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                        <!-- Title -->
                        <div class="tw-flex tw-justify-between tw-w-full sm:tw-w-auto tw-items-start">
                            <div class="tw-font-extrabold tw-text-[#00101D] dark:tw-text-white tw-text-lg lg:tw-text-xl tw-line-clamp-2 lg:tw-mr-3">
                                {{ title }}
                            </div>

                            <!-- Add to playlist on mobile -->
                            <button v-if="!showEnrollmentLabel" class="dark:tw-bg-[#00101D] tw-text-[#00101D] dark:tw-text-white tw-border tw-border-[#00101D] dark:tw-border-white tw-rounded-full tw-flex tw-justify-center tw-items-center sm:tw-hidden tw-p-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" @click="addToPlaylist">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                </div>
                <!-- Description -->
                <div class="tw-hidden xl:tw-block tw-text-[#000C17] dark:tw-text-[#E7EFF6] lg:tw-mr-14 tw-mt-2 tw-mb-2 tw-text-xs lg:tw-text-sm description" v-html="description"></div>
                <!-- Artist -->
                <div class="tw-uppercase tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm tw-mb-2">{{ artistName }}</div>
                <!-- Info -->
                <div class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-xs xl:tw-text-sm tw-flex tw-items-center">
                    {{pack.lesson_count}} Lessons <span class="tw-mx-2">•</span>{{ pack.total_xp }} XP <span class="tw-mx-2" v-if="pack.launch_date">•</span>  {{pack.launch_date}}
                </div>
            </a>
            <div class="sm:tw-flex tw-flex-shrink-0">
                <!-- Add to playlist -->
                <button class="tw-mr-4 dark:tw-bg-[#00101D] tw-text-[#00101D] dark:tw-text-white tw-border tw-border-[#00101D] dark:tw-border-white tw-rounded-full sm:tw-flex tw-justify-center tw-items-center tw-w-[45px] tw-hidden hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" @click="addToPlaylist">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <!-- Action button  -->
                <a :href="pack.primary_cta_url" class="tw-btn-primary tw-items-center tw-px-6 xl:tw-px-10 tw-w-full sm:tw-w-auto tw-mt-3 sm:tw-mt-0" :class="progressButtonColor">
                    <i class="fas tw-mr-2 tw-mb-0.5" :class="progressIcon"></i> {{ progressText }}
                </a>
            </div>
        </div>
    </div>
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

const enrolled = computed(() => {
    return props.pack.enrollment_state === 'enrolled';
})

const showEnrollmentLabel = computed(() => {
    return enrolled.value || enrollmentOpen.value;
})

const progressText = computed(() => {
    return props.pack.primary_cta_text;
})

const packURL = computed(() => {
    if(enrollmentOpen.value){
        return props.pack.primary_cta_url;
    } else {
        return props.pack.url;
    }
})

const progressIcon = computed(() => {
    if(enrollmentOpen.value){
        return 'fa-solid fa-graduation-cap';
    } else if (progressText.value === 'Continue'){
        return `fa-adjust`;
    } else if(progressText.value === 'Completed'){
        return `fa-check-circle`;
    } else {
        return 'fa-play';
    }
})

const progressButtonColor = computed(() => {
    if(progressText.value === 'Start'){
        return 'dark:tw-bg-[#00101D] tw-text-[#00101D] dark:tw-text-white tw-border dark:tw-border-white tw-border-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]';
    } else {
        return 'tw-bg-[#00101D] dark:tw-bg-white tw-text-white dark:tw-text-[#00101D] hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white';
    }
})

const artistName = computed(() => {
    return props.pack.instructors && props.pack.instructors.length > 0 && props.pack.instructors[0];
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

const logoStyle = computed(() => {
    if(title.value === 'Electrify Your Drumming' || title.value === 'Beyond Beginner Drumming' || title.value === 'Anatomy Of A Drum Solo' || title.value === 'Creative Control' || title.value === 'Getting Started on the Piano' || title.value === 'Easy Chords' || title.value === 'The Power of Chords' || title.value === 'The Beginner’s Guide To Classical Piano' || title.value === 'The Beginner’s Guide To PLaying Beautiful Piano' || title.value === 'Beginner Guitar System' || title.value === 'Rhythm & Groove') {
        return 'lg:tw-max-h-[50px]';
    }

    if(title.value.includes('Rock Drumming Masterclass') || title.value === 'New Drummers Start Here' || title.value.includes('Drum Technique Made Easy') || title.value.includes('Independence Made Easy') || title.value === 'The Ultimate Guide To Recording Drums' || title.value === 'De-Stupefy Your Left Hand' || title.value === 'Blues Guitar Blueprint' || title.value === 'Guitar Quest' || title.value === 'The Ultimate Guide To Recording Guitar'){
        return 'lg:tw-max-h-[40px]';
    }


})
</script>
