<script setup>
import { computed } from 'vue';
import { PlusIcon } from '@heroicons/vue/solid';

const props = defineProps({
    thumbnail: {
        type: String,
        default: '',
    },
    instructor: {
        type: String,
        default: '',
    },
    title: {
        type: String,
        default: '',
    },
    difficulty: {
        type: String,
        default: '',
    },
    contentType: {
        type: String,
        default: '',
    },
    url: {
        type: String,
        default: '',
    },
    id: {
        type: Number,
        default: null,
    },
    lesson: {
        type: Object,
        default: () => ({}),
    },
});

const addToPlaylist = () => {
    window.openplaylistmodal({
        modalType: 'addItem', content: {
            content_id: props.id,
            type: props.contentType,
            name: props.title,
            thumbnail_url: props.thumbnail,
            description: props.lesson.description,
        }
    });
}
const levelColor = computed(() => {
    switch (props.difficulty) {
        case 'Novice':
            return 'tw-text-[#16A34A]';
        case 'Beginner':
            return 'tw-text-[#0B76DB]';
        case 'Advanced':
            return 'tw-text-[#F06314]';
        case 'Expert':
            return 'tw-text-[#B91C1C]';
        case 'Intermediate':
            return 'tw-text-[#EAB308]';
        default:
            return 'tw-text-gray-500';
    }
});

</script>

<template>
    <div class="tw-flex tw-pl-[8px] tw-pr-[18px] tw-py-[4px]">
        <a :href="url" class="tw-h-[71px] tw-w-[123px] tw-rounded-[7px] tw-shrink-0"
            :style="{ backgroundImage: `url(${thumbnail})` }"></a>
        <div
            class="tw-ml-[8px] tw-flex tw-flex-col tw-h-full tw-flex-grow tw-justify-center tw-overflow-hidden tw-py-[4px]">
            <a :href="url" class="tw-text-[12px] dark:tw-text-[#9EC0DC] tw-uppercase">{{ instructor }}</a>
            <a :href="url" class="tw-text-[14px] tw-truncate">{{ title }}</a>
            <a :href="url" class="tw-text-[12px] dark:tw-text-[#9EC0DC]">
                <span :class="levelColor">⬤</span>
                &nbsp;
                <span>{{ difficulty }}</span>
                &nbsp;•&nbsp;
                <span>{{ contentType }}</span>
            </a>
        </div>
        <div class="tw-flex tw-justify-center tw-items-center tw-shrink-0">
            <button @click="addToPlaylist">
                <PlusIcon class="tw-w-[27px] tw-h-[27px]" />
            </button>
        </div>
    </div>
</template>
