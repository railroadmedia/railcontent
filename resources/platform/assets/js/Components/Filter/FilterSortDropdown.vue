<script setup>
    import MusoraIcon from "../MusoraIcons/MusoraIcon";

    const props = defineProps({
        sortOptions: {
            type: Array,
            default: [],
        }
    });

    const emit = defineEmits(['onClose', 'onSort']);
</script>

<template>
    <div v-click-outside="() => { emit('onClose') }"
         class="tw-w-[185px] tw-drop-shadow-lg tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-right-0 tw-py-2 tw-mt-1 tw-top-[100%] tw-z-[2000]">
        <ul class="tw-text-xs tw-w-full">
            <!-- List Items -->
            <li v-for="(item, i) in sortOptions" :key="i" class="tw-w-full">
                <button
                    class="tw-flex tw-items-center tw-w-full tw-px-[10px] tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                    @click.prevent="() => {
                        $emit('onSort', item.value)
                        $emit('onClose');
                    }"
                >
                    <musora-icon :icon-name="item.icon" class="tw-w-[20px] tw-h-[20px] tw-mr-[10px]" />
                    {{ item.name }}
                </button>
            </li>
        </ul>
    </div>
</template>
