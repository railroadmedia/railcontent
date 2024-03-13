<template>
    <PageHeaderCta text="Where to begin" faIconClass="fa-question-circle" data-open-modal="surveyModal" showAllAlways />
    <div id="surveyModal" class="modal">
        <div class="flex flex-column corners-10">
            <div v-if="brand === 'drumeo'" class="typeform-widget"
                data-url="https://form.typeform.com/to/rnPhq70s?typeform-medium=embed-snippet"
                style="width: 100%; height: 600px;"></div>
            <div v-else-if="brand === 'pianote'" class="typeform-widget"
                data-url="https://form.typeform.com/to/huIKxOSj?typeform-medium=embed-snippet"
                style="width: 100%; height: 600px;"></div>
        </div>
    </div>
</template>

<script setup>
import PageHeaderCta from '../PageHeaderCta.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../../stores/user';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>