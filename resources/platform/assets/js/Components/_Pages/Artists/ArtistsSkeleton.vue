<template>
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
        <!-- Breadcrumbs -->
        <Breadcrumb :is-loading="true"/>

        <div class="tw-animate-pulse tw-mb-4">
            <!-- Header Skeleton -->
            <div class="tw-my-4 tw-w-[125px] tw-h-[32px] md:tw-my-8 tw-bg-ui-skeleton tw-rounded-full"></div>
            <div class="tw-columns-xs">
                <div class="tw-mb-2" v-for="n in 26" :key="n">
                    <h2 class="tw-h-[28px] tw-w-[28px] tw-bg-ui-skeleton tw-rounded-full"></h2>
                    <li v-for="i in 4" :key="i" class="marker:tw-text-ui-skeleton tw-h-[24px] tw-w-2/3 tw-m-2 tw-bg-ui-skeleton tw-rounded-full" ></li>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
