<script setup>
    import { ref, onMounted } from 'vue';
    
    const props = defineProps(['url', 'height'])

    const srcUrl = ref('');

    //Change the url on mount
    onMounted(() => {
        srcUrl.value = props.url;
    });
</script>

<template>
    <iframe :src="srcUrl" 
            :height="props.height" 
            class="tw-w-full" 
            frameborder="0" 
            marginheight="0" 
            marginwidth="0">
            Loading…
    </iframe>
</template>