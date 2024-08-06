<template>
    <div>
        <div v-if="isLoading" class="transition-opacity duration-500" :class="isLoading ? 'opacity-100' : 'opacity-0'">
            <h2 class="tw-text-white">Loading...</h2>
        </div>
        <div v-else class="transition-opacity duration-500" :class="!isLoading ? 'opacity-100' : 'opacity-0'">
            <slot name="page" :pageData="data"></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
//import SkeletonLoader from '@components/SkeletonLoader.vue'; // hypothetical skeleton loader component

const data = ref(null);
const error = ref(null);
const isLoading = ref(true);

const fetchData = async () => {
    try {
        // Simulate a loading state with a timeout
        await new Promise(resolve => setTimeout(resolve, 500));
        
        // Placeholder data to simulate fetched data
        data.value = {
            title: 'Home Page',
            content: 'This is the home page content.'
        };
    } catch (err) {
        error.value = err;
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchData();
});
</script>
