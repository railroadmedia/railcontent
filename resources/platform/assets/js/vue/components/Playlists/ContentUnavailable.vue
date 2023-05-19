<script setup>
import { computed } from 'vue';
import { LockClosedIcon, ClockIcon } from '@heroicons/vue/outline';

// lifetime, expired, song, pack, unavailable
// todo: ask about progress bar on design

const props = defineProps({
    bgImgUrl: String,
    itemName: String,
    unavailableType: {
        type: String,
        default: 'unavailable'
    },
});

const cta = computed(() => {
    return {
        lifetime: {
            text: `CLICK HERE TO LEARN MORE`,
            url: ``
        },
        unreleased: {
            text: `ADD TO CALENDAR`,
            url: ``
        },
        expired: {
            text: `CLICK HERE TO UPGRADE`,
            url: ``
        },
        song: {
            text: `CLICK HERE TO LEARN MORE AND UPGRADE`,
            url: ``
        },
        pack: {
            text: `CLICK HERE TO LEARN MORE`,
            url: ``
        },
    }[props.unavailableType];
});

const subtitle = computed(() => {
    return {
        lifetime: ``,
        unreleased: ``,
        expired: ``,
        song: ``,
        pack: ``,
    }[props.unavailableType];
});

const handleClick = () => {
    console.log('CTA');
};

</script>

<template>
    <div :class="`tw-flex tw-items-center tw-justify-center tw-w-full tw-aspect-video tw-bg-[url('${bgImgUrl}')]`">
        <div class="tw-flex tw-flex-col">
            <div class="tw-w-[35px] tw-h-[35px]">
                <ClockIcon v-if="icon === 'unreleased'" />
                <LockClosedIcon v-if="icon !== 'unreleased'" />
            </div>
            <h2>Content Unavailable</h2>
            <p>{{ subtitle }}</p>
            <button type="button" class="tw-mb-[20px] tw-mx-4 tw-btn-secondary tw-bg-[#00101D] tw-text-white"
                dusk="cta-button" @click="handleClick">
            </button>
        </div>
    </div>
</template>
