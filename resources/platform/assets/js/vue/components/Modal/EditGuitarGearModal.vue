<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Guitar Gear</h2>
            <form 
                accept-charset="UTF-8" 
                method="POST" 
                @submit.prevent="submitUserForm"
            >
                <MuSelect
                    inputOverride="tw-mb-3" 
                    id="playingGuitarSince"
                    input-name="guitar_playing_since_year"
                    label="Playing Guitar Since"
                    :options="yearValues"
                    :disabled="formProcessing"
                    v-model="formData.guitar_playing_since_year"
                    placeholder="Select Year"
                />

                <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-8">
                    <MuInput
                        inputOverride="" 
                        type="text"
                        id="guitarBrand" 
                        name="guitar_gear_guitar_brands" 
                        label="Guitars"
                        :disabled="formProcessing"
                        placeholder="Enter Guitar Brands" 
                        v-model="formData.guitar_gear_guitar_brands"
                    />
                    <MuInput
                        inputOverride="" 
                        type="text"
                        id="ampBrands" 
                        name="guitar_gear_amp_brands" 
                        label="Amps"
                        placeholder="Enter Amp Brands" 
                        :disabled="formProcessing"
                        v-model="formData.guitar_gear_amp_brands"
                    />
                    <MuInput
                        inputOverride="" 
                        type="text"
                        id="pedalBrands" 
                        name="guitar_gear_pedal_brands" 
                        label="Pedals"
                        placeholder="Enter Pedal Brands" 
                        :disabled="formProcessing"
                        v-model="formData.guitar_gear_pedal_brands"
                    />
                    <MuInput
                        inputOverride="" 
                        type="text"
                        id="stringBrands" 
                        name="guitar_gear_string_brands" 
                        label="Strings"
                        placeholder="Enter String Brands" 
                        :disabled="formProcessing"
                        v-model="formData.guitar_gear_string_brands"
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
    userPlayingGuitarSince,
    userGuitarBrands,
    userAmpBrands,
    userPedalBrands,
    userStringBrands,
} = storeToRefs(userStore);

const emit = defineEmits(['onCloseGuitarGearModal']);

//Refs
const formProcessing = ref(false);
const formData = ref({
    guitar_playing_since_year: userPlayingGuitarSince.value || '',
    guitar_gear_guitar_brands: userGuitarBrands.value || '',
    guitar_gear_amp_brands: userAmpBrands.value || '',
    guitar_gear_pedal_brands: userPedalBrands.value || '',
    guitar_gear_string_brands: userStringBrands.value || '',
});

const yearValues = computed(() => {
    const currentYear = new Date().getFullYear();
    return ["", ...Array(currentYear - 1899).fill().map((_, idx) => currentYear - idx)];
});

const handleClose = () => {
    emit('onCloseGuitarGearModal');
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


