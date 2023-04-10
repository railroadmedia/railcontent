<script setup>
    // TODO: Add Upload Modal for thumbnail add/change
    // TODO: Consider edit mode in the avatar upload process
    // TODO: Close modal after create is 200
    import { reactive, ref, inject, onMounted, onBeforeMount, onBeforeUnmount } from 'vue';
    import InputLabel from '../../InputLabel/InputLabel.vue';
    import Dropdown from '../../Dropdown/Dropdown.vue'
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import ThumbnailUpload from '../../ThumbnailUpload/ThumbnailUpload.vue';

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
        category: 'My List',
        thumb: null,
        description: '',
    })

    //------------Static Data------------//
    const sortedOptions = [
        {
            value: 'Rock',
            label: 'Rock'
        },
        {
            value: 'Pop',
            label: 'Pop'
        },
        {
            value: 'Jazz',
            label: 'Jazz'
        },
        {
            value: 'Blues',
            label: 'Blues'
        },
        {
            value: 'Country',
            label: 'Country'
        },
        {
            value: 'Metal',
            label: 'Metal'
        },
        {
            value: 'Funk',
            label: 'Funk'
        },
        {
            value: 'Soul',
            label: 'Soul'
        },
        {
            value: 'CCM/Worship',
            label: 'CCM/Worship'
        },
        {
            value: 'Hip-Hop/Rap',
            label: 'Hip-Hop/Rap'
        },
        {
            value: 'My List',
            label: 'My-List'
        },
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
            private: props.playlist.private,
            thumbnail_url: state.thumb,
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
                        text: `'${payload.name}' was added to your library.`
                    })
                    if (props.playlist.hasAddItemCallback) {
                        console.log('has add item callback', response.data)
                        window.addItemCallback(response.data.data[0].id)
                    }
                    //load Playlists (if collection catalog exists)
                    if(playlistsStore.pageHasPlaylistCatalog) {
                        playlistsStore.getPlaylists({ brand: props.brand, page: playlistsStore.resultsPage, limit: null }, token);
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
                            text: `Your playlist was successfully edited`
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
        }
        //Close Modal
        emit('onCloseModal')
    };

    //----------Lifecycle Hooks----------//
    onMounted(()=> {
        console.log(props.playlist)
    })
    onBeforeMount(()=> {
        //Load Data
        state.thumb = props.playlist.thumbnail_url;
        state.name = props.mode === 'duplicate' ? props.playlist.name + ' (Duplicate)' : props.playlist.name;
        state.description = props.playlist.description;
        state.category = props.playlist.category || 'My List';

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
        <h2 class="tw-font-bold tw-font-open-sans tw-text-[24px] tw-text-center">
            <span v-if="mode === 'create'">Create Playlist</span>
            <span v-if="mode === 'edit'">Edit Playlist</span>
            <span v-if="mode === 'duplicate'">Duplicate Playlist</span>
        </h2>
        <div v-if="playlist.hasAddItemCallback" class="tw-pt-[24px]">
            <p v-if="playlist.additionalItems > 0">
                <strong>{{ playlist.name }}</strong> with <strong>{{ playlist.additionalItems }}</strong> assignment items will be added to your new playlist
            </p>
            <p v-if="playlist.additionalItems === 0">
                <strong>{{ playlist.name }}</strong> will be added to your new playlist
            </p>
        </div>
        <div class="tw-flex tw-pt-[24px] tw-flex-col sm:tw-flex-row">
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
                    inputOverride="tw-mb-[20px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full dark:tw-bg-[#002039]/90 tw-px-[14px] tw-box-border tw-border-[#D4D4D8] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px]"
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
                    class="tw-no-scrollbar tw-text-sm tw-h-[93px] tw-rounded-[6px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white dark:tw-bg-[#002039]/90 tw-mt-[20px] tw-box-border tw-border-[#D4D4D8] dark:tw-border-[#445F74] tw-py-[9px]"
                    v-model="state.description"
                    @change="handleDescriptionChange"
                ></textarea>
            </div>
        </div>
        <div class="tw-pt-[30px] tw-flex tw-flex-col sm:tw-flex-row tw-justify-between">
            <button @click="() => emit('onCloseModal')" class="tw-order-1 sm:tw-order-none tw-btn-primary tw-text-center tw-justify-center tw-items-center tw-border-[#000C17] dark:tw-text-white dark:tw-border-white dark:bg-[#081825] tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10">CANCEL</button>
            <button @click="() => handleConfirm()" :class="`tw-mb-2 sm:tw-mb-0 sm:tw-ml-4 tw-btn-primary tw-bg-${brand} tw-text-center tw-flex tw-justify-center tw-items-center hover:tw-bg-${brand}-600`"><span>{{ props.modalProps.modalType === 'create' ? 'create' : props.modalProps.modalType === 'duplicate' ? 'duplicate' : 'save' }}</span></button>
        </div>
    </div>
</template>
