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
                        
                        <!-- 
                            @if($membershipLevel !== 'none')
                                <div class="tw-flex tw-flex-col body tw-pt-0 pa-3">
                                    <div
                                        class="tw-flex tw-flex-row tw-flex-auto tw-py-2 dark:tw-text-white tw-text-[#00101D]">
                                        <h2 class="tw-font-bold tw-text-lg dark:tw-text-white">Your Membership Access</h2>
                                    </div>

                                    <div
                                        class="tw-flex tw-flex-row tw-flex-auto dark:tw-text-white tw-text-[#00101D]">
                                        <div class="tw-flex tw-flex-col">
                                            <p>{{ ucwords($membershipLevel) }} Membership</p>
                                            @if( $membershipLevel == 'plus' || $membershipLevel == 'basic')
                                                <p>Valid Until: {{ $membershipExpirationDate->format('F j, Y') }}</p>
                                            @elseif($membershipLevel == 'lifetime' && $isLifetimeMember == true)
                                                <p>Never Expires</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            @endif

                            @if(!empty($allPackPermissionNames))
                                <div class="tw-flex tw-flex-col body tw-pt-0 pa-3">
                                    <div
                                        class="tw-flex tw-flex-row tw-flex-auto tw-py-2 dark:tw-text-white tw-text-[#00101D]">
                                        <h2 class="tw-font-bold tw-text-lg dark:tw-text-white">Your Other Products</h2>
                                    </div>

                                    <div
                                        class="tw-flex tw-flex-row tw-flex-auto dark:tw-text-white tw-text-[#00101D]">
                                        <div class="tw-flex tw-flex-col">
                                            <ul class="tw-mt-3 tw-space-y-1 tw-list-disc tw-ml-6">
                                                @foreach($allPackPermissionNames as $product)
                                                    <li>{{ $product }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            @endif

                            <div class="tw-flex tw-flex-col pa-3" id="rcPortalContainer">
                                <iframe id="rcPortal"
                                        src=""
                                        width=100% height=850px>
                                </iframe>
                            </div>
                        -->

                    </div>
                </section>

                <!--
                    <form id="legacy-form" method="POST" action="{{ url()->route('user_management_system.user.update', ['id' => user()->id ])}}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="pa-3 tw-border-0 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid tw-w-full">
                            <h3 class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 tw-text-lg tw-font-bold">Would you like to use our
                                legacy video player?</h3>
                            <p class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 lg:tw-max-w-[50%]">
                                Our video player may have compatibility issues with older devices and operating systems. We recommend
                                switching to our legacy video player if you are experiencing playback issues.
                            </p>
                            <div class="tw-flex tw-flex-row tw-mt-3">
                                @include('partials.bladesora.members.inputs.toggle-input', [
                                    "inputID" => "useLegacyPlayer",
                                    "inputName" => "use_legacy_video_player",
                                    "inputLabel" => "Use legacy video player.",
                                    "checked" => (boolean) user()->use_legacy_video_player ?? false,
                                    "submitOnChange" => true,
                                ])
                            </div>
                        </div>
                    </form>
                    <delete-account-modal></delete-account-modal>
                -->

            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../../stores/user";
    import Breadcrumb from '../../Breadcrumb/Breadcrumb';
    import PageHeader from '../../PageHeader/PageHeader';
    import PillNav from "../../PillNav/PillNav.vue";

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