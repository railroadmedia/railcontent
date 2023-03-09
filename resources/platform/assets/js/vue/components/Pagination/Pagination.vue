<script setup>
    import { onBeforeMount, onMounted, watch, inject, reactive, computed } from 'vue';
    import Utils from '../../vuesora/assets/js/helper-functions/utils.js';
    
    //-----------Emits-----------//
    const emit = defineEmits(['pageChange']);
    
    //-----------Props-----------//
    const props = defineProps({
        currentPage: {
            type: Number,
            default: () => 1,
        },
        pageQuantity: {
            type: Number,
            default: () => 0,
        },
        limit: {
            type: Number,
            default: () => 10,
        },
    })

    //-----------Computed-----------//
    const totalPages = computed(() => {
        return Math.ceil(props.pageQuantity / props.limit);
    });
    const activePages = computed(() => {
        const pages = range(Math.ceil(props.pageQuantity / props.limit), 1);
        return pages.filter(page => page < (props.currentPage + 2) && page > (props.currentPage - 2));
    });

    //-----------Method-----------//
    const range = (length, start) => Utils.range(length, start);

    const goToPage = (page) => {
        emit('pageChange', page );
    }

</script>

<template>
    <div class="tw-flex tw-flex-row pagination tw-items-center tw-justify-center tw-w-full tw-py-4">
        
        <!-- Left Arrow -->
        <button
            v-if="currentPage > 1"
            class="tw-w-[26px] tw-h-[26px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-lg tw-font-bold tw-mx-1 tw-text-[#A1A1A9] dark:tw-text-[#9EC0DC]"
            @click="goToPage(currentPage - 1)"
        >
            <i class="far fa-chevron-left"></i>
        </button>

        <!-- Page is greater thatn 2 -->
        <button
            v-if="currentPage > 2"
            class="tw-w-[26px] tw-h-[26px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-lg tw-font-bold tw-mx-1 tw-text-[#A1A1A9] dark:tw-text-[#9EC0DC]"
            @click="goToPage(1)"
        >
            1
        </button>

        <!-- Page is greater thatn 3 -->
        <button
            v-if="currentPage > 3"
            disabled
            class="tw-w-[26px] tw-h-[26px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-lg tw-font-bold tw-mx-1 tw-text-[#A1A1A9] dark:tw-text-[#9EC0DC]"
        >
            ...
        </button>

        <!-- First Set -->
        <button
            v-for="i in activePages"
            :key="`page-${i}`"
            class="tw-w-[26px] tw-h-[26px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-lg tw-font-bold tw-mx-1"
            :class="currentPage === i ? 'tw-text-white tw-bg-[#52525A] dark:tw-text-[#223F57] dark:tw-bg-[#9EC0DC]' : 'tw-text-[#A1A1A9] dark:tw-text-[#9EC0DC]'"
            @click="goToPage(i)"
        >
            {{ i }}
        </button>

        <button
            v-if="currentPage < totalPages - 2"
            disabled
            class="tw-w-[26px] tw-h-[26px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-lg tw-font-bold tw-mx-1 tw-text-[#A1A1A9] dark:tw-text-[#9EC0DC]"
        >
            ...
        </button>

        <button
            v-if="currentPage < totalPages - 1"
            class="tw-w-[26px] tw-h-[26px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-lg tw-font-bold tw-mx-1 tw-text-[#A1A1A9] dark:tw-text-[#9EC0DC]"
            @click="goToPage(totalPages)"
        >
            {{ totalPages }}
        </button>

        <!-- Right Arrow -->
        <button
            v-if="currentPage < totalPages"
            class="tw-w-[26px] tw-h-[26px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-lg tw-font-bold tw-mx-1 tw-text-[#A1A1A9] dark:tw-text-[#9EC0DC]"
            @click="goToPage(currentPage + 1)"
        >
            <i class="far fa-chevron-right"></i>
        </button>
    </div>
</template>
<style lang="scss">
    button.btn.page-button {
        margin:0 3px;

        & > span {
            border-width:1px;
            font-weight:500;
        }
    }
</style>
