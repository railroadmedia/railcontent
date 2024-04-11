<template>
    <header class="tw-px-4 md:tw-px-8">
        <div class="tw-py-5 tw-flex tw-flex-col tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]">
            <div class="tw-flex tw-justify-between tw-items-center"> 
                <div class="tw-flex-grow">
                    <slot name="top-left"></slot>
                </div>
                <!-- only use this div if top-right is used -->

                <div v-if="$slots['top-right']" class="tw-flex tw-flex-grow tw-justify-end sm:tw-self-end tw-items-end">
                    <slot name="top-right"></slot>
                </div>
            </div>
            <div class="w-full">
                <slot name="bottom-full"></slot>
            </div>
        </div>
    </header>
</template>
