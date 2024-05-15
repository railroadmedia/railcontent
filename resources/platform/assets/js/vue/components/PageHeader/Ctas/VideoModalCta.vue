<template>
    <PageHeaderCta v-bind="$attrs" :text="text" :faIconClass="faIconClass" showAllAlways @click="handleOpen" />
    <InfoModal v-if="modalOpen"
        :classOverride="'tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]'"
        :modalId="modalId" :selfContained="true" @onClose="handleClose">
        <div class="flex flex-column corners-10 tw-px-5 tw-pt-8">
            <div class="video-wrap">
                <div class="widescreen">
                    <div class="flex flex-column video-player user-active">
                        <iframe
                            style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;"
                            :src="iframeSrc" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </InfoModal>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import InfoModal from '../../Modal/InfoModal.vue';

const props = defineProps({
    text: String,
    faIconClass: String,
    iframeSrc: String,
});

const modalId = ref('');

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};

onMounted(() => {
    modalId.value = `videoModalCta-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
});
</script>
