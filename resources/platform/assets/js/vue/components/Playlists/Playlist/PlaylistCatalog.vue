<script setup>
    import { onBeforeMount, onMounted, watch, inject, ref, reactive, computed } from 'vue';
    import { VueDraggableNext } from 'vue-draggable-next';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import PlaylistCard from './PlaylistCard.vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';

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
            default: {
                data: []
            }
        },
        playlistCount: {
            type: Number,
            default: 0
        },
        infiniteScroll: {
            type: Boolean,
            default: false
        },
        limit: {
            type: Number,
            default: 20,
        },
        isCueCatalog: {
            type: Boolean,
            default: false,
        },
        hasAccess: {
            type: Number,
            default: 1,
        }
    })

    //-----------Refs-----------//
    const pageNumber = ref(1);
    const preventReFetch = ref(false);
    const lessonsArray = ref([]);
    const lessonsCopy = ref([]);

    //-----------Reactive Data-----------//
    const state = reactive({
        stopScroll: true,
        lessonsContainerKey: Math.round(Math.random() * 100000)
    })

    //-----------Static Data-----------//
    const scrollContainer = document.querySelector('#content-container');

    //-------------Methods-------------//

    const handleSort = () => {
        playlistsStore.sortingPlaylist = false;

        console.log('trying to save:', lessonsCopy.value)

        //Update each item in temp array
        lessonsCopy.value.forEach(lesson => {
            //Then send update item request
            if (lesson.hasChanged) {
                PlaylistService.updatePlaylistItem({
                    user_playlist_item_id: lesson.user_playlist_item_id,
                    position: lesson.user_playlist_item_position
                }, token)
            }
        });

        //Update store and computed array
        playlistsStore.lessons = lessonsCopy.value;

        state.lessonsContainerKey = Math.round(Math.random() * 100000);

        //show success message
        window.shownotification({
            icon: 'fa-pen-to-square',
            text: `You have successfully re-ordered your playlist items.`
        })
    }
    //Cancel Sort
    const handleCancelSort = () => {
        console.log('handle cancel sort')
        //Update array to initial order
        lessonsCopy.value = playlistsStore.lessons;
        playlistsStore.sortingPlaylist = false;
        state.lessonsContainerKey = Math.round(Math.random() * 100000);
    }

    const handleDragChange = (e) => {
        const oldObj = lessonsCopy.value[e.oldIndex];
        const oldUserItemPosition = oldObj.user_playlist_item_position;
        const newObj = lessonsCopy.value[e.newIndex];
        const newUserItemPosition = newObj.user_playlist_item_position;
        oldObj.user_playlist_item_position = newUserItemPosition;
        newObj.user_playlist_item_position = oldUserItemPosition;
        newObj.hasChanged = true;

        lessonsCopy.value[e.oldIndex] = newObj;
        lessonsCopy.value[e.newIndex] = oldObj;
    }

    //Vertical Scroll
    const VerticalMaxed = () => {
        return (window.innerHeight + window.scrollY) >= document.body.offsetHeight;
    }

    //---------Lifecycle Methods---------//

    onMounted(()=> {
        //Handle infinite Scroll
        if(props.infiniteScroll) {
            scrollContainer.onscroll = () => {
                if ( (scrollContainer.scrollHeight - scrollContainer.scrollTop - scrollContainer.clientHeight < 1) && !preventReFetch.value ) {
                    pageNumber.value = pageNumber.value + 1;
                    //Payload
                    const payload = {
                        page: pageNumber.value,
                        limit: props.limit,
                        playlist_id: playlistsStore.activePlaylist.id,
                    };
                    //Get Lessons
                    playlistsStore.loadingLessons = true;
                    PlaylistService.getPlaylistLessons(payload, token).then(response => {
                        playlistsStore.loadingLessons = false;
                        if (response.data.results.length) {
                            playlistsStore.lessons = playlistsStore.lessons.concat(response.data.results);
                        } else {
                            preventReFetch.value = true;
                        }
                    }).catch(() => {
                        window.shownotification({ icon: 'error', text: 'An error ocurred while fetching your data, please try again later.' });
                    });
                }
            }
        }
    })

    onBeforeMount(() => {
        playlistsStore.lessons = [...props.lessons.data];
        lessonsCopy.value = [...props.lessons.data];
    });
</script>
<template>
    <main class="tw-w-full ">

        <template v-if="hasAccess">
            <div class="tw-w-full tw-transition-all dark:tw-bg-[#002039] tw-bg-[#e5e7ea] tw-overflow-hidden"
                :class="playlistsStore.sortingPlaylist ? 'tw-max-h-[200px] tw-z-20 tw-sticky tw-top-0 tw-drop-shadow-md' : 'tw-max-h-0'">
                <div class="tw-w-full tw-container tw-mx-auto tw-pt-4 md:tw-pt-0 tw-px-4 md:tw-px-8 dark:tw-text-white tw-flex tw-flex-col md:tw-flex-row tw-items-center">
                    <p class="tw-text-center md:tw-text-left  md:tw-mr-auto">Click <span class="tw-font-bold tw-mx-0.5">save changes</span> to save your changes or <span class="tw-font-bold tw-mx-0.5">cancel</span> to exit re-ordering</p>
                    <div class="tw-ml-6 tw-flex tw-py-[15px]">
                        <button class="tw-btn-primary tw-mr-[10px] tw-px-[30px] xl:tw-w-[250px]" :class="`tw-bg-${brand}`" @click.prevent="handleSort">
                            Save changes
                        </button>
                        <button class="tw-btn-secondary tw-bg-transparent dark:tw-text-white tw-text-[#00101D] tw-px-[30px] hover:tw-bg-black/10 xl:tw-w-[200px]"
                                @click.prevent="handleCancelSort">
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
                            <musora-icon icon-name="playlist" width="45" height="45" />
                        </div>
                        <h1 class="tw-text-3xl tw-font-bold tw-mb-[15px]">No lessons here yet</h1>
                        <p>Go to a lesson and click the plus icon to add to this playlist. </p>
                    </section>

                    <!-- Catalog -->
                    <div v-if="playlistsStore.lessons.length" class="tw-w-full">

                        <!-- List View Header -->
                        <header class="tw-hidden lg:tw-flex tw-w-full tw-font-bold tw-items-center tw-transition-colors tw-bg-[#E6E7E9] dark:tw-bg-[#002039] tw-text-[#0D0D0D] dark:tw-text-white tw-mb-1 tw-rounded-t-md tw-p-3">
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
                            <VueDraggableNext 
                                :ghost-class="playlistsStore.sortingPlaylist ? 'ghost' : ''"
                                :v-model="playlistsStore.lessons" 
                                :sort="playlistsStore.sortingPlaylist"
                                :key="state.lessonsContainerKey"
                                @update="handleDragChange"
                            >
                                <!-- Print Each Card -->
                                <playlist-card
                                    v-for="(lesson,i) in playlistsStore.lessons"
                                    :key="i"
                                    :index="i"
                                    :lesson="lesson"
                                    :token="token"
                                    :brand="brand"
                                />
                            </VueDraggableNext>

                            <!-- Skeleton Loader For Infinite Scroll -->
                            <div v-if="playlistsStore.loadingLessons && infiniteScroll"
                                class="tw-w-full tw-animate-pulse tw-flex tw-flex-col">
                                <div v-for="n in limit"
                                    :key="n"
                                    class="tw-flex tw-w-full tw-h-[90px] tw-flex-row tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#E6E7E9] dark:even:tw-bg-[#081825]"
                                >
                                </div>
                            </div>

                        </section>

                    </div>
                </div>
            </div>
        </template>

        <!-- No Access -->
        <template v-else>
            <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14 tw-pt-[80px]">
                <div class="tw-flex tw-flex-col tw-items-center">
                    <h1 class="tw-text-3xl tw-font-bold tw-mb-[15px]">Oops!</h1>
                    <p>This playlist is private and you don’t have access to view it</p>
                </div>
            </div>
        </template>

    </main>
</template>
<style>
    .ghost {
        border-bottom: 1px solid black;
        width: 100%;
    }
    body.tw-dark .ghost {
        border-bottom: 1px solid white;
    }
</style>