<template>
    <!-- DESKTOP -->
    <div :style="{ backgroundImage: `url('https://d3fzm1tzeyr5n3.cloudfront.net/learning-paths/IndependenceBackground.png')` }"
         class="tw-hidden xl:tw-block tw-relative tw-overflow-hidden tw-text-white tw-rounded-[10px] tw-h-[272px] 3xl:tw-h-[295px] 4xl:tw-h-[330px] tw-bg-cover tw-bg-center tw-py-4 2xl:tw-py-6 3xl:tw-py-5 tw-px-[30px] 2xl:tw-px-[35px] 3xl:tw-px-7">
        <!-- Background Overlay -->
        <div class="tw-absolute tw-inset-0 tw-backdrop-blur-sm tw-bg-[linear-gradient(270deg,_rgba(0,0,0,0.3)_30%,_rgba(0,0,0,0.5)_45.09%,_#000000_100%)] tw-z-[1]"></div>
        <div class="tw-flex tw-items-center tw-gap-4 2xl:tw-gap-2 tw-relative tw-z-[2] tw-h-full">
            <!-- Left -->
            <div class="tw-flex-1 tw-flex tw-flex-col tw-justify-center 3xl:tw-justify-between tw-items-start 3xl:tw-self-stretch">
                <!-- Challenge Type Label -->
                <div class="tw-hidden 3xl:tw-block">
                    <div class="tw-bg-[#374151] tw-rounded-[6px] tw-px-2 tw-py-1 tw-flex tw-text-[11px] tw-uppercase tw-font-bold tw-items-center">
                        <svg v-if="isCommunityChallenge" class="tw-w-4 tw-h-4 tw-mr-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.8031 5.38681C11.8031 6.78052 10.6733 7.91034 9.27957 7.91034C7.88587 7.91034 6.75604 6.78052 6.75604 5.38681C6.75604 3.9931 7.88587 2.86328 9.27957 2.86328C10.6733 2.86328 11.8031 3.9931 11.8031 5.38681Z" fill="#D1D5DB"/>
                            <path d="M16.009 7.06916C16.009 7.9983 15.2558 8.75152 14.3266 8.75152C13.3975 8.75152 12.6443 7.9983 12.6443 7.06916C12.6443 6.14003 13.3975 5.38681 14.3266 5.38681C15.2558 5.38681 16.009 6.14003 16.009 7.06916Z" fill="#D1D5DB"/>
                            <path d="M12.6443 12.9574C12.6443 11.0991 11.1378 9.59269 9.27957 9.59269C7.4213 9.59269 5.91487 11.0991 5.91487 12.9574V15.4809H12.6443V12.9574Z" fill="#D1D5DB"/>
                            <path d="M5.91487 7.06916C5.91487 7.9983 5.16165 8.75152 4.23251 8.75152C3.30338 8.75152 2.55016 7.9983 2.55016 7.06916C2.55016 6.14003 3.30338 5.38681 4.23251 5.38681C5.16165 5.38681 5.91487 6.14003 5.91487 7.06916Z" fill="#D1D5DB"/>
                            <path d="M14.3266 15.4809V12.9574C14.3266 12.0707 14.098 11.2374 13.6964 10.5132C13.8978 10.4614 14.109 10.4339 14.3266 10.4339C15.7203 10.4339 16.8502 11.5637 16.8502 12.9574V15.4809H14.3266Z" fill="#D1D5DB"/>
                            <path d="M4.86278 10.5132C4.46119 11.2374 4.23251 12.0707 4.23251 12.9574V15.4809H1.70898V12.9574C1.70898 11.5637 2.83881 10.4339 4.23251 10.4339C4.45013 10.4339 4.66132 10.4614 4.86278 10.5132Z" fill="#D1D5DB"/>
                        </svg>
                        {{ labelText }}
                    </div>
                </div>
                <!-- Logo -->
                <div>
                    <img :class="isSoloChallenge ? 'tw-mb-[10px] xl:tw-h-[86px] 2xl:tw-h-[99px] 3xl:tw-h-[105px] 4xl:tw-h-[110px]' : 'tw-mb-1 tw-h-[65px]'" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" alt="Challenge Logo" />
                    <template v-if="isCommunityChallenge">
                        <div class="tw-mb-2 tw-flex">
                            <!-- Avatars -->
                            <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-overflow-hidden tw-bg-cover tw-bg-center" style="background-image: url('https://www.musora.com/musora-cdn/image/quality=75,width=250,height=250,metadata=none/https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1727447340-755877.jpg');"></div>
                            <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-overflow-hidden tw-bg-cover tw-bg-center -tw-ml-3" style="background-image: url('https://www.musora.com/musora-cdn/image/quality=75,width=250,height=250,metadata=none/https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1727435036-755827.jpg');"></div>
                            <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-overflow-hidden tw-bg-cover tw-bg-center -tw-ml-3" style="background-image: url('https://www.musora.com/musora-cdn/image/quality=75,width=250,height=250,metadata=none/https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1727463538-755945.jpg');"></div>
                        </div>

<!--                        <div class="tw-flex tw-mb-2 3xl:tw-mb-1">-->
<!--                            &lt;!&ndash; Avatars &ndash;&gt;-->
<!--                            <div class="tw-w-[30px] tw-h-[30px] tw-border tw-border-white tw-rounded-full tw-relative tw-overflow-hidden"></div>-->
<!--                            <div class="tw-w-[30px] tw-h-[30px] tw-border tw-border-white tw-rounded-full tw-relative tw-overflow-hidden -tw-ml-3"></div>-->
<!--                            <div class="tw-w-[30px] tw-h-[30px] tw-border tw-border-w hite tw-rounded-full tw-relative tw-overflow-hidden -tw-ml-3"></div>-->
<!--                        </div>-->
                        <p class="tw-text-sm tw-line-clamp-2 tw-mb-2">
                            Join <span class="tw-font-bold">Stidger, Poco Askew, Dr Mojo,</span> and <span class="tw-font-bold">683</span> other drummers who have already enrolled! Runs Aug 1 - 31.
                        </p>
                    </template>
                    <div v-else class="tw-text-sm tw-font-bold tw-mb-3 3xl:tw-mb-0">29 Lessons <span class="tw-mx-1 tw-text-base tw-leading-none">·</span> Beginner</div>
                </div>
                <!-- CTA -->
                <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white" is-link href="/drumeo/enrollment/30-day-independence">
                    <svg class="tw-w-5 tw-h-5 tw-mr-1 tw-hidden 3xl:tw-block" width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 20.4166L30.625 13.1249L17.5 5.83325L4.375 13.1249L17.5 20.4166ZM17.5 20.4166L26.482 15.4265C27.2734 17.422 27.7083 19.5976 27.7083 21.8748C27.7083 22.8976 27.6206 23.8998 27.4522 24.8745C23.6458 25.2446 20.1965 26.8342 17.5 29.2476C14.8035 26.8342 11.3542 25.2446 7.54778 24.8745C7.37941 23.8998 7.29167 22.8975 7.29167 21.8747C7.29167 19.5976 7.72661 17.422 8.51794 15.4265L17.5 20.4166ZM11.6667 29.1665V18.2291L17.5 14.9883" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Enroll Now
                </MuButton>
            </div>
            <!-- Right -->
            <div class="tw-flex-1 tw-flex tw-justify-end">
                <div class="tw-aspect-square 3xl:tw-aspect-video tw-overflow-hidden tw-relative tw-w-[212px] 2xl:tw-w-[225px] 3xl:tw-w-[255px] 3xl:tw-w-full tw-rounded-[5px]">
                    <img class="tw-absolute tw-inset-0 " src="https://d3fzm1tzeyr5n3.cloudfront.net/learning-paths/IndependenceSquare.png" :alt="` Thumbnail`" />
                </div>
            </div>
        </div>
    </div>

    <!-- MOBILE -->
    <div :style="{ backgroundImage: `url('https://d3fzm1tzeyr5n3.cloudfront.net/learning-paths/IndependenceBackground.png')` }"
         class="tw-shrink-0 tw-flex xl:tw-hidden tw-relative tw-text-white tw-justify-start tw-items-center tw-rounded-[10px] tw-w-[330px] tw-h-[430px] lg:tw-w-auto tw-bg-cover tw-bg-center">
        <!-- Background Overlay -->
        <div class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(180deg,_rgba(0,0,0,0)_46.12%,_rgba(0,0,0,0.7)_65.36%,_#000000_100%)] tw-z-[1]"></div>
        <!-- Challenge Type Label -->
        <div class="tw-absolute tw-top-[18px] tw-left-[18px] tw-z-[2]">
            <div class="tw-bg-[#374151] tw-rounded-[6px] tw-px-2 tw-py-1 tw-flex tw-text-[11px] tw-uppercase tw-font-bold tw-items-center">
                <svg v-if="isCommunityChallenge" class="tw-w-4 tw-h-4 tw-mr-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.8031 5.38681C11.8031 6.78052 10.6733 7.91034 9.27957 7.91034C7.88587 7.91034 6.75604 6.78052 6.75604 5.38681C6.75604 3.9931 7.88587 2.86328 9.27957 2.86328C10.6733 2.86328 11.8031 3.9931 11.8031 5.38681Z" fill="#D1D5DB"/>
                    <path d="M16.009 7.06916C16.009 7.9983 15.2558 8.75152 14.3266 8.75152C13.3975 8.75152 12.6443 7.9983 12.6443 7.06916C12.6443 6.14003 13.3975 5.38681 14.3266 5.38681C15.2558 5.38681 16.009 6.14003 16.009 7.06916Z" fill="#D1D5DB"/>
                    <path d="M12.6443 12.9574C12.6443 11.0991 11.1378 9.59269 9.27957 9.59269C7.4213 9.59269 5.91487 11.0991 5.91487 12.9574V15.4809H12.6443V12.9574Z" fill="#D1D5DB"/>
                    <path d="M5.91487 7.06916C5.91487 7.9983 5.16165 8.75152 4.23251 8.75152C3.30338 8.75152 2.55016 7.9983 2.55016 7.06916C2.55016 6.14003 3.30338 5.38681 4.23251 5.38681C5.16165 5.38681 5.91487 6.14003 5.91487 7.06916Z" fill="#D1D5DB"/>
                    <path d="M14.3266 15.4809V12.9574C14.3266 12.0707 14.098 11.2374 13.6964 10.5132C13.8978 10.4614 14.109 10.4339 14.3266 10.4339C15.7203 10.4339 16.8502 11.5637 16.8502 12.9574V15.4809H14.3266Z" fill="#D1D5DB"/>
                    <path d="M4.86278 10.5132C4.46119 11.2374 4.23251 12.0707 4.23251 12.9574V15.4809H1.70898V12.9574C1.70898 11.5637 2.83881 10.4339 4.23251 10.4339C4.45013 10.4339 4.66132 10.4614 4.86278 10.5132Z" fill="#D1D5DB"/>
                </svg>
                {{ labelText }}
            </div>
        </div>
        <div class="tw-absolute tw-z-[2] tw-inset-0 tw-flex tw-items-end">
            <div class="tw-flex tw-flex-col tw-items-center tw-pb-5 tw-px-4 tw-w-full tw-max-w-[320px] tw-mx-auto">
                <!-- Logo -->
                <img :class="isSoloChallenge ? 'tw-h-[107px] tw-mb-[10px]' : 'tw-h-[86px] tw-mb-1'" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" alt="Challenge Logo" />
                <template v-if="isCommunityChallenge">
                    <div class="tw-flex tw-mb-2 3xl:tw-mb-0">
                        <!-- Avatars -->
                        <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-relative tw-overflow-hidden"></div>
                        <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-relative tw-overflow-hidden -tw-ml-3"></div>
                        <div class="tw-w-10 tw-h-10 tw-border tw-border-w hite tw-rounded-full tw-relative tw-overflow-hidden -tw-ml-3"></div>
                    </div>
                    <p class="tw-text-sm tw-line-clamp-3 tw-mb-2 tw-text-center">
                        Join <span class="tw-font-bold">Stidger, Poco Askew, Dr Mojo,</span> and <span class="tw-font-bold">683</span> other drummers who have already enrolled! Runs Aug 1 - 31.
                    </p>
                </template>
                <div v-else class="tw-text-sm tw-font-bold tw-mb-5">29 Lessons <span class="tw-mx-1 tw-text-base tw-leading-none">·</span> Beginner</div>
                <!-- CTA -->
                <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white tw-w-full">
                    <svg class="tw-w-4 tw-h-4 tw-mr-1" width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 20.4166L30.625 13.1249L17.5 5.83325L4.375 13.1249L17.5 20.4166ZM17.5 20.4166L26.482 15.4265C27.2734 17.422 27.7083 19.5976 27.7083 21.8748C27.7083 22.8976 27.6206 23.8998 27.4522 24.8745C23.6458 25.2446 20.1965 26.8342 17.5 29.2476C14.8035 26.8342 11.3542 25.2446 7.54778 24.8745C7.37941 23.8998 7.29167 22.8975 7.29167 21.8747C7.29167 19.5976 7.72661 17.422 8.51794 15.4265L17.5 20.4166ZM11.6667 29.1665V18.2291L17.5 14.9883" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Enroll Now
                </MuButton>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { breakpointsTailwind, useBreakpoints } from '@vueuse/core';
import { useUserStore } from "@stores/user";
import { postChallengesEnrollmentNotification } from 'musora-content-services';

import MuButton from '@units/Button/MuButton';
import ChallengeGetNotifiedModal from '@collections/Modal/ChallengeGetNotifiedModal';

const userStore = useUserStore();

const breakpoints = useBreakpoints({ ...breakpointsTailwind, '3xl': 1815 });
const desktop = breakpoints.greaterOrEqual('lg');
const bigDesktop = breakpoints.greaterOrEqual('3xl');
const mobile = breakpoints.smaller('md');

const hasSquareImg = ref(false);

const props = defineProps({
    challengeType: {
        type: String,
        default: 'community'
    },
});

const isSoloChallenge = computed(() => {
    return props.challengeType === 'solo';
});

const isCommunityChallenge = computed(() => {
    return props.challengeType === 'community';
});

const labelText = computed(() => {
    if(isSoloChallenge.value){
        return 'Start Now';
    }

    return props.challengeType;
})

const handleCta = async () => {
    try {
        //Get enrollment notification
        // const notification = postChallengesEnrollmentNotification(id);
    } catch (e){
        window.shownotification({
            icon: 'error',
            text: 'Woops! Something wrong happened, please try again later.'
        })
    }
}
</script>
