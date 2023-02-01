<script setup>
const props = defineProps({

});
</script>

<template>
    <div class="tw-inline-flex tw-relative tw-w-[48px] mr-1 tw-rounded-full tw-ring-offset-2 focus-within:tw-ring-1 tw-shrink-0">
        <input tabindex="0"
            type="checkbox" name="send_email" id="sendEmailNotifications"
            class="tw-peer tw-absolute tw-h-0 tw-w-0 tw-top-[10px] tw-left-[10px] has-input"><label tabindex="-1"
            for="sendEmailNotifications"
            class="tw-cursor-pointer tw-inline-flex tw-w-full tw-h-[24px] tw-p-[2px] tw-transition-colors tw-transform-gpu tw-duration-75 tw-shadow tw-rounded-full tw-bg-gray-400 dark:tw-bg-[#445F74] peer-checked:tw-bg-drumeo"></label><label
            tabindex="-1" for="sendEmailNotifications"
            class="tw-cursor-pointer tw-w-[20px] tw-h-[20px] tw-bg-white tw-rounded-full tw-transition-all transform-gpu tw-duration-75 tw-absolute tw-top-[2px] tw-right-[calc(100%-22px)] peer-checked:tw-right-[2px]"></label>
    </div>
</template>
