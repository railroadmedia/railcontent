<script setup>
// TODO: FIX WHEN THE CUE IS BARELY VISIBLE AND YOU OPEN THE DROPDOWN
import { onBeforeMount, onMounted, inject, reactive, computed } from 'vue';
import PlaylistService from '../../../services/playlists.js';
import { usePlaylistsStore } from '../../../stores/playlists';
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

//Inject
const token = inject('csrf_token');

//Pinia Stores
const playlistsStore = usePlaylistsStore();

//Emits
const emit = defineEmits(['closeDropdown', 'pinItem', 'makePublic', 'updatePinned']);

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    dropdownOptions: {
        type: Object,
    },
    data: {
        type: Object,
    },
    index: {
        type: Number,
        default: 0,
    },
    isOpen: {
        type: Boolean,
        default: false
    },
    isPinned: {
        type: Boolean,
        default: false,
    },
    isPrivate: {
        type: Number
    },
    type: {
        type: String,
        default: "playlist",
    },
    dropdownTop: {
        type: Boolean
    },
    lessonsLength: {
        type: Number
    },
    isMyPlaylist: {
        type: Number,
        default: 1
    },
    inPlaylistHeader: {
        type: Boolean,
        default: false,
    },
    inPlaybackCue: {
        type: Boolean,
        default: false,
    },
})

//---------Computed Props---------//
const hasPlaylists = computed(() => {
    return playlistsStore.playlists.length > 0 ? true : false;
})

//-----------Reactive Data-----------//
const state = reactive({

})

//-------------Methods-------------//

//Handle Share
const sharePlaylist = () => {
    navigator.clipboard.writeText(props.data.url)
    window.shownotification({
        icon: 'fa-link',
        text: `Link copied to clipboard.`
    })
    //close after click
    emit('closeDropdown');
};

const privateToggle = () => {
    state.isPrivate = !state.isPrivate;
    emit('makePublic', state.isPrivate)
    let isPrivate = props.data.private === 1 ? true : false;
    PlaylistService.setToPrivate(props.data.id, isPrivate, token)
        .then((response) => {
            if (response.status === 201) {
                //show success message
                window.shownotification({
                    icon: state.isPrivate ? 'fa-lock' : 'fa-lock-open',
                    text: `${props.data.name} is now ${ state.isPrivate ? 'private' : 'public' }.`
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
    emit('closeDropdown');
}

//Handle Pin/Unpin Request
const pinPlaylist = () => {
    if (!props.isPinned) { //PIN
        if (playlistsStore.pinnedPlaylists.length !== 5) {
            emit('pinItem', true)
            PlaylistService.pinPlaylist(props.data.id, props.brand, token)
                .then((response) => {
                    if (response.status === 200) {
                        //emit event or update pinia
                        playlistsStore.pinPlaylist(props.data)
                        //show success message
                        window.shownotification({
                            icon: 'playlist',
                            text: `${props.data.name} has been successfully pinned to the menu.`
                        })
                        emit('updatePinned', true);
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
            window.openplaylistmodal({ modalType: 'unpinPlaylists', data: props.data });
            emit('closeDropdown');
        }
    } else { //UNPIN
        emit('pinItem', false)
        PlaylistService.unpinPlaylist(props.data.id, props.brand, token)
            .then((response) => {
                console.log(response)
                if (response.status === 200) {
                    //emit event or update pinia
                    playlistsStore.unpinPlaylist(props.data.id)
                    //show success message
                    window.shownotification({
                        icon: 'playlist',
                        text: `${props.data.name} has been successfully unpinned from the menu.`
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
        emit('updatePinned', false);
    }
    //close after click
    emit('closeDropdown');
}

const duplicatePlaylist = () => {
    window.openplaylistmodal({ modalType: 'duplicate', data: props.data });
    emit('closeDropdown');
};

const deletePlaylist = () => {
    window.openplaylistmodal({ modalType: 'remove', data: props.data });
    emit('closeDropdown');
};

const addToPlaylist = () => {
    window.openplaylistmodal({
        modalType: 'addItem', content: { ...props.data, content_id: props.data.id }
    });
}

const editPlaylist = () => {
    window.openplaylistmodal({ modalType: 'edit', data: props.data });
    emit('closeDropdown');
};

const unpinPlaylistModal = () => {
    window.openplaylistmodal({ modalType: 'unpinPlaylists' });
    emit('closeDropdown');
};

const removeLesson = () => {
    window.openplaylistmodal({ modalType: 'removeLesson', data: { ...props.data, index: props.index } });
    emit('closeDropdown');
};

const editLessonTime = () => {
    window.openplaylistmodal({ modalType: 'startEnd', data: props.data });
    emit('closeDropdown');
};

//Dragon Drop
const reorderPlaylist = () => {
    playlistsStore.sortingPlaylist = true;
    emit('closeDropdown');
};

const clickHandler = (fnstring) => {
    switch (fnstring) {
        case "sharePlaylist": sharePlaylist(); break;
        case "editPlaylist": editPlaylist(); break;
        case "addToPlaylist": addToPlaylist(); break;
        case "deletePlaylist": deletePlaylist(); break;
        case "duplicatePlaylist": duplicatePlaylist(); break;
        case "pinPlaylist": pinPlaylist(); break;
        case "privateToggle": privateToggle(); break;
        case "removeLesson": removeLesson(); break;
        case "editLessonTime": editLessonTime(); break;
        case "reorderPlaylist": reorderPlaylist(); break;
    }
}

//---------Lifecycle Methods---------//
onBeforeMount(() => {
    state.isPrivate = props.data.private ? 1 : 0;
});

onMounted(() => {
    //load Playlists
})

</script>
<template>
    <div v-if="isOpen"
        class="tw-w-[162px] tw-drop-shadow-lg tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-right-0 tw-py-2 tw-z-50"
        :class="dropdownTop ? 'tw-bottom-[100%]' : 'tw-top-[100%]'">
        <span class="tw-absolute tw-w-3 tw-h-3 tw-bg-white dark:tw-bg-[#081825] tw-rotate-45 tw-right-[11px]"
            :class="dropdownTop ? 'tw-bottom-[-4px]' : 'tw-top-[-4px]'"></span>
        <ul class="tw-text-sm tw-w-full">
            <!-- List Items -->
            <li v-for="(item, i) in dropdownOptions" :key="i" class="tw-w-full"
                :class="{ 'tw-hidden': (item.name === 'Share' && state.isPrivate) || (!isMyPlaylist || inPlaybackCue && item.name !== 'Add to List') }">
                <button
                    class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                    :class="[{'tw-pointer-events-none tw-cursor-default tw-opacity-60' : item.name === 'Re-Order' && lessonsLength === 1 }]"
                    @click.prevent="clickHandler(item.action)">
                    <template v-if="item.name === 'Private'">
                        {{ state.isPrivate ? 'Private' : 'Public' }}
                        <div
                            class="tw-relative tw-inline-flex tw-ml-auto tw-w-[27px] tw-h-[12px] tw-rounded-xl"
                            :class="state.isPrivate ? 'tw-bg-[#445F74]' : 'tw-bg-drumeo'"
                        >
                            <div class="tw-rounded-full tw-h-[15px] tw-w-[15px] tw-bg-white tw-flex-inline tw-items-center tw-justify-center tw-drop-shadow-lg tw-absolute tw-top-[-1.5px] tw-transition"
                                :class="state.isPrivate ? 'tw-left-[-1px]' : 'tw-right-[-1px]'">
                            </div>
                        </div>
                    </template>
                    <template v-else-if="item.name === 'Pin To Sidebar'">
                        {{ isPinned ? 'Unpin from Sidebar' : 'Pin to Sidebar' }}
                    </template>
                    <template v-else>
                        {{ item.name }}
                    </template>
                </button>
            </li>
        </ul>
    </div>
</template>
