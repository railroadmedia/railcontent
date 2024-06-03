<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">About You</h2>
            <form 
                accept-charset="UTF-8" 
                method="POST" 
                @submit.prevent="submitDisplayNameForm"
            >
                <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-[20px]">
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        inputType="text"
                        id="firstName" 
                        inputName="first_name" 
                        labelValue="First Name"
                        placeholder="Enter First Name" 
                        :initial-value="userFirstName"
                        :inputErrors="[]" 
                        @onChange="handleFirstName" 
                    />
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        inputType="text"
                        id="lastName" 
                        inputName="last_name" 
                        labelValue="Last Name"
                        placeholder="Enter Last Name" 
                        :initial-value="userLastName"
                        :inputErrors="[]" 
                        @onChange="handleLastName" 
                    />
                    <MuSelect
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        id="profileCountry"
                        label="Country"
                        :options="countryList"
                        :initial-value="userCountry"
                        v-model="selectedCountry"
                        placeholder="Choose a Country"
                    />
                    <MuDateInput
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        id="profileBirthday"
                        label="Birthday"
                        :initial-value="userBirthday"
                        v-model="selectedBirthday"
                    />
                </div>
                <MuTextarea
                    inputOverride="tw-w-full tw-text-[#00101D] tw-mb-6" 
                    id="profileBio"
                    label="Biography"
                    :initial-value="userBiography"
                    v-model="selectedCountry"
                    placeholder="Enter Biography"
                />
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <button
                        :disabled="!formData.first_name.length" 
                        type="submit"
                        class="tw-mx-1 tw-btn-primary dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        :class="!formData.first_name.length ? 'tw-opacity-50' : ''"
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
    import { ref, onBeforeMount } from 'vue';
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
        userFirstName,
        userLastName,
        userCountry,
        userBirthday,
        userBiography
    } = storeToRefs(userStore);

    //Props
    const props = defineProps({
        countryList: Array,
    });

    //Refs
    const emit = defineEmits(['onCloseAboutYouModal']);
    const selectedCountry = ref('');

    const formData = ref({
        first_name: userFirstName.value || '', 
        last_name: userLastName.value || '',
        country: userCountry.value || '',
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