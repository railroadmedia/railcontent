<script setup>
import axios from 'axios';
import { ref, onBeforeMount } from 'vue';
import { XIcon } from "@heroicons/vue/solid";
import ModalRenderer from '../Modal/ModalRenderer.vue';
import MembershipTierSelector from './MembershipTierSelector.vue';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    upgradeCost: {
        type: String,
        default: null,
    },
    currentTier: {
        type: String,
        default: 'plus'
    },
    isLifetimeMember: {
        type: Boolean,
        default: false,
    },
});

const buildDescription = (upgradeCost) => {
    console.log(upgradeCost)
    if (upgradeCost && upgradeCost > 0) {
        descriptions.value = {
            month: `By clicking "Pay Monthly", I agree to be billed immediately for a prorated upgrade cost of $${upgradeCost}. I understand that my next renewal will be $30 for Musora+ with Songs.`,
            year: `By clicking "Pay Annually", I agree to be billed immediately for a prorated upgrade cost of $${upgradeCost}. I understand that my next renewal will be $240 for Musora+ with Songs.`
        };
    } else {
        descriptions.value = {
            month: `By clicking "Pay Monthly", I understand that my next renewal will be $30 for Musora+ with Songs.`,
            year: `By clicking "Pay Annually", I understand that my next renewal will be $240 for Musora+ with Songs.`
        };
    }
};

const DEFAULT_DESCRIPTION = 'Musora Songs access is not available with this membership. To add Songs, choose Musora+.';

const intervalTierPrices = {
    basic: {
        year: {
            title: '$16.67/month',
            description: 'Billed at $200 per year.'
        },
        month: {
            title: '$25/month',
            description: 'Pay as you go.',
        }
    },
    plus: {
        year: {
            title: '$20/month',
            description: 'Billed at $240 per year.'
        },
        month: {
            title: '$30/month',
            description: 'Pay as you go.',
        }
    }
};

const emit = defineEmits(['onCloseModal']);

const selectedTier = ref('plus');
const descriptions = ref({ year: '', month: '' });

const handleSelectedTier = (val) => {
    console.log(val)
    selectedTier.value = val;
};

const handleSelectedInterval = (interval) => {
    axios.get(`/ecommerce/subscription/change/${selectedTier.value}/${interval}`)
        .then(() => {
            window.shownotification({
                icon: 'check',
                text: 'Membership changed.'
            })
        })
        .catch(() => {
            window.shownotification({
                icon: 'error',
                text: 'Membership change error.'
            })
        });
};

onBeforeMount(() => {
    console.log(props.currentTier)
    buildDescription(props.upgradeCost);
});

</script>
<template>
    <ModalRenderer>
        <section
            class="tw-relative tw-flex tw-justify-center lg:tw-items-center tw-h-full tw-w-full tw-overflow-auto tw-max-h-[100vh] tw-p-2">
            <div v-if="!isLifetimeMember"
                class="tw-table sm:tw-block tw-my-auto tw-text-center tw-text-white tw-mx-2 tw-px-2 sm:tw-px-6 tw-py-10 sm:tw-py-14 lg:tw-py-20 tw-bg-[#081825] tw-border-[#445F74] tw-rounded-[10px] tw-border-[1px] tw-relative md:tw-static">
                <button @click="emit('onCloseModal')"
                    class="tw-text-white tw-absolute lg:tw-top-[32px] tw-top-[12px] tw-right-[12px]  md:tw-right-[32px] md:tw-top-[32px]">
                    <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
                </button>
                <div class="tw-table-row sm:tw-block">
                    <h1 class="tw-mb-[20px] tw-text-[30px] lg:tw-text-[36px]"><strong>Manage Membership</strong></h1>
                    <MembershipTierSelector @onTierSelect="handleSelectedTier" :selectedTier="selectedTier" />
                    <div
                        class="tw-flex tw-flex-col md:tw-flex-row tw-items-start tw-justify-center tw-max-w-sm md:tw-max-w-2xl lg:tw-max-w-3xl tw-my-5 sm:tw-my-7 tw-mx-auto">
                        <div class="tw-flex tw-flex-col tw-w-full tw-h-full md:tw-w-1/2 tw-px-2 md:tw-px-3 tw-relative">
                            <p class="tw-inline-block tw-absolute -tw-mt-3 tw-px-5 tw-py-1 tw-z-10 tw-text-[12px] tw-text-black tw-rounded-full tw-mx-auto tw-left-0 tw-right-0 tw-w-[100px]"
                                style="background-color:#ffac00;">SAVE 33%</p>
                            <div
                                class="tw-flex tw-flex-col tw-h-full tw-text-black tw-overflow-hidden tw-rounded-2xl tw-mx-auto tw-mb-4 md:tw-mb-0 tw-group">
                                <div class="tw-bg-white tw-px-3 tw-pt-6 md:tw-pt-8 tw-pb-5 md:tw-pb-8">
                                    <h2 class="tw-leading-none tw-mb-3"><strong>Annual</strong></h2>
                                    <h4 class="tw-inline-block tw-leading-none"><strong>{{
        intervalTierPrices[selectedTier].year.title
}}</strong></h4>
                                    <p class="tw-text-sm tw-mb-4"><em>{{
        intervalTierPrices[selectedTier].year.description
}}</em></p>
                                    <button @click="() => handleSelectedInterval('year')"
                                        class="tw-btn-primary tw-bg-[#00101D]">PAY ANNUALLY</button>
                                </div>
                                <div class="tw-grow tw-h-full tw-px-3 tw-pt-5 md:tw-pt-6 tw-pb-9 md:tw-pb-10"
                                    style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                    <p class="tw-mb-1"><strong>The world’s best music lessons.</strong></p>
                                    <p class="tw-mb-1"><strong>Step-by-step curriculums.</strong></p>
                                    <p class="tw-mb-1"><strong>Unlimited personal support.</strong></p>
                                    <p class="tw-mb-2" v-if="selectedTier === 'plus'"><strong>Thousands of popular
                                            songs.</strong></p>
                                    <p class="tw-mb-1">{{ selectedTier === 'plus' ? descriptions.year :
        DEFAULT_DESCRIPTION
}}</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tw-flex tw-flex-col tw-grow tw-w-full tw-h-full md:tw-w-1/2 tw-px-2 md:tw-px-3 tw-relative">
                            <div
                                class="tw-flex tw-flex-col tw-grow tw-text-black tw-overflow-hidden tw-rounded-2xl tw-mx-auto tw-mb-4 md:tw-mb-0 tw-group">
                                <div class="tw-bg-white tw-px-3 tw-pt-6 md:tw-pt-8 tw-pb-5 md:tw-pb-8">
                                    <h2 class="tw-leading-none tw-mb-3"><strong>Monthly</strong></h2>
                                    <h4 class="tw-inline-block tw-leading-none"><strong>{{
        intervalTierPrices[selectedTier].month.title
}}</strong></h4>
                                    <p class="tw-text-sm tw-mb-4"><em>{{
        intervalTierPrices[selectedTier].month.description
}}</em></p>
                                    <button @click="() => handleSelectedInterval('month')"
                                        class="tw-btn-primary tw-bg-[#00101D]">PAY MONTHLY</button>
                                </div>
                                <div class="tw-grow tw-px-3 tw-pt-5 md:tw-pt-6 tw-pb-9 md:tw-pb-10"
                                    style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                    <p class="tw-mb-1"><strong>The world’s best music lessons.</strong></p>
                                    <p class="tw-mb-1"><strong>Step-by-step curriculums.</strong></p>
                                    <p class="tw-mb-1"><strong>Unlimited personal support.</strong></p>
                                    <p class="tw-mb-2" v-if="selectedTier === 'plus'"><strong>Thousands of popular
                                            songs.</strong></p>
                                    <p class="tw-mb-1">{{ selectedTier === 'plus' ? descriptions.month :
        DEFAULT_DESCRIPTION
}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p><em>All prices listed in USD.</em></p>
                </div>
            </div>
            <div v-if="isLifetimeMember"
                class="tw-table sm:tw-block tw-my-auto tw-text-center tw-text-white tw-mx-2 lg:tw-w-[755px] tw-px-2 sm:tw-px-6 tw-py-10 sm:tw-py-14 tw-bg-[#081825] tw-border-[#445F74] tw-rounded-[10px] tw-border-[1px] tw-relative md:tw-static">
                <button @click="emit('onCloseModal')"
                    class="tw-text-white tw-absolute lg:tw-top-[32px] tw-top-[12px] tw-right-[12px]  md:tw-right-[32px] md:tw-top-[32px]">
                    <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
                </button>
                <div class="tw-table-row sm:tw-block tw-w-full">
                    <p class="tw-mb-[10px] tw-text-[14px]">We're sorry, but your membership level does not include songs.
                                Please
                                upgrade your membership to a Musora+ level membership to access our songs library.</p>
                            <h1 class="tw-mb-[20px] tw-text-[30px] lg:tw-text-[36px]"><strong>Manage Membership</strong>
                            </h1>
                            <div class="tw-text-center tw-text-[20px]">
                                Songs Subscription
                            </div>
                    <div
                        class="tw-flex tw-flex-col md:tw-flex-row tw-items-start tw-justify-center tw-max-w-sm tw-my-5 sm:tw-my-7 tw-mx-auto">
                        <div class="tw-flex tw-flex-col tw-grow tw-h-full tw-px-2 md:tw-px-3 tw-relative">
                            <div
                                class="tw-flex tw-flex-col tw-grow tw-text-black tw-overflow-hidden tw-rounded-2xl tw-mx-auto tw-mb-4 md:tw-mb-0 tw-group">
                                <div class="tw-bg-white tw-px-3 tw-pt-6 md:tw-pt-8 tw-pb-5 md:tw-pb-8">
                                    <h2 class="tw-leading-none tw-mb-3"><strong>Annual</strong></h2>
                                    <h4 class="tw-inline-block tw-leading-none"><strong>$3.33/month</strong></h4>
                                    <p class="tw-text-sm tw-mb-4"><em>Billed at $40 per year.</em></p>
                                    <button @click="() => handleSelectedInterval('year')"
                                        class="tw-btn-primary tw-bg-[#00101D]">PAY ANNUALLY</button>
                                </div>
                                <div class="tw-grow tw-px-3 tw-pt-5 md:tw-pt-6 tw-pb-9 md:tw-pb-10"
                                    style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                    <p class="tw-mb-1"><strong>This is an annual subscription that adds access to
                                            thousands of professionally transcribed songs to your Lifetime
                                            Membership.</strong></p>
                                    <p class="tw-mb-1"><strong>This subscription allows us to officially license work
                                            from its creators and compensate them for their work</strong></p>
                                    <p class="tw-mb-1">You will be immediately charged $40 to your card on file, and
                                        your subscription will renew again for $40 in 365 days.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p><em>All prices listed in USD.</em></p>
                </div>
            </div>
        </section>
    </ModalRenderer>>
</template>
