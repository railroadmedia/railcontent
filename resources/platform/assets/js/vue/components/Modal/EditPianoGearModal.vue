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
                method="POST" 
                @submit.prevent="submitDisplayNameForm"
            >
                <MuSelect
                    inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D] tw-mb-3" 
                    id="drummingSince"
                    input-name="drums_playing_since_year"
                    label="Drumming Since"
                    :options="yearValues"
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
                        v-model="formData.drums_gear_set_brands"
                    />
                    <MuInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        type="text"
                        id="cymbals" 
                        name="cymbals" 
                        label="Cymbals"
                        placeholder="Enter Cymbal Brands" 
                        v-model="formData.drums_gear_cymbal_brands"
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
    userId, 
    userDrumBrands,
    userCymbalBrands,
    userHardwareBrands,
    userStickBrands,
    userDrummingSince
} = storeToRefs(userStore);

const emit = defineEmits(['onCloseDrumGearModal']);

const formData = ref({
    drums_playing_since_year: userDrummingSince.value || '',
    drums_gear_set_brands: userDrumBrands.value || '',
    drums_gear_cymbal_brands: userCymbalBrands.value || '',
    drums_gear_hardware_brands: userHardwareBrands.value || '',
    drums_gear_stick_brands: userStickBrands.value || '',
});

const yearValues = computed(() => {
    const currentYear = new Date().getFullYear();
    return ["", ...Array(currentYear - 1899).fill().map((_, idx) => currentYear - idx)];
});

const handleClose = () => {
    emit('onCloseDrumGearModal');
};

const submitDisplayNameForm = async () => {
    // API call to update user's drum gear
    try {
        await userStore.updateUserGear(userId.value, formData.value);
        handleClose(); // Close modal after success
    } catch (error) {
        console.error("Failed to update the drum gear:", error.message);
    }
};
</script>
