<template>
    <div class="tw-mb-[30px]">
        <h1 class="tw-pb-[15px] tw-font-bold tw-text-[20px] tw-leading-[30px] lg:tw-leading-[36px] lg:tw-text-[24px]">Let's Explore</h1>
        <div class="tw-flex tw-flex-col xl:tw-flex-row tw-gap-[10px]">
            <ExploreCard v-for="task in exploreTasks" :key="task.title" :id="task.hook" :title="task.title" :description="task.description">
                <NewMusoraIcon :variant="task.icon" :brand="brand" svgClass="tw-w-[50px] tw-h-[50px] xl:tw-w-[70px] xl:tw-h-[70px]" />
            </ExploreCard>
        </div>
    </div>
</template>

<script setup>
import ExploreCard from '@collections/ExploreCard/ExploreCard.vue';
import NewMusoraIcon from '@collections/NewMusoraIcon/NewMusoraIcon.vue';
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";

const props = defineProps({
    exploreTasks: {
        type: Array,
        required: true
    }
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>