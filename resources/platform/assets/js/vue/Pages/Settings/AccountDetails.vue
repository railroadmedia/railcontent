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

        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <!-- Page Content -->
            <div class="tw-flex tw-flex-col tw-grow">
                
                <!-- Payment History -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Account Details</h2>
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

    //methods

</script>