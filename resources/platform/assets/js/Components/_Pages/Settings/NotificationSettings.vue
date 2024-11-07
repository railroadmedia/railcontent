<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="tw-mb-[30px]">
            <!-- Header -->
            <Breadcrumb :breadcrumbs="[ { title: 'Settings' }, { title: 'Profile' } ]"/>
            <PageHeader
                page-type="settings"
                :title="userDisplayName"
                :hero-img="userProfilePictureUrl"
                :info-data="[`Musora Member Since ${ userCreatedYear }`]"
                :ctas="[{
                    type: 'PageHeaderPrimaryCta',
                    props: {
                        text: `${showOnboardingBanner ? 'Update Your Account' : 'Complete Your Account'}`,
                        url: `/onboarding?brand=${brand}`,
                        showAllAlways: true,
                    }
                }]"
            />
        </div>

        <!-- Page Pills -->
        <PillNav :pills="accountPages"/>

        <!-- Edit Forms -->
        <div class="tw-flex tw-flex-row">
            <input id="userInfo" type="hidden" :data-user-id="userId">

            <div class="tw-flex tw-flex-col tw-grow tw-w-full">
                <!-- @yield('edit-forms') -->
            </div>
        </div>
    </div>
</template>
<script setup>
    import { computed, ref, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "@stores/user";
    import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
    import PageHeader from '@collections/PageHeader/PageHeader';
    import PillNav from "@collections/PillNav/PillNav.vue";

    //Pinia
    const userStore = useUserStore();
    const {
        brand,
        userId,
        userDisplayName,
        userProfilePictureUrl,
        userCreatedYear,
        showOnboardingBanner
    } = storeToRefs(userStore);

    //Props
    const props = defineProps({

    })

    //Computed

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
            isActive: true,
        },
        {
            name: 'Account Details',
            url: `/${brand.value}/profile/settings/account`,
        }
    ])

    //Lifecycle Hooks
</script>
