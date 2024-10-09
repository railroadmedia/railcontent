<template>
    <div class="tw-flex tw-flex-nowrap tw-overflow-x-scroll tw-no-scrollbar lg:tw-grid tw-grid-cols-2 tw-gap-[6px] 2xl:tw-gap-[10px]">
        <EnrollCard />
<!--        <EnrollCard />-->
        <InProgressCard />
<!--        <InProgressCard />-->
<!--        <InProgressCard />-->
<!--                <InProgressCard />-->
    </div>
</template>
<script setup>
import { useUserStore } from '@stores/user';
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import { storeToRefs } from "pinia/dist/pinia";
import InProgressCard from '@collections/ChallengeCarousel/InProgressCard';
import EnrollCard from '@collections/ChallengeCarousel/EnrollCard';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>
