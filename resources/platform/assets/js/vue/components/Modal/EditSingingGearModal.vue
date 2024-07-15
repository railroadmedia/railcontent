<template>
    <InfoModal
        classOverride="tw-max-w-[654px]"
        modalId="displayNameModal"
        title="Edit Singing Gear"
        :selfContained="true"
        @onClose="handleClose"
    >
        <form
            accept-charset="UTF-8"
            @submit.prevent="submitUserForm"
        >
            <MuSelect
                inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D] tw-mb-3"
                id="SingingSince"
                input-name="singing_since_year"
                label="Singing Since"
                :options="yearValues"
                :disabled="formProcessing"
                v-model="formData.singing_since_year"
                placeholder="Select Year"
            />

            <div class="tw-grid tw-gap-3 tw-mb-8">
                <MuInput
                    type="text"
                    id="micBrands"
                    name="singing_gear_mic_brands"
                    label="Microphones"
                    placeholder="Enter Microphone Brands"
                    :disabled="formProcessing"
                    v-model="formData.singing_gear_mic_brands"
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
import InfoModal from '../Modal/InfoModal.vue';
import MuInput from "../../components/FormInputs/MuInput.vue"
import MuSelect from "../../components/FormInputs/MuSelect.vue"
import MuButton from '../Button/MuButton.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';

const userStore = useUserStore();
const {
    userSingingSince,
    userMicBrands,
} = storeToRefs(userStore);

const emit = defineEmits(['onCloseSingingGearModal']);

//Refs
const formProcessing = ref(false);
const formData = ref({
    singing_since_year: userSingingSince.value || '',
    singing_gear_mic_brands: userMicBrands.value || ''
});

const yearValues = computed(() => {
    const currentYear = new Date().getFullYear();
    return ["", ...Array(currentYear - 1899).fill().map((_, idx) => currentYear - idx)];
});

const handleClose = () => {
    emit('onCloseSingingGearModal');
};

const submitUserForm = async () => {
    //Refs
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
