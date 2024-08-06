<template>
    <div>
        <div v-if="isLoading" class="transition-opacity duration-500" :class="isLoading ? 'opacity-100' : 'opacity-0'">
            
            <!-- Skeleton Loader -->
            <div class="lg:tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8 tw-animate-pulse">
                <!-- Banner -->
                <div class="tw-block tw-w-full tw-h-[370px] tw-border-box tw-rounded-[10px] tw-relative tw-mt-[16px] tw-mb-[30px] tw-bg-ui-skeleton"></div>
            </div>
            
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
