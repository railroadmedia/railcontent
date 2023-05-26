<script setup>
import { computed, onMounted } from 'vue';
import { DateTime } from 'luxon';
import { LockClosedIcon, ClockIcon } from '@heroicons/vue/outline';

// todo: add to calendar modal (what to do here?)

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    bgImgUrl: {
        type: String,
        default: ''
    },
    itemName: {
        type: String,
        default: ''
    },
    releaseDate: {
        type: String,
        default: ''
    },
    packName: {
        type: String,
        default: ''
    },
    needAccessMessage: {
        type: String,
        default: ''
    },
    unavailableType: {
        type: String,
        default: 'unreleased'
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
            url: `https://${props.brand}.com/shop`
        },
        unreleased: {
            text: `ADD TO CALENDAR`,
            url: ``
        },
        expired: {
            text: `CLICK HERE TO UPGRADE`,
            url: `https://${props.brand}.com/shop`
        },
        song: {
            text: `CLICK HERE TO LEARN MORE AND UPGRADE`,
            url: `https://${props.brand}.com/songs`
        },
        pack: {
            text: `CLICK HERE TO LEARN MORE`,
            url: `https://${props.brand}.com/shop`
        },
    }[props.unavailableType];
});

//Parse Release Date

const month = DateTime.fromSeconds(props.releaseDate).toFormat('LLL');
const dayNumber = DateTime.fromSeconds(props.releaseDate).toFormat('d');
const yearNumber = DateTime.fromSeconds(props.releaseDate).toFormat('yy');

onMounted(() => {
    console.log(props.releaseDate)
})

</script>

<template>
    <div
        :class="`tw-flex tw-items-center tw-justify-center tw-text-center tw-text-white tw-w-full tw-aspect-video tw-relative`">
        <img :src="bgImgUrl" />
        <div class="tw-absolute tw-bg-[#000000]/80 tw-w-full tw-h-full"></div>
        <div class="tw-absolute tw-flex tw-flex-col tw-items-center tw-justify-center">
            <div class="tw-w-[35px] tw-h-[35px] tw-mb-[10px]">
                <ClockIcon v-if="unavailableType === 'unreleased'" />
                <LockClosedIcon v-if="unavailableType !== 'unreleased'" />
            </div>
            <h2 class="tw-mb-[2px]">Content Unavailable</h2>
            <!--
            <p v-if="unavailableType === 'pack'"><strong>{{ itemName }}</strong> is part of our <strong>{{ packName
            }}</strong></p>
            <p v-if="unavailableType === 'song'">This song is part of <strong>Musora+ Membership.</strong></p>
            <p v-if="unavailableType === 'expired'">This lesson is part of our <strong>Musora Membership.</strong></p>
            <p v-if="unavailableType === 'lifetime'">This masterclass is part of our exclusive <strong>Lifetime
                    Membership.</strong></p>
            -->
            <p v-if="unavailableType === 'unreleased'">
                <strong>{{ itemName }}</strong> is scheduled for release on <strong><span class="tw-capitalize">{{ month
                }}</span> <span class="">{{ dayNumber }}/{{ yearNumber }}</span></strong>
                <br />
                Please check back after the content is released.
            </p>
            <p v-if="unavailableType !== 'unreleased'" class="lg:tw-line-clamp-2" v-html="state.message"></p>
            <button v-if="unavailableType === 'unreleased'" data-open-modal="addToCalendarModal" @click="addEvent" type="button" class="tw-mt-[20px] tw-mx-4 tw-btn-secondary tw-bg-[#00101D] tw-text-white" dusk="cta-button">
                {{ cta.text }}
            </button>
            <a v-else :href="cta.url" type="button" class="tw-mt-[20px] tw-mx-4 tw-btn-secondary tw-bg-[#00101D] tw-text-white" dusk="cta-button">
                {{ cta.text }}
            </a>
        </div>
</div></template>
