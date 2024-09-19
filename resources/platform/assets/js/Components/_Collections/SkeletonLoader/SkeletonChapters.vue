<template>
    <div class="tw-animate-pulse tw-flex tw-flex-col">
        <div class="tw-flex tw-justify-between tw-items-center tw-mb-[30px]">
            <!-- Chapters Text -->
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-32 tw-h-[30px]"></div>
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-[50px] tw-h-[50px]"></div>
        </div>
        <section class="tw-pb-5 tw-mb-5 tw-flex tw-w-full tw-no-scrollbar tw-flex-wrap tw-gap-4">
            <div v-for="index in 5"
                 :key="index"
                 class="tw-flex tw-items-center tw-w-full"
            >
                <!-- Chapter Thumbnail -->
                <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[5px] tw-w-[115px] tw-h-16 tw-mr-[10px]"></div>
                <!-- Chapter Info Wrapper -->
                <div class="tw-w-full tw-flex tw-justify-between tw-items-center">
                    <div class="tw-flex-grow tw-flex tw-flex-col">
                        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-10 tw-h-5 tw-mb-1"></div>
                        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-32 tw-h-6"></div>
                    </div>
                    <div class="tw-hidden md:tw-flex tw-flex-shrink-0">
                        <!-- Practice Button -->
                        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-mr-2 tw-w-36 tw-h-[40px]"></div>
                        <!-- Loop Button -->
                        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-mr-2 tw-w-32 tw-h-[40px]"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
