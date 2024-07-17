<template>
    <div class="tw-flex tw-flex-col tw-w-full">
        <!-- Section Header -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
            <div class="tw-flex tw-items-center">
                <a :href="`${brand}/forums`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Popular Conversations</h2>
                </a>
            </div>
            <div class="tw-flex tw-items-center">
                <a :href="`${brand}/forums`" aria-label="See All Lessons In Progress" class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-mt-1"> 
                    Forums 
                </a>
            </div>
        </div>
        <!-- Conversation Section -->
        <div class="tw-block tw-overflow-x-auto lg:tw-overflow-x-hidden tw-no-scrollbar tw-w-[100vw] lg:tw-w-full">
            <div class="tw-flex tw-flex-row tw-flex-nowrap sm:tw-grid sm:tw-grid-cols-[1fr,340px,2fr] lg:tw-grid-cols-3 tw-px-4 lg:tw-px-0">
                <ForumMiniPost 
                    v-for="(post, index) in posts" 
                    :key="index"
                    :authorAccessLevel="post.user.access_level" 
                    :author="post.user.display_name"
                    :avatar="post.user.profile_picture_url"
                    :date="post.published_on"
                    :content="post.content"
                    :rank="post.xp_rank" 
                    :title="post.data"
                    :url="`${brand}/forums/jump-to-post/${post.id}`"
                    :xp="post.user_xp"
                />
            </div>
        </div>
    </div>
</template>
<script setup>
    //Imports
    import ForumMiniPost from "./ForumMiniPost.vue";
    import { useUserStore } from "../../Stores/user";
    import {storeToRefs} from "pinia/dist/pinia";

    //Pinia Stores
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    //Props
    const props = defineProps({
        posts: Array, 
    });

</script>
