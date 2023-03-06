<script setup>
    import InputLabel from '../../InputLabel/InputLabel.vue';

    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo'
        }
    });

    //Emits
    const emit = defineEmits(['onCloseModal']);
</script>
<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="ttw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">Set Start/End Time</h2>
        <div class="tw-flex tw-pt-[29px]">
            <InputLabel :maskaConfig="{  dataMaska: 'T#:T#', maskaTokens: 'T:[0-5]' }" labelValue="Start Time" placeholder="00:00" inputOverride="tw-rounded-[8px] tw-ml-[13px] tw-w-full" />
            <InputLabel :maskaConfig="{  dataMaska: 'T#:T#', maskaTokens: 'T:[0-5]' }" labelValue="End Time" placeholder="00:00" inputOverride="tw-rounded-[8px] tw-ml-[13px] tw-w-full" />
        </div>
        <div class="tw-pt-[30px] tw-flex tw-justify-end tw-w-full">
            <!-- Close Modal -->
            <button @click="() => emit('onCloseModal')"
                    class="tw-btn-primary tw-btn-small tw-text-base dark:tw-text-white tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10 tw-w-[218px]">
                    CANCEL
            </button>
            <!-- Delete Lesson -->
            <button :class="`tw-mb-2 tw-btn-primary tw-btn-small tw-text-base tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                    @click.prevent="handleConfirm()"
            >
                CONFIRM
            </button>
        </div>
    </div>
</template>