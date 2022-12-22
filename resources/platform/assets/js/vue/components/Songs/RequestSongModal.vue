<script setup>
import { ref } from 'vue';
import axios from 'axios';
import InfoModal from '../Modal/InfoModal.vue';
import InputLabel from "../InputLabel/InputLabel.vue";
const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    }
});
const emit = defineEmits(['onCloseModal']);

const formData = ref({
    song_name: '',
    artist_name: '',
});

const submitForm = () => {
    axios.post(`/${props.brand}/songs`, formData.value).then((e) => {
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
        :selfContained="true" classOverride="tw-bg-white dark:tw-bg-[#081825]">
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <form accept-charset="UTF-8" method="POST" @submit.prevent="submitForm">
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <InputLabel inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" :brand="brand" inputType="text"
                        id="inputSongName" inputName="song_name" labelValue="Song Name"
                        placeholder="Enter the song name..." :inputErrors="[]" @onChange="handleSongName" />
                </div>
                <div class="tw-flex tw-flex-col tw-mb-[25px]">
                    <InputLabel inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" :brand="brand" inputType="text"
                        id="inputSongArtist" inputName="artist_name" labelValue="Artist Name"
                        placeholder="Enter the artist name..." :inputErrors="[]" @onChange="handleArtistName" />
                </div>
                <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                    <button :disabled="!formData.song_name.length || !formData.artist_name.length" class="tw-btn-primary tw-max-w-[351px]" :class="`tw-bg-${brand}`" type="submit">SUBMIT SONG
                        REQUEST</button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
