<template>
    <div class="tw-w-full tw-relative">
        <!-- BREADCRUMBS -->
        <Breadcrumb
            :first-level-url="firstLevelUrl" 
            :first-level-title="firstLevelTitle"
            :last-level-title="lastLevelTitle"
        />

        <!-- Headers/OverviewHeader Component -->

        <!-- Headers/OverviewSubheader Component -->

        <!-- ContentProgress Component -->

        <!-- List Item Component : Next Lesson Variant -->

        <!-- Content Catalog -->
        <section class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-4">
            <div class="tw-flex tw-flex-col">
                <div class="tw-flex tw-w-full tw-flex-row">

                    <transition appear name="fade">
                        <content-catalogue></content-catalogue>
                    </transition>

                </div>
            </div>
        </section>

        <!-- XP Level -->

        <!-- Pianote Foundations Section -->
        <template v-if="slug === 'pianote-method'">
            <a href="/pianote/method/foundations-2019/215952"
               class="tw-flex tw-flex-row tw-no-underline dark:hover:tw-bg-[#002039] tw-relative">
                <div class="tw-flex tw-flex-col">
                    <p class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-mt-[5px]">Pianote Foundations</p>
                </div>
                <div class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-hidden sm:tw-inline-flex tw-flex-col tw-justify-center tw-text-center tw-mr-2">
                    10 Levels
                </div>
                <div class="tw-flex-col tw-items-center tw-justify-center tw-hidden sm:tw-inline-flex">
                    <div class="">
                        <i class="fas tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D] tw-rounded-full fa-play-circle"></i>
                    </div>
                </div>
            </a>
        </template>

        <!-- for guitareo 500 songs special page -->
        <template v-if="songPDFs.length">
            <section class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-3">
                <div class="tw-flex tw-flex-col">
                    <div class="tw-flex tw-flex-row tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]">
                        <content-catalogue
                            catalogue-type="downloads"
                            theme-color="guitareo"
                            brand="guitareo"
                            :use-theme-color="true"
                            sort-override="slug"
                            :included-types="['song-pdf']"
                            :filterable-values="['artist', 'style']"
                            :pre-loaded-content="{{ $songsPdfs }}"
                            user-id="{{ auth()->id() }}"
                            :infinite-scroll="true"
                        ></content-catalogue>
                    </div>
                </div>
            </section>
        </template>

    </div>
</template>
<script setup>
    //Imports
    import { storeToRefs } from 'pinia';
    import {useUserStore} from "../../stores/user";

    //Props
    const props = defineProps({
        slug: { type: String, default: '' },
        songPDFs: { type: Array, default: [] },
    });
</script>