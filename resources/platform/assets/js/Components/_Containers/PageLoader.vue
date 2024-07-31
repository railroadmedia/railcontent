<template>
    <div>
      <div v-if="isLoading" class="transition-opacity duration-500" :class="isLoading ? 'opacity-100' : 'opacity-0'">
        <slot name="loading"></slot>
      </div>
      <div v-else-if="!isLoading && data" class="transition-opacity duration-500" :class="!isLoading && data ? 'opacity-100' : 'opacity-0'">
        <slot name="page" :pageData="data"></slot>
      </div>
    </div>
</template>
<script setup>
    import { ref, onMounted } from 'vue';
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
        contentId: {
            type: String,
            required: false,
        },
    });

    const { data, error, isLoading } = usePageData(props, brand.value, userId.value, token.value);
</script>
