<template>
    <div class="tw-items-center tw-flex-grow tw-justify-end"
        :class="displayMobileDropdown ? 'tw-hidden sm:tw-flex' : ''">
        <div class="ctas-container tw-flex-shrink-0 tw-flex">
            <CtaResolver :ctas="ctas" />
        </div>
    </div>
    <MobileCtaDropdown v-if="displayMobileDropdown" class="sm:tw-hidden" :ctas="secondaryCtas" />
</template>

<script setup>
import { defineProps, computed } from 'vue';
import CtaResolver from './Ctas/CtaResolver.vue';
import MobileCtaDropdown from './MobileCtaDropdown.vue';
const props = defineProps({
    ctas: {
        type: Array,
        default: () => [],
    },
});

const secondaryCtas = computed(() =>
    props.ctas.filter(cta =>
        cta.type !== 'PageHeaderPrimaryCta' &&
        (cta.type !== 'ResetProgressCta' || cta.props.progress > 0) &&
        (cta.type !== 'DownloadResourcesCta' || cta.props.resources.length > 0)
    )
);

console.log(secondaryCtas.value);

// only display mobile dropdown if there are more than 1 secondary CTAs
const displayMobileDropdown = secondaryCtas.value.length >= 1;
</script>
<style lang="scss" scoped>
.ctas-container {
    ::v-deep>* {
        margin-left: 0.5rem;
    }
}
</style>