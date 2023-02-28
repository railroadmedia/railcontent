<script setup>
    import { onBeforeMount, watch, ref, inject, computed, reactive } from 'vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        lesson: {
            type: Object,
            default: {}
        },
        isListView: {
            type: Boolean,
            default: true,
        }
    });

    //-----------Computed Props-----------//
    const duration_formated = computed(()=> {
        return props.lesson.created_on.replace(/^0(?:0:0?)?/, '');;
    })
    //Thumbnail
    const lessonThumnail = computed( () => {
        const thumbnail = props.lesson.data.find(data => data.key === 'original_thumbnail_url');
        return thumbnail.value;
    })
    //Description
    const lessonDescription = computed( () => {
        const description = props.lesson.fields.find(field => field.key === 'title');
        return description.value;
    })


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
    watch(props.lesson, async (newList) => {
        state.isPinned = newList.pinned;
    })

    //-----------Methods-----------//

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
        //check if it's pinned with request? Or prerender?
        state.isPinned = props.lesson.pinned;
        state.isPrivate = props.lesson.private; 

        console.log('lesson', props.lesson)
    }); 
    
    

</script>
<template>
    <div class="tw-group tw-relative tw-h-[90px] tw-flex tw-w-full tw-items-center tw-transition-colors tw-py-1 hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-[#081825]/50 even:tw-bg-white dark:even:tw-bg-[#081825] tw-pr-4"
    >
        <!-- PLAYLIST INFO: clickable link -->
        <a  :href="lesson.url"
            class="tw-inline-flex tw-items-center tw-flex tw-w-[calc(100%-100px)] tw-text-[#0D0D0D] dark:tw-text-white"
        >   
            <div class="tw-inline-flex tw-shrink-0 tw-w-[40px] tw-pl-4"></div>

            <!-- Playlist thumbnail -->
            <div class="tw-relative tw-inline-flex tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-h-[61px] tw-w-[110px] tw-rounded tw-shrink-0">
                <!-- Image Conatiner -->
                <div class="tw-relative tw-w-full tw-h-full" v-if="lessonThumnail">
                    <img :src="`https://musora.com/cdn-cgi/image/width=330/${lessonThumnail}`" alt="playlist thumbnail">
                </div>
            </div>  

            <div class="tw-truncate tw-w-[calc(100%-350px)] tw-pl-2 md:tw-pl-[15px] tw-pr-2">
                <!--name-->
                <p>
                    <span class="tw-uppercase tw-mr-1 tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm" 
                            v-for="(instructor, i) in lesson.instructors" 
                            :key="i">
                            {{ instructor }}
                    </span>
                </p>
                <!-- description -->
                <p class="tw-font-bold tw-truncate">{{ lessonDescription }}</p>
                <!-- Time -->
                <p class="tw-text-[13px]">
                    <span>Begins {{ }}</span><span class="tw-mx-0.5">•</span><span>Ends</span>
                </p>
            </div>
            
            <div class="tw-inline-flex tw-justify-center tw-shrink-0 tw-w-[100px]">
                <span v-if="lesson.type" class="tw-text-center">
                    {{ lesson.type }}
                </span>  
            </div> 
            
            <div class="tw-inline-flex tw-justify-center tw-shrink-0  tw-w-[100px]">
                <span>{{ duration_formated }}</span>
            </div>              
        </a>
        
        <!-- PLAYLISTS OPTIONS DROPDOWN -->
        <div class="tw-inline-flex tw-items-center tw-justify-end tw-shrink-0 tw-w-[100px] md:tw-justify-center" >
            <div class="tw-relative " 
                    v-click-outside="()=>{ state.dropdownOpen = false }"
            >
                <button class="tw-btn-primary tw-btn-small tw-btn-circle tw-text-[#445F74] dark:tw-text-[#7E9AB1] tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2 tw-rotate-0 md:tw-rotate-90" 
                        title="Playlist Options"
                        @click.prevent="dropdownTriggerHandler(this)" 
                >
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- Dropdown-->
                <div v-if="state.dropdownOpen" 
                     class="tw-w-[162px] tw-shadow tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-right-0 tw-py-2 tw-z-50"
                     :class="state.dropdownTop ? 'tw-bottom-[100%]' : 'tw-top-[100%]'"
                >
                    <span class="tw-absolute tw-w-3 tw-h-3 tw-bg-white dark:tw-bg-[#081825] tw-rotate-45 tw-right-[11px]" :class="state.dropdownTop ? 'tw-bottom-[-4px]' : 'tw-top-[-4px]' "></span>
                    <ul class="tw-text-sm tw-w-full">
                        <li class="tw-w-full tw-flex" v-if="!lesson.private || !state.isPrivate">
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
                                    @click.prevent="pinHandler(lesson.id)"
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