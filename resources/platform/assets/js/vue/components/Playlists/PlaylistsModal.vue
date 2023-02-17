<script setup>
import InfoModal from '../Modal/InfoModal.vue';
import CreatePlaylist from './CreatePlaylist.vue';
import AddItem from './AddItem.vue'
import StartEnd from './StartEnd.vue';
import DeleteModal from './DeleteModal.vue';
import UnpinModal from './UnpinModal.vue';

const props = defineProps({
    modalProps: {
        type: Object,
        default: () => ({
            modalType: null,
            imgSrc: 'asdasdsad',
            data: {}
        })
    },
    brand: {
        type: String,
        default: 'drumeo'
    }
});

const emit = defineEmits(['onClosePlaylistsModal']);

const modalContainerProps = {
    create: 'tw-max-w-[654px] tw-px-[64px]',
    duplicate: 'tw-max-w-[654px] tw-px-[64px]',
    edit: 'tw-max-w-[654px] tw-px-[64px]',
    remove: 'tw-max-w-[606px] tw-px-[64px]',
    startEnd: 'tw-max-w-[589px] tw-px-[48px]',
    addItem: 'tw-max-w-[917px] tw-px-[32px]',
    alreadyAddedItem: ''
};

</script>

<template>
    <InfoModal :classOverride="`tw-bg-[#081825] ${modalContainerProps[modalProps.modalType]} tw-border-[1px] tw-border-[#445F74]`" key="create-playlist-modal-instance" modalId="create-playlist-modal"
        @onClose="() => emit('onClosePlaylistsModal')" :selfContained="true">
        <div class="tw-pt-[12px]">
            
            <CreatePlaylist mode="create" @onCloseModal="() => emit('onClosePlaylistsModal')" :modalProps="modalProps" v-if="modalProps.modalType === 'create'"  />
            <CreatePlaylist mode="duplicate" @onCloseModal="() => emit('onClosePlaylistsModal')" :modalProps="modalProps" v-if="modalProps.modalType === 'duplicate'"  />
            <CreatePlaylist mode="edit" @onCloseModal="() => emit('onClosePlaylistsModal')" :modalProps="modalProps" v-if="modalProps.modalType === 'edit'"  />
            
            <div v-if="modalProps.modalType === 'remove'">
                <DeleteModal @onCloseModal="() => emit('onClosePlaylistsModal')"
                             :brand="brand" 
                             :playlist="modalProps.data"
                />
            </div>
            <div v-if="modalProps.modalType === 'startEnd'">
                <StartEnd :brand="brand" />
            </div>
            <div v-if="modalProps.modalType === 'addItem'">
                <AddItem @onCancel="() => emit('onClosePlaylistsModal')" 
                         :brand="brand" 
                         :contentId="modalProps.contentId" 
                />
            </div>
            <div v-if="modalProps.modalType === 'alreadyAddedItem'">
                Already Added Item
            </div>
            <div v-if="modalProps.modalType === 'unpinPlaylists'">
                <UnpinModal :brand="brand" />
            </div>
        </div>
    </InfoModal>
</template>
