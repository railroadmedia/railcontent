<script setup>
    import { onBeforeMount, watch, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import PlaylistCollectionCard from './PlaylistCollectionCard.vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';

    //Props
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        playlists: {
            type: Array,
            default: []
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
        //Get Current User's Playlists
        if(props.playlists.length <= 10) {
            playlistsStore.playlists = props.playlists;
        } else {
            // get all user playlists
        }
        //Get Local Storage Value
        if(localStorage.getItem('playlistIsListView')) {
            state.isListView = JSON.parse(localStorage.getItem('playlistIsListView'));
        }
    });

    //Watchers

    //Store ListView to Local Storage
    watch(state, async () => {
        localStorage.setItem('playlistIsListView', state.isListView);
    })

</script>
<template>
    <main class="tw-w-full">
        
        <!-- Empty State -->
        <section v-if="!hasPlaylists && !playlistsStore.loadingPlaylists" class="tw-w-full tw-flex tw-flex-col dark:tw-text-white tw-items-center tw-mt-[58px]">
            <div class="tw-h-[84px] tw-w-[84px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-white dark:tw-text-[#9EC0DC] tw-transition-colors tw-bg-[#3F3F46] dark:tw-bg-[#445F74] tw-mb-[30px]">
                <musora-icon icon-name="playlist" class="tw-w-[36px]" />
            </div>
            <h1 class="tw-text-3xl tw-font-bold tw-mb-[15px]">No Playlists here yet</h1>
            <p>Go ahead and create your first playlist!</p>
        </section>

        <!-- Catalog -->
        <div v-if="hasPlaylists" class="tw-w-full">
            <!-- Controls -->
            <nav  class="tw-flex tw-my-4 tw-w-full tw-items-center">    
                <!--Filters -->
                <div class="tw-mr-auto">
                    <select name="playlist-sort"
                            id="playlist-sort"
                            class="tw-bg-transparent tw-rounded-3xl"
                    >
                        <option class="tw-text-black" value="">Filter By:</option>
                        <optgroup class="tw-text-black">
                            <option value="all">All Playlist</option>
                            <option value="public">Public Playlists</option>
                            <option value="mine">My Playlists</option>
                            <option value="private">Private Playlists</option>
                            <option value="pinned">Pinned Playlists</option>
                        </optgroup>
                    </select>
                </div>
                <!-- Search -->
                <div class="tw-relative">
                    <div></div>
                    <input type="search" class="tw-bg-transparent tw-rounded-lg" placeholder="Search">
                </div>

                <!-- List/Grid Toggle -->
                <div class="tw-px-1">
                    <button class="tw-text-xs tw-uppercase tw-px-1 tw-font-bebas-neue"
                            :class="[state.isListView ? 'dark:tw-text-white' : 'tw-text-[#D4D4D8] dark:tw-text-[#7E9AB1]']"
                            @click="state.isListView = true"
                    >
                        <svg width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 6.5625C5.5 5.69956 6.19956 5 7.0625 5H9.14583C10.0088 5 10.7083 5.69956 10.7083 6.5625C10.7083 7.42544 10.0088 8.125 9.14583 8.125H7.0625C6.19956 8.125 5.5 7.42544 5.5 6.5625Z" fill="currentColor"/>
                            <path d="M12.7917 6.5625C12.7917 5.69956 13.4912 5 14.3542 5H28.9375C29.8004 5 30.5 5.69956 30.5 6.5625C30.5 7.42544 29.8004 8.125 28.9375 8.125H14.3542C13.4912 8.125 12.7917 7.42544 12.7917 6.5625Z" fill="currentColor"/>
                            <path d="M12.7917 28.4375C12.7917 27.5746 13.4912 26.875 14.3542 26.875H28.9375C29.8004 26.875 30.5 27.5746 30.5 28.4375C30.5 29.3004 29.8004 30 28.9375 30H14.3542C13.4912 30 12.7917 29.3004 12.7917 28.4375Z" fill="currentColor"/>
                            <path d="M12.7917 21.1458C12.7917 20.2829 13.4912 19.5833 14.3542 19.5833H28.9375C29.8004 19.5833 30.5 20.2829 30.5 21.1458C30.5 22.0088 29.8004 22.7083 28.9375 22.7083H14.3542C13.4912 22.7083 12.7917 22.0088 12.7917 21.1458Z" fill="currentColor"/>
                            <path d="M12.7917 13.8542C12.7917 12.9912 13.4912 12.2917 14.3542 12.2917H28.9375C29.8004 12.2917 30.5 12.9912 30.5 13.8542C30.5 14.7171 29.8004 15.4167 28.9375 15.4167H14.3542C13.4912 15.4167 12.7917 14.7171 12.7917 13.8542Z" fill="currentColor"/>
                            <path d="M5.5 28.4375C5.5 27.5746 6.19956 26.875 7.0625 26.875H9.14583C10.0088 26.875 10.7083 27.5746 10.7083 28.4375C10.7083 29.3004 10.0088 30 9.14583 30H7.0625C6.19956 30 5.5 29.3004 5.5 28.4375Z" fill="currentColor"/>
                            <path d="M5.5 21.1458C5.5 20.2829 6.19956 19.5833 7.0625 19.5833H9.14583C10.0088 19.5833 10.7083 20.2829 10.7083 21.1458C10.7083 22.0088 10.0088 22.7083 9.14583 22.7083H7.0625C6.19956 22.7083 5.5 22.0088 5.5 21.1458Z" fill="currentColor"/>
                            <path d="M5.5 13.8542C5.5 12.9912 6.19956 12.2917 7.0625 12.2917H9.14583C10.0088 12.2917 10.7083 12.9912 10.7083 13.8542C10.7083 14.7171 10.0088 15.4167 9.14583 15.4167H7.0625C6.19956 15.4167 5.5 14.7171 5.5 13.8542Z" fill="currentColor"/>
                        </svg>
                        <span>List</span>
                    </button>
                    <button class="tw-text-xs tw-uppercase tw-px-1 tw-font-bebas-neue"
                            :class="[state.isListView ? 'tw-text-[#D4D4D8] dark:tw-text-[#7E9AB1]' : 'dark:tw-text-white']"
                            @click="state.isListView = false"
                    >
                        <svg width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.25 5.25C7.317 5.25 5.75 6.817 5.75 8.75V12.25C5.75 14.183 7.317 15.75 9.25 15.75H12.75C14.683 15.75 16.25 14.183 16.25 12.25V8.75C16.25 6.817 14.683 5.25 12.75 5.25H9.25Z" fill="currentColor"/>
                            <path d="M9.25 19.25C7.317 19.25 5.75 20.817 5.75 22.75V26.25C5.75 28.183 7.317 29.75 9.25 29.75H12.75C14.683 29.75 16.25 28.183 16.25 26.25V22.75C16.25 20.817 14.683 19.25 12.75 19.25H9.25Z" fill="currentColor"/>
                            <path d="M19.75 8.75C19.75 6.817 21.317 5.25 23.25 5.25H26.75C28.683 5.25 30.25 6.817 30.25 8.75V12.25C30.25 14.183 28.683 15.75 26.75 15.75H23.25C21.317 15.75 19.75 14.183 19.75 12.25V8.75Z" fill="currentColor"/>
                            <path d="M19.75 22.75C19.75 20.817 21.317 19.25 23.25 19.25H26.75C28.683 19.25 30.25 20.817 30.25 22.75V26.25C30.25 28.183 28.683 29.75 26.75 29.75H23.25C21.317 29.75 19.75 28.183 19.75 26.25V22.75Z" fill="currentColor"/>
                        </svg>
                        <span>Grid</span>
                    </button>
                </div>
            </nav>

            <!-- List View Header -->
            <header class="tw-w-full tw-font-bold tw-items-center tw-transition-colors tw-bg-[#E6E7E9] dark:tw-bg-[#002039] tw-text-[#0D0D0D] dark:tw-text-white tw-mb-1 tw-rounded-t-md tw-py-4 tw-pl-[48px]"
                    :class="state.isListView ? 'tw-hidden md:tw-flex' : 'tw-hidden'"
            >
                <div class="tw-grid tw-grid-cols-10 tw-w-full">
                    <p class="tw-col-span-2 tw-relative">
                        <span class="tw-ml-[-24px] tw-inline-block">Name</span>
                    </p>
                    <p class="tw-col-span-5 tw-pl-2">Description</p>
                    <div class="tw-col-span-3 tw-w-full tw-flex">
                        <p class="tw-w-1/2 tw-text-center">Category</p>
                        <p class="tw-w-1/2 tw-text-center">
                            Time
                        </p>
                    </div>
                </div>
                <div class="tw-inline-flex tw-px-4 xl:tw-px-8"><span class="tw-w-[24px] tw-h-[24px]"></span></div> <!-- Spacer for Pin Icon -->
                <p class="tw-pr-[22px] tw-w-[100px] tw-text-center">Options</p>
            </header>

            <!-- Cards -->
            <section v-if="!playlistsStore.loadingPlaylists" class="tw-w-full tw-relative"
                :class="state.isListView ? 'tw-flex tw-flex-col' : 'tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 tw-gap-4' "
            >
                <!-- Print Each Card -->
                <playlist-collection-card 
                    v-for="list in playlistsStore.playlists" 
                    :key="list.id" 
                    :list="list"
                    :isListView="state.isListView"
                    :token="token"
                />    
            </section>
        </div>
        
        <!-- Skeleton Loader -->
        <div v-if="playlistsStore.loadingPlaylists" class="tw-w-full tw-animate-pulse" :class="state.isListView ? 'tw-flex tw-flex-col' : 'tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 tw-gap-4 tw-mt-4' ">
            <div v-for="n in 10" 
                    :key="n" 
                    class="tw-flex tw-w-full "
                    :class="state.isListView ? 'tw-h-[52px] tw-flex-row tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#E6E7E9] dark:even:tw-bg-[#081825]' : 'tw-flex-col'"
            >
                <div class="tw-w-full tw-bg-[#E6E7E9] dark:tw-bg-[#081825] tw-aspect-square"
                        :class="state.isListView ? 'tw-hidden' : 'tw-rounded-lg'"
                ></div>
                <div :class="state.isListView ? 'tw-hidden' : 'tw-mt-2 tw-w-full tw-bg-[#E6E7E9] dark:tw-bg-[#081825] tw-aspect-square tw-h-[44px] tw-rounded-lg' "></div>
            </div>
        </div>
        

    </main>
</template>