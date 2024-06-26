<template>
    <div class="tw-w-full">
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-[30px]">
            <!-- Header -->
            <Breadcrumb :breadcrumbs="[ { title: 'Settings' }, { title: 'Account' } ]"/>
            <PageHeader
                page-type="settings"
                :title="userDisplayName"
                :hero-img="userProfilePictureUrl"
                :info-data="[`Musora Member Since ${ userCreatedYear }`]"
                :ctas="[{
                    type: 'PageHeaderPrimaryCta',
                    props: {
                        text: `${userCompletedAccount ? 'Update Your Account' : 'Complete Your Account'}`,
                        url: `/onboarding?brand=${brand}`,
                        showAllAlways: true,
                    }
                }]"
            />
        </div>

        <!-- Page Pills -->
        <PillNav :pills="accountPages"/>

        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-8">
            <!-- Page Content -->
            <div class="tw-flex tw-flex-col tw-grow">
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6">
                    <div class="tw-flex tw-flex-col tw-grow">

                        <!-- Membership Access -->
                        <div v-if="userMembershipLevel !== 'none'" class="tw-flex tw-flex-col tw-pt-0 tw-mb-6">
                            <div class="tw-flex tw-flex-row tw-flex-auto dark:tw-text-white tw-text-[#00101D]">
                                <h2 class="tw-font-bold tw-text-xl dark:tw-text-white tw-mb-3">Your Membership Access</h2>
                            </div>
                            <div class="tw-flex tw-flex-row tw-flex-auto dark:tw-text-white tw-text-[#00101D]">
                                <div class="tw-flex tw-flex-col">
                                    <p class="tw-capitalize"><span class="tw-font-bold">{{ userMembershipLevel }}</span> Membership</p>
                                    <template v-if="userMembershipLevel !== 'lifetime' && !isLifetimeMember">
                                        <p v-if="userMembershipLevel === 'plus' || userMembershipLevel === 'basic'">
                                            Valid Until: {{ userMembershipExpirationFormatted }}
                                        </p>
                                    </template>
                                    <p v-else>Never Expires</p>
                                </div>
                            </div>
                        </div>

                        <!-- User Packs -->
                        <div v-if="userPacks.length" class="tw-flex tw-flex-col tw-pt-0">
                            <div class="tw-flex tw-flex-row tw-flex-auto dark:tw-text-white tw-text-[#00101D]">
                                <h2 class="tw-font-bold tw-text-xl dark:tw-text-white">Your Other Products</h2>
                            </div>
                            <div class="tw-flex tw-flex-row tw-flex-auto dark:tw-text-white tw-text-[#00101D]">
                                <div class="tw-flex tw-flex-col">
                                    <ul class="tw-mt-3 tw-space-y-1 tw-list-disc tw-ml-6">
                                        <li v-for="(product, i) in userPacks" :key="i">{{ product }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Recharge iFrame -->
                        <div v-if="showIframe" class="tw-flex tw-flex-col tw-p-4" id="rcPortalContainer">
                            <iframe id="rcPortal"
                                    :src="portalUrl"
                                    width="100%"
                                    height="850px"
                            ></iframe>
                        </div>
                    </div>
                </section>

                <!-- Legacy Media Player -->
                <div class="tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <h3 class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 tw-text-lg tw-font-bold">
                        Would you like to use our legacy video player?
                    </h3>
                    <p class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 lg:tw-max-w-[50%]">
                        Our video player may have compatibility issues with older devices and operating systems. We recommend
                        switching to our legacy video player if you are experiencing playback issues.
                    </p>
                    <form class="tw-flex tw-flex-row tw-mt-3" id="legacy-form" @submit.prevent="submitUserForm">
                        <MuToggle
                            :brand="brand"
                            v-model="formData.use_legacy_video_player"
                            :disabled="formProcessing"
                            id="useLegacyPlayer"
                            input-label="Use legacy video player."
                            name="use_legacy_video_player"
                            @change="submitUserForm"
                        />
                    </form>
                </div>

                <!-- Delete Account UI -->
                <section class="tw-w-full tw-px-0 md:tw-px-6 tw-py-6">
                    <h3 class="tw-text-[#00101D] dark:tw-text-white tw-text-xl tw-font-bold tw-mb-3">
                        Delete Account
                    </h3>
                    <p class="tw-text-[#00101D] dark:tw-text-white tw-mb-4 lg:tw-max-w-[50%]">Delete your account and account data.</p>
                    <MuButton @click="modalOpen = true">Delete Account</MuButton>
                </section>
                <DeleteAccountModal v-if="modalOpen" @onCloseModal="modalOpen = false"/>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useUserStore } from "../../../../stores/user";
import { initRecharge, loginShopifyAppProxy, loginWithShopifyStorefront, getCustomerPortalAccess } from '@rechargeapps/storefront-client';
import Breadcrumb from '../../Breadcrumb/Breadcrumb';
import PageHeader from '../../PageHeader/PageHeader';
import MuToggle from '../../FormInputs/MuToggle.vue';
import PillNav from "../../PillNav/PillNav.vue";
import DeleteAccountModal from "../../Modal/DeleteAccountModal.vue";
import MuButton from "../../Button/MuButton.vue";

const props = defineProps({
    storeIdentifier: String,
    rechargeStorefrontAccessToken: String,
    storefrontAccessToken: String,
    customerAccessToken: String,
    userPacks: {
        type: Array,
        default: []
    }
});

// Pinia
const userStore = useUserStore();
const {
    brand,
    userId,
    userDisplayName,
    userProfilePictureUrl,
    userCreatedYear,
    userCompletedAccount,
    userMembershipLevel,
    isLifetimeMember,
    userMembershipExpirationFormatted,
    useLegacyVideoPlayer,
} = storeToRefs(userStore);

// Refs
const accountPages = ref([
    {
        name: 'Profile',
        url: `/${brand.value}/profile/${userId.value}/settings/profile`,
    },
    {
        name: 'Login Credentials',
        url: `/${brand.value}/profile/${userId.value}/settings/login-credentials`,
    },
    {
        name: 'Payments',
        url: `/${brand.value}/profile/${userId.value}/settings/payments`,
    },
    {
        name: 'Notification Settings',
        url: `/${brand.value}/profile/${userId.value}/settings/notifications`,
    },
    {
        name: 'Account Details',
        url: `/${brand.value}/profile/settings/account`,
        isActive: true,
    }
]);

const showIframe = ref(false);
const formProcessing = ref(false);
const modalOpen = ref(false);
const portalUrl = ref('');
const customerDetails = ref(null);
const formData = ref({
    use_legacy_video_player: useLegacyVideoPlayer.value || false
});

/*
 * Using Recharge CDN Script because the NPM script was not working and could only test in prod.
 * Anyone else is welcome to try but for now this is working fine.
 * -Miguel
 */
const loadRechargeScript = () => {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = "https://static.rechargecdn.com/assets/storefront/recharge-client-1.12.0.min.js";
        script.async = true;
        script.onload = () => resolve();
        script.onerror = () => reject(new Error("Failed to load Recharge script"));
        document.head.appendChild(script);
    });
};

// const initializeRecharge = async () => {
//     try {
//         console.log("Loading Recharge script...");
//         await loadRechargeScript();
//         console.log("Initializing Recharge...");
//         recharge.init({
//             // optional when in a shopify environment
//             storeIdentifier: props.storeIdentifier,
//             // required for API access
//             storefrontAccessToken: props.rechargeStorefrontAccessToken,
//             // retry middleware function if/when Recharge session expires
//             loginRetryFn: () => {
//                 return recharge.auth.loginShopifyApi(
//                     props.storefrontAccessToken,
//                     props.customerAccessToken
//                 )
//                 .then(session => {
//                     return session;
//                 })
//                 .catch(error => {
//                     console.log(error);
//                 })
//             },
//         });
//         recharge.auth.loginShopifyApi(
//             props.storefrontAccessToken,
//             props.customerAccessToken
//         )
//         .then(session => {
//             recharge.customer.getCustomerPortalAccess(session)
//         }).catch(error => {
//             console.log(error);
//         });
//         showIframe.value = true;
//     } catch (error) {
//         console.error("Error initializing Recharge:", error);
//     }
// };

const initializeRecharge = async () => {
    await initRecharge({
        storeIdentifier: props.storeIdentifier,
        storefrontAccessToken: props.rechargeStorefrontAccessToken,
        loginRetryFn: async() => {
            return await loginShopifyAppProxy();
        }
    })

    const session = await loginWithShopifyStorefront(props.storefrontAccessToken, props.customerAccessToken);

    try {
        const portal = await getCustomerPortalAccess(session);
        document.getElementById('rcPortal').src = portal.portal_url.replace('schedule', 'subscriptions');
    } catch {
        document.getElementById('rcPortalContainer').remove();
    }
};

const submitUserForm = async () => {
    formProcessing.value = true;
    try {
        await userStore.updateProfile(formData.value);
        formProcessing.value = false;
        // Notify user of successful update
        window.shownotification({
            icon: 'check',
            text: 'Legacy Player option saved successfully!',
        });
    } catch (error) {
        console.error("Failed to update the legacy video preference:", error.message);
        formProcessing.value = false;
    }
};

onMounted(() => {
    initializeRecharge();
});
</script>
