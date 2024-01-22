<template>
    <div class="tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-flex-nowrap tw-py-[30px] first:tw-border-none tw-border-b tw-border-[#D4D4D8] dark:tw-border-[#223F57] tw-relative">
        <a
            class="tw-flex-shrink-0 tw-w-full tw-h-auto sm:tw-w-[220px] sm:tw-h-[220px] md:tw-w-[280px] md:tw-h-[280px] tw-rounded-xl tw-overflow-hidden tw-relative tw-group tw-pb-[100%] sm:tw-pb-0 tw-mb-4 sm:tw-mb-0"
            :class="isReleased ? '' : 'tw-saturate-0 tw-pointer-events-none tw-cursor-default'"
            :href="pack.url"
        >
            <!-- Thumbnail -->
            <img
                class="tw-transition-opacity tw-opacity-0 tw-absolute tw-inset-0"
                :src="`https://www.musora.com/musora-cdn/image/width=280,height=280,quality=95/${thumbnail}`"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
                :alt="`${title} thumbnail`"
            />
            <!-- Logo -->
            <div class="tw-absolute tw-bottom-0 tw-w-full tw-p-[10px] tw-pt-[30px]" style="background:linear-gradient(to bottom, transparent 0%, #000 100%);">
                <img
                    class="tw-w-full"
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
        </a>
        <div class="tw-flex tw-grow tw-items-center">
            <div class="sm:tw-px-4 lg:tw-flex-1">
                <!-- Opening text -->
                <p v-if="!isReleased" :class="`tw-uppercase tw-text-${brand}`"> Opening Monday, December 1 at 12:00 AM </p>
                <!-- Title -->
                <div class="tw-flex tw-justify-between">
                    <a
                        class="tw-font-bold tw-text-[#00101D] dark:tw-text-white no-decoration tw-text-xl"
                        :href="pack.url"
                        :class="isReleased ? '' : 'tw-pointer-events-none tw-cursor-default'"
                    >
                        {{ title }}
                    </a>
                <!-- Add to playlist -->
                    <button class="lg:tw-hidden"><i class="fas fa-plus tw-text-[#ccd3d3] dark:tw-text-[#9EC0DC] tw-text-2xl" aria-hidden="true"></i></button>
                </div>
                <!-- Description -->
                <div class="dark:tw-text-white lg:tw-mr-14 tw-mt-2 tw-mb-3" v-html="description"></div>
                <!-- Buttons -->
                <div v-if="isReleased" class="tw-flex tw-flex-col sm:tw-flex-row tw-flex-wrap sm:tw-items-center tw-mt-2">
                    <a :class="`tw-btn-primary tw-bg-${brand} tw-text-xl tw-mb-2 tw-mr-3`" :href="pack.next_lesson_url">
                        <template v-if="0 < pack.progress_percent && pack.progress_percent < 100">
                            <i class="fas fa-play tw-mr-2"></i> Next Lesson
                        </template>
                        <template v-else-if="pack.progress_percent === 100">
                            <i class="fas fa-check-circle tw-mr-2"></i> Completed
                        </template>
                        <template v-else>
                            <i class="fas fa-play tw-mr-2" aria-hidden="true"></i> First Lesson
                        </template>

                    </a>
                    <a
                       class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-text-xl tw-mr-3"
                       :href="pack.url"
                       :class="isReleased ? '' : 'tw-pointer-events-none tw-cursor-default'"
                    >
                        <i class="fas fa-arrow-circle-right tw-mr-2"></i>
                        See Lessons
                    </a>
                </div>
            </div>
            <div class="tw-hidden lg:tw-flex tw-flex-shrink-0">
                <button class="tw-mr-6"><i class="fas fa-plus tw-text-[#ccd3d3] dark:tw-text-[#9EC0DC] tw-text-[28px]" aria-hidden="true" @click="addToPlaylist"></i></button>
                <a v-if="isReleased" :href="pack.next_lesson_url">
                    <i
                        class="fas tw-text-[28px]" aria-hidden="true"
                        :class="progressIcon"
                    ></i>
                </a>
                <button v-else>
                    <i class="fas fa-calendar-plus tw-text-[#ccd3d3] dark:tw-text-[#9EC0DC] tw-text-[28px]"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script setup>
import {storeToRefs} from "pinia/dist/pinia";
import { useUserStore } from '../../../stores/user';
import {computed, onMounted} from "vue";
import { DateTime } from 'luxon';

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

const progressIcon = computed(() => {
    if (0 < props.pack.progress_percent && props.pack.progress_percent < 100){
        return `fa-adjust tw-text-${brand.value}`;
    } else if(props.pack.progress_percent === 100){

        return `fa-check-circle tw-text-${brand.value}`;
    } else {
        return 'fa-arrow-circle-right tw-text-[#ccd3d3] dark:tw-text-[#9EC0DC]';
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

onMounted(()=> {

})
</script>
