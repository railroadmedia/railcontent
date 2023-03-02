<script setup>
    // TODO: Add Upload Modal for thumbnail add/change
    // TODO: Consider edit mode in the avatar upload process
    // TODO: Close modal after create is 200
    import { reactive, ref, inject, onBeforeMount, onBeforeUnmount } from 'vue';
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

    const resetState = () => {
        state.name = '';
        state.category = 'My List'; //Default
        state.thumb = null;
        state.description = '';
    }

    const handleConfirm = () => {
        const payload = {
            brand: props.brand,
            name: state.name || 'New Playlist',
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
                    //load Playlists
                    playlistsStore.getPlaylists({ brand: brand, page: playlistsStore.resultsPage, limit: null }, token);       
                }
            })
        }
        if(props.mode === "edit") {
            PlaylistService.updatePlaylist(props.playlist.id, payload, token)
                .then(function(response) {
                    
                    if (response.status === 201) {
                        playlistsStore.loadingPlaylists = true;
                        //show success message
                        window.shownotification({
                            icon: 'fa-pen-to-square',
                            text: `Your playlist was successfully edited`
                        })
                        //load Playlists
                        playlistsStore.getPlaylists({ brand: brand, page: playlistsStore.resultsPage, limit: null }, token);       
                    } else {
                        console.log('edit response code', response)
                    }
                })
        }
        if(props.mode === "duplicate") {
            const duplicateData = {
                playlist_id: props.playlist.id,
                name: state.name,
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
                        playlistsStore.getPlaylists({ brand: brand, page: playlistsStore.resultsPage, limit: null }, token);       
                    } else {
                        console.log('duplicate response code', response)
                    }
                })
        }

        //Close Modal
        emit('onCloseModal')
    };

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

    //----------Lifecycle Hooks----------//
    onBeforeMount(()=> {
        //Load Data        
        console.log(props.playlist)
        state.thumb = props.playlist.thumbnail_url;
        state.name = props.playlist.name;
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
        <div class="tw-flex tw-pt-[24px]">
            <ThumbnailUpload :token="token" type='playlist' :imgUrl="state.thumb"/>
            <div class="tw-flex tw-flex-col tw-w-full">
                <InputLabel 
                    :initialValue="state.name"
                    placeholder="Playlist Title" 
                    :remove-default-input-styles="true"
                    inputOverride="tw-mb-[20px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full tw-bg-[#eeeeef] dark:tw-bg-[#002039]/90 tw-px-[14px] tw-box-border tw-border-[#D4D4D8] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px]"
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
                    class="tw-no-scrollbar tw-text-sm tw-h-[93px] tw-rounded-[6px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-bg-[#eeeeef] dark:tw-bg-[#002039]/90 tw-mt-[20px] tw-box-border tw-border-[#D4D4D8] dark:tw-border-[#445F74] tw-py-[9px]"
                    v-model="state.description"
                    @change="handleDescriptionChange" 
                ></textarea>
                <div class="tw-pt-[30px] tw-flex tw-justify-end">
                    <button @click="() => emit('onCloseModal')" class="tw-btn-primary tw-btn-small tw-text-center tw-justify-center tw-items-center dark:tw-text-white tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10">CANCEL</button>
                    <button @click="() => handleConfirm()" :class="`tw-ml-4 tw-btn-primary tw-btn-small tw-bg-${brand} tw-text-center tw-flex tw-justify-center tw-items-center tw-p-0 tw-px-[30px]`"><span>CONFIRM</span></button>
                </div>
            </div>
        </div>
    </div>
</template>
