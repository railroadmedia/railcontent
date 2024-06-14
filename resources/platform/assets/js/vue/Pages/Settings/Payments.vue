<template>
    <div class="tw-w-full">
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-[30px]">
            <!-- Header -->
            <Breadcrumb :breadcrumbs="[ { title: 'Settings' }, { title: 'Payments' } ]"/>
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

        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <!-- Page Content -->
            <div class="tw-flex tw-flex-col tw-grow">
                
                <!-- Payment History -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Payment History</h2>
                        </div>
                        <div class="tw-flex tw-flex-col">
                            <!-- Put Stuff Here -->
                            <template v-if="shopifyOrders.length" >
                                <a v-for="(order, i) in shopifyOrders"
                                    :key="i"
                                    :href="order.statusUrl"
                                    class="tw-flex tw-flex-wrap tw-mb-2 tw-text-[#00101D] dark:tw-text-white tw-no-underline"
                                    target="_blank"
                                >
                                    <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/3">
                                        <div class="tw-flex">
                                            <p class="tw-text-sm tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                                                <i class="fal fa-file-pdf mr-1"></i>
                                                {{ formatDate(order.processedAt) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-flex-col tw-w-full md:tw-w-2/3">
                                        <div class="tw-flex">
                                            <div class="tw-flex tw-flex-column tw-text-xs tw-italic tw-uppercase tw-w-1/2 tw-text-[#00101D] dark:tw-text-white">
                                                {{ order.itemsProductTitlesString }}
                                            </div>
                                            <div class="tw-flex tw-flex-column tw-text-xs tw-italic tw-uppercase tw-w-1/4 tw-justify-end tw-text-[#00101D] dark:tw-text-white">
                                                ${{ formatPrice(order.totalPrice) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </template>
                            <p v-else class="tw-text-[#00101D] dark:tw-text-white">
                                You do not have any payments in your payment history.
                            </p>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../stores/user";
    import Breadcrumb from '../../components/Breadcrumb/Breadcrumb';
    import PageHeader from '../../components/PageHeader/PageHeader';
    import PillNav from "../../components/PillNav/PillNav.vue";

    const props = defineProps({        
        shopifyOrders: Array,
    });


    //Pinia
    const userStore = useUserStore();
    const { 
        brand, 
        userId, 
        userDisplayName, 
        userProfilePictureUrl, 
        userCreatedYear, 
        userCompletedAccount 
    } = storeToRefs(userStore);   

    //Refs
    const accountPages = ref([
        {
            name: 'Profile',
            url: `/${brand.value}/profile/${userId.value}/settings/profile`,
        }, 
        {
            name: 'Login Credentials',
            url: `/${brand.value}/profile/${userId.value}/settings/login-credentials`,
            isActive: true,
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
        }
    ]);

    onBeforeMount(()=> {
        console.log(props.shopifyOrders)
    })

    //methods
    const formatDate = (dateString) => {
      const date = new Date(dateString);
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return date.toLocaleDateString('en-US', options);
    }

    const formatPrice = (value) => {
      return value.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }

</script>