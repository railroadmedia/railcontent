<script setup>
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';
const props = defineProps({
    classOverride: {
        type: String,
        default: ''
    },
})
</script>

<template>
    <MusoraIcon width="24" height="24" viewBox="0 0 24 24" icon-name="whistle-filled" class="tw-inline-block tw-w-[25px] tw-h-[25px] MusoraSpinner" :class="classOverride" />
</template>

<style scoped>
.MusoraSpinner {
    color: white;
    animation: spin 1s ease-in-out infinite;
    -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
</style>
