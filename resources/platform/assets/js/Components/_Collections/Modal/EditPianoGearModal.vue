<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal"
        title="Edit Piano Gear"
        :selfContained="true"
        @onClose="handleClose"
    >
        <form
            accept-charset="UTF-8"
            @submit.prevent="submitUserForm"
        >
            <MuSelect
                inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D] tw-mb-3"
                id="playingPianoSince"
                input-name="piano_playing_since_year"
                label="Playing Piano Since"
                :options="yearValues"
                placeholder="Select Year"
                :disabled="formProcessing"
                v-model="formData.piano_playing_since_year"
            />

            <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-8">
                <MuInput
                    inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
                    type="text"
                    id="pianoBrand"
                    name="piano_gear_piano_brands"
                    label="Piano"
                    placeholder="Enter Piano Brand"
                    :disabled="formProcessing"
                    v-model="formData.piano_gear_piano_brands"
                />
                <MuInput
                    inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
                    type="text"
                    id="keyboardBrand"
                    name="piano_gear_keyboard_brands"
                    label="Keyboard"
                    placeholder="Enter Keyboard Brand"
                    :disabled="formProcessing"
                    v-model="formData.piano_gear_keyboard_brands"
                />
            </div>
            <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] tw-flex-wrap sm:tw-flex-nowrap tw-gap-2 sm:tw-gap-0">
                <MuButton
                    class="tw-w-full sm:tw-w-auto sm:tw-mx-1"
                    type="submit"
                    :processing="formProcessing"
                    processing-text="Saving..."
                    @click="handleClick"
                >
                    Save
                </MuButton>
            </div>
        </form>
    </InfoModal>
</template>

<script setup>
import { ref, computed } from 'vue';
import InfoModal from '@collections/Modal/InfoModal.vue';
import MuInput from "@units/FormInputs/MuInput.vue"
import MuSelect from "@units/FormInputs/MuSelect.vue"
import MuButton from '@units/Button/MuButton.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';

const userStore = useUserStore();
const {
    userPlayingPianoSince,
    userPianoBrands,
    userKeyboardBrands

} = storeToRefs(userStore);

//Emits
const emit = defineEmits(['onClosePianoGearModal']);

//Refs
const formProcessing = ref(false);
const formData = ref({
    piano_playing_since_year: userPlayingPianoSince.value || '',
    piano_gear_piano_brands: userPianoBrands.value || '',
    piano_gear_keyboard_brands: userKeyboardBrands.value || '',
});

//Computed
const yearValues = computed(() => {
    const currentYear = new Date().getFullYear();
    return ["", ...Array(currentYear - 1899).fill().map((_, idx) => currentYear - idx)];
});

//Methods
const handleClose = () => {
    emit('onClosePianoGearModal');
};

const submitUserForm = async () => {
    formProcessing.value = true;
    try {
        await userStore.updateProfile(formData.value);
        handleClose();
    } catch (error) {
        console.error("Failed to update the display name:", error.message);
        formProcessing.value = false;
    }

};
</script>
