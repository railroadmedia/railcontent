<template>
    <td>
        <router-link :to="to" :target="target"></router-link>
        <slot></slot>
    </td>
</template>

<script>
export default {
    name: 'LinkableTd',
    inheritAttrs: true,
    props: {
        to: {
            type: Object,
        },
        target: {
            type: String,
            default: () => '_self',
        },
    },
};
</script>
