<script setup>
import {DateTime} from 'luxon';
import {computed, onBeforeMount, reactive, ref} from 'vue';
import { usePlatformStore } from '../../../../Stores/platform';
import { usePlaylistsStore } from '@stores/playlists';
import { contentTypes } from '../../../../utils';
import PlaylistDropdown from '../PlaylistDropdown.vue';
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel.vue'

//Pinia Stores
const playlistsStore = usePlaylistsStore();
const platformStore = usePlatformStore();

//--------------Props--------------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    lesson: {
        type: Object,
        default: {}
    },
    index: {
        type: Number,
        default: 0,
    },
    isListView: {
        type: Boolean,
        default: true,
    },
    cueVersion: {
        type: Boolean,
        default: false,
    },
    cardId: {
        type: String,
        default: 'playlist-card-id'
    },
    currentItem: {
        type: [String, Number],
        default: null
    },
    isMyPlaylist: {
        type: Number,
        default: 1,
    },
    inPlaybackCue: {
        type: Boolean,
        default: false,
    }
});

//-----------Computed Props-----------//

//Thumbnail
const lessonThumbnail = computed(() => {
    return props.lesson.thumbnail_url;
})
//Song Artist
const artist = computed(() => {
    return props.lesson.artist;
})

const contentTypeString = computed(() => {
    if (props.lesson?.item_type && contentTypes[props.lesson.item_type]?.singular) {
        return contentTypes[props.lesson.item_type].singular
    }
    return '';
})

const showOverlay = computed(() => {
    return !(props.lesson.status === 'published' || props.lesson.status === 'unlisted');
})

//Instructor
const instructor = computed(() => {
    const instructorObject = props.lesson?.fields?.length ? props.lesson.fields.find(data => data.key === 'instructor') : { value: null };
    // console.log('instructor', instructorObject)
    return instructorObject && instructorObject.value ? instructorObject.value : null;
})
//Description
const lessonDescription = computed(() => {
    return props.lesson.playlist_item_name ? props.lesson.playlist_item_name : props.lesson.title;
})
//Show Content Mask
const showMask = computed(() => {
    return playlistsStore.sortingPlaylist;
})
//Need Access
const needAccess = computed(() => {
    return props.lesson.need_access;
})
//Show Time Stamp
const showTimeStamp = computed(() => {
    return props.lesson.start_second !== null && props.lesson.end_second !== null;
})
//Get Instrument Name
const instrument = computed(() => {
    switch (props.brand) {
        case 'drumeo':
            return 'Drum'
        case 'pianote':
            return 'Piano'
        case 'guitareo':
            return 'Guitar'
        case 'singeo':
            return 'Song'
        default:
            return 'Instrument'
    }
})

//-----------Refs-----------//
const dropdownTarget = ref(null)

//-----------Reactive Data-----------//
const state = reactive({
    dropdownOpen: false,
    dropdownTop: false,
    isFullTrack: true,
});

const dropdownOptions = ref([
    {
        name: "Remove",
        action: "removeLesson"
    },
    {
        name: "Add to List",
        action: "addToPlaylist"
    },
    {
        name: "Rename",
        action: "renameItem"
    }
]);

//Get Dates
const dateNow = Date.now();
const lessonDateParsed = props.lesson.published_on_in_timezone ? Date.parse(props.lesson.published_on_in_timezone) : Date.parse(props.lesson.published_on);
const lessonDate = props.lesson.published_on_in_timezone ? props.lesson.published_on_in_timezone : props.lesson.published_on;

//Parse Release Date
const month = DateTime.fromSQL(lessonDate).toFormat('LLL');
const day = DateTime.fromSQL(lessonDate).toFormat('ccc');
const dayNumber = DateTime.fromSQL(lessonDate).toFormat('d');
const yearNumber = DateTime.fromSQL(lessonDate).toFormat('yy');
const time = DateTime.fromSQL(lessonDate).toFormat('h:mm a');

//-----------Methods-----------//

//Format Duration (in seconds)
const duration_formatted = (seconds) => {
    let time = seconds;
    if (time) { //does it exist
        const hrs = Math.floor(time / 3600);
        const min = Math.floor( (time % 3600) / 60);
        const sec = time % 60;
        const hrsFormatted = hrs < 10 ? `${hrs}` : hrs;
        const minFormatted = min < 10 ? `0${min}` : min;
        const secFormatted = sec < 10 ? `0${sec}` : sec;

        if (hrsFormatted === 0 && minFormatted === 0 && secFormatted === 0) return false;
        else return `${hrsFormatted}:${minFormatted}:${secFormatted}`;
    } else {
        return '0:00';
    }
}

const handleNoAccess = (e) => {
    if (props.lesson.need_access) {
        e.preventDefault
        if(props.lesson.show_plus_upgrade_modal){
            platformStore.openMembershipUpgradeModal();
        } else {
            window.openplaylistmodal({ modalType: 'noAccess', data: props.lesson });
        }

    }
}

//Check Dropdown Distance
const GetElementDistance = el => {
    let rect = el.getBoundingClientRect();
    let spaceBelow = window.innerHeight - rect.bottom;
    if (spaceBelow < 240) {
        state.dropdownTop = true;
    } else {
        state.dropdownTop = false;
    }
}

//Handle Dropdown Trigger
const dropdownTriggerHandler = target => {
    GetElementDistance(event.target);
    state.dropdownOpen = !state.dropdownOpen;
}

const openUpgradeModal = () => {
    platformStore.openMembershipUpgradeModal();
}

//-----------Lifecycle Methods-----------//

onBeforeMount(() => {
    state.isPinned = props.lesson.pinned;
    state.isPrivate = props.lesson.private;

    if (props.lesson.type !== 'assignment' && props.lesson.type !== 'song') {
        dropdownOptions.value = [...dropdownOptions.value, {
            name: "Start/End Time",
            action: "editLessonTime"
        }]
    }

    //Check if it's a full track
    if(JSON.parse(props.lesson.user_playlist_item_extra_data)) {
        let instrumentData = JSON.parse(props.lesson.user_playlist_item_extra_data);
        if(instrumentData.is_instrumentless_track) {
            state.isFullTrack = false;
        }
    }

});
</script>
<template>
    <div :id="cardId"
        class="tw-mb-[1px] tw-group tw-h-[100px] tw-min-h-[100px] tw-flex tw-w-full tw-items-center tw-transition-colors hover:tw-bg-[#E0E0E1] dark:hover:tw-bg-[#102230] tw-bg-white dark:tw-bg-[#081825] tw-px-3">
        <div class="tw-flex tw-items-center tw-h-full tw-w-full"
             :class="{ 'tw-relative' : playlistsStore.sortingPlaylist }"
        >
            <!-- PLAYLIST INFO: clickable link -->
            <component :is="needAccess ? 'div' : 'a' "
                       :href="lesson.url && !showMask && !needAccess ? lesson.url : ''"
                       class="tw-inline-flex tw-items-center tw-flex tw-h-full tw-text-[#0D0D0D] dark:tw-text-white tw-cursor-pointer"
                       :class="[!cueVersion ? 'tw-w-[calc(100%-35px)] lg:tw-w-[calc(100%-100px)]' : 'tw-w-full']"
                       @click="handleNoAccess"
            >
                <div class="tw-inline-flex tw-items-center tw-shrink-0 tw-min-w-[40px] tw-transition-opacity tw-text-sm"
                    :class="{ 'tw-opacity-0': playlistsStore.sortingPlaylist }">
                    <template v-if="Number(lesson.user_playlist_item_position) === Number(currentItem)">
                        <i class="fas fa-play"></i>
                    </template>
                    <template v-else>{{ props.index + 1 }}</template>
                </div>
                <!-- Playlist thumbnail -->
                <div
                    class="tw-relative tw-inline-flex tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-aspect-video tw-w-[125px] tw-rounded tw-shrink-0 "
                >
                    <!-- Image Container -->
                    <div class="tw-relative tw-w-full tw-h-full" v-if="lessonThumbnail">
                        <img :src="`https://musora.com/cdn-cgi/image/width=330/${lessonThumbnail}`" alt="playlist thumbnail"
                            class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm" loading="lazy" onload="this.classList.remove('tw-opacity-0')" />
                        <!-- Image Mask -->
                        <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                            <img class="tw-h-full tw-object-contain" :class="{ '': needAccess }"
                                :src="`https://musora.com/cdn-cgi/image/width=330/${lessonThumbnail}`" alt="playlist thumbnail">
                        </div>
                    </div>

                    <!-- Overlay -->
                    <div v-if="lesson.progress_percent === 100 || showOverlay"
                         class="tw-z-10 tw-absolute tw-top-0 tw-w-full tw-h-full tw-text-white tw-left-0 tw-bg-black/70 tw-flex tw-flex-col tw-items-center tw-justify-center"
                    >
                        <template v-if="showOverlay">
                            <p class="tw-text-xs text-white font-bold">
                                {{ day }},
                                <span class="tw-capitalize">{{ month }}</span> <span class="">{{ dayNumber }}/{{ yearNumber
                                }}</span>
                            </p>
                            <p class="tw-text-xs text-white">{{ time }}</p>
                        </template>
                        <template v-if="lesson.progress_percent === 100">
                            <musora-icon icon-name="circle-check-filled" class="tw-w-6 tw-h-6"/>
                        </template>
                    </div>

                    <!-- Progress Bar -->
                    <div class="tw-z-[15] tw-absolute tw-flex tw-bottom-0 tw-left-0 tw-h-1 tw-w-full">
                        <span class="tw-h-full tw-absolute tw-left-0 tw-bottom-0"
                              :class="[`tw-bg-${brand}`]"
                              :style="`width: ${lesson.progress_percent}%;`"
                        >
                        </span>
                    </div>

                    <!-- Lock Icon -->
                    <div v-if="needAccess" class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-[rgba(0,12,23,0.85)] tw-z-20 tw-flex tw-justify-center tw-items-center">
                        <musora-icon class="tw-w-[30px]" icon-name="lock-icon"></musora-icon>
                    </div>
                </div>

                <div class="tw-truncate tw-w-full  tw-px-3 lg:tw-pl-[15px]"
                    :class="[{ 'lg:tw-w-[calc(100%-350px)]': !cueVersion }]">
                    <!--title-->
                    <p class="tw-truncate tw-uppercase tw-mr-1 tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-xs"
                        :class="[{ 'md:tw-block': !cueVersion }]">
                        <!-- Breadcrumb -->
                        <span v-for="(route, i) in lesson.route" :key="i">
                            {{ route }}<span v-if="i != (lesson.route.length - 1)" class="tw-px-1">•</span>
                        </span>

                        <!-- if instrumentless -->
                        <template v-if="lesson.item_type === 'song' && !state.isFullTrack">
                            <span>{{ instrument }}less</span>
                        </template>
                        <!-- if routine -->
                        <template v-if="lesson.item_type === 'routine' && lesson.is_high_routine === true">
                            <span>High Voice</span>
                        </template>
                        <template v-if="lesson.item_type === 'routine' && lesson.is_low_routine === true">
                            <span>Low Voice</span>
                        </template>
                    </p>
                    <!-- description / Time Stamp-->
                    <div class="tw-flex tw-items-center tw-w-full">
                        <p class="tw-font-bold tw-text-sm tw-whitespace-normal tw-line-clamp-1">{{ lessonDescription }}</p>
                        <!-- Time Stamp Icon -->
                        <button v-if="!cueVersion"
                            :title="`Begins ${duration_formatted(lesson.start_second) || '0:00:00'}&nbsp; • &nbsp;Ends ${duration_formatted(lesson.end_second) || duration_formatted(lesson.duration) || '0:00:00'}`">
                            <svg v-if="showTimeStamp" class="tw-ml-2 tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]" width="16"
                                height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_225_6622)">
                                    <path
                                        d="M12.176 9.005H8.48C8.208 9.005 8 8.797 8 8.525V4.829C8 4.541 8.256 4.317 8.528 4.349C10.688 4.589 12.4 6.301 12.64 8.461C12.688 8.749 12.464 9.005 12.176 9.005Z"
                                        fill="currentColor" />
                                    <path
                                        d="M14.2415 4.63743L14.0015 4.84543C13.9375 4.90943 13.8415 4.89343 13.7935 4.82943C13.5055 4.44543 13.1695 4.07743 12.8175 3.75743C12.7535 3.69343 12.7535 3.59743 12.8175 3.54943L13.0575 3.34143C13.2335 3.18143 13.4415 3.11743 13.6495 3.11743C13.8895 3.11743 14.1295 3.21343 14.3055 3.40543C14.6415 3.74143 14.6095 4.30143 14.2415 4.63743Z"
                                        fill="currentColor" />
                                    <path
                                        d="M8.5605 2.31696V1.67696H9.2805C9.4245 1.67696 9.5365 1.56496 9.5365 1.42096V0.892963C9.5365 0.748963 9.4245 0.636963 9.2805 0.636963H6.7205C6.5765 0.636963 6.4645 0.748963 6.4645 0.892963V1.42096C6.4645 1.56496 6.5765 1.67696 6.7205 1.67696H7.4565V2.31696C6.0485 2.42896 4.7685 2.98896 3.7445 3.83696C3.2805 4.22096 2.8805 4.65296 2.5445 5.13296C1.7605 6.22096 1.3125 7.56496 1.3125 9.00496C1.3125 12.701 4.3205 15.709 8.0165 15.709C11.7125 15.709 14.7205 12.701 14.7205 9.00496C14.7045 5.50096 12.0005 2.60496 8.5605 2.31696ZM8.0005 14.461C4.9925 14.461 2.5445 12.013 2.5445 9.00496C2.5445 7.88496 2.8805 6.84496 3.4565 5.98096C3.7925 5.48496 4.1925 5.05296 4.6565 4.68496C5.5845 3.96496 6.7365 3.54896 7.9845 3.54896C10.9925 3.54896 13.4405 5.99696 13.4405 9.00496C13.4565 12.013 11.0085 14.461 8.0005 14.461Z"
                                        fill="currentColor" />
                                    <path
                                        d="M3.16687 3.6766C2.79887 3.9966 2.46287 4.3486 2.17487 4.7486C2.12687 4.8126 2.03087 4.8286 1.96687 4.7646L1.79087 4.6046C1.42287 4.2686 1.40687 3.7246 1.72687 3.3566C1.90287 3.1646 2.14287 3.0686 2.38287 3.0686C2.59087 3.0686 2.81487 3.1486 2.97487 3.2926L3.16687 3.4686C3.24687 3.5326 3.23087 3.6286 3.16687 3.6766Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_225_6622">
                                        <rect width="16" height="16" fill="white" transform="translate(0 0.172119)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </div>
                    <!-- Cue Version Data -->
                    <p class="tw-w-full tw-flex tw-items-center tw-text-xs tw-capitalize tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-mt-1 tw-mr-1"
                        :class="[{ 'md:tw-mt-0 md:tw-text-sm': !cueVersion }]">
                        <!-- Instructor / Artist -->
                        <template v-if="lesson.item_type === 'song'">
                            <span>{{ artist }}</span>
                        </template>
                        <template v-else-if="lesson.instructors && lesson.instructors.length">
                            <span v-for="(instructor, i) in lesson.instructors" class="tw-whitespace-nowrap tw-truncate "
                                :key="i">
                                {{ instructor }}<span v-if="i != (lesson.instructors.length - 1)">,</span>
                            </span>
                        </template>
                        <!-- Or Lesson Type -->
                        <span v-else>{{ aaaa }}</span>
                        <!-- Duration OR Lesson Type -->
                        <span class="tw-mx-0.5" :class="[{ 'lg:tw-hidden': !cueVersion }]">|</span>
                        <span :class="[{ 'lg:tw-hidden': !cueVersion }]">{{ contentTypeString }}</span>
                    </p>
                </div>

                <template v-if="!cueVersion">
                    <!-- Lesson Skill Level -->
                    <div class="tw-hidden xl:tw-inline-flex tw-justify-start tw-shrink-0 tw-w-[140px]" :title="contentTypeString">
                        <span v-if="lesson.item_type" class="tw-text-center tw-text-sm ">
                            <DifficultyLabel class="" :difficultyValue="lesson.difficulty" textCase="uppercase" />
                        </span>
                    </div>
                    <!-- Lesson Type -->
                    <div class="tw-hidden xl:tw-inline-flex tw-justify-start tw-shrink-0 tw-w-[140px]" :title="contentTypeString">
                        <span v-if="lesson.item_type" class="tw-text-center tw-text-sm tw-capitalize">
                            {{ contentTypeString }}
                        </span>
                    </div>
                    <!-- Lesson Time -->
                    <div class="tw-hidden xl:tw-inline-flex tw-justify-center tw-shrink-0 tw-w-[100px] tw-text-sm"
                        :title="lesson.duration">
                        <span>{{ duration_formatted(lesson.duration) || '' }}</span>
                    </div>
                </template>

                <!-- PLAYBACK CUE OPTIONS DROPDOWN -->
                <div v-if="cueVersion"
                    class="tw-inline-flex tw-items-center tw-justify-end tw-shrink-0 tw-w-[25px] tw-h-[25px] md:tw-justify-center 2xl:tw-hidden 2xl:group-hover:tw-inline-flex">
                    <div class="tw-relative tw-align-middle" v-click-outside="() => { state.dropdownOpen = false }">
                        <button v-if="!needAccess && !playlistsStore.sortingPlaylist"
                            class="tw-flex tw-justify-center tw-items-center tw-w-[25px] tw-h-[25px] tw-text-[#445F74] dark:tw-text-[#7E9AB1] tw-rounded-full tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2"
                            title="Playlist Options" @click.prevent="dropdownTriggerHandler($event)">
                            <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <!-- Dropdown-->
                        <PlaylistDropdown
                            :brand="brand"
                            :dropdownTop="state.dropdownTop"
                            :is-open="state.dropdownOpen"
                            :dropdownOptions="dropdownOptions"
                            :data="lesson"
                            :index="index"
                            type="lesson"
                            @closeDropdown="state.dropdownOpen = false"
                            @pinItem="(val) => state.isPinned = val"
                            :in-playback-cue="inPlaybackCue"
                            :is-my-playlist="isMyPlaylist"
                        />
                    </div>
                </div>
            </component>

            <!-- PLAYLISTS OPTIONS DROPDOWN -->
            <div v-if="!cueVersion"
                class="tw-inline-flex tw-items-center tw-justify-end tw-shrink-0 tw-w-[35px] lg:tw-w-[100px] md:tw-justify-center">
                <div class="tw-relative " v-click-outside="() => { state.dropdownOpen = false }">
                    <button v-if="!playlistsStore.sortingPlaylist"
                        class="tw-btn-primary tw-btn-small tw-btn-circle tw-text-[#445F74] dark:tw-text-[#7E9AB1] tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2 tw-rotate-0 lg:tw-rotate-90"
                        title="Playlist Options" @click.prevent="dropdownTriggerHandler($event)">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <!-- Info Icon -->
                    <!-- <svg v-else-if="needAccess && !playlistsStore.sortingPlaylist"
                        class="tw-text-[#445F74] dark:tw-text-[#7E9AB1]" width="30" height="29" viewBox="0 0 30 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.4583 20.3333H15V14.5H13.5417M15 8.66667H15.0146M28.125 14.5C28.125 21.7487 22.2487 27.625 15 27.625C7.75126 27.625 1.875 21.7487 1.875 14.5C1.875 7.25126 7.75126 1.375 15 1.375C22.2487 1.375 28.125 7.25126 28.125 14.5Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> -->
                    <!-- Sort Icon -->
                    <svg v-else class="tw-text-[#445F74] dark:tw-text-[#9EC0DC]" width="25" height="14" viewBox="0 0 25 14"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.83301 1.66699H23.1663M1.83301 12.3337H23.1663" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <!-- Dropdown-->
                    <PlaylistDropdown
                        :brand="brand"
                        :dropdownTop="state.dropdownTop"
                        :is-open="state.dropdownOpen"
                        :dropdownOptions="dropdownOptions"
                        :data="lesson"
                        :index="index"
                        :in-playback-cue="inPlaybackCue"
                        :is-my-playlist="isMyPlaylist"
                        type="lesson"
                        @closeDropdown="state.dropdownOpen = false"
                        @pinItem="(val) => state.isPinned = val"
                    />
                </div>
            </div>

            <!-- content mask -->
            <div :class="[{ 'tw-hidden': !showMask }, playlistsStore.sortingPlaylist ? 'drag-handle tw-cursor-move' : 'tw-cursor-pointer']"
                class="tw-z-[15] tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-border-[#445F74] dark:tw-border-[#7E9AB1]"
            >
            </div>
        </div>
    </div>
</template>
