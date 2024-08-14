<script setup>
import { ref, onMounted, onUpdated } from 'vue';
import { XCircleIcon } from '@heroicons/vue/outline'

const props = defineProps({
    text: {
        type: String,
        default: () => "",
    },
    classOverride: {
        type: String,
        default: () => "",
    },
});

const emit = defineEmits(['onHide'])

const timeout = ref(null);
const visible = ref(false);

const hideToast = () => {
    clearTimeout(timeout.value);
    visible.value = false;
    timeout.value = setTimeout(() => {
        clearTimeout(timeout.value);
        emit('onHide');
    }, 200);
};
const autoHide = () => {
    clearTimeout(timeout.value);
    timeout.value = setTimeout(() => {
        hideToast();
    }, 3000);
};

onMounted(() => {
    autoHide();
    visible.value = true;
})

onUpdated(() => {
    autoHide();
})
</script>


<template>
    <teleport to="#notifications-container">
        <div class="tw-z-[2000] tw-fixed tw-bottom-[36px] tw-h-[53px] tw-w-full">
            <div class="tw-text-center tw-pb-6 tw-text-white">
                <div :style="{ opacity: visible ? 1 : 0 }" class="
          tw-px-[22px]
          tw-py-[16px]
          tw-w-4/6
          tw-justify-self-center
          tw-mx-auto
          tw-rounded-md
          tw-transition-opacity
        " :class="classOverride">
                    <div class="tw-flex tw-justify-between tw-text-[14px]">
                        <div>
                            <slot name="icon"></slot>
                            {{ text }}
                        </div>
                        <button class="tw-bg-transparent tw-border-none" @click="hideToast();">
                            <XCircleIcon class="tw-w-[20px] tw-h-[20px]" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>
