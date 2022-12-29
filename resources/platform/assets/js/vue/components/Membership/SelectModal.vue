<script setup>
import { ref } from 'vue';
import ModalRenderer from '../Modal/ModalRenderer.vue';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    }
});

const emit = defineEmits(['onCloseModal']);

const selectedTier = ref('plus');
const selectedInterval = ref('year');

const handleSelectedTier = (val) => {
    selectedTier.value = val;
};

const handleSelectedInterval = (val) => {
    selectedInterval.value = val;
};

</script>
<template>
    <ModalRenderer>
        <section class="tw-text-center tw-text-white tw-px-5 sm:tw-px-6 tw-py-10 sm:tw-py-14 lg:tw-py-20" style="background-color:#0c1524;">
            <div class="tw-container tw-mx-auto">
                <h1 class="tw-mb-[20px]"><strong>Manage membership</strong></h1>
                <div class="tw-flex tw-items-end tw-justify-center">
                    <button @click="() => handleSelectedTier('plus')" class="tw-px-2 tw-relative">
                        <strong class="tw-inline-block tw-w-[115px] tw-absolute tw-mx-auto tw-right-0 tw-left-0 tw-whitespace-nowrap -tw-mt-[10px] tw-px-3 tw-py-0.5 tw-z-10 tw-leading-tight tw-text-black tw-text-xs tw-rounded-full"
                            style="background-color:#00c9ac;">MOST POPULAR</strong>
                        <div class="tw-relative tw-flex tw-items-end tw-rounded-xl tw-border-2 tw-border-white tw-px-3 tw-py-2 tw-w-[198px] tw-h-[60px]"
                            style="background-color:#273040;">
                            <div class="tw-text-left">
                                <div class="tw-flex tw-flex-row">
                                    <img class="tw-w-[79px]" src="https://dmmior4id2ysr.cloudfront.net/logos/musora-logo-white.png">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.79437 4.19242V0.484863H4.37239V4.19242H0.601807V8.55161H4.37239V12.2594H8.79437V8.55161H12.565V4.19242H8.79437Z" fill="white"/>
                                    </svg>
                                </div>
                                <p class="tw-opacity-60 tw-text-[10px]"><em>Lessons, songs & support</em></p>
                            </div>
                            <div class="tw-flex tw-h-full tw-absolute tw-right-0 tw-items-center tw-justify-end -tw-mb-2 tw-mr-2">
                                <i class="fas fa-check-circle tw-text-white tw-text-2xl"></i>
                            </div>
                        </div>
                    </button>
                    <button @click="() => handleSelectedTier('basic')" class="tw-px-2 tw-relative">
                        <div class="tw-flex tw-items-end tw-rounded-xl tw-px-3 tw-py-2 tw-w-[198px] tw-h-[60px]" style="background-color:#273040;">
                            <div class="tw-text-left">
                                <img class="tw-w-[79px]" src="https://dmmior4id2ysr.cloudfront.net/logos/musora-logo-white.png">
                                <p class="tw-opacity-60 tw-text-[10px]"><em>Lessons only.</em></p>
                            </div>
                            <div class="tw-flex tw-h-full tw-absolute tw-right-0 tw-items-center tw-justify-end -tw-mb-2 tw-mr-2">
                                <i class="far fa-circle tw-text-2xl tw-ml-1 sm:tw-ml-10"></i>
                            </div>
                        </div>
                    </button>

                </div>

                <div
                    class="tw-flex tw-flex-wrap tw-items-end tw-justify-center tw-2-full tw-max-w-sm md:tw-max-w-2xl lg:tw-max-w-3xl tw-my-5 sm:tw-my-7 tw-mx-auto">
                    <div class="tw-w-full md:tw-w-1/2 tw-px-2 md:tw-px-3 tw-relative">
                        <p class="tw-inline-block tw-relative -tw-bottom-1 tw-mb-1 tw-px-5 tw-py-1 tw-z-10 tw-leading-tight tw-text-black tw-text-sm tw-rounded-full"
                            style="background-color:#ffac00;">SAVE 33%</p>
                        <a href="todo" class="tw-text-black tw-overflow-hidden tw-rounded-2xl tw-block tw-mx-auto tw-mb-4 md:tw-mb-0 tw-group">
                            <div class="tw-bg-white tw-px-3 tw-pt-6 md:tw-pt-8 tw-pb-5 md:tw-pb-8">
                                <h2 class="tw-leading-none tw-mb-3"><strong>Annual</strong></h2>
                                <h4 class="tw-inline-block tw-leading-none"><strong>$TODO ADD PRICE/month</strong></h4>
                                <p class="tw-text-sm tw-mb-4"><em>Billed at $TODO ADD PRICE per year.</em></p>
                                <div class="join blue smaller tw-w-full tw-transition-opacity tw-duration-300 group-hover:tw-opacity-80"
                                    style="max-width: 230px;">Free for 7 days</div>
                            </div>
                            <div class="tw-px-3 tw-pt-5 md:tw-pt-6 tw-pb-9 md:tw-pb-10"
                                style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                <p class="tw-mb-1"><strong>The world’s best drum lessons.</strong></p>
                                <p class="tw-mb-1"><strong>5000+ popular songs.</strong></p>
                                <p class="tw-mb-1"><strong>Unlimited personal support</strong></p>
                                <p class="tw-mb-1">Join a community of STUDENT_NUMBER drum students.</p>
                                <p class="tw-mb-1">Lesson access for piano, guitar, and singing.</p>
                                <p>90-day money back guarantee.</p>
                            </div>
                        </a>
                    </div>
                    <div class="tw-w-full md:tw-w-1/2 tw-px-2 md:tw-px-3 tw-relative">
                        <a href="todo" class="tw-text-black tw-overflow-hidden tw-rounded-2xl tw-block tw-mx-auto tw-mb-4 md:tw-mb-0 tw-group">
                            <div class="tw-bg-white tw-px-3 tw-pt-6 md:tw-pt-8 tw-pb-5 md:tw-pb-8">
                                <h2 class="tw-leading-none tw-mb-3"><strong>Monthly</strong></h2>
                                <h4 class="tw-inline-block tw-leading-none"><strong>$TODO ADD PRICE/month</strong></h4>
                                <p class="tw-text-sm tw-mb-4"><em>Pay as you go.</em></p>
                                <div class="join blue smaller tw-w-full tw-transition-opacity tw-duration-300 group-hover:tw-opacity-80"
                                    style="max-width: 230px;">Free for 7 days</div>
                            </div>
                            <div class="tw-px-3 tw-pt-5 md:tw-pt-6 tw-pb-9 md:tw-pb-10"
                                style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                <p class="tw-mb-1"><strong>The world’s best drum lessons.</strong></p>
                                <p class="tw-mb-1"><strong>5000+ popular songs.</strong></p>
                                <p class="tw-mb-1"><strong>Unlimited personal support</strong></p>
                                <p class="tw-mb-1">Join a community of STUDENT_NUMBER drum students.</p>
                                <p class="tw-mb-1">Lesson access for piano, guitar, and singing.</p>
                                <p>90-day money back guarantee.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <p><em>All prices listed in USD.</em></p>
            </div>
        </section>
    </ModalRenderer>>
</template>
