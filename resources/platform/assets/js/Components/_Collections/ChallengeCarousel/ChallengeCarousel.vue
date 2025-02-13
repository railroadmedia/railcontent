<template>
    <div class="tw-flex tw-flex-nowrap tw-overflow-x-scroll tw-no-scrollbar lg:tw-grid tw-grid-cols-2 tw-gap-[6px] 2xl:tw-gap-[10px]">
        <SkeletonChallengeCarousel v-if="isLoading" v-for="n in 2" :key="n" />
        <template v-else v-for="card in preLoadedContent">
            <NewLearningPathCard
                v-if="card.type === 'onboarding'"
                :key="card.id"
                :contentType="card.content_type ?? ''"
                :title="card.header"
                :description="card.subheader"
                :logo="card.logo"
                :ctaText="card.ctaText"
                :ctaUrl="card.button?.web_url_path"
                :bgImg="card.bgImg"
                :wideImg="card.wideImg"
                :squareImg="card.squareImg"
                :is-draft="card.is_draft"
            />
            <EnrollmentAward v-else-if="card.type === 'custom' || !card.is_user_enrolled" :challenge="card" @on-remove-challenge="id => emit('removeChallenge', id)" />
            <InProgressCard v-else :challenge="card" :page-type="pageType" @on-remove-challenge="id => emit('removeChallenge', id)" @on-re-fetch-carousel="data => emit('reFetchCarousel', data)" />
        </template>
    </div>
</template>
<script setup>
import { useUserStore } from '@stores/user';
import { storeToRefs } from "pinia/dist/pinia";
import InProgressCard from '@collections/ChallengeCarousel/InProgressCard';
import EnrollmentAward from '@collections/ChallengeCarousel/EnrollmentAward';
import NewLearningPathCard from '@collections/NewLearningPaths/NewLearningPathCard';
import SkeletonChallengeCarousel from '@collections/SkeletonLoader/SkeletonChallengeCarousel';
import {usePlatformStore} from "@stores/platform";

const props = defineProps({
    preLoadedContent: {
        type: Array,
        default: () => [],
    },
    pageType: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['removeChallenge', 'reFetchCarousel']);

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const showEnrollmentAward = (card) => {
    return card.type === 'challenge-award' && !card.is_user_enrolled;
}
</script>
