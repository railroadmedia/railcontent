<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Piano Gear</h2>
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
                    v-model="formData.piano_playing_since_year"
                    placeholder="Select Year"
                />

                <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-8">
                    <MuInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        type="text"
                        id="pianoBrand" 
                        name="piano_gear_piano_brands" 
                        label="Piano"
                        placeholder="Enter Piano Brand" 
                        v-model="formData.piano_gear_piano_brands"
                    />
                    <MuInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        type="text"
                        id="keyboardBrand" 
                        name="piano_gear_keyboard_brands" 
                        label="Keyboard"
                        placeholder="Enter Keyboard Brand" 
                        v-model="formData.piano_gear_keyboard_brands"
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <button   
                        type="submit"
                        class="tw-mx-1 tw-btn-primary dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                    >
                        Save
                    </button>
                    <button
                        @click="handleClose"
                        class="tw-mx-1 tw-btn-secondary tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>

<script setup>
import { ref, computed } from 'vue';
import InfoModal from '../Modal/InfoModal.vue';
import MuInput from "../../components/FormInputs/MuInput.vue"
import MuSelect from "../../components/FormInputs/MuSelect.vue"
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';

const userStore = useUserStore();
const { 
    token,
    userId, 
    userPlayingPianoSince,
    userPianoBrands,
    userKeyboardBrands

} = storeToRefs(userStore);

const emit = defineEmits(['onClosePianoGearModal']);

const formData = ref({
    piano_playing_since_year: userPlayingPianoSince.value || '',
    piano_gear_piano_brands: userPianoBrands.value || '',
    piano_gear_keyboard_brands: userKeyboardBrands.value || '',
});

const yearValues = computed(() => {
    const currentYear = new Date().getFullYear();
    return ["", ...Array(currentYear - 1899).fill().map((_, idx) => currentYear - idx)];
});

const handleClose = () => {
    emit('onClosePianoGearModal');
};

const submitUserForm = async () => {
    try {
        await userStore.updateProfile(token.value, userId.value, formData.value);
    } catch (error) {
        console.error("Failed to update the display name:", error.message);
    }
    handleClose(); // Close modal
};
</script>