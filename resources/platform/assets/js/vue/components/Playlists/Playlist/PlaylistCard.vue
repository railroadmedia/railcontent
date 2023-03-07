<script setup>
    import { onBeforeMount, watch, ref, inject, computed, reactive } from 'vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import PlaylistService from '../../../../services/playlists.js';
    import PlaylistDropdown from '../PlaylistDropdown.vue';
    import { usePlaylistsStore } from '../../../../stores/playlists';

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

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
        },
        isListView: {
            type: Boolean,
            default: true,
        }
    });

    //-----------Computed Props-----------//
    
    //Thumbnail
    const lessonThumbnail = computed( () => {
        const thumbnail = props.lesson.data.find(data => data.key === 'original_thumbnail_url');
        return props.lesson.thumbnail_url || thumbnail.value;
    })
    //Description
    const lessonDescription = computed( () => {
        const description = props.lesson.fields.find(field => field.key === 'title');
        return description.value;
    })

    //-----------Refs-----------//
    const dropdownTarget = ref(null)

    //-----------Reactive Data-----------//
    const state = reactive({
        dropdownOpen: false,
        dropdownTop: false,
    });

    //-----------Static Data-----------//
    const dropdownOptions = [
        {
            name: "Remove",
            action: "removeLesson"
        },
        {
            name: "Add to List",
            action: "addToPlaylist"
        },
        {
            name: "Start/End Time",
            action: "editLessonTime"
        }
    ]

    //-----------Methods-----------//

    //Format Duration (in seconds)
    const duration_formatted = (seconds) => {
        let time = seconds;
        if( time ) { //does it exist
            const hrs = Math.floor(time / 3600);
            const min = Math.floor(time / 60);
            const sec = time - min * 60;
            const hrsFormatted = hrs < 10 ? `${hrs}` : hrs;
            const minFormatted = min < 10 ? `0${min}` : min;
            const secFormatted = sec < 10 ? `0${sec}` : sec;
            return `${hrsFormatted}:${minFormatted}:${secFormatted}`;
        } else {
            return false;
        }
    }

    //Handle Share
    const shareHandler = () => {
        navigator.clipboard.writeText(props.lesson.url)
        window.shownotification({
            icon: 'fa-link',
            text: `${ props.lesson.name } link copied to clipboard.`
        })
        //close after click
        state.dropdownOpen = false;
    };

    const privateToggleHandler = () => {
        state.isPrivate = !state.isPrivate;
        let isPrivate = props.lesson.private === 1 ? true : false;
        PlaylistService.setToPrivate(props.lesson.id, isPrivate, token)
            .then((response) => {
                if(response.status === 201) {
                    //show success message
                    window.shownotification({
                        icon: `${props.lesson.private === 1 ? 'fa-lock-open' : 'fa-lock'}.`,
                        text: `Your playlist is now ${props.lesson.private === 0 ? 'private' : 'public'}.`
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
        //close
        state.dropdownOpen = false;
    }

    //Handle Pin/Unpin Request
    const pinHandler = (id, brand) => {
        if(!props.lesson.pinned) { //PIN
            if(playlistsStore.pinnedPlaylists.length !== 5) {
                state.isPinned = true;
                PlaylistService.pinPlaylist(id, brand, token)
                    .then((response) => {
                        if(response.status === 200) {
                            //emit event or update pinia
                            playlistsStore.pinPlaylist(props.lesson)
                            //show success message
                            window.shownotification({
                                icon: 'playlist',
                                text: `'${props.lesson.name}' has been pinned within the sidebar.`
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
                window.openplaylistmodal({ modalType: 'unpinPlaylists', data: props.lesson });
                state.dropdownOpen = false;
            }
        } else { //UNPIN
            state.isPinned = false;
            PlaylistService.unpinPlaylist(id, brand, token)
                .then((response) => {
                    if(response.status === 200) {
                        //emit event or update pinia
                        playlistsStore.unpinPlaylist(props.lesson.id)
                        //show success message
                        window.shownotification({
                            icon: 'playlist',
                            text: `'${props.lesson.name}' has been unpinned from the sidebar.`
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
        window.openplaylistmodal({ modalType: 'duplicate', data: props.lesson });
        state.dropdownOpen = false;
    };

    const deletePlaylistHandler = () => {
        window.openplaylistmodal({ modalType: 'remove', data: props.lesson });
        state.dropdownOpen = false;
    };

    const editPlaylistHandler = () => {
        window.openplaylistmodal({ modalType: 'edit', data: props.lesson });
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
        console.log(props.lesson);
        state.isPinned = props.lesson.pinned;
        state.isPrivate = props.lesson.private;
    });
</script>
<template>
    <div class="tw-group tw-relative tw-h-[90px] tw-flex tw-w-full tw-items-center tw-transition-colors tw-py-1 hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-[#081825]/50 even:tw-bg-white dark:even:tw-bg-[#081825] tw-pr-4"
    >
        <!-- PLAYLIST INFO: clickable link -->
        <a  :href="lesson.url"
            class="tw-inline-flex tw-items-center tw-flex tw-w-[calc(100%-35px)] lg:tw-w-[calc(100%-100px)] tw-text-[#0D0D0D] dark:tw-text-white"
        >
            <div class="tw-inline-flex tw-items-center tw-font-bold tw-shrink-0 tw-w-[40px] tw-pl-4">{{ props.index + 1 }}</div>

            <!-- Playlist thumbnail -->
            <div class="tw-relative tw-inline-flex tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-aspect-video tw-w-[110px] tw-rounded tw-shrink-0">
                <!-- Image Conatiner -->
                <div class="tw-relative tw-w-full tw-h-full" v-if="lessonThumbnail">
                    <img
                        :src="`https://musora.com/cdn-cgi/image/width=330/${lessonThumbnail}`"
                        alt="playlist thumbnail"
                        class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                        loading="lazy"
                        onload="this.classList.remove('tw-opacity-0')"
                    />
                    <!-- Image Mask -->
                    <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                        <img class="tw-h-full tw-object-contain" :src="`https://musora.com/cdn-cgi/image/width=330/${lessonThumbnail}`" alt="playlist thumbnail">
                    </div>
                </div>
            </div>

            <div class="tw-truncate tw-w-full lg:tw-w-[calc(100%-350px)] tw-px-3 lg:tw-pl-[15px]">
                <!--name-->
                <p class="tw-truncate">
                    <template v-if="lesson.type !== 'assignment'">
                        <span class="tw-uppercase tw-mr-1 tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm"
                                v-for="(instructor, i) in lesson.instructors"
                                :key="i">
                                {{ instructor }}<span v-if="i != (lesson.instructors.length - 1)">,</span>
                        </span>
                    </template>
                    <template v-else>
                        <span class="tw-uppercase tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm"
                                v-for="(route, i) in lesson.route"
                                :key="i">
                                {{ route }}<span v-if="i != (lesson.route.length - 1)" class="tw-px-1">•</span>
                        </span>
                    </template>
                </p>
                <!-- description -->
                <p class="tw-font-bold tw-truncate">{{ lessonDescription }}</p>
                <!-- Time -->
                <p class="tw-text-[13px] tw-text-[#00101D] dark:tw-text-[#7E9AB1]">
                    <span>Begins {{ duration_formatted(lesson.start_second ) || '0:00:00' }}</span>
                    <span class="tw-mx-0.5">•</span>
                    <span>Ends {{ duration_formatted( lesson.end_second ) || duration_formatted(lesson.duration) || '0:00:00' }} </span>
                </p>
            </div>

            <!-- Lesson Type -->
            <div class="tw-hidden lg:tw-inline-flex tw-justify-center tw-shrink-0 tw-w-[128px]">
                <span v-if="lesson.type" class="tw-text-center">
                    {{ lesson.type }}
                </span>
            </div>

            <!-- Lesson Time -->
            <div class="tw-hidden lg:tw-inline-flex tw-justify-center tw-shrink-0 tw-w-[100px]">
                <span>{{ duration_formatted(lesson.duration) || '0:00:00' }}</span>
            </div>
        </a>

        <!-- PLAYLISTS OPTIONS DROPDOWN -->
        <div class="tw-inline-flex tw-items-center tw-justify-end tw-shrink-0 tw-w-[35px] lg:tw-w-[100px] md:tw-justify-center" >
            <div class="tw-relative "
                    v-click-outside="()=>{ state.dropdownOpen = false }"
            >
                <button class="tw-btn-primary tw-btn-small tw-btn-circle tw-text-[#445F74] dark:tw-text-[#7E9AB1] tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2 tw-rotate-0 lg:tw-rotate-90"
                        title="Playlist Options"
                        @click.prevent="dropdownTriggerHandler(this)"
                >
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                />
            </div>
        </div>
    </div>
</template>
