<script setup>
    // TODO: Add Upload Modal for thumbnail add/change
    // TODO: Consider edit mode in the avatar upload process
    import { ref, inject } from 'vue';
    import { XCircleIcon } from '@heroicons/vue/outline'
    import InputLabel from '../InputLabel/InputLabel.vue';
    import Dropdown from '../Dropdown/Dropdown.vue';
    import PlaylistService from '../../../services/playlists';
    //import ThumbnailUpload from '../ThumbnailUpload/ThumbnailUpload.vue';

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
    });

    const emit = defineEmits(['onClose']);

    const title = ref('');
    const category = ref(null);
    const description = ref('');

    const token = inject('csrf_token');

    const { imgUrl } = props.modalProps;

    const handleTitleChange = (val) => {
        title.value = val;
    };

    const handleCategoryChange = (val) => {
        category.value = val;
    };

    const handleDescriptionChange = (e) => {
        description.value = e.target.value;
    };

    const handleConfirm = () => {
        const payload = {
            brand: props.brand,
            description: description.value,
            category: category.value,
            private: true,
            thumbnail_url: thumb.value,
        };
        PlaylistService.createUserPlaylist({
            token,
            payload
        });
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
    ];
</script>

<template>
    <div class="tw-flex tw-flex-col tw-justify-center tw-text-white">
        <h2 class="tw-font-bold tw-font-open-sans tw-text-[24px] tw-text-center">
            <span v-if="mode === 'create'">Create Playlist</span>
            <span v-if="mode === 'edit'">Edit Playlist</span>
        </h2>
        <div class="tw-flex tw-pt-[24px]">
            <div class="tw-flex tw-flex-col tw-w-full tw-dark">
                <InputLabel placeholder="Playlist Title" :remove-default-input-styles="true"
                    inputOverride="tw-mb-[20px] tw-text-white placeholder:tw-text-white tw-w-full tw-bg-[#002039]/90 tw-px-[14px] tw-box-border tw-border-[#445F74] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
                    @onChange="handleTitleChange" />
                <Dropdown :sortedOptions="sortedOptions" placeholderLabel="Playlist Category"
                    @onChange="handleCategoryChange" :selected-value="category" />
                <textarea @change="handleDescriptionChange" id="playlist-description" name="playlistDescription"
                    placeholder="Playlist Description"
                    class="tw-h-[93px] tw-rounded-[6px] placeholder:tw-text-white tw-text-white tw-bg-[#002039]/90 tw-mt-[20px] tw-box-border tw-border-[#445F74]"></textarea>
                <div class="tw-pt-[30px] tw-flex">
                    <button @click="() => emit('onCancel')" class="tw-btn-primary tw-text-center tw-justify-center tw-items-center">CANCEL</button>
                    <button @click="handleConfirm" :class="`tw-ml-[20px] tw-btn-primary tw-bg-${brand} tw-text-center tw-flex tw-justify-center tw-items-center tw-p-0 tw-px-[30px]`"><span>CONFIRM</span></button>
                </div>
            </div>
        </div>
    </div>
</template>