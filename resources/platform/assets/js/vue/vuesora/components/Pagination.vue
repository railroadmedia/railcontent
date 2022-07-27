<template>
    <div class="tw-flex tw-flex-row pagination tw-items-center tw-justify-center tw-w-full tw-py-4">
        <!-- Left Arrow -->
        <button
            v-show="currentPage > 1"
            class="btn short collapse-square page-button"
            @click="goToPage(currentPage - 1)"
        >
            <span class="flat tw-font-primary tw-text-lg tw-text-[#A1A1A9] dark:tw-text-[#7E9AB1]">
                <i class="far fa-chevron-left"></i>
            </span>
        </button>

        <!-- Page is greater thatn 2 -->
        <button
            v-show="currentPage > 2"
            class="btn short collapse-square page-button"
            @click="goToPage(1)"
        >
            <span class="flat tw-font-primary tw-text-lg tw-font-semibold tw-shadow-none tw-text-[#A1A1A9] dark:tw-text-[#7E9AB1]">
                1
            </span>
        </button>

        <!-- Page is greater thatn 3 -->
        <button
            v-show="currentPage > 3"
            disabled
            class="btn short collapse-square page-button"
        >
            <span class="flat tw-font-primary tw-text-lg tw-font-semibold tw-shadow-none tw-text-[#A1A1A9] dark:tw-text-[#7E9AB1]">
                ...
            </span>
        </button>

        <!-- First Set -->
        <button
            v-for="i in activePages"
            :key="`page-${i}`"
            class="btn short collapse-square page-button"
            @click="goToPage(i)"
        >
            <span class="tw-font-primary tw-text-lg tw-font-semibold tw-shadow-none"
                :class="currentPage === i ? 'tw-text-white tw-bg-[#52525A] dark:tw-bg-[#002039]' : 'tw-text-[#A1A1A9] dark:tw-text-[#7E9AB1]'"
            >
                {{ i }}
            </span>
        </button>

        <button
            v-show="currentPage < totalPages - 2"
            disabled
            class="btn short collapse-square page-button"
        >
            <span class="flat tw-font-primary tw-text-lg tw-font-semibold tw-shadow-none tw-text-[#A1A1A9] dark:tw-text-[#7E9AB1]">
                ...
            </span>
        </button>

        <button
            v-show="currentPage < totalPages - 1"
            class="btn short collapse-square page-button"
            @click="goToPage(totalPages)"
        >
            <span class="flat tw-font-primary tw-text-lg tw-font-semibold tw-shadow-none tw-text-[#A1A1A9] dark:tw-text-[#7E9AB1]">
                {{ totalPages }}
            </span>
        </button>

        <!-- Right Arrow -->
        <button
            v-show="currentPage < totalPages"
            class="btn short collapse-square page-button"
            @click="goToPage(currentPage + 1)"
        >
            <span class="flat tw-font-primary tw-text-lg tw-text-[#A1A1A9] dark:tw-text-[#7E9AB1]">
                <i class="far fa-chevron-right"></i>
            </span>
        </button>
    </div>
</template>
<script>
import ThemeClasses from '../mixins/ThemeClasses';
import Utils from '../assets/js/helper-functions/utils.js';

export default {
    name: 'Pagination',
    mixins: [ThemeClasses],
    props: {
        currentPage: {
            type: Number,
            default: () => 1,
        },
        totalPages: {
            type: Number,
            default: () => 0,
        },
        themeColor: {
            type: String,
            default: 'grey-3',
        },
    },
    computed: {
        activePages() {
            const pages = this.range(this.totalPages, 1);

            return pages.filter(page => page < (this.currentPage + 2) && page > (this.currentPage - 2));
        },
    },
    methods: {
        goToPage(page) {
            this.$emit('pageChange', {
                page,
            });
        },

        range: (length, start) => Utils.range(length, start),
    },
};
</script>
<style lang="scss">
    button.btn.page-button {
        margin:0 3px;

        & > span {
            border-width:1px;
            font-weight:500;
        }
    }
</style>
