<template>
    <PageHeaderDropdown faIconClass="fa fa-ellipsis-h" v-if="hasCtas">
        <template v-slot:content>
            <div class="dropdown-content tw-min-w-[256px]">
                <CtaResolver :ctas="ctas" inDropdown />
            </div>
        </template>
    </PageHeaderDropdown>
</template>

<script setup>
import { computed } from 'vue';
import PageHeaderDropdown from './PageHeaderDropdown.vue';
import CtaResolver from './Ctas/CtaResolver.vue';

const props = defineProps({
    ctas: {
        type: Array,
        default: () => [],
    },
});

const hasCtas = computed(() => props.ctas && props.ctas.length > 0);
</script>

