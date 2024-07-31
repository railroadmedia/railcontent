<template>
    <div>
        <div v-show="isLoading" class="transition-opacity duration-500" :class="isLoading ? 'opacity-100' : 'opacity-0'">
            <slot name="loading"></slot>
        </div>
        <div v-show="!isLoading" class="transition-opacity duration-500" :class="!isLoading ? 'opacity-100' : 'opacity-0'">
            <slot name="page" :pageData="data"></slot>
        </div>
    </div>
</template>  
<script setup>
    import { usePageData } from '@hooks/usePageData';
    
    const props = defineProps({
        page: {
            type: String,
            required: true,
        },
        contentId: {
            type: String,
            required: true,    
        }
    });
    
    const { data, error, isLoading, contentId } = usePageData(props);
</script>