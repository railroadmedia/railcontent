<template>
    <div class="tw-flex tw-flex-nowrap tw-overflow-x-scroll tw-no-scrollbar lg:tw-grid tw-grid-cols-2 tw-gap-[6px] 2xl:tw-gap-[10px]">
        <EnrollCard />
        <template v-for="card in preLoadedContent">
            <template v-if="showCard(card)">
                <NewLearningPathCard
                    v-if="card.type === 'onboarding'"
                    :key="card.id"
                    :contentType="card.content_type ?? ''"
                    :title="card.header"
                    :description="card.subheader"
                    :logo="card.logo"
                    :ctaText="card.ctaText"
                    :ctaUrl="card.button?.content_url"
                    :bgImg="card.bgImg"
                    :wideImg="card.wideImg"
                    :squareImg="card.squareImg"
                />
                <EnrollCard v-else-if="!card.is_user_enrolled" :challenge="card" />
                <InProgressCard v-else :challenge="card" @on-remove-challenge="id => emit('removeChallenge', id)" />
            </template>
        </template>
    </div>
</template>
<script setup>
import { computed } from "vue";
import { useUserStore } from '@stores/user';
import { storeToRefs } from "pinia/dist/pinia";
import InProgressCard from '@collections/ChallengeCarousel/InProgressCard';
import EnrollCard from '@collections/ChallengeCarousel/EnrollCard';
import NewLearningPathCard from '@collections/NewLearningPaths/NewLearningPathCard';

const props = defineProps({
    preLoadedContent: {
        type: Array,
        default: () => [],
    },
    type: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['removeChallenge']);

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const isHomepage = computed(() => {
    return props.type === 'home';
})

const isDashboard = computed(() => {
    return props.type === 'dashboard';
})

const showCard = (card) => {
    if(isHomepage.value || isDashboard.value) {
        return true;
    } else {
        return card.show_everywhere;
    }
}
</script>
