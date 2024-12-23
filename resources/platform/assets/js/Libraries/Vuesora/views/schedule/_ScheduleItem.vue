<template>
    <div
        class="flex tw-w-full flex-row tw-items-center scheduled tw-px-0 pa-1 tw-border-t tw-border-[#E4E4E7] dark:tw-border-[#223457]"
        :class="month"
    >

        <div class="tw-flex tw-flex-col tw-justify-center tw-w-[116px] md:tw-w-[143px] tw-shrink-0">
            <div class="thumb-wrap corners-10">
                <div class="thumb-img corners-10 bg-grey-2 dark:tw-bg-[#081825] widescreen text-center">
                    <img
                        class="tw-transition-opacity tw-opacity-0 tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover tw-object-top"
                        :src="`https://www.musora.com/cdn-cgi/image/width=280,height=280,quality=95/${item.image}`"
                        loading="lazy"
                        @load="$event.target.classList.remove('tw-opacity-0')"
                        :alt="`${item.title} thumbnail`"
                    />

                    <div class="tw-absolute tw-top-0 tw-w-full tw-h-full tw-left-0 tw-bg-black/80 tw-flex tw-flex-col tw-items-center tw-justify-center">
                        <p class="tw-text-xs text-white font-bold">
                            {{ day }},
                            <span class="tw-capitalize">{{ month }}</span> <span class="">{{ dayNumber }}/{{ yearNumber }}</span>
                        </p>
                        <p class="tw-text-xs text-white">
                            {{ time }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-mr-auto tw-flex tw-w-full tw-flex-col xl:tw-flex-row xl:tw-justify-center">
            <div class="tw-flex tw-flex-col tw-justify-center ph-1 title-column overflow tw-mr-auto tw-mb-1 xl:tw-mb-0">
                <p class="tw-text-sm uppercase text-truncate tw-text-[#52525A] dark:tw-text-[#9EC0DC]">
                    {{ item.type }}
                </p>
                <p class="tw-text-sm tw-text-[#00101D] dark:tw-text-white tw-font-bold item-title">
                    {{ item.title }}
                </p>
            </div>

            <div class="ph-1 tw-hidden sm:tw-flex">
                <div class="tw-flex tw-flex-col uppercase tw-justify-center tw-pr-2 sm:tw-w-[116px] md:tw-w-[143px] tw-text-[#52525A] dark:tw-text-[#9EC0DC] tw-text-xs hide-sm-down xl:tw-text-center">
                    {{ releaseType }}
                </div>
                <div class="tw-flex tw-flex-col uppercase tw-justify-center tw-pr-2 sm:tw-w-[116px] md:tw-w-[143px] tw-text-[#52525A] dark:tw-text-[#9EC0DC] tw-text-xs xl:tw-text-center">
                    {{ item.artist_name }}
                </div>
                <DifficultyLabel v-if="item.difficulty" class="basic-col dark:tw-text-[#9EC0DC] tw-justify-center tw-text-center tw-text-xs tw-ml-2" :difficultyValue="mappedData.difficulty" textCase="uppercase" />
            </div>
        </div>

        <div class="tw-flex tw-h-full tw-flex-col icon-col tw-justify-center">
            <div class="body tw-h-full tw-inline-flex tw-items-center tw-text-[#52525A] dark:tw-text-[#9EC0DC]"
                tabindex="0"
                title="Add to Playlist"
                @click.stop.prevent="addToList"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </div>
        </div>

        <div
            class="tw-flex tw-flex-col icon-col tw-justify-center tw-h-full"
            style="position:relative;"
        >
            <div
                class="body pointer add-to tw-inline-flex tw-items-center tw-h-full"
                title="Add to Calendar"
                tabindex="0"
                data-open-modal="scheduleAddToCalendarModal"
                @click="addEvent"
            >
                <i class="fas fa-calendar-plus flex-center tw-text-[#52525A] dark:tw-text-[#9EC0DC] rounded"></i>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onUnmounted, onBeforeMount, ref } from 'vue';
import { DateTime } from 'luxon';
import ContentHelpers from "../../assets/js/helper-functions/content.js";
import ContentModel from '../../assets/js/models/_model.js';
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel';

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});

const timezone = ref("UTC"); // Default timezone

const mappedData = getContentModel();

const time_to_display = computed(() => props.item.published_on);
const formatted_time = computed(() => time_to_display.value);
const month = computed(() => formatDate(formatted_time.value, 'LLL'));
const day = computed(() => formatDate(formatted_time.value, 'ccc'));
const dayNumber = computed(() => formatDate(formatted_time.value, 'd'));
const yearNumber = computed(() => formatDate(formatted_time.value, 'yy'));
const time = computed(() => formatDate(formatted_time.value, 'h:mm a'));
const releaseType = computed(() => props.item.status === 'scheduled' ? 'Live Broadcast' : 'Lesson Release');

function formatDate(isoDate, formatString) {
    return DateTime.fromISO(isoDate, { zone: 'utc' })
        .setZone(timezone.value)
        .toFormat(formatString);
}

function getContentModel() {
    const shows = ContentHelpers.shows();
    let type = props.item.type;

    if (shows.includes(type)) {
        type = 'show';
    }

    const model = new ContentModel(type, {
        brand: props.item.brand,
        post: props.item,
    });

    const difficultyValue = props.item.difficulty;
    model.schedule.difficulty = difficultyValue;

    return model.schedule;
}

function getRegionParam() {
    try {
        const currentUrl = window.location.href;

        const urlObj = new URL(currentUrl);

        const timezoneParam = urlObj.searchParams.get("timezone");

        if (timezoneParam) {
            const extractedValue = timezoneParam.split(" - ")[0];
            timezone.value = extractedValue; 
            //console.log("Extracted Timezone:", extractedValue);
        } else {
            console.warn("Timezone parameter not found in URL, defaulting to UTC.");
        }
    } catch (error) {
        console.error("Error parsing URL for timezone:", error);
    }
}

onBeforeMount(() => {
    getRegionParam();
    //console.log('published_on', props.item.published_on);
});

</script>
