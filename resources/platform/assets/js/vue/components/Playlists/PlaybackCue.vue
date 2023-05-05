<script setup>
import { onBeforeMount, onMounted, inject, ref, reactive, computed, nextTick } from 'vue';
import PlaylistService from '../../../services/playlists.js';
import PlaylistCard from './Playlist/PlaylistCard.vue';
import { usePlaylistsStore } from '../../../stores/playlists';
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

//Inject
const token = inject('csrf_token');

//Pinia Stores
const playlistsStore = usePlaylistsStore();

//Emits
const emit = defineEmits(['closeDropdown', 'pinItem', 'makePublic']);

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    prevLessonUrl: {
        type: String,
        default: ''
    },
    nextLessonUrl: {
        type: String,
        default: ''
    },
    playlistName: {
        type: String,
        default: "Playlist"
    },
    playlistUrl: {
        type: String,
        default: ""
    },
    playlistItemId: {
        type: [Number, String],
        default: null
    },
    playlistItemPosition: {
        type: [Number, String],
        default: null
    },
    playlistId: {
        type: [String, Number],
        default: ""
    },
    lessons: {
        type: Object,
        default: {}
    },
    duration: {
        type: String,
        default: "0"
    },
    infiniteScroll: {
        type: Boolean,
        default: true,
    },
    limit: {
        type: Number,
        default: 20,
    },
    isMyPlaylist: {
        type: Number,
        default: 1,
    }
})

//-----------Reactive-----------//
const state = reactive({
    collapsed: true,
})

//-----------Refs-----------//
const pageNumberTop = ref(1);
const pageNumberBottom = ref(1);
// const preventReFetch = ref(false);
const isLoading = ref(false);
const isPlaybackShuffleOn = ref(false);
const isPlaybackRepeatOn = ref(false);


//---------Computed--------//

const shouldShowBottomSkeleton = computed(() => isLoading.value);

/*
const shouldShowBottomSkeleton = computed(() => {
    return (
        (isLoading.value && props.infiniteScroll)
            || (playlistsStore.lessons.length < 20
            && !preventReFetch.value)
        ) && props.lessons?.meta?.totalResults > 20
});

const shouldShowTopSkeleton = computed(() => {
    return pageNumberTop.value > 1;
});
*/
//-----------Methods-----------//

const handleShuffleToggle = () => {
    isPlaybackShuffleOn.value = !isPlaybackShuffleOn.value;
    localStorage.setItem("playbackShuffleOn", isPlaybackShuffleOn.value);
    if (isPlaybackShuffleOn.value) {
        window.shownotification({
            icon: 'shuffle',
            text: `Awesome! Shuffle has been enabled.`
        });
    } else {
        window.shownotification({
            icon: 'shuffle',
            text: `Shuffle has been disabled.`
        });
    }
};

const handleRepeatToggle = () => {
    isPlaybackRepeatOn.value = !isPlaybackRepeatOn.value;
    localStorage.setItem("playbackRepeatOn", isPlaybackRepeatOn.value);

    if (isPlaybackRepeatOn.value) {
        window.shownotification({
            icon: 'repeat',
            text: `Awesome! Looping has been enabled.`
        });
    } else {
        window.shownotification({
            icon: 'repeat',
            text: `Looping has been disabled.`
        });
    }
};

//-----------Lifecycle Hooks -----------//

onBeforeMount(() => {
    playlistsStore.lessons = props.lessons?.data ? props.lessons.data : [];
    pageNumberBottom.value = props.lessons.meta.page;
    pageNumberTop.value = props.lessons.meta.page;

    if (localStorage.getItem("playbackShuffleOn")) {
        isPlaybackShuffleOn.value = JSON.parse(localStorage.getItem("playbackShuffleOn"));
    }
    if (localStorage.getItem("playbackRepeatOn")) {
        isPlaybackRepeatOn.value = JSON.parse(localStorage.getItem("playbackRepeatOn"));
    }
});

onMounted(() => {
    const cueScrollContainer = document.getElementById('cue-scroll-container');
    if (cueScrollContainer) {
        cueScrollContainer.scrollTop = 90;
    }

    const payload = {
        page: 1,
        limit: 300,
        playlist_id: props.playlistId
    };

    //Get Lessons
    isLoading.value = true;
    PlaylistService.getPlaylistLessons(payload, token).then(response => {
        isLoading.value = false;
        if (response.data.results.length) {
            playlistsStore.lessons = response.data.results;
            nextTick(() => {
                const cueScrollContainer = document.getElementById('cue-scroll-container');
                // cueScrollContainer.scrollTop = 90 * 20;
            })
        }
    }).catch(() => {
        window.shownotification({ icon: 'error', text: 'An error ocurred while fetching your data, please try again later.' });
    });
});
</script>
<template>
    <section
        class="tw-z-10 tw-border dark:tw-border-[#002039] tw-border-[#e5e7ea] dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-mb-4">
        <!-- Header -->
        <div class="tw-flex tw-flex-col dark:tw-bg-[#002039] tw-bg-[#e5e7ea] tw-py-[17px] tw-px-[10px]">
            <div class="tw-flex">
                <a :href="playlistUrl"
                    class="tw-inline-flex tw-mr-auto tw-pb-1 tw-large tw-leading-tight tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent hover:tw-border-current">
                    {{ playlistName }}
                </a>
                <button class="tw-px-1 lg:tw-hidden" :title="state.collapsed ? 'Show Playback Cue' : 'Hide Playback Cue'"
                    :class="state.collapsed ? 'tw-rotate-180' : ''" @click="state.collapsed = !state.collapsed">
                    <i class="fas fa-chevron-down tw-text-[#00101D] dark:tw-text-white"></i>
                </button>
            </div>
            <!-- Cue Data -->
            <p class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-mb-1">
                <span>{{ playlistItemPosition }}/{{ props.lessons?.meta?.totalResults }}</span>
                <span class="tw-mx-1">•</span>
                <span>{{ Math.floor(duration / 60) }} min</span>
            </p>
            <!-- CTAs -->
            <div class="tw-flex">
                <!-- Prev Lesson -->
                <a class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white tw-transition-colors tw-mr-3"
                    :href="prevLessonUrl" title="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.76712 0.114258C1.23289 0.114258 0.799805 0.529617 0.799805 1.04199V14.958C0.799805 15.4703 1.23289 15.8857 1.76712 15.8857C2.30135 15.8857 2.73443 15.4703 2.73443 14.958V9.81879C2.76226 9.83874 2.79068 9.85829 2.81971 9.87742L11.2617 15.4418C12.0911 15.9885 13.0893 15.9951 13.8701 15.652C14.6531 15.3079 15.3095 14.5629 15.3095 13.5643V2.43561C15.3095 1.43701 14.6531 0.692022 13.8701 0.347956C13.0893 0.00486338 12.0911 0.011484 11.2617 0.558154L2.81971 6.12252C2.79068 6.14165 2.76226 6.1612 2.73443 6.18115V1.04199C2.73443 0.529617 2.30135 0.114258 1.76712 0.114258ZM12.3575 2.08731C12.5716 1.94619 12.8397 1.93608 13.0643 2.0348C13.2867 2.13253 13.3749 2.28788 13.3749 2.43561V13.5643C13.3749 13.7121 13.2867 13.8674 13.0643 13.9651C12.8397 14.0639 12.5716 14.0538 12.3575 13.9126L3.91546 8.34827C3.75312 8.24126 3.70175 8.1085 3.70175 7.99997C3.70175 7.89145 3.75312 7.75868 3.91546 7.65168L12.3575 2.08731Z"
                            fill="currentColor" />
                    </svg>
                </a>
                <!-- Shuffle -->
                <button class="tw-text-[#3F3F46] tw-transition-colors tw-mr-3"
                    :class="`${isPlaybackShuffleOn ? 'dark:tw-text-white' : 'dark:tw-text-[#9EC0DC] dark:hover:tw-text-white'}`"
                    @click.prevent="handleShuffleToggle" title="Shuffle">
                    <MusoraIcon icon-name="shuffle" class="tw-h-[22px] tw-w-[22px]" width="22" height="22"
                        viewBox="0 0 22 22" />
                </button>
                <!-- Repeat -->
                <button class="tw-text-[#3F3F46] tw-transition-colors tw-mr-3"
                    :class="`${isPlaybackRepeatOn ? 'dark:tw-text-white' : 'dark:tw-text-[#9EC0DC] dark:hover:tw-text-white'}`"
                    @click.prevent="handleRepeatToggle" title="Loop">
                    <MusoraIcon icon-name="repeat" class="tw-h-[22px] tw-w-[22px]" width="22" height="22"
                        viewBox="0 0 22 22" />
                </button>
                <!-- Next Lesson -->
                <a class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white tw-transition-colors"
                    :href="nextLessonUrl" title="Next">
                    <svg class="tw-rotate-180" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.76712 0.114258C1.23289 0.114258 0.799805 0.529617 0.799805 1.04199V14.958C0.799805 15.4703 1.23289 15.8857 1.76712 15.8857C2.30135 15.8857 2.73443 15.4703 2.73443 14.958V9.81879C2.76226 9.83874 2.79068 9.85829 2.81971 9.87742L11.2617 15.4418C12.0911 15.9885 13.0893 15.9951 13.8701 15.652C14.6531 15.3079 15.3095 14.5629 15.3095 13.5643V2.43561C15.3095 1.43701 14.6531 0.692022 13.8701 0.347956C13.0893 0.00486338 12.0911 0.011484 11.2617 0.558154L2.81971 6.12252C2.79068 6.14165 2.76226 6.1612 2.73443 6.18115V1.04199C2.73443 0.529617 2.30135 0.114258 1.76712 0.114258ZM12.3575 2.08731C12.5716 1.94619 12.8397 1.93608 13.0643 2.0348C13.2867 2.13253 13.3749 2.28788 13.3749 2.43561V13.5643C13.3749 13.7121 13.2867 13.8674 13.0643 13.9651C12.8397 14.0639 12.5716 14.0538 12.3575 13.9126L3.91546 8.34827C3.75312 8.24126 3.70175 8.1085 3.70175 7.99997C3.70175 7.89145 3.75312 7.75868 3.91546 7.65168L12.3575 2.08731Z"
                            fill="currentColor" />
                    </svg>
                </a>
            </div>
        </div>
        <!-- Items -->
        <div v-if="playlistsStore.lessons.length" id="cue-scroll-container"
            class="tw-w-full tw-flex tw-flex-col tw-max-h-[540px] tw-overflow-y-auto tw-relative"
            :class="state.collapsed ? 'tw-hidden lg:tw-block' : ''">
            <!-- Top Skeleton for offset For top Infinite Scroll -->
            <div v-if="shouldShowTopSkeleton" class="tw-w-full tw-animate-pulse tw-flex tw-flex-col">
                <div
                    class="tw-flex tw-w-full tw-h-[90px] tw-flex-row tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#E6E7E9] dark:even:tw-bg-[#081825]">
                </div>
            </div>
            <!-- Print Each Card -->
            <playlist-card :currentItem="playlistItemPosition" v-for="(lesson, i) in playlistsStore.lessons"
                :key="'playlist-card-cue-' + lesson.id" :index="i" :cardId="'playlist-card-cue-' + lesson.id"
                :lesson="lesson" :token="token" :brand="brand" :cue-version="true" :in-playback-cue="true"
                :is-my-playlist="isMyPlaylist" />
            <!-- Skeleton Loader For Infinite Scroll -->
            <div v-if="shouldShowBottomSkeleton" class="tw-w-full tw-animate-pulse tw-flex tw-flex-col">
                <div v-for="n in (playlistsStore.lessons.length >= 20 ? limit : 20 - playlistsStore.lessons.length)"
                    :key="n"
                    class="tw-flex tw-w-full tw-h-[90px] tw-flex-row tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#E6E7E9] dark:even:tw-bg-[#081825]">
                </div>
            </div>
        </div>
    </section>
</template>
