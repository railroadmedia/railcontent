<template>
    <router-link tag="tr" :to="to" :style="{ cursor: 'pointer'}">
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    name: 'LinkableTR',
    inheritAttrs: true,
    props: {
        to: {
            type: Object,
        },
    },
};
</script>
