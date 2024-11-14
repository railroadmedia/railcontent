<template>
    <div class="tw-flex tw-flex-nowrap tw-overflow-x-scroll tw-no-scrollbar lg:tw-grid tw-grid-cols-2 tw-gap-[6px] 2xl:tw-gap-[10px]">
        <template v-for="challenge in preLoadedContent">
            <EnrollCard v-if="!challenge.is_user_enrolled" :challenge="challenge" />
            <InProgressCard v-else :challenge="challenge" @on-remove-challenge="id => emit('removeChallenge', id)" />
        </template>
    </div>
</template>
<script setup>
import { useUserStore } from '@stores/user';
import { storeToRefs } from "pinia/dist/pinia";
import InProgressCard from '@collections/ChallengeCarousel/InProgressCard';
import EnrollCard from '@collections/ChallengeCarousel/EnrollCard';

const props = defineProps({
    preLoadedContent: {
        type: Array,
        default: () => [],
    },
})

const emit = defineEmits(['removeChallenge'])

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>
