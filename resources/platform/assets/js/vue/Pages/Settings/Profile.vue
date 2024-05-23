<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <!-- Header -->
        <Breadcrumb :breadcrumbs="[ { title: 'Settings' }, { title: 'Profile' }]"/>
        <PageHeader 
            page-type="dashboard"
            :title="userDisplayName"
            :hero-img="userProfilePictureUrl"
            :hero-image-class="profilePicStyles"
            :info-data="[`Musora Member Since ${ userCreatedYear }`]"

        />
        
        <!-- Page Content -->
        <div class="tw-flex tw-flex-col tw-grow tw-pt-[30px]">
            
            <!-- Page Pills -->
            <PillNav :pills="accountPages"/>
            
            <!-- Edit Forms -->
            <div class="tw-flex tw-flex-row">
                <input id="userInfo" type="hidden" data-user-id="{{ auth()->id() }}">
                
                <div class="tw-flex tw-flex-col tw-grow tw-w-full">
                    <!-- @yield('edit-forms') -->
                </div>
            </div>

        </div>
    </div>
</template>
<script setup>
    import { computed, ref, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../stores/user";
    import Breadcrumb from '../../components/Breadcrumb/Breadcrumb';
    import PageHeader from '../../components/PageHeader/PageHeader';
    import PillNav from "../../components/PillNav/PillNav.vue";

    //Pinia
    const userStore = useUserStore();
    const { brand, userId, userDisplayName, userProfilePictureUrl, userCreatedYear } = storeToRefs(userStore);   

    //Props
    const props = defineProps({

    })

    //Computed

    //Refs
    const accountPages = ref([
        {
            name: 'Profile',
            url: `/${brand}/profile/${userId}/settings/profile`,
            isActive: true,
        }, 
        {
            name: 'Login Credentials',
            url: `/${brand}/profile/${userId}/settings//login-credentials`,
        },
        {
            name: 'Payments',
            url: `/${brand}/profile/${userId}/settings/payments`,
        },
        {
            name: 'Notification Settings',
            url: `/${brand}/profile/${userId}/settings/notifications`,
        },
        {
            name: 'Account Details',
            url: `/${brand}/profile/settings/account`,
        }
    ])

    //Lifecycle Hooks
    onBeforeMount( ()=> {
        console.log('component loaded: Profile')
    })  
</script>