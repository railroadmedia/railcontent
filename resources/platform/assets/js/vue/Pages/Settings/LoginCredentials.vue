<template>
    <div class="tw-w-full">
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-[30px]">
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
                <input id="userInfo" type="hidden" :data-user-id="userId">
                
                <!-- LOGIN -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Login Email</h2>
                            <button class="tw-ml-auto tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" 
                                    @click="handleShowEmailModal"
                            >
                                <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                            </button>
                        </div>
                        <div class="tw-flex tw-flex-col">
                            <div class="tw-flex tw-flex-row tw-flex-auto tw-mb-2 tw-w-full tw-text-[#00101D] dark:tw-text-white">
                                <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Current Email</h6>
                                <p class="">{{ userEmail }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Display Name Modal -->
                    <EditEmailModal v-if="showEmailModal" @onCloseModal="handleShowEmailModal" />
                </section>

                <!-- PASSWORD -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Login Email</h2>
                            <button class="tw-ml-auto tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" 
                                @click="handleShowPasswordModal"
                            >
                                <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                            </button>
                        </div>
                        <div class="tw-flex tw-flex-col">
                            <div class="tw-flex tw-flex-row tw-flex-auto tw-mb-2 tw-w-full tw-text-[#00101D] dark:tw-text-white">
                                <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Current Password</h6>
                                <p class="">********</p>
                            </div>
                        </div>
                    </div>
                    <!-- Display Name Modal -->
                    <EditPasswordModal v-if="showPasswordModal" @onCloseModal="handleShowPasswordModal" />
                </section>

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
    import EditEmailModal from "../../components/Modal/EditEmailModal.vue";
    import EditPasswordModal from "../../components/Modal/EditPasswordModal.vue";

    //Pinia
    const userStore = useUserStore();
    const { 
        brand, 
        userId, 
        userEmail,
        userDisplayName, 
        userProfilePictureUrl, 
        userCreatedYear, 
        userCompletedAccount 
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

    const showEmailModal = ref(false);
    const showPasswordModal = ref(false);
    
    //Methods
    const handleShowEmailModal = () => {
        showEmailModal.value = !showEmailModal.value;
    };
    const handleShowPasswordModal = () => {
        showPasswordModal.value = !showPasswordModal.value;
    };

    const formData = ref({
        display_name: ''
    });

    //Methods
    const submitDisplayNameForm = () => {
        axios.post(`/user-management-system/user/update/${ userId.value }`, formData.value).then((e) => {
            if (window.shownotification) {
                window.shownotification({
                    icon: 'check',
                    text: 'Success! Your song request has been submitted.'
                });
            }
            handleClose()
        });  
    }; 
</script>