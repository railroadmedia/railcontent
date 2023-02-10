<script setup>
import InfoModal from '../Modal/InfoModal.vue';
import CreatePlaylist from './CreatePlaylist.vue';
import AddItem from './AddItem.vue'
import StartEnd from './StartEnd.vue';

const props = defineProps({
    modalProps: {
        type: Object,
        default: () => ({
            modalType: null,
            imgSrc: 'asdasdsad',
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
    edit: 'tw-max-w-[654px] tw-px-[64px]',
    remove: '',
    startEnd: 'tw-max-w-[589px] tw-px-[48px]',
    addItem: 'tw-max-w-[917px] tw-px-[32px]',
    alreadyAddedItem: ''
};

</script>

<template>
    <InfoModal :classOverride="`tw-bg-[#081825] ${modalContainerProps[modalProps.modalType]} tw-border-[1px] tw-border-[#445F74]`" key="create-playlist-modal-instance" modalId="create-playlist-modal"
        @onClose="() => emit('onClosePlaylistsModal')" :selfContained="true">
        <div class="tw-pt-[12px]">
            <CreatePlaylist mode="create" @onCancel="() => emit('onClosePlaylistsModal')" :modalProps="modalProps" v-if="modalProps.modalType === 'create'"  />
            <CreatePlaylist mode="edit" @onCancel="() => emit('onClosePlaylistsModal')" :modalProps="modalProps" v-if="modalProps.modalType === 'edit'"  />
            <div v-if="modalProps.modalType === 'remove'">
                REMOVE MODAL
            </div>
            <div v-if="modalProps.modalType === 'startEnd'">
                <StartEnd :brand="brand" />
            </div>
            <div v-if="modalProps.modalType === 'addItem'">
                <AddItem :brand="brand" />
            </div>
            <div v-if="modalProps.modalType === 'alreadyAddedItem'">
                ALREADY ADDED MODAL
            </div>
        </div>
    </InfoModal>
</template>
