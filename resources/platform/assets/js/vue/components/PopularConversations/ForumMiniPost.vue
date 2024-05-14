<template>
    <div class="tw-flex tw-flex-nowrap sm:tw-flex-wrap tw-transition-colors tw-flex-col tw-min-w-[340px] sm:tw-min-w-0 sm:tw-w-[340px] lg:tw-w-auto tw-rounded-md pa-2 hover:tw-shadow-lg dark:hover:tw-bg-[#081825] tw-border tw-border-transparent dark:hover:tw-border-[#223F57]">
        <a :href="url" class="tw-flex tw-flex-row tw-no-underline tw-flex-1">
            <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white hot-forum-avatar-col">
                
                <UserAvatar 
                    :access-level="authorAccessLevel"
                    :avatar-image="avatar"
                    :name="author"
                />
                <!-- Rank Data -->
                <p class="tw-text-sm tw-uppercase tw-text-center dense font-compressed tw-leading-[1.2]">
                    {{ rank }}
                </p>
                <p class="tw-text-sm tw-text-center font-compressed tw-mt-[-3px]">
                    {{ xp }} XP
                </p>
            </div>
            <div class="tw-flex tw-flex-col tw-pl-3">
                <h5 class="dark:tw-text-white tw-text-[#00101D] tw-text-sm tw-font-bold tw-mb-1">
                    {{ title }}
                </h5>
                <h6 class="tw-text-xs dark:tw-text-[#9EC0DC] tw-text-[#3F3F46] tw-uppercase tw-mb-1">
                    Posted
                    <strong>{{ date }}</strong>
                    by
                    <strong>{{ author }}</strong>
                </h6>
                <p class="tw-text-xs dark:tw-text-white tw-text-[#00101D] tw-flex-1 tw-relative tw-pb-6" style="overflow-wrap: anywhere;">
                    <span class="!tw-text-xs" v-html="formattedContent"></span>
                    <span class="tw-inline xl:tw-block tw-font-bold dark:tw-text-white tw-text-[#00101D] tw-underline lg:tw-absolute lg:tw-left-0 lg:tw-bottom-0">See Post &raquo;</span>
                </p>
            </div>
        </a>
    </div>
</template>
<script setup>
    //Imports
    import { computed } from 'vue';
    import { useUserStore } from "../../../stores/user";
    import {storeToRefs} from "pinia/dist/pinia";
    import UserAvatar from '../UserAvatar/UserAvatar.vue';

    //Pinia Stores
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    //Props
    const props = defineProps({
        authorAccessLevel: String, 
        author: String,
        avatar: String,
        content: String,
        date: String,
        rank: String, 
        title: String,
        url: String,
        xp: String,
    });

    //Computed Props
    const formattedContent = computed(() => {
        if (!props.content) return '';
        // Replace '&nbsp;' with an empty space, take the first 100 characters
        return props.content.replace(/&nbsp;/g, '').substring(0, 100);
    });
</script>
<style>
    p { font-size: inherit; }
</style>