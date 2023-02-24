<script setup>
    import { onBeforeMount, onMounted, watch, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../stores/playlists';
    import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

    //Props
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        playlists: {
            type: Array,
            default: []
        },
        isOpen: {
            type: Boolean,
            default: false
        }
    })
    
    //Computed Props
    const hasPlaylists = computed(() => {
        return playlistsStore.playlists.length > 0 ? true : false;
    })

    //Reactive Data
    const state = reactive({ 
        isListView: false 
    })

    //Inject
    const token = inject('csrf_token');
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //Methods

    //Lifecycle Hooks
    onBeforeMount(() => {      
        //Get Local Storage Value
        if(localStorage.getItem('playlistIsListView')) {
            state.isListView = JSON.parse(localStorage.getItem('playlistIsListView'));
        }
    });

    onMounted(()=> {
        //load Playlists
        // console.log(props.playlists);
        
        if(props.playlists !== 0) {
            playlistsStore.loadingPlaylists = true;
            playlistsStore.getPlaylists({ brand: brand, page: 1, limit: null }, token); 
        }
    })

    //Watchers

    //Store ListView to Local Storage
    watch(state, async () => {
        localStorage.setItem('playlistIsListView', state.isListView);
    })

</script>
<template>
        
    <div v-if="isOpen" 
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

</template>