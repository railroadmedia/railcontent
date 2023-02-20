<script setup>
    import { onBeforeMount, watch, ref, inject, reactive } from 'vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        list: {
            type: Object,
            default: {}
        },
        isListView: {
            type: Boolean,
            default: false,
        }
    });

    //-----------Refs-----------//
    const dropdownTarget = ref(null)

    //Inject
    const token = inject('csrf_token');
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Reactive Data-----------//
    const state = reactive({ 
            dropdownOpen: false,
            dropdownTop: false,
            isPinned: false,
            isPrivate: false,
        });

    //-----------Watchers-----------//
    watch(props.list, async (newList) => {
        state.isPinned = newList.pinned;
    })

    //-----------Methods-----------//

    //Handle Share
    const shareHandler = () => {
        navigator.clipboard.writeText(props.list.url)
        window.shownotification({
            icon: 'fa-link',
            text: `${ props.list.name } link copied to clipboard.`
        })
        //close after click
        state.dropdownOpen = false;
    };

    const privateToggleHandler = () => {
        state.isPrivate = !state.isPrivate;
        let isPrivate = props.list.private === 1 ? true : false;
        PlaylistService.setToPrivate(props.list.id, isPrivate, token)
            .then((response) => {
                if(response.status === 201) {
                    //show success message
                    window.shownotification({
                        icon: `${props.list.private === 1 ? 'fa-lock-open' : 'fa-lock'}.`,
                        text: `Your playlist is now ${props.list.private === 1 ? 'private' : 'public'}.`
                    })
                }
            })
            .catch(function (error) {
                if (error.response) {
                    //undo private/public change
                    state.isPrivate = !state.isPrivate;
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                }
            });
        //close after 200ms
        setTimeout(()=> {
            state.dropdownOpen = false;
        }, "200")
    }

    //Handle Pin/Unpin Request
    const pinHandler = (id, brand) => {
        if(!props.list.pinned) { //PIN
            if(playlistsStore.pinnedPlaylists.length !== 5) {
                state.isPinned = true;
                PlaylistService.pinPlaylist(id, brand, token)
                    .then((response) => {
                        if(response.status === 200) { 
                            //emit event or update pinia
                            playlistsStore.pinPlaylist(props.list)
                            //show success message
                            window.shownotification({
                                icon: 'playlist',
                                text: `'${props.list.name}' has been pinned within the sidebar.`
                            })
                        }
                    })
                    .catch(function (error) {
                        if (error.response) {
                            //handle error
                            window.shownotification({
                                icon: 'error',
                                text: 'Woops! Something wrong happened, please try again later.'
                            })
                        }
                    });
            } else {
                //Too Many Playlists
                window.openplaylistmodal({ modalType: 'unpinPlaylists', data: props.list });
                state.dropdownOpen = false;
            }
        } else { //UNPIN
            state.isPinned = false;
            PlaylistService.unpinPlaylist(id, brand, token)
                .then((response) => {
                    if(response.status === 200) { 
                        //emit event or update pinia
                        playlistsStore.unpinPlaylist(props.list.id)
                        //show success message
                        window.shownotification({
                            icon: 'playlist',
                            text: `'${props.list.name}' has been unpinned from the sidebar.`
                        })
                    }
                })
                .catch(function (error) {
                    if (error.response) {
                        //handle error
                        
                        window.shownotification({
                            icon: 'error',
                            text: 'Woops! Something wrong happened, please try again later.'
                        })
                    }
                });
        }
        //close after click
        state.dropdownOpen = false;
    }

    const duplicatePlaylistHandler = () => {
        window.openplaylistmodal({ modalType: 'duplicate', data: props.list });
        state.dropdownOpen = false;
    };

    const deletePlaylistHandler = () => {
        window.openplaylistmodal({ modalType: 'remove', data: props.list });
        state.dropdownOpen = false;
    };

    const editPlaylistHandler = () => {
        window.openplaylistmodal({ modalType: 'edit', data: props.list });
        state.dropdownOpen = false;
    };

    const unpinPlaylistModalHandler = () => {
        window.openplaylistmodal({ modalType: 'unpinPlaylists' });
        state.dropdownOpen = false;
    };

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

    //Handle Dropdown Trigger
    const dropdownTriggerHandler = target => {
        GetElementDistance(target.$el);
        state.dropdownOpen = !state.dropdownOpen;
    }

    //-----------Lifecycle Methods-----------//
    
    onBeforeMount(() => {
        //check if it's pinned with request? Or prerender?
        state.isPinned = props.list.pinned;
        state.isPrivate = props.list.private; 
    }); 
    
    

</script>
<template>
    <div class="tw-group tw-relative" 
         :class="props.isListView ? 'tw-h-[52px] tw-flex tw-flex-row tw-w-full tw-items-center tw-transition-colors tw-py-0.5 hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-[#081825]/50 even:tw-bg-white dark:even:tw-bg-[#081825]' : 'tw-grid tw-grid-rows-5 tw-grid-cols-5 tw-gap-1' "
    >
        <!-- Playlist thumbnail -->
        <a :href="list.url"
            class="tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-aspect-square"
           :class="props.isListView ? 'tw-h-[48px] tw-w-[48px] tw-rounded tw-shrink-0' : 'tw-row-span-5 tw-col-span-5 tw-rounded-lg'"
        >
            <img
                v-if="list.thumbnail_url"
                :src="list.thumbnail_url"
                alt="playlist thumbnail"
                class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            />
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

            <!-- hover overlay -->
            <div v-if="!props.isListView" 
                 class="tw-h-full tw-w-full tw-absolute tw-top-0 tw-left-0 tw-transition-colors tw-z-10 group-hover:tw-bg-black/30">
            </div>
        </a>  

        <!-- PLAYLIST INFO: clickable link -->
        <a  :href="list.url"
            class="tw-flex tw-w-full tw-text-[#0D0D0D] dark:tw-text-white"
            :class="props.isListView ? '' : 'tw-col-span-4'"
        >
            <div :class="props.isListView ? 'tw-w-full tw-grid tw-grid-cols-10 tw-items-center' : '' ">
                <!--name-->
                <p class="tw-font-bold tw-capitalize tw-truncate" 
                   :class="props.isListView ? 'tw-col-span-10 md:tw-col-span-2 tw-pl-2 md:tw-pl-[19px] tw-pr-2' : '' "
                >
                    {{ list.name }} 
                </p>
                <!--description-->
                <p class="tw-capitalize tw-truncate tw-hidden"
                    :class=" props.isListView ? 'tw-flex tw-col-span-5 md:tw-inline-flex' : '' " 
                > 
                    <span class="tw-truncate tw-max-w-[512px] tw-pl-2 tw-pr-4">{{ list.description }}</span>
                </p>
                <!--category / duration -->
                <div class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm tw-flex" 
                    :class="props.isListView ? 'tw-col-span-3 tw-w-full tw-pl-2 md:tw-pl-0 md:tw-text-base' : ''"
                >
                    <div :class="props.isListView ? 'md:tw-w-1/2 tw-inline-flex tw-items-center tw-justify-center' : '' ">
                        <span v-if="list.category">
                            {{ list.category }}
                            <span class="tw-mx-1 tw-leading-none" :class="props.isListView ? 'md:tw-hidden' : '' ">|</span>
                        </span>
                        
                    </div> 
                    <div :class="props.isListView ? 'md:tw-w-1/2 md:tw-w-1/2 tw-text-center' : '' ">
                        {{ list.duration || "0:00" }}
                    </div>
                </div>
            </div>
            <!-- Pinned Icon -->
            <div class="tw-inline-flex tw-items-center tw-transition-colors" 
                 :class="[ !props.isListView ? 'tw-absolute tw-top-3 tw-right-3' : 'tw-px-4 xl:tw-px-8',`tw-text-${brand}`, { 'tw-opacity-0' : !state.isPinned } ]"
            >
                <musora-icon icon-name="tack" class="tw-w-[24px] tw-h-[24px] tw-mx-auto tw-hidden md:tw-flex" />
            </div>
        </a>
        
        <!-- PLAYLISTS OPTIONS DROPDOWN -->
        <div class="tw-inline-flex tw-items-center tw-justify-end" 
             :class="props.isListView ? 'tw-w-[100px] md:tw-justify-center md:tw-pr-[22px]' : 'tw-col-span-1'" 
        >
            <div class="tw-relative " 
                    v-click-outside="()=>{ state.dropdownOpen = false }"
            >
                <button class="tw-btn-primary tw-btn-small tw-btn-circle tw-text-[#445F74] dark:tw-text-[#7E9AB1] tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2 tw-rotate-0" 
                        :class="props.isListView ? 'md:tw-rotate-90' : ''"
                        title="Playlist Options"
                        @click.prevent="dropdownTriggerHandler(this)" 
                >
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- Dropdown-->
                <div v-if="state.dropdownOpen" 
                     class="tw-w-[162px] tw-shadow tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-right-0 tw-py-2 tw-z-20"
                     :class="state.dropdownTop ? 'tw-bottom-[100%]' : 'tw-top-[100%]'"
                >
                    <span class="tw-absolute tw-w-3 tw-h-3 tw-bg-white dark:tw-bg-[#081825] tw-rotate-45 tw-right-[11px]" :class="state.dropdownTop ? 'tw-bottom-[-4px]' : 'tw-top-[-4px]' "></span>
                    <ul class="tw-text-sm tw-w-full">
                        <li class="tw-w-full tw-flex">
                            <button class="tw-flex tw-w-full tw-itemx-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-black/20"
                                    @click.prevent="shareHandler()"
                            >Share</button>
                        </li>
                        <li class="tw-w-full tw-flex">
                            <button class="tw-flex tw-w-full tw-itemx-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-black/20"
                                    @click.prevent="editPlaylistHandler()"
                            >
                                Edit
                            </button>
                        </li>
                        <li class="tw-w-full tw-flex">
                            <button class="tw-flex tw-w-full tw-itemx-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-black/20"
                                    @click.prevent="deletePlaylistHandler()"
                            >
                                Delete
                            </button>
                        </li>
                        <li class="tw-w-full tw-flex">
                            <button class="tw-flex tw-w-full tw-itemx-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-black/20"
                                    @click.prevent="duplicatePlaylistHandler()"
                            >
                                Duplicate
                            </button>
                        </li>
                        <li class="tw-w-full tw-flex">
                            <button class="tw-flex tw-w-full tw-itemx-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-black/20"
                                    @click.prevent="pinHandler(list.id)"
                            >
                                {{ state.isPinned ? 'Unpin from Sidebar' : 'Pin to Sidebar' }} 
                            </button>
                        </li>
                        <!-- If not public -->
                        <li class="tw-w-full tw-w-full tw-flex">
                            <button class="tw-relative tw-cursor-pointer tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-black/20"
                                    @click.prevent="privateToggleHandler()"
                            >
                                {{ state.isPrivate ? 'Private' : 'Public' }} 
                                <!-- Toggle -->
                                <div class="tw-relative tw-inline-flex tw-ml-auto tw-w-[27px] tw-h-[12px] tw-rounded-xl tw-bg-[#445F74]">
                                    <div class="tw-rounded-full tw-h-[15px] tw-w-[15px] tw-bg-white tw-flex-inline tw-items-center tw-justify-center tw-shadow tw-absolute tw-top-[-1.5px] tw-transition"
                                         :class="state.isPrivate ? 'tw-left-[-1px]': 'tw-right-[-1px]' "
                                    >
                                    </div>
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>