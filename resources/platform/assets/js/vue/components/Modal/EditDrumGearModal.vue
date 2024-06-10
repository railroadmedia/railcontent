<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Drum Gear</h2>
            <form 
                accept-charset="UTF-8" 
                @submit.prevent="submitUserForm"
            >
                <MuSelect
                    inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D] tw-mb-3" 
                    id="drummingSince"
                    input-name="drums_playing_since_year"
                    label="Drumming Since"
                    :options="yearValues"
                    :disabled="formProcessing"
                    v-model="formData.drums_playing_since_year"
                    placeholder="Select Year"
                />

                <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-8">
                    <MuInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        type="text"
                        id="drumSet" 
                        name="drums" 
                        label="Drum Set"
                        placeholder="Enter Drum Set Brand" 
                        :disabled="formProcessing"
                        v-model="formData.drums_gear_set_brands"
                    />
                    <MuInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        type="text"
                        id="cymbals" 
                        name="cymbals" 
                        label="Cymbals"
                        placeholder="Enter Cymbal Brands" 
                        :disabled="formProcessing"
                        v-model="formData.drums_gear_cymbal_brands"
                    />
                    <MuInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        type="text"
                        id="hardware" 
                        name="hardware" 
                        label="Hardware"
                        placeholder="Enter Hardware Brands" 
                        :disabled="formProcessing"
                        v-model="formData.drums_gear_hardware_brands"
                    />
                    <MuInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        type="text"
                        id="drumSticks" 
                        name="drumSticks" 
                        label="Drum Sticks"
                        placeholder="Enter Drum Stick Brands" 
                        :disabled="formProcessing"
                        v-model="formData.drums_gear_stick_brands"
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <MuButton
                        class="tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :processing="formProcessing"
                        @click="handleClick"
                    >
                        Save
                    </MuButton>
                    <MuButton
                        @click="handleClose"
                        style-type="secondary"
                        class="tw-mx-1 tw-btn-secondary tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                    >
                        Cancel
                    </MuButton>
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
import MuButton from '../Button/MuButton.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';

const userStore = useUserStore();
const { 
    token,
    userId, 
    userDrumBrands,
    userCymbalBrands,
    userHardwareBrands,
    userStickBrands,
    userDrummingSince
} = storeToRefs(userStore);

const emit = defineEmits(['onCloseDrumGearModal']);

//Refs
const formProcessing = ref(false);
const formData = ref({
    drums_playing_since_year: userDrummingSince.value || '',
    drums_gear_set_brands: userDrumBrands.value || '',
    drums_gear_cymbal_brands: userCymbalBrands.value || '',
    drums_gear_hardware_brands: userHardwareBrands.value || '',
    drums_gear_stick_brands: userStickBrands.value || '',
});

//Computed
const yearValues = computed(() => {
    const currentYear = new Date().getFullYear();
    return ["", ...Array(currentYear - 1899).fill().map((_, idx) => currentYear - idx)];
});


//Methods
const handleClose = () => {
    emit('onCloseDrumGearModal');
};

const submitUserForm = async () => {
    formProcessing.value = true;
    try {
        await userStore.updateProfile(formData.value);
    } catch (error) {
        console.error("Failed to update the display name:", error.message);
    }
    handleClose(); // Close modal
};
</script>
