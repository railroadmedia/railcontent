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
    message: String,
    brand: {
        type: String,
        default: 'drumeo'
    },
    isSong: {
        type: Boolean,
        default: false
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
            <p>{{ props.message }}</p>
            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                <!-- Go To Shop -->
                <a v-if="!isSong"
                   :href="`https://${brand}.com/shop`"
                   target="_blank"
                   class="tw-btn-secondary tw-text-[#0D0D0D] dark:tw-text-white">
                    Click Here To Learn More
                </a>
                <!-- Go To Songs -->
                <a v-else :href="`/${brand}/songs`" class="tw-btn-secondary tw-text-[#0D0D0D] dark:tw-text-white">
                    Click Here To Learn More and Upgrade
                </a>
            </div>
<!--            <button type="button" class="tw-mb-[20px] tw-mx-4 tw-btn-secondary tw-bg-[#00101D] tw-text-white"-->
<!--                dusk="cta-button" @click="handleClick">-->
<!--            </button>-->
        </div>
    </div>
</template>
