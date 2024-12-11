<template>
    <div>
        <PageHeaderCta
            v-bind="$attrs"
            url=""
            :text="text"
            showAllAlways
            @click="handleOpen"
        />
        <ChallengeLockedModal v-if="modalOpen" :is-from-lesson="false" :date="unlockDate" @close-modal="handleClose" />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { getDateFromIso } from '../../../../utils';
import PageHeaderCta from '@collections/PageHeader/PageHeaderCta';
import ChallengeLockedModal from '@collections/Modal/ChallengeLockedModal';

const props = defineProps({
    text: String,
    lessonData: {
        type: Object,
        default: () => {},
    },
});

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};

const unlockDate = computed(() => {
    return getDateFromIso(props.lessonData.next_lesson.unlock_date);
})
</script>
