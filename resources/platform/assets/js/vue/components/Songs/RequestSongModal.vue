<script setup>
import InfoModal from '../Modal/InfoModal.vue';
import InputLabel from "../InputLabel/InputLabel.vue";
const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    }
});
const emit = defineEmits(['onCloseModal']);
</script>
<template>
    <InfoModal title="Request A Song" modalId="request-a-song-modal" @onClose="emit('onCloseModal')" :selfContained="true" classOverride="tw-bg-white dark:tw-bg-[#081825]">
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <form accept-charset="UTF-8" method="POST">
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <InputLabel inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" :brand="brand" inputType="text"
                        id="inputSongName" inputName="song_name" labelValue="Song Name" placeholder="Enter the song name..."
                        :inputErrors="[]"/>
                </div>
                <div class="tw-flex tw-flex-col tw-mb-[25px]">
                    <InputLabel inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" :brand="brand" inputType="text"
                        id="inputSongArtist" inputName="artist_name" labelValue="Artist Name"
                        placeholder="Enter the artist name..." :inputErrors="[]"/>
                </div>
                <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                    <button class="tw-btn-primary tw-max-w-[351px]" :class="`tw-bg-${brand}`" type="submit">SUBMIT SONG REQUEST</button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
