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
                @submit.prevent="submitUserForm"
            >
                <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-[20px]">
                    <MuInput 
                        type="text"
                        id="firstName" 
                        name="first_name" 
                        label="First Name"
                        required
                        title="First Name cannot be empty"
                        :error="!formData.first_name.length"
                        placeholder="Enter First Name"
                        :disabled="formProcessing" 
                        v-model="formData.first_name"
                    />
                    <MuInput 
                        type="text"
                        id="lastName" 
                        name="last_name" 
                        label="Last Name"
                        required
                        title="Last Name cannot be empty"
                        :error="!formData.last_name.length"
                        placeholder="Enter Last Name" 
                        :disabled="formProcessing"
                        v-model="formData.last_name"
                    />
                    <MuSelect
                        id="profileCountry"
                        label="Country"
                        :options="countryList"
                        v-model="formData.country"
                        placeholder="Choose a Country"
                        :disabled="formProcessing"
                    />
                    <MuDateInput
                        id="profileBirthday"
                        label="Birthday"
                        v-model="formData.birthday"
                        :disabled="formProcessing"
                    />
                </div>
                <MuTextarea
                    inputOverride="tw-w-full tw-text-[#00101D] tw-mb-6" 
                    id="profileBio"
                    label="Biography"
                    v-model="formData.biography"
                    placeholder="Enter Biography"
                    :disabled="formProcessing"
                />
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <mu-button
                        class="tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :disabled="!formData.first_name.length && !formData.last_name"
                        :processing="formProcessing"
                        @click="handleClick"
                    >
                        Save
                    </mu-button>
                    <mu-button
                        @click="handleClose"
                        style-type="secondary"
                        class="tw-mx-1 tw-btn-secondary tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                    >
                        Cancel
                    </mu-button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>

<script setup>
    import { ref, onBeforeMount } from 'vue';
    import InfoModal from '../Modal/InfoModal.vue';
    import MuInput from "../../components/FormInputs/MuInput.vue"
    import MuSelect from "../../components/FormInputs/MuSelect.vue"
    import MuTextarea from "../../components/FormInputs/MuTextarea.vue"
    import MuDateInput from "../../components/FormInputs/MuDateInput.vue"
    import MuButton from '../Button/MuButton.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { 
        token,
        userId, 
        userFirstName,
        userLastName,
        userCountry,
        userBirthday,
        userBiography
    } = storeToRefs(userStore);

    const props = defineProps({
        countryList: Array,
    });

    //Emits
    const emit = defineEmits(['onCloseAboutYouModal']);

    //Refs
    const formProcessing = ref(false);
    const formData = ref({
        first_name: userFirstName.value || '', 
        last_name: userLastName.value || '',
        country: userCountry.value || '',
        birthday: userBirthday.value || '',
        biography: userBiography.value || '',
    });

    //Methods
    const handleClose = () => {
        emit('onCloseAboutYouModal');
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
