<script setup>
import MembershipTierSelector from './MembershipTierSelector.vue';
import MembershipCard from './MembershipCard.vue';
import LoadingSpinner from '../LoadingSpinner/LoadingSpinner.vue';
import axios from 'axios';
import { ref, onBeforeMount } from 'vue';

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
    hideHeaders: {
        type: Boolean,
        default: false,
    }
});

const buildDescription = (upgradeCost) => {
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

const selectedTier = ref('plus');
const descriptions = ref({ year: '', month: '' });
const isLoading = ref(false);

const handleSelectedTier = (val) => {
    selectedTier.value = val;
};

const handleSelectedInterval = (interval) => {
    isLoading.value = true;
    axios.get(`/ecommerce/subscription/change/${selectedTier.value}/${interval}`)
        .then(() => {
            if (props.currentTier === 'plus' && props.isLifetimeMember) {
                window.shownotification({
                    icon: 'check',
                    text: `Your subscription to songs has been canceled.`
                });
            } else {
                window.shownotification({
                    icon: 'check',
                    text: `Your subscription has been successfully updated to ${selectedTier.value === 'plus' ? 'Musora+' : 'Musora'} (${interval === 'year' ? 'Annually' : 'Monthly'}).`
                });
            }
            setTimeout(() => {
                location.reload();
            }, 3000);
        })
        .catch((error) => {
            let message = "There was an unexpected error, try again later or contact support."
            if (error?.response?.data?.friendlyMessage) {
                message = error.response.data.friendlyMessage;
            }
            window.shownotification({
                icon: 'error',
                text: message
            })
        })
        .finally(() => {
            isLoading.value = false;
        });
};

onBeforeMount(() => {
    if (props.currentTier === 'plus' && props.isLifetimeMember) {
        selectedTier.value = 'basic';
    }
    buildDescription(props.upgradeCost);
});
</script>

<template>
    <div class="tw-w-full tw-h-full">
        <div v-if="isLoading"
            class="tw-absolute tw-flex tw-flex-col xl:tw-flex-row tw-justify-center tw-items-center tw-h-full tw-w-full tw-z-30 tw-bg-black tw-opacity-50">
            <LoadingSpinner classOverride="tw-h-[36px] tw-w-[36px]" />
        </div>
        <div v-if="!isLifetimeMember" class="tw-w-full tw-h-full">
            <div class="tw-table-row sm:tw-block">
                <div class="tw-w-full" v-if="!hideHeaders">
                    <h1 class="tw-mb-[20px] tw-text-[30px] lg:tw-text-[36px]"><strong>Manage Membership</strong>
                    </h1>
                </div>
                <MembershipTierSelector @onTierSelect="handleSelectedTier" :selectedTier="selectedTier" />
                <div
                    class="tw-flex tw-flex-col md:tw-flex-row tw-items-start tw-justify-center tw-max-w-sm md:tw-max-w-2xl lg:tw-max-w-3xl tw-my-5 sm:tw-my-7 tw-mx-auto">
                    <div class="tw-flex tw-flex-col tw-w-full tw-h-full md:tw-w-1/2 tw-px-2 md:tw-px-3 tw-relative">
                        <MembershipCard discount="SAVE 33%" title="Annual"
                            :price="intervalTierPrices[selectedTier].year.title"
                            :priceDescription="intervalTierPrices[selectedTier].year.description"
                            ctaTitle="PAY ANNUALLY" @onCTAClick="() => handleSelectedInterval('year')">
                            <p class="tw-mb-1"><strong>The world’s best music lessons.</strong></p>
                            <p class="tw-mb-1"><strong>Step-by-step curriculums.</strong></p>
                            <p class="tw-mb-1"><strong>Unlimited personal support.</strong></p>
                            <p class="tw-mb-2" v-if="selectedTier === 'plus'"><strong>Thousands of popular
                                    songs.</strong></p>
                            <p class="tw-mb-1">{{ selectedTier === 'plus' ? descriptions.year :
                                DEFAULT_DESCRIPTION
                            }}</p>
                        </MembershipCard>
                    </div>
                    <div
                        class="tw-flex tw-flex-col tw-grow tw-w-full tw-h-full md:tw-w-1/2 tw-px-2 md:tw-px-3 tw-relative">
                        <MembershipCard title="Monthly" :price="intervalTierPrices[selectedTier].month.title"
                            :priceDescription="intervalTierPrices[selectedTier].month.description"
                            ctaTitle="PAY MONTHLY" @onCTAClick="() => handleSelectedInterval('month')">
                            <p class="tw-mb-1"><strong>The world’s best music lessons.</strong></p>
                            <p class="tw-mb-1"><strong>Step-by-step curriculums.</strong></p>
                            <p class="tw-mb-1"><strong>Unlimited personal support.</strong></p>
                            <p class="tw-mb-2" v-if="selectedTier === 'plus'"><strong>Thousands of popular
                                    songs.</strong></p>
                            <p class="tw-mb-1">{{ selectedTier === 'plus' ? descriptions.month :
                                DEFAULT_DESCRIPTION
                            }}</p>
                        </MembershipCard>
                    </div>
                </div>
                <p><em>All prices listed in USD.</em></p>
            </div>
        </div>
        <div v-if="isLifetimeMember && currentTier !== 'plus'" class="tw-w-full tw-h-full">
            <div class="tw-table-row sm:tw-block tw-w-full">
                <div class="tw-w-full" v-if="!hideHeaders">
                    <p class="tw-mb-[10px] tw-text-[14px]">We're sorry, but your membership level does not include
                        songs.
                        Please
                        upgrade your membership to a Musora+ level membership to access our songs library.</p>
                    <h1 class="tw-mb-[20px] tw-text-[30px] lg:tw-text-[36px]"><strong>Manage Membership</strong>
                    </h1>
                    <div class="tw-text-center tw-text-[20px]">
                        Songs Subscription
                    </div>
                </div>
                <div
                    class="tw-flex tw-flex-col md:tw-flex-row tw-items-start tw-justify-center tw-max-w-sm tw-my-5 sm:tw-my-7 tw-mx-auto">
                    <div class="tw-flex tw-flex-col tw-grow tw-h-full tw-px-2 md:tw-px-3 tw-relative">
                        <MembershipCard title="Annual" price="$3.33/month" priceDescription="Billed at $40 per year."
                            ctaTitle="PAY ANNUALLY" @onCTAClick="() => handleSelectedInterval('year')">
                            <p class="tw-mb-1"><strong>This is an annual subscription that adds access to
                                    thousands of professionally transcribed songs to your Lifetime
                                    Membership.</strong></p>
                            <p class="tw-mb-1"><strong>This subscription allows us to officially license
                                    work
                                    from its creators and compensate them for their work</strong></p>
                            <p class="tw-mb-1">You will be immediately charged $40 to your card on file, and
                                your subscription will renew again for $40 in 365 days.</p>
                        </MembershipCard>
                    </div>
                </div>
                <p><em>All prices listed in USD.</em></p>
            </div>
        </div>
        <div v-if="isLifetimeMember && currentTier === 'plus'" class="tw-w-full tw-h-full">
            <div class="tw-table-row sm:tw-block tw-w-full">
                <div class="tw-w-full" v-if="!hideHeaders">
                    <p class="tw-mb-[10px] tw-text-[14px]">Your current Membership includes Songs.</p>
                    <h1 class="tw-mb-[20px] tw-text-[30px] lg:tw-text-[36px]"><strong>Manage Membership</strong>
                    </h1>
                    <div class="tw-text-center tw-text-[20px]">
                        Songs Subscription
                    </div>
                </div>
                <div
                    class="tw-flex tw-flex-col md:tw-flex-row tw-items-start tw-justify-center tw-max-w-sm tw-my-5 sm:tw-my-7 tw-mx-auto">
                    <div class="tw-flex tw-flex-col tw-grow tw-h-full tw-px-2 md:tw-px-3 tw-relative">
                        <MembershipCard title="Annual" price="$3.33/month" priceDescription="Billed at $40 per year."
                            ctaTitle="CANCEL SONGS" @onCTAClick="() => handleSelectedInterval('year')">

                            <p class="tw-mb-1"><strong>Your Songs subscription gives you access to thousands
                                        of
                                        professionally transcribed songs alongside your Lifetime Membership.
                                        Annual
                                        subscription allows us to compensate creators for their work through
                                        official licensing.</strong></p>
                                <p class="tw-mb-1">If you cancel your Songs subscription, it will not continue
                                    to
                                    renew. You will have Musora Songs access until your current subscription
                                    period
                                    ends.</p>
                        </MembershipCard>
                    </div>
                </div>
                <p><em>All prices listed in USD.</em></p>
            </div>
        </div>
    </div>
</template>