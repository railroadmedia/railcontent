<template>
    <a class="tw-shrink-0 tw-text-primary-2 tw-text-[11px] lg:tw-text-xs" :class="widthStyles">
        <div class="tw-rounded-[0.5px] sm:tw-rounded-md lg:tw-rounded-lg tw-overflow-hidden tw-border tw-border-primary-7 tw-relative tw-group">
            <!-- Card Image -->
            <img class="tw-w-full" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://www.musora.com/musora-cdn/image/width=300,quality=95/https://cdn.musora.com/image/fetch/c_fill,w_660,h_960,q_auto:good/https://d1923uyy6spedc.cloudfront.net/coaches-2022/drumeo/Domino-Santantonio-HEAD.jpg" />
            <!-- Community Icon -->
            <div class="tw-bg-[#374151] tw-rounded-xl tw-absolute tw-left-2 lg:tw-left-[13px] tw-top-2 lg:tw-top-[13px] tw-px-1 sm:tw-px-1.5 tw-py-0.5 sm:tw-py-1">
                <svg class="tw-w-4 sm:tw-w-5 lg:tw-w-6 tw-h-4 sm:tw-h-5 lg:tw-h-6" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.8031 5.38681C11.8031 6.78052 10.6733 7.91034 9.27957 7.91034C7.88587 7.91034 6.75604 6.78052 6.75604 5.38681C6.75604 3.9931 7.88587 2.86328 9.27957 2.86328C10.6733 2.86328 11.8031 3.9931 11.8031 5.38681Z" fill="#D1D5DB"/>
                    <path d="M16.009 7.06916C16.009 7.9983 15.2558 8.75152 14.3266 8.75152C13.3975 8.75152 12.6443 7.9983 12.6443 7.06916C12.6443 6.14003 13.3975 5.38681 14.3266 5.38681C15.2558 5.38681 16.009 6.14003 16.009 7.06916Z" fill="#D1D5DB"/>
                    <path d="M12.6443 12.9574C12.6443 11.0991 11.1378 9.59269 9.27957 9.59269C7.4213 9.59269 5.91487 11.0991 5.91487 12.9574V15.4809H12.6443V12.9574Z" fill="#D1D5DB"/>
                    <path d="M5.91487 7.06916C5.91487 7.9983 5.16165 8.75152 4.23251 8.75152C3.30338 8.75152 2.55016 7.9983 2.55016 7.06916C2.55016 6.14003 3.30338 5.38681 4.23251 5.38681C5.16165 5.38681 5.91487 6.14003 5.91487 7.06916Z" fill="#D1D5DB"/>
                    <path d="M14.3266 15.4809V12.9574C14.3266 12.0707 14.098 11.2374 13.6964 10.5132C13.8978 10.4614 14.109 10.4339 14.3266 10.4339C15.7203 10.4339 16.8502 11.5637 16.8502 12.9574V15.4809H14.3266Z" fill="#D1D5DB"/>
                    <path d="M4.86278 10.5132C4.46119 11.2374 4.23251 12.0707 4.23251 12.9574V15.4809H1.70898V12.9574C1.70898 11.5637 2.83881 10.4339 4.23251 10.4339C4.45013 10.4339 4.66132 10.4614 4.86278 10.5132Z" fill="#D1D5DB"/>
                </svg>
            </div>
            <!-- Date Label -->
            <div class="tw-flex tw-justify-center tw-absolute tw-left-0 tw-bottom-0 tw-w-full">
                <div :class="`tw-bg-${brand} tw-rounded-t-md tw-text-white tw-text-[11px] lg:tw-text-sm tw-uppercase tw-font-bold tw-px-2 tw-pb-0.5 tw-pt-1`">September 1 - 31</div>
            </div>
            <!-- Completed Icon -->
            <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center tw-items-center">
                <musora-icon icon-name="circle-check-filled" class="tw-text-white tw-w-12 sm:tw-w-16 lg:tw-w-20 tw-h-12 sm:tw-h-16 lg:tw-h-20" />
            </div>
            <!-- Overlay -->
            <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/40 tw-hidden group-hover:tw-block"></div>
        </div>
        <div class="tw-my-[7px] tw-uppercase">
            El Estepario Siberiano
        </div>
        <DifficultyLabel />
    </a>
</template>
<script setup>
import { computed } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel';
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";

const props = defineProps({
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const widthStyles = computed(() => {
    if(props.isGroupedView){
        return 'tw-w-[168px] sm:tw-w-[230px] lg:tw-w-auto'
    }
})
</script>
