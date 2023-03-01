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


    //Lifecycle Hooks
    onMounted(()=> {

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
            <header class="tw-hidden md:tw-flex tw-w-full tw-font-bold tw-items-center tw-transition-colors tw-bg-[#E6E7E9] dark:tw-bg-[#002039] tw-text-[#0D0D0D] dark:tw-text-white tw-mb-1 tw-rounded-t-md tw-p-4">
                <div class="tw-w-[40px]">#</div>
                <p class="tw-relative tw-inline-block tw-mr-auto tw-w-full">Name</p>
                <p class="tw-inline-flex tw-shrink-0 tw-justify-center tw-w-[128px]">Type</p>
                <p class="tw-inline-flex tw-shrink-0 tw-justify-center tw-w-[100px]">Time</p>
                <p class="tw-inline-flex tw-shrink-0 tw-justify-center tw-w-[100px]">Actions</p>
            </header>

            <!-- Cards -->
            <section v-if="lessons.data.length" class="tw-w-full tw-relative tw-mb-5 tw-flex tw-flex-col">
                <!-- Print Each Card -->
                <playlist-card 
                    v-for="(lesson,i) in lessons.data" 
                    :key="i" 
                    :index="i"
                    :lesson="lesson"
                    :token="token"
                    :brand="brand"
                />  
            </section>

        </div>      

    </main>
</template>