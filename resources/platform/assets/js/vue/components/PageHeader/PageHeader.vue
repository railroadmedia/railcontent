<template>
    <header class="tw-px-4 md:tw-px-8">
        <div class="tw-py-4 tw-flex tw-flex-col tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]">
            <div class="tw-flex tw-justify-between"> 
                <div class="">
                    <slot name="top-left"></slot>
                </div>
                <div class="tw-self-end">
                    <slot name="top-right"></slot>
                </div>
            </div>
            <div class="w-full">
                <slot name="bottom-full"></slot>
            </div>
        </div>
    </header>
</template>
