<script setup>
    import { onBeforeMount, onMounted, watch, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import PlaylistCard from './PlaylistCard.vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import Pagination from '../../../components/Pagination/Pagination.vue';

    //Props
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        lessons: {
            type: Object,
            default: {}
        },
        playlistCount: {
            type: Number,
            default: 0
        },
    })
    
    //Computed Props
    const hasPlaylists = computed(() => {
        return props.playlistCount && playlistsStore.playlists.length ? true : false;
    })

    //Reactive Data
    const state = reactive({ 

    })

    //Inject
    const token = inject('csrf_token');
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //Methods
    // const handlePageChange = (pageNumber) => {
    //     //load playlists
    //     playlistsStore.loadingPlaylists = true;
    //     playlistsStore.getPlaylists({ brand: props.brand, page: pageNumber, limit: 10 }, token);
    //     //update current page number 
    //     playlistsStore.resultsPage = pageNumber;
    //     //update url
    //     let url = new URL(window.location.href);
    //     url.searchParams.set('page', pageNumber)
    //     window.history.pushState({}, '', url);
    // }

    //Lifecycle Hooks
    onMounted(()=> {
        //load Playlists
        // if(props.playlistCount <= 10 && props.lessons.length <= 10) {
        //     playlistsStore.playlists = props.lessons;
        // } else {
        //     playlistsStore.loadingPlaylists = true;
        //     playlistsStore.getPlaylists({ brand: brand, page: 1, limit: null }, token); 
        // }
    })

    onBeforeMount(() => {      

    });

    //Watchers


</script>
<template>
    <main class="tw-w-full tw-pt-[33px]">
        
        <!-- Empty State -->
        <section v-if="lessons.length === 0" class="tw-w-full tw-flex tw-flex-col dark:tw-text-white tw-items-center tw-mt-[58px]">
            <div class="tw-h-[84px] tw-w-[84px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-white dark:tw-text-[#9EC0DC] tw-transition-colors tw-bg-[#3F3F46] dark:tw-bg-[#445F74] tw-mb-[30px]">
                <musora-icon icon-name="playlist" class="tw-w-[36px]" />
            </div>
            <h1 class="tw-text-3xl tw-font-bold tw-mb-[15px]">No Playlists here yet</h1>
            <p>Go ahead and create your first playlist!</p>
        </section>

        <!-- Catalog -->
        <div v-if="lessons.data.length" class="tw-w-full">

            <!-- List View Header -->
            <header class="tw-hidden md:tw-flex tw-w-full tw-font-bold tw-items-center tw-transition-colors tw-bg-[#E6E7E9] dark:tw-bg-[#002039] tw-text-[#0D0D0D] dark:tw-text-white tw-mb-1 tw-rounded-t-md tw-py-4 tw-pl-[48px]"
            >
                <div class="tw-grid tw-grid-cols-10 tw-w-full">
                    <p class="tw-col-span-2 tw-relative">
                        <span class="tw-ml-[-24px] tw-inline-block">Name</span>
                    </p>
                    <div class="tw-col-span-3 tw-w-full tw-flex">
                        <p class="tw-w-1/2 tw-text-center">Type</p>
                        <p class="tw-w-1/2 tw-text-center">
                            Time
                        </p>
                    </div>
                </div>
                <div class="tw-inline-flex tw-px-4 xl:tw-px-8"><span class="tw-w-[24px] tw-h-[24px]"></span></div> <!-- Spacer for Pin Icon -->
                <p class="tw-pr-[22px] tw-w-[100px] tw-text-center">Actions</p>
            </header>

            <!-- Cards -->
            <section v-if="lessons.data.length" class="tw-w-full tw-relative tw-mb-5 tw-flex tw-flex-col">
                <!-- Print Each Card -->
                <playlist-card 
                    v-for="(lesson,i) in lessons.data" 
                    :key="i" 
                    :lesson="lesson"
                    :token="token"
                    :brand="brand"
                />    
            </section>

        </div>      

    </main>
</template>