<template>
    <div class="tw-relative tw-flex tw-flex-row tw-items-center tw-text-[#00101D] tw-border-0 tw-border-b tw-border-solid tw-border-gray-200 dark:tw-border-[#223F57] dark:hover:tw-bg-[#002039]/50 hover:tw-bg-[#F5F5F6] tw-transition">
        <a :href="thread.url+'?sortby_val=-published_on'"
           :class="[brandHoverColor]"
           :id="`thread-${thread.id}`"
           :datatest-id="`thread-${thread.id}`"
           class="tw-py-4 tw-pl-2 tw-transition-colors tw-inline-flex tw-no-underline tw-w-full" 
        >
            <!-- Avatar -->
            <div class="tw-h-14 tw-w-14 tw-rounded-full tw-flex tw-justify-center tw-items-center tw-relative tw-mr-6 tw-flex-shrink-0">
                <div class="user-avatar tw-w-full"
                    :class="[avatarClassObject, brand]"    
                >
                    <img :src="thread.authorAvatar" class="tw-rounded-full tw-border-3">
                    <i v-if="!thread.authorAvatar" class="tw-text-2xl tw-text-white fas fa-comments"></i>
                </div>
            </div>
        
            <!-- Description -->
            <div class="tw-flex tw-flex-col tw-justify-center tw-pr-4 tw-mr-auto">
                <p class="tw-text-sm tw-text-[#00101D] tw-font-bold dark:tw-text-white">
                    <i v-if="thread.isPinned" class="fas fa-thumbtack tw-mr-1"></i>
                    <i v-if="thread.isLocked" class="fas fa-lock tw-mr-1"></i>
                    {{ thread.title }}
                </p>
                <p class="tw-text-sm tw-text-gray-600 dark:tw-text-white">
                    Started <strong class="dark:tw-text-[#9EC0DC]">{{ thread.createdOn }}</strong> by <strong class="dark:tw-text-[#9EC0DC]">{{ thread.authorUsername }}</strong> 
                </p>
                <!-- Responsive version (could not reorder with flex) -->
                <p class="tw-text-sm tw-text-gray-600 dark:tw-text-white lg:tw-hidden">
                    <span class="tw-text-sm tw-font-bold">{{ thread.latestPost ? thread.latestPost.created_at_diff : ''}} </span>
                    <span> By: <span class="tw-font-bold">{{  thread.latestPost ? thread.latestPost.author_display_name : '' }}</span></span>
                </p>
            </div>

            <!-- Thread Category -->
            <div v-if="thread.category"
                class="tw-hidden tw-mx-6 tw-w-52 tw-items-center tw-flex-shrink-0 xl:tw-flex">
                <p class="tw-text-sm tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-font-bold ">
                    {{ thread.category }}
                </p>
            </div>

            <!-- Reply Count -->
            <div class="tw-items-center tw-text-gray-600 dark:tw-text-[#9EC0DC] tw-flex-shrink-0 tw-flex-shrink-0 tw-w-24 tw-text-left tw-hidden tw-pr-2 sm:tw-inline-flex">
                <h6 class="tw-text-sm tw-font-bold">
                    <i class="fas fa-comment-lines tw-mr-1"></i>
                    {{ replyCount }}
                </h6>
            </div>
        </a>
        <a :href="thread.latestPost ? thread.latestPost.url : '#'" class="tw-bg-[#F4F4F5] dark:tw-bg-[#002039] tw-transition-colors hover:tw-bg-gray-100 tw-py-6 tw-inline-flex tw-items-center tw-no-underline tw-h-full tw-px-4 sm:tw-px-8 sm:tw-w-28 lg:tw-w-full lg:tw-max-w-xs">
            <!-- Post Date -->
            <div class="tw-flex-col tw-justify-center tw-mr-6 tw-text-gray-600 dark:tw-text-[#9EC0DC] tw-flex-shrink-0 tw-w-28 tw-hidden lg:tw-flex">
                <h6 class="tw-text-sm tw-font-bold">{{ thread.latestPost ? thread.latestPost.created_at_diff : ''}}</h6>
                <p class="tw-text-sm tw-truncate">
                    <span class="">By: </span>
                    <span class="tw-font-bold">{{  thread.latestPost ? thread.latestPost.author_display_name : ''}}</span>
                </p>
            </div>

            <!-- New Badge-->
            <div v-if="thread.isNew"
                 class="tw-flex-col tw-hidden tw-mr-6 lg:tw-flex">
                <span class="tw-text-white tw-rounded-sm tw-uppercase tw-flex tw-px-1 tw-py-0.5 tw-text-sm tw-items-center tw-font-bold"
                    :class="brandBgColor">
                    <i class="fas fa-star tw-mr-0.5"></i> New
                </span>
            </div>

            <!-- Arrow -->
            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-ml-auto">
                <i class="fas fa-arrow-circle-right tw-rounded-full tw-text-3xl"
                :class="thread.isRead ? 'tw-text-gray-300 dark:tw-text-[#9EC0DC]' : brandTextColor"
                ></i>
            </div>
        </a>
    </div>
</template>
<script>
export default {
    name: 'ForumThreadsTableItem',
    props: {
        brand: {
            type: String,
            default: () => '',
            require: true
        },
        thread: {
            type: Object,
            default: () => {},
            require: true
        },
    },
    computed: {
        brandBgColor() {
            return 'tw-bg-' + this.brand;
        },
        brandTextColor() {
            return 'tw-text-'+ this.brand;
        },
        brandHoverColor() {
            return 'hover:tw-bg-'+this.brand+'-100'
        },
        topicIdMap() {
            const topics = {
                1: 'general',
                2: 'gear',
                3: 'website feedback',
                4: 'off topic',
            };
            return topics[this.thread.topic];
        },
        avatarClassObject() {
            return {
                subscriber: ['edge', 'lifetime', 'team', 'admin', 'guitar', 'piano'].indexOf(this.thread.access_level) !== -1,
                edge: this.thread.access_level === 'edge',
                pack: this.thread.access_level === 'pack',
                coach: this.thread.access_level === 'coach', 
                'house-coach': this.thread.access_level === 'house-coach', 
                team: ['team', 'admin'].indexOf(this.thread.access_level) !== -1,
                guitar: this.thread.access_level === 'guitar',
                piano: this.thread.access_level === 'piano',
                lifetime: this.thread.access_level === 'lifetime',
            };
        },
        replyCount() {
            return (this.thread.replyAmount - 1).toLocaleString("en-US");
        }
    },
};
</script>
