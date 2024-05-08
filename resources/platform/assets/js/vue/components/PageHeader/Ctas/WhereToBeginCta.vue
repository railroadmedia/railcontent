<template>
    <PageHeaderCta v-bind="$attrs" text="Where to begin" faIconClass="fa-question-circle" showAllAlways
        @click="handleOpen" />
    <InfoModal v-if="modalOpen"
        :classOverride="'tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]'"
        modalId="surveyModall" :selfContained="true" @onClose="handleClose">
        <div class="flex flex-column corners-10 tw-px-5 tw-pt-8">
            <div v-if="brand === 'drumeo'" class="typeform-widget"
                data-url="https://form.typeform.com/to/rnPhq70s?typeform-medium=embed-snippet"
                style="width: 100%; height: 600px;"></div>
            <div v-else-if="brand === 'pianote'" class="typeform-widget"
                data-url="https://form.typeform.com/to/huIKxOSj?typeform-medium=embed-snippet"
                style="width: 100%; height: 600px;"></div>
        </div>
    </InfoModal>
</template>

<script setup>
import { ref } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../../stores/user';
import InfoModal from '../../Modal/InfoModal.vue';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};
</script>