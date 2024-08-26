<template>
    <div class="tw-col-span-3 2xl:tw-col-span-2 2xl:tw-row-span-2">
        <div class="tw-flex tw-flex-col tw-flex-grow comments-container tw-w-full lg:tw-mb-6 tw-animate-pulse">
            <!-- Title Section -->
            <div class="tw-flex tw-flex-row tw-w-full tw-flex-wrap tw-py-6 tw-items-center">
                <div class="tw-w-full tw-flex-wrap tw-flex tw-items-center">
                    <!-- Preview Cards --><!--v-if-->
                    <div class="tw-flex tw-flex-grow">
                        <div class="tw-inline-flex tw-mb-0.5 tw-h-[50px] tw-w-[149px] tw-bg-ui-skeleton tw-rounded-full"></div>
                        <div class="tw-flex tw-flex-grow tw-justify-end">
                            <!-- Sort -->
                            <div class="tw-relative">
                                <button class="tw-bg-ui-skeleton tw-h-[35px] sm:tw-h-[50px] tw-w-[35px] sm:tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center tw-mr-3"></button>
                            </div>
                            <div class="collapse-square">
                                <button class="tw-bg-ui-skeleton tw-h-[35px] sm:tw-h-[50px] tw-w-[35px] sm:tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Comment Section -->
            <div class="tw-flex tw-flex-col tw-w-full">
                <!-- Post a Comment -->
                <div class="tw-flex tw-flex-row comment-post tw-mb-6">
                    <div class="tw-flex-col avatar-column tw-mr-[15px] tw-hidden md:tw-flex">
                        <div class="user-avatar smaller">
                            <!-- User Avatar -->
                            <div class="tw-rounded-full tw-w-[100px] tw-h-[100px] tw-bg-ui-skeleton"></div>
                        </div>
                    </div>
                    <div class="tw-flex tw-flex-col tw-grow tw-w-full">
                        <div class="tw-w-full tw-h-[300px] tw-bg-ui-skeleton tw-rounded-[10px]"></div>
                        <div class="tw-flex tw-flex-row tw-justify-end mv-1">
                            <button class="tw-rounded-[25px] tw-mu-button tw-btn-medium tw-flex tw-justify-center tw-items-center tw-cursor-pointer tw-bg-ui-skeleton tw-w-[125px] tw-h-[40px]"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>