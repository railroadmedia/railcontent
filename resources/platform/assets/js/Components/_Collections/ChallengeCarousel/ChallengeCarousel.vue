<template>
    <div class="tw-flex tw-flex-nowrap tw-overflow-x-scroll tw-no-scrollbar lg:tw-grid tw-grid-cols-2 tw-gap-[6px] 2xl:tw-gap-[10px]">
        <template v-for="card in preLoadedContent">
            <template v-if="showCard(card)">
                <!-- TODO(challenge): updated content_url to web_url_path -->
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
                <EnrollmentAward v-else-if="!card.is_user_enrolled" :challenge="card" />
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
import EnrollmentAward from '@collections/ChallengeCarousel/EnrollmentAward';
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

const showEnrollmentAward = (card) => {
    return card.type === 'challenge-award' && !card.is_user_enrolled;
}

const showCard = (card) => {
    if(isHomepage.value || isDashboard.value) {
        return true;
    } else {
        return card.show_everywhere;
    }
}
</script>
