<script setup>
import { computed, onMounted, ref } from 'vue';
import { DateTime } from 'luxon';
import { LockClosedIcon, ClockIcon } from '@heroicons/vue/outline';
import AddEventModal from '@vuesora/Components/AddEvent/AddEventModal.vue';
import UserCatalogueEvents from "@vuesora/mixins/UserCatalogueEvents";


// todo: calendar in progress, still need to find why the calendar buttons are not showing up

const props = defineProps({
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
    unavailableType: {
        type: String,
        default: 'unreleased'
    },
    message: {
        type: String,
        default: ''
    },
    brand: {
        type: String,
        default: 'drumeo'
    },
    isSong: {
        type: Boolean,
        default: false
    },
    subscriptionCalendarId: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['goToNext']);

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
const month = DateTime.fromMillis(props.releaseDate).toFormat('LLL');
const dayNumber = DateTime.fromMillis(props.releaseDate).toFormat('d');
const yearNumber = DateTime.fromMillis(props.releaseDate).toFormat('yy');

// refs

const ctaClicked = ref(false);

// Methods

const handleCalendarCtaClick = (e) => {
    //Commenting this out until is needed, I think in other instances this creates an object to show the single event button. This could be replaced with a different pattern.
    //addEvent(e);
    ctaClicked.value = true;
};

const handleCtaClick = () => {
    ctaClicked.value = true;
    window.location.href = cta.value.url;
};

const handleGoToNext = () => {
    if (!ctaClicked.value) {
        emit('goToNext');
    }
};

// lifecycle methods

onMounted(() => {
    const isPlaylistRepeatOn = localStorage.getItem("isPlaybackPlaylistRepeatOn") ? JSON.parse(localStorage.getItem("isPlaybackPlaylistRepeatOn")) : false;
    if (isPlaylistRepeatOn) {
        setTimeout(() => {
            document.getElementById('content-unavailable-blue-bar').style.width = '100%';
        }, 300);

        setTimeout(() => {
            handleGoToNext();
        }, 3300);
    }
});

</script>

<template>
    <div
        :class="`tw-flex tw-items-center tw-justify-center tw-text-center tw-text-white tw-w-full tw-aspect-video tw-relative tw-overflow-hidden`">
        <img :src="bgImgUrl" />
        <div class="tw-absolute tw-bg-[#000000]/80 tw-w-full tw-h-full"></div>
        <div class="tw-absolute tw-flex tw-flex-col tw-items-center tw-justify-center">
            <div class="tw-w-[35px] tw-h-[35px] tw-mb-[10px]">
                <ClockIcon v-if="unavailableType === 'unreleased'" />
                <LockClosedIcon v-if="unavailableType !== 'unreleased'" />
            </div>
            <h2 class="tw-mb-[2px]">Content Unavailable</h2>
            <p v-if="unavailableType === 'unreleased'">
                <strong>{{ itemName }}</strong> is scheduled for release on <strong><span class="tw-capitalize">{{ month
                }}</span> <span class="">{{ dayNumber }}/{{ yearNumber }}</span></strong>
                <br />
                Please check back after the content is released.
            </p>
            <p v-if="unavailableType !== 'unreleased' && message" class="lg:tw-line-clamp-2" v-html="message"></p>
            <button v-if="unavailableType === 'unreleased'" data-open-modal="addToCalendarModal"
                @click="handleCalendarCtaClick" type="button"
                class="tw-mt-[20px] tw-mx-4 tw-btn-secondary tw-bg-[#00101D] tw-text-white" dusk="cta-button">
                {{ cta.text }}
            </button>
            <button v-else @click="handleCtaClick" type="button"
                class="tw-mt-[20px] tw-mx-4 tw-btn-secondary tw-bg-[#00101D] tw-text-white" dusk="cta-button">
                {{ cta.text }}
            </button>
        </div>
        <div class="tw-absolute tw-w-full tw-h-[8px] tw-bottom-0">
            <div id="content-unavailable-blue-bar" class="tw-h-full tw-bg-[#0B76DB]" style="width: 0"></div>
        </div>
        <AddEventModal v-if="unavailableType === 'unreleased'" modal-id="addToCalendarModal"
            :subscription-calendar-id="subscriptionCalendarId" :theme-color="brand" toggleSubscribe="toggleSubscribe">
        </AddEventModal>
    </div>
</template>

<style>
#content-unavailable-blue-bar {
    transition: width 3s;
}
</style>
