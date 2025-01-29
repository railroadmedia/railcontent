<template>
    <div class="tw-flex tw-flex-nowrap tw-overflow-x-scroll tw-no-scrollbar challengeCarousel-container -tw-mr-[6px] 2xl:-tw-mr-[10px]" :class="`${sectionTitle}`" @touchend="emit('handleScrollEnd')">
        <SkeletonChallengeCarousel v-if="isLoading" v-for="n in 2" :key="n" />
        <template v-else v-for="card in preLoadedContent">
            <div v-if="card.type === 'fill'" class="tw-w-[330px] lg:tw-w-1/2 tw-shrink-0"></div>
            <NewLearningPathCard
                v-else-if="card.type === 'onboarding'"
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
                @activate-auto-scroll="emit('activateAutoScroll')"
                @stop-auto-scroll="emit('stopAutoScroll')"
            />
            <EnrollmentAward v-else-if="!card.is_user_enrolled" :challenge="card" @on-remove-challenge="id => emit('removeChallenge', id)" @activate-auto-scroll="emit('activateAutoScroll')" @stop-auto-scroll="emit('stopAutoScroll')" />
            <InProgressCard v-else :challenge="card" :page-type="pageType" @on-remove-challenge="id => emit('removeChallenge', id)" @on-re-fetch-carousel="data => emit('reFetchCarousel', data)" @activate-auto-scroll="emit('activateAutoScroll')" @stop-auto-scroll="emit('stopAutoScroll')" />
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
    sectionTitle: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['removeChallenge', 'reFetchCarousel', 'activateAutoScroll', 'stopAutoScroll', 'handleScrollEnd']);

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const showEnrollmentAward = (card) => {
    return card.type === 'challenge-award' && !card.is_user_enrolled;
}
</script>
