<template>
    <a
        :href="item.url"
        class="tw-relative tw-flex tw-bg-cover tw-bg-top tw-bg-gray-200 tw-overflow-hidden tw-rounded-lg lg:tw-rounded-xl tw-no-underline tw-text-white tw-group"
    >
        <img :src="`https://www.musora.com/musora-cdn/image/width=300,quality=95/${coachImage}`"
             :alt="coachName"
             class="tw-w-full tw-transition-opacity tw-duration-500"
             :class="[
            item.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0',
            item.type === 'song' ? 'tw-blur-sm' : ''
         ]"
             loading="lazy"
             :onload="item.imageLoaded = true"
        />
        <!-- Coach Details -->
        <div
            class="tw-flex tw-flex-col tw-mt-auto tw-w-full tw-items-center tw-justify-center tw-h-3/4 tw-px-2 tw-text-center tw-absolute tw-bottom-0 tw-left-0"
            style="background: linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050F 100%);"
        >
            <h3
                class="tw-uppercase tw-font-bebas-neue tw-text-white tw-text-2xl xl:tw-text-3xl xl:tw-leading-none tw-break-all tw-leading-tight md:tw-leading-none tw-mt-auto tw-mb-2 tw-text-center"
            >
        <span>{{ coachFirstName }}</span
        ><br />
                <span v-if="hasLastName">{{ coachLastName }}</span>
            </h3>
            <p class="tw-text-yellow-400 tw-text-xs tw-h-8 tw-leading-snug tw-mb-4 tw-uppercase">{{ coachFocus }}</p>
            <div v-if="item.is_house_coach" class="tw-text-white tw-items-center tw-leading-none tw-text-xs tw-font-bebas-neue tw-absolute tw-bottom-0 tw-w-full tw-flex tw-mb-2 tw-justify-center">
                <musora-icon
                    icon-name="whistle-filled"
                    height="12"
                    class="tw-text-white tw-mr-0.5 tw-w-[16px] tw-leading-none"
                ></musora-icon>
                <span class="tw-mt-1">HOUSE</span>
            </div>
        </div>

        <!-- Subscribe To Coach -->
        <button
            class="tw-btn-primary tw-btn-small tw-h-6 tw-w-6 tw-p-0 tw-absolute tw-right-1 tw-top-1 tw-transitoin-all group-hover:tw-rotate-[15deg] tw-origin-center"
            :title="isSubscribed ? 'Unsubscribe From Coach' : 'Subscribe to Coach'"
            :class="
                isSubscribed
                  ? 'tw-bg-yellow-500'
                  : 'tw-bg-[#00101d] tw-opacity-40'
            "
            @click.prevent="updateCoachSubscription(item.id)"
        >
            <i class="fas fa-bell tw-text-base"></i>
        </button>

    </a>
</template>
<script setup>
import { computed, ref } from "vue";
import coachService from '@services/coachService';

const props = defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
})

const isSubscribed = ref(props.item.current_user_is_subscribed);

const coachName = computed(() => {
    return props.item['fields']?.find((data) => data.key === 'name')?.value;
})

const coachFirstName = computed(() => {
    return coachName.value.split(' ')[0];
})

const hasLastName = computed(() => {
    return coachName.value.split(' ').length > 1;
})

const coachLastName = computed(() => {
    return coachName.value.substr(coachName.value.indexOf(" ") + 1);
})

const coachFocus = computed(() => {
    return props.item['data']?.find((data) => data.key === 'focus_text')?.value;
})

const coachImage = computed(() => {
    return props.item['data']?.find((data) => data.key === 'coach_card_image')?.value;
})

const updateCoachSubscription = (coachId) => {
    if (!isSubscribed.value) {
        isSubscribed.value = true;
        coachService.followCoach(coachId, isSubscribed, coachFirstName.value);
    } else {
        isSubscribed.value = false;
        coachService.unfollowCoach(coachId, isSubscribed, coachFirstName.value);
    }
}
</script>

