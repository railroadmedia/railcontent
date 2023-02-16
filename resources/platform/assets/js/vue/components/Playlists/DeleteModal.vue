<script setup>
import InputLabel from '../InputLabel/InputLabel.vue';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    }
});

</script>
<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="tw-text-[24px] tw-font-bold tw-w-full tw-text-white tw-text-center">Set Start/End Time</h2>
        <div class="tw-flex tw-pt-[29px]">
            
        </div>
        <div class="tw-pt-[30px] tw-flex tw-justify-end tw-w-full">
            <button @click="() => emit('onCancel')"
                    class="tw-btn-primary tw-text-center tw-justify-center tw-items-center tw-w-[150px]">
                    CANCEL
            </button>
            <button :class="`tw-ml-[20px] tw-btn-primary tw-bg-${brand} tw-text-center tw-flex tw-justify-center tw-items-center tw-p-0 tw-px-[30px] tw-w-[150px]`">
                <span>CONFIRM</span>
            </button>
        </div>
    </div>
</template>