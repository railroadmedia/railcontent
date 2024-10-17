<template>
    <div class="tw-items-center tw-flex-grow tw-justify-end"
        :class="primaryCta || (displayMobileDropdown && ctas?.length > 0) ? 'tw-hidden sm:tw-flex' : ''">
        <div class="ctas-container tw-flex-shrink-0 tw-flex">
            <CtaResolver :ctas="ctas" />
        </div>
    </div>
    <PageHeaderDropdown v-if="displayDropdown" class="tw-hidden sm:tw-block" faIconClass="fa fa-ellipsis-h sm:tw-mt-1">
        <template v-slot:content>
            <div class="dropdown-content tw-min-w-[210px]">
                <CtaResolver v-bind="props" :ctas="dropdowns"  inDropdown />
            </div>
        </template>
    </PageHeaderDropdown>
    <MobileCtaDropdown v-if="displayMobileDropdown" class="sm:tw-hidden" :ctas="secondaryCtas" />
</template>

<script setup>
import { computed, onMounted } from 'vue';
import CtaResolver from './Ctas/CtaResolver.vue';
import PageHeaderDropdown from '@collections/PageHeader/PageHeaderDropdown';
import MobileCtaDropdown from './MobileCtaDropdown.vue';
const props = defineProps({
    ctas: {
        type: Array,
        default: () => [],
    },
    dropdowns: {
        type: Array,
        default: () => [],
    },
    primaryCta: {
        type: Boolean,
        default: false,
    },
});

const secondaryCtas = computed(() =>
    props.ctas?.filter(cta =>
        cta.type !== 'PageHeaderPrimaryCta' &&
        (cta.type !== 'ResetProgressCta' || cta.props.progress > 0) &&
        (cta.type !== 'DownloadResourcesCta' || cta.props.resources.length > 0)
    ).concat(props.dropdowns) || []
);


// display dropdown if there are dropdowns in bigger screens than mobile
const displayDropdown = computed(() => props.dropdowns.length > 0 );
// only display mobile dropdown if there are more than 1 secondary CTAs or dropdowns exist
const displayMobileDropdown = secondaryCtas.value.length >= 1;

onMounted(() => {
    console.log('dropdowns', secondaryCtas.value)
})
</script>
<style lang="scss" scoped>
.ctas-container {
    ::v-deep>* {
        margin-left: 0.5rem;
    }
}
</style>
