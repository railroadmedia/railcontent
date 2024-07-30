<template>
    <div v-if="isLoading">
      <!-- Loading state -->
      <slot name="loading" v-if="isLoading"></slot>
    </div>
    <div v-else-if="error">
      <!-- Error state -->
      <p>Error: {{ error.message }}</p>
    </div>
    <div v-else>
      <!-- Pass the fetched data as a prop to the child component -->
      <slot name="page" :pageData="data"></slot>
    </div>
  </template>
  
  <script setup>
    import { usePageData } from '@hooks/usePageData';
    
    const props = defineProps({
        page: {
            type: String,
            required: true,
        },
    });
    
    const { data, error, isLoading } = usePageData(props.page);
  </script>