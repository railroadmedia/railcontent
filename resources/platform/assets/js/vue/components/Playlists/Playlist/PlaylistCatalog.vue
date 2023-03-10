<script setup>
    import { onBeforeMount, onMounted, watch, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import PlaylistCard from './PlaylistCard.vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import Pagination from '../../../components/Pagination/Pagination.vue';

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
        lessons: {
            type: Object,
            default: {}
        },
        playlistCount: {
            type: Number,
            default: 0
        },
    })
    
    //-----------Computed Props-----------//
    const hasPlaylists = computed(() => {
        return props.playlistCount && playlistsStore.playlists.length ? true : false;
    })

    //-----------Reactive Data-----------//
    const state = reactive({ 
        startID: 0,
        startPosition: 0,
        endPosition: 0,
        newSortPositions: [],
    })

    //-------------Methods-------------//
    const handleSort = () => {
        playlistsStore.sortingPlaylist = false;
        //Update each item in temp array
        state.newSortPositions.forEach(lesson => {
            //Then send update item request
            PlaylistService.updatePlaylistItem({ 
                user_playlist_item_id: lesson.id, 
                position: lesson.position 
            }, token)
        });
        //show success message
        window.shownotification({
            icon: 'fa-pen-to-square',
            text: `You have successfully re-ordered your playlist items`
        })
    }
    const handleDragStart = (event, position, id) => {
        if(playlistsStore.sortingPlaylist) {
            //save start position
            state.startID = id;
            state.startPosition = position;
            console.log(state.startID, position)
        }
    }
    const handleDragOver = (event) => {
        // console.log('drag over: ')
        if(playlistsStore.sortingPlaylist) {
            event.target.classList.add('tw-border-b');
        }
    }
    const handleDragLeave = (event) => {
        // console.log('drag leave: ')
        if(playlistsStore.sortingPlaylist) {
            event.target.classList.remove('tw-border-b');
        }
    }
    const handleDrop = (event, position) => {
        console.log(state.startID, position)
        if(playlistsStore.sortingPlaylist) {
            event.target.classList.remove('tw-border-b');
            state.endPosition = position;
            //Reorder UI
            playlistsStore.lessons.splice(state.endPosition, 0, playlistsStore.lessons.splice(state.startPosition, 1)[0])
            //Update Array
            const index = state.newSortPositions.findIndex(object => object.id === state.startID);
            if(index == -1) {
                state.newSortPositions.push({id: state.startID, position: state.endPosition + 1})
            } else{
                state.newSortPositions[index].position =  state.endPosition + 1;
            }
        }
        console.log(state.newSortPositions)
    }

    //---------Lifecycle Methods---------//

    onMounted(()=> {

    })

    onBeforeMount(() => {      
        playlistsStore.lessons = props.lessons.data;
    });
</script>
<template>
    <main class="tw-w-full ">

        <div class="tw-w-full tw-transition-all dark:tw-bg-[#002039] tw-bg-[#e5e7ea] tw-overflow-hidden" 
             :class="playlistsStore.sortingPlaylist ? 'tw-max-h-[200px] tw-z-20 tw-sticky tw-top-0 tw-drop-shadow-md' : 'tw-max-h-0'">
            <div class="tw-w-full tw-container tw-mx-auto tw-pt-4 md:tw-pt-0 tw-px-4 md:tw-px-8 dark:tw-text-white tw-flex tw-flex-col md:tw-flex-row tw-items-center">
                <p class="tw-text-center md:tw-text-left  md:tw-mr-auto">Click <span class="tw-font-bold tw-mx-0.5">save changes</span> to save your changes or <span class="tw-font-bold tw-mx-0.5">cancel</span> to exit re-ordering</p>
                <div class="tw-ml-6 tw-flex tw-py-[15px]">
                    <button class="tw-btn-primary tw-btn-small tw-mr-[10px] tw-px-[30px]" :class="`tw-bg-${brand}`" @click.prevent="handleSort">
                        Save changes
                    </button>
                    <button class="tw-btn-primary tw-btn-small tw-bg-transparent dark:tw-text-white tw-text-[#00101D] tw-px-[30px] hover:tw-bg-black/10" @click.prevent="playlistsStore.sortingPlaylist = false">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
        

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14 tw-pt-[28px]">
            <div class="tw-flex tw-flex-col">
                <!-- Empty State -->
                <section v-if="playlistsStore.lessons.length === 0" class="tw-w-full tw-flex tw-flex-col dark:tw-text-white tw-items-center tw-mt-[58px]">
                    <div class="tw-h-[84px] tw-w-[84px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-white dark:tw-text-[#9EC0DC] tw-transition-colors tw-bg-[#3F3F46] dark:tw-bg-[#445F74] tw-mb-6">
                        <musora-icon icon-name="eigth-notes" width="45" height="45" />
                    </div>
                    <h1 class="tw-text-3xl tw-font-bold tw-mb-[15px]">No lessons here yet</h1>
                    <p>Go to a lesson and click the plus icon to add to this playlist. </p>
                </section>

                <!-- Catalog -->
                <div v-if="playlistsStore.lessons.length" class="tw-w-full">

                    <!-- List View Header -->
                    <header class="tw-hidden lg:tw-flex tw-w-full tw-font-bold tw-items-center tw-transition-colors tw-bg-[#E6E7E9] dark:tw-bg-[#002039] tw-text-[#0D0D0D] dark:tw-text-white tw-mb-1 tw-rounded-t-md tw-p-4">
                        <div class="tw-w-[40px]">#</div>
                        <p class="tw-relative tw-inline-block tw-mr-auto tw-w-full">Name</p>
                        <p class="tw-inline-flex tw-shrink-0 tw-justify-center tw-w-[128px]">Type</p>
                        <p class="tw-inline-flex tw-shrink-0 tw-justify-center tw-w-[100px]">Time</p>
                        <p class="tw-inline-flex tw-shrink-0 tw-justify-center tw-w-[100px]">Actions</p>
                    </header>

                    <!-- Cards -->
                    <section v-if="playlistsStore.lessons.length" 
                            class="tw-w-full tw-relative tw-mb-5 tw-flex tw-flex-col"
                    >
                        <!-- Print Each Card -->
                        <playlist-card 
                            v-for="(lesson,i) in playlistsStore.lessons" 
                            :key="i" 
                            :index="i"
                            :lesson="lesson"
                            :token="token"
                            :brand="brand"
                            :draggable="playlistsStore.sortingPlaylist"
                            @dragstart="handleDragStart($event, i,lesson.user_playlist_item_id)"
                            @dragleave="handleDragLeave($event)"
                            @dragover.prevent="handleDragOver($event)"
                            @drop="handleDrop($event, i)"
                        />  

                    </section>

                </div>   
            </div>
        </div>

    </main>
</template>
