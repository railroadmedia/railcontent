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
                        v-model="formData.guitar_gear_amp_brands"
                    />
                    <MuInput
                        inputOverride="" 
                        type="text"
                        id="pedalBrands" 
                        name="guitar_gear_pedal_brands" 
                        label="Pedals"
                        placeholder="Enter Pedal Brands" 
                        v-model="formData.guitar_gear_pedal_brands"
                    />
                    <MuInput
                        inputOverride="" 
                        type="text"
                        id="stringBrands" 
                        name="guitar_gear_string_brands" 
                        label="Strings"
                        placeholder="Enter String Brands" 
                        v-model="formData.guitar_gear_string_brands"
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
    userPlayingGuitarSince,
    userGuitarBrands,
    userAmpBrands,
    userPedalBrands,
    userStringBrands,
} = storeToRefs(userStore);

const emit = defineEmits(['onCloseGuitarGearModal']);

const formData = ref({
    guitar_playing_since_year: userPlayingGuitarSince || '',
    guitar_gear_guitar_brands: userGuitarBrands || '',
    guitar_gear_amp_brands: userAmpBrands || '',
    guitar_gear_pedal_brands: userPedalBrands || '',
    guitar_gear_string_brands: userStringBrands || '',
});

const yearValues = computed(() => {
    const currentYear = new Date().getFullYear();
    return ["", ...Array(currentYear - 1899).fill().map((_, idx) => currentYear - idx)];
});

const handleClose = () => {
    emit('onCloseGuitarGearModal');
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


