<template>
    <div>
        <div v-show="isLoading" class="transition-opacity duration-500" :class="isLoading ? 'opacity-100' : 'opacity-0'">
            <slot name="loading"></slot>
        </div>
        <div v-show="!isLoading && data" class="transition-opacity duration-500" :class="!isLoading && data ? 'opacity-100' : 'opacity-0'">
            <slot name="page" :pageData="data"></slot>
        </div>
    </div>
</template>
<script setup>
import { ref, onBeforeMount } from 'vue';
import { usePageData } from '@hooks/usePageData';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';

const userStore = useUserStore();
const { brand, userId, token } = storeToRefs(userStore);

const props = defineProps({
    page: {
        type: String,
        required: true,
        default: {}
    },
    contentId: Number,
});

// Initialize reactive state
const data = ref(null);
const error = ref(null);
const isLoading = ref(true);

// Use onBeforeMount to handle the async data fetching
onBeforeMount(async () => {
    const { data: fetchedData, error: fetchedError, isLoading: fetchedIsLoading } = await usePageData(props, brand.value, userId.value, token.value);
    data.value = fetchedData.value;
    error.value = fetchedError.value;
    isLoading.value = fetchedIsLoading.value;
});
</script>
