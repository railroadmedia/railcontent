<script setup>
    import PlaylistService from '../../../../services/playlists.js';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue'
    import PlaylistDropdown from '../PlaylistDropdown.vue';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import { onBeforeMount, ref, inject, reactive, onMounted, onUpdated } from 'vue';

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        playlist: {
            type: Object,
            default: {}
        },
        lessons: {
            type: Object,
            default: {
                data: []
            }
        },
        hasAccess: {
            type: Number,
            default: 1,
        }
    })

    //-------------Refs-------------//
    const dropdownTarget = ref(null)

    //-----------Reactive Data-----------//
    const state = reactive({
        dropdownOpen: false,
        dropdownTop: false,
        isPrivate: 1,
        isPinned: false,
        isLiked: false,
    })

    //-----------Static Data-----------//
    const dropdownOptions = [
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
            name: "Re-Order",
            action: "reorderPlaylist"
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

    //--------------Methods--------------//

    //Check Dropdown Distance
    const GetElementDistance = el => {
        let rect = el.getBoundingClientRect();
        let spaceBelow = window.innerHeight - rect.bottom;
        if(spaceBelow < 240) {
            state.dropdownTop = true;
        } else {
            state.dropdownTop = false;
        }
    }

    //Handle Share
    const sharePlaylist = () => {
        navigator.clipboard.writeText(props.playlist.url)
        window.shownotification({
            icon: 'fa-link',
            text: `${ props.playlist.name } link copied to clipboard.`
        })
    };

    //Handle Like/Unllike
    const likePlaylist = () => {
        state.isLiked = !state.isLiked;
        if(state.isLiked){
            PlaylistService.likePlaylist({ "brand": props.brand, "playlist_id": props.playlist.id }, token)
                .then((response) => {
                    console.log('successfully liked')
                })
                .catch(function (error) {
                    console.log('failed to like')
                });
        }
        else {
            PlaylistService.unlikePlaylist(props.playlist.id, token)
                .then((response) => {
                    console.log('successfully unliked')
                })
                .catch(function (error) {
                    console.log('failed to unlike')
                });
        }
    }

    //Handle Dropdown Trigger
    const dropdownTriggerHandler = event => {
        GetElementDistance(event.target);
        state.dropdownOpen = !state.dropdownOpen;
    }

    //---------Lifecycle Methods---------//

    onBeforeMount(() => {
        playlistsStore.setActivePlaylist(props.playlist)
        state.isLiked = props.playlist.is_liked_by_current_user;
        state.isPinned = props.playlist.pinned ? true : false;
        state.isPrivate = props.playlist.private;
    })

    onUpdated(()=>{
        // console.log(playlistsStore.pinnedPlaylists)
        state.isPinned = props.playlist.pinned ? true : false;
    })
</script>
<template>
    <platform-header
        :backgroundImage="playlistsStore.activePlaylist.thumbnail_url || 'https://musora-web-platform.s3.amazonaws.com/headers/unified_header.jpg'"
        :blurBG="true"
    >
        <template v-slot:content>
            <div class="tw-flex tw-flex-col lg:tw-flex-row tw-items-center tw-w-full lg:tw-w-8/12">
                <!-- Playlist thumbnail -->
                <div class="tw-realtive tw-h-[140px] tw-w-[140px] tw-relative tw-rounded tw-shrink-0 tw-overflow-hidden tw-mb-[16px] lg:tw-mb-0">
                    <!-- Image Conatiner -->
                    <div v-if="playlistsStore.activePlaylist.thumbnail_url" class="tw-relative tw-w-full tw-h-full">
                        <img
                            :src="`https://musora.com/cdn-cgi/image/width=200/${playlistsStore.activePlaylist.thumbnail_url}`"
                            alt="playlist thumbnail"
                            class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        />
                        <!-- Image Mask -->
                        <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                            <img class="tw-h-full tw-object-contain" :src="`https://musora.com/cdn-cgi/image/width=330/${playlistsStore.activePlaylist.thumbnail_url}`" alt="playlist thumbnail">
                        </div>
                    </div>
                    <!-- placeholder (no image or items) -->
                    <div v-else class="tw-transition tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full tw-bg-[#3F3F46] dark:tw-bg-[#445F74]">
                        <svg class="tw-w-1/2 tw-h-1/2" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="79" height="79" fill="url(#pattern0)"/>
                            <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_1473_92012" transform="scale(0.00444444)"/>
                            </pattern>
                            <image id="image0_1473_92012" width="225" height="225" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAYAAAA+s9J6AAAACXBIWXMAAAsTAAALEwEAmpwYAAAF8mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuZGFiYWNiYiwgMjAyMS8wNC8xNC0wMDozOTo0NCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIyLjQgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAyMS0wOC0yNlQwMjowMToxNC0wNDowMCIgeG1wOk1vZGlmeURhdGU9IjIwMjEtMDgtMjZUMDI6MDI6MDUtMDQ6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMjEtMDgtMjZUMDI6MDI6MDUtMDQ6MDAiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6YTM4ZTA2NWQtYWMwYy1hNjQ5LTliZjYtYTg3YTIxYTQzY2QzIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6N2M5OGU1MjEtZTgyZi1jMzQ4LWFjMjgtOWU0MmYyNGQxZmRhIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6ODc5YTMzMzAtZGU1OS02YjRkLTkwMmItY2UxMDUwZTMzMmVlIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo4NzlhMzMzMC1kZTU5LTZiNGQtOTAyYi1jZTEwNTBlMzMyZWUiIHN0RXZ0OndoZW49IjIwMjEtMDgtMjZUMDI6MDE6MTQtMDQ6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi40IChXaW5kb3dzKSIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6YTM4ZTA2NWQtYWMwYy1hNjQ5LTliZjYtYTg3YTIxYTQzY2QzIiBzdEV2dDp3aGVuPSIyMDIxLTA4LTI2VDAyOjAyOjA1LTA0OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuNCAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+9BRjmAAADjRJREFUeJzt3W+IHdUZx/FvSpGy5EVZioQQl5NQbKqlWIxBtFYa+8ZAo7VVabUFEzSUKL5I/wjiC2lFpUqxGoqFKLQq9U8jja220ARK62rDWqTFNPgiOaaSSiupiCwi0u2LZ6571d29M3PO3GfuzO8Dy+yuOzNPrvd3z/w5c86qhYUFRMTPR7wLEOk7hVDEmUIo4kwhFHGmEIo4UwhFnCmEIs4UQhFnCqGIM4VQxJlCKOJMIRRxphCKOPuodwHSCduBq4ANxc9vFV+vASeAfwIv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"/>
                            </defs>
                        </svg>
                    </div>
                    <!-- Pinned Icon -->
                    <div class="tw-inline-flex tw-items-center tw-transition-colors tw-z-20 tw-absolute tw-top-1 tw-right-1 tw-bg-[rgba(0,12,23,0.5)] tw-rounded-full tw-p-1.5"
                        :class="[`tw-text-white`, { 'tw-opacity-0' : !state.isPinned } ]"
                    >
                        <musora-icon icon-name="tack" class="tw-w-[20px] tw-h-[20px] tw-mx-auto tw-hidden md:tw-flex" />
                    </div>
                </div>

                <!-- Content -->
                <div class="tw-flex-col tw-text-center lg:tw-text-left lg:tw-pl-[20px]">
                    <!-- Avatar -->
                    <div class="tw-hidden lg:tw-flex tw-items-center tw-mb-2">
                        <div class="tw-h-[40px] tw-w-[40px] tw-rounded-full tw-overflow-hidden tw-mr-[9px]">
                            <img :src="playlistsStore.activePlaylist.user ? playlistsStore.activePlaylist.user['fields.profile_picture_image_url'] : ''" alt="">
                        </div>
                        <p class="tw-font-bebas-neue tw-text-white tw-text-xl">
                            {{ playlistsStore.activePlaylist.user ? playlistsStore.activePlaylist.user.display_name : '' }}
                        </p>
                    </div>
                    <div class="tw-text-white tw-flex tw-flex-col tw-mb-2">
                        <h1 class="tw-capitalize tw-leading-tight tw-font-bold tw-mb-2 lg:tw-line-clamp-2">{{ playlistsStore.activePlaylist.name }}</h1>
                        <p class="lg:tw-line-clamp-2" v-html="playlistsStore.activePlaylist.description"></p>
                    </div>
                    <!-- Go to Playback -->
                    <a v-if="lessons.data.length && hasAccess" :href="playlistsStore.activePlaylist.playback_url"
                        class="tw-w-[39px] tw-inline-flex tw-transition"
                        :class="`tw-text-${brand} hover:tw-text-${brand}-600`"
                        :title="`Go To Player`"
                    >
                        <i class="tw-text-[39px] fas fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </template>
        <template v-slot:ctas>
            <div v-if="hasAccess" class="tw-flex tw-items-center tw-justify-center tw ml-0 lg:tw-w-1/2 lg:tw-ml-auto lg:tw-w-4/12 tw-w-full tw-mt-4 lg:tw-justify-end">
                <!--Share-->
                <button v-if="!state.isPrivate" class="tw-text-white tw-inline-flex tw-flex-col tw-items-center tw-px-4 tw-w-full tw-max-w-[120px]"
                        @click.prevent="sharePlaylist()"
                >
                    <musora-icon icon-name="share" class="tw-mb-1" />
                    <span class="tw-uppercase tw-font-bebas-neue">Share</span>
                </button>
                <!--Like-->
                <button class="tw-text-white tw-inline-flex tw-flex-col tw-items-center tw-px-4 tw-w-full tw-max-w-[120px]"
                        @click.prevent="likePlaylist()"
                >
                    <musora-icon :icon-name="state.isLiked ? 'thumb-like-filled' : 'thumb-like'" class="tw-mb-1" />
                    <span class="tw-uppercase tw-font-bebas-neue">{{ state.isLiked ? 'Liked' : 'Like'}}</span>
                </button>
                <!--More-->
                <button class="tw-relative  tw-text-white tw-inline-flex tw-flex-col tw-items-center tw-px-4 tw-w-full tw-max-w-[120px]"
                        :class="props.isListView ? 'md:tw-rotate-90' : ''"
                        title="Playlist Options"
                        @click.prevent="dropdownTriggerHandler($event)"
                        v-click-outside="()=>{ state.dropdownOpen = false }"
                >
                    <div class="tw-relative tw-w-[32px] tw-flex tw-justify-center tw-items-center tw-h-[35px] tw-mb-1 tw-text-center">
                        <svg class="tw-rotate-90" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <!-- Dropdown-->
                        <PlaylistDropdown
                            :lessons-length="lessons.data.length"
                            :brand="brand"
                            :dropdownTop="state.dropdownTop"
                            :is-private="state.isPrivate"
                            :is-pinned="state.isPinned"
                            :dropdownOptions="dropdownOptions"
                            :data="playlistsStore.activePlaylist"
                            :is-open="state.dropdownOpen"
                            :is-my-playlist="props.playlist.is_my_playlist"
                            :in-playlist-header="true"
                            type="playlist"
                            @closeDropdown="state.dropdownOpen = false"
                            @updatePinned="(val) => state.isPinned = val"
                            @pinItem="playlistsStore.activePlaylist.pinned = $event"
                            @makePublic="(val) => state.isPrivate = val"
                        />
                    </div>
                    <span class="tw-uppercase tw-font-bebas-neue">More</span>
                </button>
            </div>
        </template>
    </platform-header>
</template>
