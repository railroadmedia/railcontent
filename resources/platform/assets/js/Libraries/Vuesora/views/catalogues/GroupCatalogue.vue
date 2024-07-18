<template>
    <a class="tw-flex tw-justify-between tw-items-center">
        <div class="tw-flex tw-items-center tw-mb-4 tw-text-[#000C17] dark:tw-text-white">
            <img class="tw-w-[77px] tw-h-[77px] tw-rounded-full tw-border-2 tw-border-white tw-border-solid tw-mr-2" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,height=250,metadata=none/https://s3.amazonaws.com/pianote/defaults/avatar.png" alt="" />
            <div class="tw-group">
                <div class="tw-text-2xl tw-font-bold tw-leading-none group-hover:tw-underline">Alice In Chains</div>
                <div class="tw-text-lg group-hover:tw-underline">11 Songs - 3,576 Plays</div>
            </div>
        </div>
        <div class="tw-text-[#000C17] dark:tw-text-white tw-font-bebas-neue tw-text-lg hover:tw-underline">See All</div>
    </a>

    <div class="tw-flex tw-flex-nowrap tw-overflow-x-auto lg:tw-auto-rows-[0] lg:tw-overflow-hidden lg:tw-grid-rows-1 lg:tw-grid lg:tw-grid-cols-5 xl:tw-grid-cols-6 tw-gap-3 tw-no-scrollbar">
        <CatalogueGroupItem />
    </div>
</template>

<script setup>
import CatalogueGroupItem from './_CatalogueGroupItem';
</script>
