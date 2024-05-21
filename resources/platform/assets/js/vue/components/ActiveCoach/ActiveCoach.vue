<template>
    <div class="tw-my-[30px]">
        <div class="tw-text-[#00101D] dark:tw-text-white tw-pb-1">
            <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-3">
                Active Coaches
            </h2>
        </div>

        <!-- Active Coaches -->
        <div class="tw-my-3">
            <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 xl:tw-grid-cols-4 2xl:tw-grid-cols-6 tw-gap-3">
                <a v-for="coach in activeCoaches" :href="coach['url']"
                   class="tw-rounded-3xl tw-overflow-hidden tw-relative tw-flex tw-mb-3">

                    <!-- Coach Image -->
                    <img :src="`https://www.musora.com/musora-cdn/image/width=300,quality=95/${cardImage(coach)}`"
                         class="tw-w-full tw-flex tw-object-top tw-object-cover tw-transition-opacity tw-opacity-0"
                         :alt="`${fullName(coach)} Card`"
                         loading="lazy"
                         onload="this.classList.remove('tw-opacity-0')"
                    >

                    <div class="tw-absolute tw-w-full tw-left-0 tw-bottom-0 tw-text-white tw-flex tw-flex-col tw-text-center tw-uppercase tw-h-3/4"
                         style="background: linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050F 100%);">
                        <!-- Coach Name -->
                        <p class="tw-text-2xl xl:tw-text-3xl tw-font-bebas-neue tw-break-words tw-flex tw-flex-col tw-mt-auto tw-mb-4"
                           style="line-height:1.1 !important; hyphens: auto;">
                            <span class="tw-block">{{ firstName(coach) }}</span>
                            {{ lastName(coach) }}
                        </p>

                        <!-- Coach Title -->
                        <p class="tw-text-sm tw-font-primary tw-text-yellow-400 tw-h-10 tw-mb-10 tw-leading-snug tw-px-3">
                            {{ title(coach) }}
                        </p>

                        <div v-if="coach['is_house_coach']" class="tw-text-white tw-items-center tw-leading-none tw-text-xs tw-font-bebas-neue tw-absolute tw-bottom-0 tw-w-full tw-flex tw-mb-4 tw-justify-center tw-items-center">
                            <musora-icon
                                icon-name="whistle-filled"
                                height="12"
                                class="tw-text-white tw-mr-0.5 tw-w-[16px] tw-leading-none"
                            ></musora-icon>
                            <span class="tw-mt-1">HOUSE</span>
                        </div>
                    </div>

                    <!-- Overlay -->
                    <div
                        class="tw-flex tw-items-center tw-content-center tw-p-6 tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-bottom-0 tw-bg-black tw-opacity-0 tw-transition tw-bg-opacity-60 tw-duration-500 tw-ease-in-out hover:tw-opacity-100">
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    activeCoaches: {
        type: Array,
        default: () => [],
    }
})

const cardImage = (coach) => {
    return `https://www.musora.com/musora-cdn/image/width=300,quality=95/${coach.data.find(c => c.key === 'coach_card_image').value}`
}

const fullName = (coach) => {
    return coach.name;
}

const firstName = (coach) => {
    return coach.name.split(' ')[0];
}

const lastName = (coach) => {
    return coach.name.split(' ').slice(1).join(' ');
}

const title = (coach) =>{
    return coach.data.find(c => c.key === 'focus_text').value;
}
</script>
