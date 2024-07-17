<template>
    <PageHeaderCta v-bind="$attrs" text="Where to begin" faIconClass="fa-question-circle" showAllAlways
        @click="handleOpen" />
    <InfoModal v-if="modalOpen"
        :classOverride="'tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]'"
        modalId="surveyModall" :selfContained="true" @onClose="handleClose">
        <div class="flex flex-column corners-10 tw-px-5 tw-pt-8">
            <div id="typeform-in-modal" class="tw-w-full tw-h-[600px]"></div>
        </div>
    </InfoModal>
</template>

<script setup>
import { nextTick, ref } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../Stores/user';
import InfoModal from '../../Modal/InfoModal.vue';
import { createWidget } from '@typeform/embed'
import '@typeform/embed/build/css/widget.css'

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const getBrandTypeformId = () => {
    if (brand.value === 'drumeo') {
        return 'rnPhq70s';
    } else if (brand.value === 'pianote') {
        return 'huIKxOSj';
    }
    return null
};

const attachTypeformWidget = () => {
    const typeformId = getBrandTypeformId();
    if (typeformId) {
        createWidget(typeformId, {
            container: document.getElementById('typeform-in-modal'),
        });
    }
};

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;

    nextTick().then(() => {
        attachTypeformWidget();
    });
};

const handleClose = () => {
    modalOpen.value = false;
};
</script>