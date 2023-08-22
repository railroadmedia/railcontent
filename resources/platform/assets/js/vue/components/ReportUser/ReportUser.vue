<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { FlagIcon } from '@heroicons/vue/outline'

const props = defineProps({
    user: {
        type: Object,
        default: {},
    },
});

const isReported = ref(false);

const reportUser = () => {
    if (!isReported.value) {
        isReported.value = true;
        axios.put(`/user-management-system/user/report/${props.user.id}`).then(() => {
            window.shownotification({
                icon: 'report',
                text: 'User has been successfully reported.'
            });
        }).catch(() => {
            isReported.value = false;
            window.shownotification({
                icon: 'error',
                text: 'There was am error reporting this user, please try again later.'
            });
        });
    } else {
        window.shownotification({
            icon: 'report',
            text: 'You have already reported this user.'
        });
    }
};

onMounted(() => {
    isReported.value = props.user.is_reported;
});
</script>
<template>
    <button class="dark:tw-text-[#9EC0DC] tw-text-[#65656B] tw-text-[20px] tw-font-bebas-neue tw-cursor-pointer tw-flex tw-items-center"
        @click="reportUser">
        <FlagIcon class="tw-inline tw-mr-[5px] tw-w-[20px] tw-h-[20px] tw-text-[#65656B] dark:tw-text-[#9EC0DC]" />
        &nbsp;{{ isReported ? 'REPORTED' : 'REPORT USER' }}
    </button>
</template>
