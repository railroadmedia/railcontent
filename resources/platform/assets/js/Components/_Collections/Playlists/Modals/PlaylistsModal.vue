<script setup>
    import InfoModal from '@collections/Modal/InfoModal.vue';
    import CreatePlaylist from './CreatePlaylist.vue';
    import AddItem from './AddItem.vue'
    import StartEnd from './StartEnd.vue';
    import DeleteModal from './DeleteModal.vue';
    import NoAccess from './NoAccess.vue';
    import UnpinModal from './UnpinModal/UnpinModal.vue';
    import RenameItem from './RenameItem.vue';
    import ShareModal from './ShareModal.vue';
    import { storeToRefs } from 'pinia'
    import { useUserStore } from '@stores/user';
    import {computed} from "vue";
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    const emit = defineEmits(['onClosePlaylistsModal']);

    const props = defineProps({
        modalProps: {
            type: Object,
            default: () => ({
                modalType: null,
                imgSrc: 'asdasdsad',
                data: {},
                index: null
            })
        }
    });

    const modalContainerProps = {
        create: 'tw-max-w-[654px]',
        duplicate: 'tw-max-w-[654px]',
        edit: 'tw-max-w-[654px]',
        remove: 'tw-max-w-[606px]',
        noAccess: 'tw-max-w-[550px]',
        removeLesson: 'tw-max-w-[606px]',
        startEnd: 'tw-max-w-[589px]',
        share: 'tw-max-w-[550px]',
        addItem: 'tw-max-w-[917px]',
        unpinPlaylists: 'tw-max-w-[917px]',
        renameItem: 'tw-max-w-[514px]',
        alreadyAddedItem: '',
    };

    const showCreatePlaylist = computed(() => {
        return props.modalProps.modalType === 'create' || props.modalProps.modalType === 'duplicate' || props.modalProps.modalType === 'edit';
    })

    const modalTitle = computed(() => {
        if(props.modalProps.modalType === 'create'){
            return 'Create Playlist';
        } else if(props.modalProps.modalType === 'duplicate'){
            return 'Duplicate Playlist';
        } else if(props.modalProps.modalType === 'edit'){
            return 'Edit Playlist';
        } else if(props.modalProps.modalType === 'share'){
            return 'This Playlist is Currently Private';
        } else if(props.modalProps.modalType === 'remove'){
            return `Delete <span class="tw-text-${brand.value}">${props.modalProps.data.name}</span> ?`;
        } else if(props.modalProps.modalType === 'removeLesson'){
            return 'Remove from playlist?';
        } else if(props.modalProps.modalType === 'noAccess'){
            return 'Content Unavailable';
        } else if(props.modalProps.modalType === 'renameItem'){
            return 'Rename Playlist Item';
        } else if(props.modalProps.modalType === 'startEnd'){
            return 'Set Start/End Time';
        } else if(props.modalProps.modalType === 'addItem'){
            return 'Add Item to Playlist';
        } else if(props.modalProps.modalType === 'unpinPlaylists'){
            return 'You\'ve reached your Pinned Playlist limit';
        }  else if(props.modalProps.modalType === 'alreadyAddedItem'){
            return 'Already Added Item';
        }
    })
</script>
<template>
    <InfoModal
        :classOverride="`${modalContainerProps[modalProps.modalType]}`"
        key="create-playlist-modal-instance"
        modalId="create-playlist-modal"
        :title="modalTitle"
        @onClose="() => emit('onClosePlaylistsModal')" :selfContained="true"
    >
        <CreatePlaylist v-if="showCreatePlaylist" :mode="modalProps.modalType" @onCloseModal="() => emit('onClosePlaylistsModal')" :brand="brand" :modalProps="modalProps" :playlist="modalProps.data" />

        <ShareModal v-if="modalProps.modalType === 'share'" mode="share" @onCloseModal="() => emit('onClosePlaylistsModal')" :brand="brand" :data="modalProps.data"  />

        <DeleteModal v-if="modalProps.modalType === 'remove'"
                     @onCloseModal="() => emit('onClosePlaylistsModal')"
                    :brand="brand"
                    :data="modalProps.data"
        />
        <DeleteModal v-if="modalProps.modalType === 'removeLesson'"
                     @onCloseModal="() => emit('onClosePlaylistsModal')"
                     :brand="brand"
                     mode="lesson"
                     :data="modalProps.data"
        />

        <NoAccess v-if="modalProps.modalType === 'noAccess'"
                  @onCloseModal="() => emit('onClosePlaylistsModal')"
                  :brand="brand"
                  :data="modalProps.data"
        />

        <RenameItem v-if="modalProps.modalType === 'renameItem'"
                    @onCloseModal="() => emit('onClosePlaylistsModal')"
                    :brand="brand"
                    :content="modalProps.content"
        />

        <div v-if="modalProps.modalType === 'startEnd'">
            <StartEnd @onCloseModal="() => emit('onClosePlaylistsModal')"
                      :brand="brand"
                      :data="modalProps.data"
            />
        </div>
        <div v-if="modalProps.modalType === 'addItem'">
            <AddItem @onCancel="() => emit('onClosePlaylistsModal')"
                     :brand="brand"
                     :content="modalProps.content"
            />
        </div>
        <div :brand="brand" v-if="modalProps.modalType === 'alreadyAddedItem'">
            Already Added Item
        </div>
        <div v-if="modalProps.modalType === 'unpinPlaylists'">
            <UnpinModal @onCloseModal="() => emit('onClosePlaylistsModal')"
                        :brand="brand"
                        :playlist="modalProps.data"
             />
        </div>
    </InfoModal>
</template>
