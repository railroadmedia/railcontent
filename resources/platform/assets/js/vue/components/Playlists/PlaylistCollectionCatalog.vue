<script setup>
    import { onBeforeMount } from 'vue';

    //Props
    const props = defineProps({
        playlists: {
            type: Array,
            default: []
        },
    })

    onBeforeMount(() => {
        fetch('/railcontent/playlists')
            .then((res) => res.json() )
            .then((json) => console.log(json) )
    })
</script>
<template>
    
</template>