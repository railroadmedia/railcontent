<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Login Password</h2>
            <form 
                accept-charset="UTF-8" 
                method="POST" 
                @submit.prevent="submitDisplayNameForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        input-type="password"
                        id="emailPassword" 
                        inputName="password" 
                        labelValue="Current Password"
                        placeholder="Enter Current Password" 
                        :inputErrors="[]" 
                        @onChange="handleDisplayName" 
                    />
                </div>
                <div class="tw-flex tw-flex-col tw-mb-4">
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        input-type="password"
                        id="emailPassword" 
                        inputName="password" 
                        labelValue="New Password"
                        placeholder="Enter New Password" 
                        :inputErrors="[]" 
                        @onChange="handleDisplayName" 
                    />
                </div>
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        input-type="password"
                        id="emailPassword" 
                        inputName="password" 
                        labelValue="Confirm New Password"
                        placeholder="Confirm New Password" 
                        :inputErrors="[]" 
                        @onChange="handleDisplayName" 
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] tw-flex-wrap sm:tw-flex-nowrap tw-gap-2 sm:tw-gap-0">
                    <button
                        :disabled="!formData.display_name.length" 
                        type="submit"
                        class="tw-w-full sm:tw-w-auto sm:tw-mx-1 tw-btn-primary dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        :class="!formData.display_name.length ? 'tw-opacity-50' : ''"
                    >
                        Save
                    </button>
                    <button
                        @click="handleClose"
                        class="tw-w-full sm:tw-w-auto sm:tw-mx-1 tw-btn-primary tw-bg-transparent dark:hover:tw-bg-white hover:tw-bg-black dark:hover:tw-text-[#00101D] hover:tw-text-white tw-text-[#00101D] dark:tw-text-white"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
<script setup>
    import { ref } from 'vue';
    import axios from 'axios';
    import InfoModal from '../Modal/InfoModal.vue';
    import InputLabel from "../InputLabel/InputLabel.vue";
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { userId, userDisplayName } = storeToRefs(userStore);

    //Refs
    const emit = defineEmits(['onCloseModal']);

    const formData = ref({
        display_name: ''
    });

    //Methods
    const handleClose = () => {
        emit('onCloseModal');
    };

    const handleDisplayName = (value) => {
        formData.value = {
            ...formData.value,
            display_name: value
        };
    };
    
    const submitDisplayNameForm = () => {
        axios.post(`/user-management-system/user/update/${ userId.value }`, formData.value).then((e) => {
            if (window.shownotification) {
                window.shownotification({
                    icon: 'check',
                    text: 'Success! Your song request has been submitted.'
                });
            }
            handleClose()
        });  
    };
</script>