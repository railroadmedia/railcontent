<template>
  <div
    class="tw-grid tw-gap-3 tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 2xl:tw-grid-cols-7 3xl:tw-grid-cols-8 tw-mb-4"
  >
   <SkeletonCoachCard v-if="isLoading" v-for="i in 8" :key="`Skeleton-${i}`" />

    <!-- Loop through Cards -->
    <CoachCard
      v-else
      v-for="(item, i) in content"
      :key="i"
      :item="item"
      :brand="brand"
      :content-type="item.type"
      @onShowNotification="onShowNotificationMessage"
    />
  </div>
</template>
<script setup>
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import CoachCard from "./_CoachCard.vue";
import SkeletonCoachCard from '@collections/SkeletonLoader/SkeletonCoachCard';

const props = defineProps({
    content: {
        type: Array,
        default: () => [],
    },
    brand: {
        type: String,
        default: () => "drumeo",
    },
})

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const onShowNotificationMessage = ({ icon, text, error }) => {
    if (error) {
        window.shownotification({
            isError: true
        })
    } else {
        window.shownotification({
            icon,
            text
        });
    }
}
</script>
