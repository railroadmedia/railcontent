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
                    :initial-value="userDrummingSince"
                    v-model="selectedYear"
                    placeholder="Drumming Since"
                />

                <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-8">
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        inputType="text"
                        id="drumSet" 
                        inputName="drums" 
                        labelValue="Drum Set"
                        placeholder="Enter First Name" 
                        :initial-value="userDrumBrands"
                        :inputErrors="[]" 
                        @onChange="handleFirstName" 
                    />
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        inputType="text"
                        id="lastName" 
                        inputName="last_name" 
                        labelValue="Cymbals"
                        placeholder="Enter Last Name" 
                        :initial-value="userCymbalBrands"
                        :inputErrors="[]" 
                        @onChange="handleLastName" 
                    />
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        inputType="text"
                        id="firstName" 
                        inputName="first_name" 
                        labelValue="Hardware"
                        placeholder="Enter First Name" 
                        :initial-value="userHardwareBrands"
                        :inputErrors="[]" 
                        @onChange="handleFirstName" 
                    />
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        inputType="text"
                        id="lastName" 
                        inputName="last_name" 
                        labelValue="Drum Sticks"
                        placeholder="Enter Last Name" 
                        :initial-value="userStickBrands"
                        :inputErrors="[]" 
                        @onChange="handleLastName" 
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
                        class="tw-mx-1 tw-btn-primary tw-bg-transparent dark:hover:tw-bg-white hover:tw-bg-black dark:hover:tw-text-[#00101D] hover:tw-text-white tw-text-[#00101D] dark:tw-text-white"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
<script setup>
    import { ref, onBeforeMount, computed } from 'vue';
    import InfoModal from '../Modal/InfoModal.vue';
    import InputLabel from "../InputLabel/InputLabel.vue";
    import MuSelect from "../../components/FormInputs/MuSelect.vue"
    import MuTextarea from "../../components/FormInputs/MuTextarea.vue"
    import MuDateInput from "../../components/FormInputs/MuDateInput.vue"
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { 
        userId, 
        userDrummingSince,
        userDrumBrands,
        userCymbalBrands,
        userHardwareBrands,
        userStickBrands,
    } = storeToRefs(userStore);

    //Props
    const props = defineProps({
        
    });

    //Refs
    const emit = defineEmits(['onCloseAboutYouModal']);
    const selectedYear = ref('');

    const formData = ref({
        drums_playing_since_year: selectedYear.value || '',
        
        
    });

    //Computed Values
    const yearValues = computed(() => {
        const currentYear = new Date().getFullYear();
        return ["", ...Array(currentYear - 1899).fill().map((_, i) => currentYear - i)];
    });

    //Methods
    const handleClose = () => {
        emit('onCloseAboutYouModal');
    };

    const handleDisplayName = (value) => {
        formData.value.first_name = value;
    };
        
    const submitDisplayNameForm = async () => {
        try {
            await userStore.updateDisplayName(userId.value, formData.value.first_name);
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
        }
        handleClose(); // Close modal
    };

    onBeforeMount( () => {
        console.log('Countries', props.countryList)
    })
</script>