<template>
    <InfoModal
        classOverride="tw-max-w-[654px]"
        modalId="displayNameModal"
        title="About You"
        :selfContained="true"
        @onClose="handleClose"
    >
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
                    placeholder="Enter First Name"
                    :disabled="formProcessing"
                    v-model="formData.first_name"
                />
                <MuInput
                    type="text"
                    id="lastName"
                    name="last_name"
                    label="Last Name"
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
            <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] tw-flex-wrap sm:tw-flex-nowrap tw-gap-2 sm:tw-gap-0">
                <MuButton
                    class="tw-w-full sm:tw-w-auto sm:tw-mx-1"
                    type="submit"
                    :processing="formProcessing"
                    processing-text="Saving..."
                >
                    Save
                </MuButton>
            </div>
        </form>
    </InfoModal>
</template>

<script setup>
    import { ref } from 'vue';
    import InfoModal from '@collections/Modal/InfoModal.vue';
    import MuInput from "@units/FormInputs/MuInput.vue"
    import MuSelect from "@units/FormInputs/MuSelect.vue"
    import MuTextarea from "@units/FormInputs/MuTextarea.vue"
    import MuDateInput from "@units/FormInputs/MuDateInput.vue"
    import MuButton from '@units/Button/MuButton.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '@stores/user';

    const userStore = useUserStore();
    const {
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
            handleClose();
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
            formProcessing.value = false;
        }
    };
</script>
