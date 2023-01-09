<script setup>
const props = defineProps({
    selectedTier: {
        type: String,
        default: 'plus'
    }
});
const emit = defineEmits(['onTierSelect']);
</script>
<template>
    <div class="tw-flex tw-items-end tw-justify-center">
        <button @click="() => emit('onTierSelect', 'plus')" class="tw-mx-2 tw-relative">
            <div v-if="selectedTier === 'plus'"
                class="tw-h-full tw-w-full tw-z-20 tw-absolute tw-border-2 tw-border-white tw-rounded-xl"></div>
            <div class="tw-relative">
                <strong
                    class="tw-inline-block tw-z-30 tw-w-[115px] tw-absolute tw-mx-auto tw-right-0 tw-left-0 tw-whitespace-nowrap -tw-mt-[10px] tw-px-3 tw-py-0.5 tw-leading-tight tw-text-black tw-text-xs tw-rounded-full"
                    style="background-color:#00c9ac;">MOST POPULAR</strong>
                <div class="tw-px-2 tw-box-border tw-relative tw-flex tw-items-end tw-rounded-xl tw-px-3 tw-py-2 tw-w-[160px] lg:tw-w-[198px] tw-h-[60px]"
                    :class="`${selectedTier === 'plus' ? 'tw-bg-[#082b4a]' : 'tw-bg-[#273040]'}`">
                    <div class="tw-text-left">
                        <div class="tw-flex tw-flex-row">
                            <img class="tw-w-[79px]"
                                src="https://dmmior4id2ysr.cloudfront.net/logos/musora-logo-white.png">
                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.79437 4.19242V0.484863H4.37239V4.19242H0.601807V8.55161H4.37239V12.2594H8.79437V8.55161H12.565V4.19242H8.79437Z"
                                    fill="white" />
                            </svg>
                        </div>
                        <p class="tw-opacity-60 tw-text-[10px]"><em>Lessons, songs & support</em></p>
                    </div>
                    <div
                        class="tw-flex tw-h-full tw-absolute tw-right-0 tw-items-center tw-justify-end -tw-mb-2 tw-mr-2">
                        <i
                            :class="`${selectedTier === 'plus' ? 'fas fa-check-circle' : 'far fa-circle'} tw-text-2xl`"></i>
                    </div>
                </div>
            </div>
        </button>
        <button @click="() => emit('onTierSelect', 'basic')" class="tw-relative tw-mx-2">
            <div class="tw-relative">
                <div v-if="selectedTier === 'basic'"
                    class="tw-h-full tw-w-full tw-z-30 tw-absolute tw-border-2 tw-border-white tw-rounded-xl"></div>
                <div class="tw-px-2 tw-box-border tw-flex tw-items-end tw-rounded-xl tw-px-2 lg:tw-px-3 tw-py-2 tw-w-[160px] lg:tw-w-[198px] tw-h-[60px]"
                    :class="`${selectedTier === 'basic' ? 'tw-bg-[#082b4a]' : 'tw-bg-[#273040]'}`">
                    <div class="tw-text-left">
                        <img class="tw-w-[79px]" src="https://dmmior4id2ysr.cloudfront.net/logos/musora-logo-white.png">
                        <p class="tw-opacity-60 tw-text-[10px]"><em>Lesson & support.</em></p>
                    </div>
                    <div
                        class="tw-flex tw-h-full tw-absolute tw-right-0 tw-items-center tw-justify-end -tw-mb-2 tw-mr-4">
                        <i
                            :class="`${selectedTier === 'basic' ? 'fas fa-check-circle' : 'far fa-circle'} tw-text-2xl`"></i>
                    </div>
                </div>
            </div>
        </button>

    </div>
</template>
