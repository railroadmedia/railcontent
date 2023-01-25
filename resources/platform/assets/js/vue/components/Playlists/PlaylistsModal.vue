<script setup>
import { ref } from 'vue';
import { XCircleIcon } from '@heroicons/vue/outline'
import InfoModal from '../Modal/InfoModal.vue';
import InputLabel from '../InputLabel/InputLabel.vue';
import Dropdown from '../Dropdown/Dropdown.vue';

const props = defineProps({
    modalProps: {
        type: Object,
        default: () => ({
            modalType: null,
            imgSrc: 'asdasdsad',
        })
    }
});

const emit = defineEmits(['onClosePlaylistsModal']);

const title = ref('');
const category = ref(null);
const description = ref('');

const handleClose = () => {
    emit('onClosePlaylistsModal');
};

const handleTitleChange = (val) => {
    title.value = val;
};

const handleCategoryChange = (e) => {
    category.value = e.target.value;
};

const handleDescriptionChange = (e) => {
    console.log(e.target.value);
    description.value = e.target.value;
};

const { modalType, imgSrc } = props.modalProps;

const sortedOptions = [
    {
        value: '1',
        label: 'Test 1'
    },
];
</script>

<template>
    <InfoModal classOverride="tw-bg-[#081825] tw-max-w-[654px] tw-border-[1px] tw-border-[#445F74]" key="create-playlist-modal-instance" modalId="create-playlist-modal"
        @onClose="handleClose" :selfContained="true">
        <div class="tw-px-[64px] tw-pt-[12px]">
            <div class="tw-flex tw-flex-col tw-justify-center tw-text-white" v-if="modalType === 'create'">
                <h2 class="tw-font-bold tw-font-open-sans tw-text-[24px] tw-text-center">
                    Create Playlist
                </h2>
                <div class="tw-flex tw-pt-[24px]">
                    <div class="tw-flex tw-flex-col lg:tw-pr-[42px] tw-w-[200px] tw-shrink-0">
                        <img class="tw-w-[158px] tw-h-[158px] tw-rounded-[9px]" :src="`${imgSrc ? imgSrc : 'https://placehold.jp/158x158.png'}`" />
                        <div class="tw-flex tw-pt-[12px] tw-justify-center tw-items-center">
                            <button class="tw-underline tw-text-[#7E9AB1] tw-italic tw-text-[13px]">
                                <span v-if="!(imgSrc && imgSrc.length)">Upload Playlist Image</span>
                                <span v-if="(imgSrc && imgSrc.length)">Change Image</span>
                            </button>
                            <button tw- v-if="(imgSrc && imgSrc.length)" class="tw-ml-[3px]"><XCircleIcon class="tw-text-[#7E9AB1] tw-w-[14px] tw-h-[14px]" /></button>
                        </div>
                    </div>
                    <div class="tw-flex tw-flex-col tw-w-full tw-dark">
                        <InputLabel
                            placeholder="Playlist Title"
                            :remove-default-input-styles="true"
                            inputOverride="tw-mb-[20px] tw-text-white placeholder:tw-text-white tw-w-full tw-bg-[#002039]/90 tw-px-[14px] tw-box-border tw-border-[#445F74] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
                            @onChange="handleTitleChange"
                        />
                        <Dropdown
                            :sortedOptions="sortedOptions"
                            placeholderLabel="Playlist Category"
                            @onChange="handleCategoryChange"
                            :selected-value="category"
                        />
                        <textarea @change="handleDescriptionChange" id="playlist-description" name="playlistDescription" placeholder="Playlist Description" class="tw-rounded-[6px] placeholder:tw-text-white tw-text-white tw-bg-[#002039]/90 tw-mt-[20px] tw-box-border tw-border-[#445F74]"></textarea>
                    </div>
                </div>
            </div>
            <div v-if="modalProps.modalType === 'edit'">
                EDIT MODAL
            </div>
            <div v-if="modalProps.modalType === 'edit'">
                REMOVE MODAL
            </div>
            <div v-if="modalProps.modalType === 'startEnd'">
                START END MODAL
            </div>
            <div v-if="modalProps.modalType === 'addItem'">
                ADD ITEM MODAL
            </div>
            <div v-if="modalProps.modalType === 'alreadyAddedItem'">
                ALREADY ADDED MODAL
            </div>
        </div>
    </InfoModal>
</template>
