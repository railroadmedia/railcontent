<template>
    <div
        class="dropdown tw-text-center tw-rounded-xl tw-mb-3 select-none tw-text-black tw-border-2 tw-border-[#EFF3F5] tw-bg-white"
    >
        <div class="tw-flex">
            <div class="tw-text-left tw-flex-grow tw-relative">
                <div
                    class="tw-pt-4 sm:tw-pt-6 tw-pr-4 sm:tw-pr-5 tw-pl-8 sm:tw-pl-12 tw-cursor-pointer"
                    @click="toggleDropdown"
                >
                    <h5
                        class="tw-leading-tight sm:tw-leading-loose tw-font-bold tw-relative"
                        :class="{ 'tw-mb-2': isOpen }"
                    >
                        <span class="tw-text-white tw-rounded-full tw-py-1 tw-px-2 md:tw-px-2.5 tw-text-xs md:tw-text-sm tw-absolute -tw-left-11 sm:-tw-left-14 md:-tw-left-16 -tw-top-0.5 sm:tw-top-[2px] lg:tw-top-0.5 tw-min-w-0" :class="isOpen ? `tw-bg-${brand}` : 'tw-bg-[#838C98]'">?</span>
                        {{ title }}
                    </h5>
                </div>
                <div class="tw-pb-4 sm:tw-pb-6 tw-pr-4 sm:tw-pr-5 tw-pl-8 sm:tw-pl-12">
                    <p
                        class="tw-transition-all tw-duration-100 tw-leading-relaxed sm:tw-leading-relaxed tw-overflow-hidden"
                        :class="isOpen ? 'tw-max-h-[2000px]' : 'tw-max-h-0'"
                        v-html="desc"
                    ></p>
                </div>
            </div>
            <div
                :class="`tw-ml-auto tw-text-${brand} tw-pt-3 sm:tw-pt-6 tw-pr-4 sm:tw-pr-5 tw-cursor-pointer`"
                @click="toggleDropdown"
            >
                <i class="fas fa-plus tw-transform tw-transition-all tw-duration-300 tw-text-lg md:tw-text-2xl lg:tw-text-3xl" :class="{ 'tw-rotate-45': isOpen }"></i>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useUserStore } from "../../Stores/user";
import { storeToRefs } from "pinia/dist/pinia";

const props = defineProps({
    title: {
        type: String,
        default: '',
    },
    desc: {
        type: String,
        default: '',
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const isOpen = ref(false);

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
}
</script>
