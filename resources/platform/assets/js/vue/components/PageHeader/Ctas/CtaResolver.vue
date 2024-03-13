<template>
    <component v-for="(cta, index) in ctas" :key="index" :is="resolveComponent(cta.type)" v-bind="cta.props" />
</template>

<script setup>
import SongRequest from '../../Songs/SongRequest.vue';
import ResetProgressCta from './ResetProgressCta.vue';
import DownloadResourcesCta from './DownloadResourcesCta.vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import TimezoneSelectCta from './TimezoneSelectCta.vue'
import PreviewLessonCta from './PreviewLessonCta.vue';
import WhereToBeginCta from './WhereToBeginCta.vue';

const componentMap = {
    SongRequest,
    ResetProgressCta,
    DownloadResourcesCta,
    PageHeaderCta,
    TimezoneSelectCta,
    PreviewLessonCta,
    WhereToBeginCta,
};

const resolveComponent = (type) => componentMap[type];

const props = defineProps({
    ctas: {
        type: Array,
        default: () => [],
    },
});
</script>