<script setup>
    // TODO: Add Upload Modal for thumbnail add/change
    // TODO: Consider edit mode in the avatar upload process
    // TODO: Close modal after create is 200
    import { reactive, ref, inject, onMounted, onBeforeMount, onBeforeUnmount } from 'vue';
    import InputLabel from '../../InputLabel/InputLabel.vue';
    import Dropdown from '../../Dropdown/Dropdown.vue'
    import PlaylistService from '../../../Services/playlists.js';
    import { usePlaylistsStore } from '../../../Stores/playlists';
    import ThumbnailUpload from '../../ThumbnailUpload/ThumbnailUpload.vue';
    import MuButton from '../../Button/MuButton';

    //Emits
    const emit = defineEmits(['onCloseModal']);

    //Pinia Store
    const playlistsStore = usePlaylistsStore();

    //Inject
    const token = inject('csrf_token');

    //--------------Props--------------//
    const props = defineProps({
        modalProps: {
            type: Object,
            default: () => ({
                modalType: null,
                imgUrl: 'asdasdsad',
            })
        },
        mode: {
            type: String,
            default: null
        },
        brand: {
            type: String,
            default: 'drumeo'
        },
        playlist: {
            type: Object,
            default: {}
        }
    });

    //------------Reactive Data------------//
    const state = reactive({
        name: '',
        category: 'General',
        thumb: null,
        description: '',
        sortValue: '-created_at' //Default
    })

    //------------Static Data------------//

    const sortedOptions = [
        {
            value: 'Watch Later',
            label: 'Watch-Later'
        },
        {
            value: 'Favorites',
            label: 'Favorites'
        },
        {
            value: 'General',
            label: 'General'
        },
        {
            value: 'Practice',
            label: 'Practice'
        },
        {
            value: 'Learning',
            label: 'Learning'
        },
        {
            value: 'Entertainment',
            label: 'Entertainment'
        },
        {
            value: 'Warm Up',
            label: 'Warm-Up'
        },
        {
            value: 'Songs',
            label: 'Songs'
        }
    ];

    //-------------Methods-------------//
    const handleTitleChange = (val) => {
        state.name = val;
    };

    const handleCategoryChange = (val) => {
        state.category = val;
    };

    const handleDescriptionChange = (e) => {
        state.description = e.target.value;
    };

    const updateThumbnail = (img) => {
        state.thumb = img;
    }

    const handleConfirm = () => {
        const payload = {
            brand: props.brand,
            name: state.name ? state.name : 'Playlist',
            description: state.description,
            category: state.category,
            thumbnail_url: state.thumb !== props.playlist.thumbnail_url ? state.thumb : null,
        };
        if(props.mode === "create") {
            PlaylistService.createUserPlaylist({
                token,
                payload
            }).then(function(response) {
                if (response.status === 201) {
                    playlistsStore.loadingPlaylists = true;
                    //show success message
                    window.shownotification({
                        icon: 'playlist',
                        text: `${payload.name} was been successfully created.`
                    })
                    if (props.playlist.hasAddItemCallback) {
                        window.addItemCallback(response.data.data[0].id)
                    }
                    //load Playlists (if collection catalog exists)
                    if(playlistsStore.pageHasPlaylistCatalog) {
                        playlistsStore.getPlaylists({
                            brand: props.brand,
                            page: playlistsStore.resultsPage,
                            sort: state.sortValue,
                            limit: null
                        }, token);
                    }

                    //load sidebar playlists
                    playlistsStore.getSidebarPlaylists({
                        brand: brand,
                        page: 1,
                        limit: 10,
                        term: '',
                        sort: 'most_recent',
                    }, token);
                }
            }).catch((error)=>{
                window.shownotification({
                    icon: 'error',
                    text: error.response.data.meta.errors[0].detail
                })
            })
        }
        if(props.mode === "edit") {
            //Update Active Playlist (For Playlist Detail Page)
            if( Object.keys(playlistsStore.activePlaylist).length ) {
                playlistsStore.updateActivePlaylist({
                    id: props.playlist.id,
                    thumbnail_url: state.thumb,
                    name: state.name ? state.name : 'Playlist',
                    description: state.description,
                    category: state.category,
                })
            }
            // Update Pinned Playlist if name changed
            playlistsStore.updatePinnedItem(props.playlist.id, payload.name);
            //Send Request
            PlaylistService.updatePlaylist(props.playlist.id, payload, token)
                .then(function(response) {
                    if (response.status === 201) {
                        playlistsStore.loadingPlaylists = true;
                        //show success message
                        window.shownotification({
                            icon: 'fa-pen-to-square',
                            text: `${state.name} has been successfully edited.`
                        })
                        //load Playlists (if collection catalog exists)
                        if( playlistsStore.pageHasPlaylistCatalog ) {
                            playlistsStore.getPlaylists({ brand: brand, page: playlistsStore.resultsPage, limit: null }, token);
                        }

                        //load sidebar playlists
                        playlistsStore.getSidebarPlaylists({
                            brand: brand,
                            page: 1,
                            limit: 10,
                            term: '',
                            sort: 'most_recent',
                        }, token);
                    } else {
                        console.log('edit response code', response)
                    }
                })
            .catch((error)=>{
                window.shownotification({
                    icon: 'error',
                    text: 'Woops! Something wrong happened, please try again later.'
                })
            })
        }
        if(props.mode === "duplicate") {
            const duplicateData = {
                playlist_id: props.playlist.id,
                name: state.name ? state.name : 'Playlist (Duplicate)',
                description: state.description,
                thumbnail_url: state.thumb,
                category: state.category,
            }
            PlaylistService.duplicatePlaylist(duplicateData, token)
                .then(function(response) {
                    if (response.status === 201) {
                        playlistsStore.loadingPlaylists = true;
                        //show success message
                        window.shownotification({
                            icon: 'fa-copy',
                            text: `The playlist was successfully duplicated.`
                        })

                        //load Playlists
                        if( playlistsStore.pageHasPlaylistCatalog ) {
                            playlistsStore.getPlaylists({ brand: brand, page: playlistsStore.resultsPage, limit: null }, token);
                        }

                        //load sidebar playlists
                        playlistsStore.getSidebarPlaylists({
                            brand: brand,
                            page: 1,
                            limit: 10,
                            term: '',
                            sort: 'most_recent',
                        }, token);
                    } else {
                        console.log('duplicate response code', response)
                    }
                })
                .catch((error)=>{
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                })
        }
        //Close Modal
        emit('onCloseModal')
    };

    //----------Lifecycle Hooks----------//
    onBeforeMount(()=> {
        //Load Data
        state.thumb = props.playlist.thumbnail_url;
        state.name = props.mode === 'duplicate' ? props.playlist.name + ' (Duplicate)' : props.playlist.name;
        state.description = props.playlist.description?.replace(/(<([^>]+)>)/gi, "");
        state.category = props.playlist.category || 'General';

        //get url params
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        //Set state props
        state.sortValue = params.sortby_val || '-created_at';
    })
    onBeforeUnmount(() => {
        //Reset Modal Data
        if (props.modalProps.nextModal) {
            window.openplaylistmodal(props.modalProps.nextModal);
        }
    })
</script>
<template>
    <div class="tw-flex tw-flex-col tw-justify-center tw-text-[#0D0D0D] dark:tw-text-white">
        <div v-if="playlist.hasAddItemCallback && playlist.importAssignments" class="tw-pt-[24px]">
            <p v-if="playlist.additionalItems > 0">
                <strong>{{ playlist.name }}</strong> with <strong>{{ playlist.additionalItems }}</strong> assignment items will be added to your new playlist
            </p>
            <p v-if="playlist.additionalItems === 0">
                <strong>{{ playlist.name }}</strong> will be added to your new playlist
            </p>
        </div>
        <div class="tw-flex tw-flex-col sm:tw-flex-row">
            <ThumbnailUpload
                :token="token"
                type='playlist'
                :imgUrl="state.thumb"
                @imageUploaded="updateThumbnail($event)"
            />
            <div class="tw-flex tw-flex-col tw-w-full">
                <InputLabel
                    :initialValue="state.name"
                    placeholder="Playlist Title"
                    :remove-default-input-styles="true"
                    inputOverride="tw-mb-[20px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full dark:tw-bg-black tw-px-[14px] tw-box-border tw-border-[#D4D4D8] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[13px] sm:tw-text-[14px]"
                    @onChange="handleTitleChange"
                />
                <Dropdown
                    :sortedOptions="sortedOptions"
                    :selected-value="state.category"
                    placeholderLabel="Playlist Category"
                    @onChange="handleCategoryChange"
                />
                <textarea
                    id="playlist-description"
                    name="playlistDescription"
                    placeholder="Playlist Description"
                    class="tw-no-scrollbar tw-text-[13px] sm:tw-text-sm tw-h-[93px] tw-rounded-[6px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white dark:tw-bg-black tw-mt-[20px] tw-box-border tw-border-[#D4D4D8] dark:tw-border-[#445F74] tw-py-[9px]"
                    v-model="state.description"
                    @change="handleDescriptionChange"
                ></textarea>
            </div>
        </div>
        <div class="tw-pt-[30px] tw-flex tw-justify-end">
            <MuButton variant="secondary" @click="() => emit('onCloseModal')" class="tw-mr-[10px]">Cancel</MuButton>
            <MuButton @click="() => handleConfirm()">{{ props.modalProps.modalType === 'create' ? 'create' : props.modalProps.modalType === 'duplicate' ? 'duplicate' : 'save' }}</MuButton>
        </div>
    </div>
</template>
