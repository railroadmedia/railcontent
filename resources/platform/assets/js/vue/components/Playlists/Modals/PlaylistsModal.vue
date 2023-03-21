<script setup>
    import InfoModal from '../../Modal/InfoModal.vue';
    import CreatePlaylist from './CreatePlaylist.vue';
    import AddItem from './AddItem.vue'
    import StartEnd from './StartEnd.vue';
    import DeleteModal from './DeleteModal.vue';
    import NoAccess from './NoAccess.vue';
    import UnpinModal from './UnpinModal/UnpinModal.vue';

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
        },
        brand: {
            type: String,
            default: 'drumeo'
        }
    });

    const modalContainerProps = {
        create: 'tw-max-w-[654px] tw-px-4 sm:tw-px-[64px]',
        duplicate: 'tw-max-w-[654px] tw-px-[64px]',
        edit: 'tw-max-w-[654px] tw-px-[64px]',
        remove: 'tw-max-w-[606px] tw-px-[64px]',
        noAccess: 'tw-max-w-[550px] tw-px-[64px]',
        removeLesson: 'tw-max-w-[606px] tw-px-[64px]',
        startEnd: 'tw-max-w-[589px] tw-px-[48px]',
        addItem: 'tw-max-w-[917px] tw-px-4 sm:tw-px-[32px]',
        unpinPlaylists: 'tw-max-w-[917px] tw-px-[32px]',
        alreadyAddedItem: '',
    };
</script>
<template>
    <InfoModal :classOverride="`tw-bg-white dark:tw-bg-[#081825] ${modalContainerProps[modalProps.modalType]} tw-border tw-border-[#445F74] dark:tw-border-[#445F74]`"
               key="create-playlist-modal-instance"
               modalId="create-playlist-modal"
               @onClose="() => emit('onClosePlaylistsModal')" :selfContained="true"
    >
        <div class="tw-pt-[12px]">

            <CreatePlaylist mode="create" @onCloseModal="() => emit('onClosePlaylistsModal')" :brand="brand" :modalProps="modalProps" :playlist="modalProps.data" v-if="modalProps.modalType === 'create'"  />
            <CreatePlaylist mode="duplicate" @onCloseModal="() => emit('onClosePlaylistsModal')" :brand="brand" :playlist="modalProps.data" :modalProps="modalProps" v-if="modalProps.modalType === 'duplicate'"  />
            <CreatePlaylist mode="edit" @onCloseModal="() => emit('onClosePlaylistsModal')" :brand="brand" :playlist="modalProps.data" :modalProps="modalProps" v-if="modalProps.modalType === 'edit'"  />


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
                         :index="modalProps.index"
            />

            <NoAccess v-if="modalProps.modalType === 'noAccess'"
                      @onCloseModal="() => emit('onClosePlaylistsModal')"
                      :brand="brand"
                      :data="modalProps.data"
            />

            <div v-if="modalProps.modalType === 'startEnd'">
                <StartEnd @onCloseModal="() => emit('onClosePlaylistsModal')"
                          :brand="brand"
                          :data="modalProps.data"
                          :index="modalProps.index"
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
        </div>
    </InfoModal>
</template>
