<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../Stores/user';

import InfoModal from '../Modal/InfoModal.vue';
import InputLabel from "../InputLabel/InputLabel.vue";
import MuButton from '../Button/MuButton';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const emit = defineEmits(['onCloseModal']);

const formData = ref({
    song_name: '',
    artist_name: '',
});

const submitForm = () => {
    axios.post(`/${brand.value}/songs`, formData.value).then((e) => {
        if (window.shownotification) {
            window.shownotification({
                icon: 'check',
                text: 'Success! Your song request has been submitted.'
            });
        }
        emit('onCloseModal');
    });
};

const handleSongName = (value) => {
    formData.value = {
        ...formData.value,
        song_name: value
    };
};

const handleArtistName = (value) => {
    formData.value = {
        ...formData.value,
        artist_name: value
    };
};
</script>
<template>
    <InfoModal title="Request A Song" modalId="request-a-song-modal" @onClose="emit('onCloseModal')"
        :selfContained="true" classOverride="tw-max-w-[575px]">
        <div class="tw-bg-white dark:tw-bg-[#081825]">
            <form accept-charset="UTF-8" method="POST" @submit.prevent="submitForm">
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <InputLabel inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" inputType="text"
                        id="inputSongName" inputName="song_name" labelValue="Song Name"
                        placeholder="Enter the song name..." :inputErrors="[]" @onChange="handleSongName" />
                </div>
                <div class="tw-flex tw-flex-col tw-mb-[25px]">
                    <InputLabel inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" inputType="text"
                        id="inputSongArtist" inputName="artist_name" labelValue="Artist Name"
                        placeholder="Enter the artist name..." :inputErrors="[]" @onChange="handleArtistName" />
                </div>
                <div class="tw-flex tw-justify-end tw-items-center">
                    <MuButton variant="secondary" :disabled="!formData.song_name.length || !formData.artist_name.length" type="submit">Submit song request</MuButton>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
