<template>
    <header class="tw-py-5 md:tw-pt-[25px] tw-flex tw-flex-col tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]">
        <div class="tw-flex tw-items-center tw-flex-wrap"> 
            <div class="tw-flex-grow tw-mr-auto">
                <slot name="top-left"></slot>
            </div>
            <!-- only use this div if top-right is used -->
            <div v-if="$slots['top-right']" class="tw-flex tw-py-1">
                <slot name="top-right"></slot>
            </div>
        </div>
        <div class="w-full">
            <slot name="bottom-full"></slot>
        </div>
    </header>
</template>
