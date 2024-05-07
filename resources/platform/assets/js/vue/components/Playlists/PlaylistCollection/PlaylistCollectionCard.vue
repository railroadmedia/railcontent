<script setup>
import { onBeforeMount, watch, ref, inject, computed, reactive } from 'vue';
import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
import PlaylistDropdown from '../PlaylistDropdown.vue';
import PlaylistThumbnail from '../PlaylistThumbnail.vue';
import userJourney from '../../../../services/userJourney';

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    listElement: {
        type: Object,
        default: {}
    },
    isListView: {
        type: Boolean,
        default: false,
    },
    isMiniCatalog: {
        type: Boolean,
        default: false,
    },
    index: {
        type: Number,
        default: 0,
    },
    trackingSection: {
        type: String,
        default: '',
    },
});

//-----------Computed Props-----------//
const duration_formated = computed(() => {
    return props.listElement.duration_formated ? props.listElement.duration_formated.replace(/^0(?:0:0?)?/, '') : '0:00';
})
const description = computed(() => {
    return props.listElement.description.replace(/(<([^>]+)>)/gi, "");
})

//-----------Reactive Data-----------//
const state = reactive({
    dropdownOpen: false,
    dropdownTop: false,
    isPinned: false,
    isPrivate: true,
});

//-----------Static Data-----------//
const dropdownOptions = [
    {
        name: "Share",
        action: "sharePlaylist"
    },
    {
        name: "Edit",
        action: "editPlaylist"
    },
    {
        name: "Delete",
        action: "deletePlaylist"
    },
    {
        name: "Duplicate",
        action: "duplicatePlaylist"
    },
    {
        name: "Pin To Sidebar",
        action: "pinPlaylist"
    },
    {
        name: "Private",
        action: "privateToggle"
    },
]

//-----------Watchers-----------//
watch(props.listElement, async (newListElement) => {
    state.isPinned = newListElement.pinned;
})

//-----------Methods-----------//

//Check Dropdown Distance
const GetElementDistance = el => {
    let rect = el.getBoundingClientRect();
    let spaceBelow = window.innerHeight - rect.bottom;
    //wait for element to appear on screen
    window.setTimeout(() => {
        let dropdown = document.querySelector(`#pl-dropdown-${props.index}`);
        if (spaceBelow < dropdown.offsetHeight) {
            state.dropdownTop = true;
        } else {
            state.dropdownTop = false;
        }
    }, 0)
}

//Handle Dropdown Trigger
const dropdownTriggerHandler = target => {
    state.dropdownOpen = !state.dropdownOpen;
    GetElementDistance(event.target);
}

//---------Lifecycle Methods---------//

onBeforeMount(() => {
    // console.log(props.listElement)
    //check if it's pinned with request? Or prerender?
    state.isPinned = props.listElement.pinned ? true : false;
    state.isPrivate = props.listElement.private;
});


const handleClick = (event, url) => {
    if (url) {
        event.preventDefault();

        userJourney.trackHomeContentClick({
            payload: {
                contentId: null,
                brand: props.brand,
                section: 'playlists',
            }
        }).finally(() => {
            window.location.href = url;
        });
    }
}
</script>
<template>
    <div class="tw-group tw-relative"
        :class="isListView ? 'tw-h-[92px] tw-mb-[1px] tw-px-1.5 md:tw-px-6 tw-flex tw-flex-row tw-w-full tw-items-center tw-transition-colors tw-py-1 hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-[#081825]/50 tw-bg-white dark:tw-bg-[#081825]' : `tw-grid tw-grid-rows-5 tw-grid-cols-5 tw-gap-1 ${isMiniCatalog ? 'tw-w-[221px] tw-min-w-[221px] lg:tw-w-auto lg:tw-min-w-0 lg:[&:nth-child(11)]:tw-hidden lg:[&:nth-child(12)]:tw-hidden 2xl:[&:nth-child(11)]:tw-grid 2xl:[&:nth-child(12)]:tw-grid' : ''}`">
        <!-- Playlist thumbnail -->
        <PlaylistThumbnail :listElement="listElement" :isListView="isListView" :isMiniCatalog="isMiniCatalog"
            :brand="brand" :linkUrl="listElement.playback_url" @onThumbnailClick="(e) => handleClick(e, listElement.playback_url)" :useCallback="true" />

        <!-- PLAYLIST INFO: clickable link -->
        <a @click="(e) => handleClick(e, listElement.url)" :href="listElement.url"
            class="playlist-info-link tw-flex tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-group"
            :class="props.isListView ? '' : 'tw-col-span-4'">
            <div class="tw-w-full" :class="props.isListView ? 'tw-grid tw-grid-cols-10 tw-items-center' : ''">
                <!--name-->
                <p class="playlist-info-link-name tw-w-full tw-flex tw-items-center group-hover:tw-no-underline"
                    :class="props.isListView ? 'tw-col-span-10 md:tw-col-span-7 xl:tw-col-span-3 tw-pl-2 md:tw-pl-[19px] tw-pr-2' : 'tw-mt-1'">
                    <span class="tw-font-bold tw-truncate tw-max-w-full tw-text-sm">{{ listElement.name }}</span>
                    <!-- Playlist Count -->
                    <span
                        class="tw-inline-flex tw-ml-1.5 tw-text-xs tw-px-2 tw-py-1.5 tw-bg-[#E0E0E1] tw-leading-none tw-rounded-full dark:tw-bg-[#002039] dark:tw-text-white">
                        {{ listElement.total_items }}
                    </span>
                </p>
                <!--description-->
                <p class="tw-truncate tw-hidden"
                    :class="props.isListView ? 'tw-hidden xl:tw-inline-flex  xl:tw-col-span-4' : ''">
                    <span class="tw-truncate tw-max-w-[512px] tw-pl-2 tw-pr-4 ">{{ description }}</span>
                </p>
                <!--category / duration -->
                <div class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-xs tw-flex"
                    :class="props.isListView ? 'tw-col-span-10 md:tw-col-span-3 tw-w-full tw-pl-2 md:tw-pl-0 md:tw-text-base' : ''">
                    <div :class="props.isListView ? 'md:tw-w-1/2 tw-inline-flex tw-items-center' : ''">
                        <span v-if="listElement.category" :class="{ 'tw-text-center': props.isListView }">
                            {{ listElement.category }}
                            <span class="tw-mx-1 tw-leading-none"
                                :class="props.isListView ? 'md:tw-hidden' : ''">|</span>
                        </span>
                    </div>
                    <div
                        :class="props.isListView ? 'md:tw-w-1/2 tw-inline-flex tw-justify-center tw-items-center' : ''">
                        <span>{{ duration_formated }}</span>
                    </div>
                </div>
            </div>
            <!-- Pinned Icon -->
            <div class="tw-items-center tw-transition-colors"
                :class="[!props.isListView ? 'tw-inline-flex tw-z-20 tw-absolute tw-top-2 tw-right-2 tw-bg-[rgba(0,12,23,0.5)] tw-rounded-full tw-p-1.5' : 'tw-hidden sm:tw-inline-flex tw-px-4 xl:tw-px-8', { 'tw-opacity-0': !state.isPinned }]">
                <musora-icon icon-name="tack" class="tw-w-[20px] tw-h-[20px] tw-mx-auto dark:tw-text-white" />
            </div>
        </a>

        <!-- PLAYLISTS OPTIONS DROPDOWN -->
        <div class="tw-inline-flex tw-items-center tw-justify-end"
            :class="props.isListView ? 'md:tw-w-[100px] md:tw-justify-center' : 'tw-col-span-1'">
            <div class="tw-relative " v-click-outside="() => { state.dropdownOpen = false }">
                <button
                    class="tw-btn-primary tw-btn-small tw-btn-circle tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#E0E0E1] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2 tw-rotate-0"
                    :class="props.isListView ? 'md:tw-rotate-90' : ''" title="Playlist Options"
                    @click.prevent="dropdownTriggerHandler($event)">
                    <svg class="tw-pointer-events-none" width="25" height="25" viewBox="0 0 25 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <!-- Dropdown -->
                <PlaylistDropdown :index="index" :brand="brand" :dropdownTop="isMiniCatalog ? true : state.dropdownTop"
                    :is-private="state.isPrivate" :is-pinned="state.isPinned ? true : false"
                    :dropdownOptions="dropdownOptions" :data="listElement" :is-open="state.dropdownOpen" type="playlist"
                    @closeDropdown="state.dropdownOpen = false" @pinItem="(val) => state.isPinned = val" />
            </div>
        </div>
    </div>
</template>

<style>
.playlist-info-link:hover .playlist-info-link-name {
    text-decoration: underline;
}
</style>
