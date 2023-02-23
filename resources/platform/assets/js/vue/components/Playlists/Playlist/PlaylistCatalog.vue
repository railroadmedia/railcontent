<script setup>
    import { onBeforeMount, onMounted, watch, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import PlaylistCollectionControls from './PlaylistCollectionControls.vue';
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
        //Get Local Storage Value
        if(localStorage.getItem('playlistIsListView')) {
            state.isListView = JSON.parse(localStorage.getItem('playlistIsListView'));
        }
    });

    onMounted(()=> {
        //load Playlists
        console.log(props.playlists);
        
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
            <PlaylistCollectionControls 
                :brand="brand"
                :isListView="state.isListView"
                @onUpdateListView="(val) => state.isListView = val"
            />

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
                <playlist-card 
                    v-for="list in playlistsStore.playlists" 
                    :key="list.id" 
                    :list="list"
                    :isListView="state.isListView"
                    :token="token"
                    :brand="brand"
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