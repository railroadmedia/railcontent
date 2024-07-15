<template>
    <div class="flex flex-column" :class="[isCoachesGrid ? 'tw-mr-4 tw-w-full xl:tw-w-1/4' : '']">
        <div class="flex flex-row flex-wrap mb nmh-1 tw-items-center">
            <div v-if="searchBarTitle.length" class="tw-flex tw-flex-col tw-mb-3 sm:tw-mb-0 tw-mr-auto ph-1">
                <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">
                    {{ searchBarTitle }}
                </h1>
            </div>
            <div v-if="includedTypes.length" class="flex flex-column xs-12 sm-4"
                :class="[isCoachesGrid ? 'tw-hidden' : '']">
                <catalogue-filter filter-name="type" :item="parsedTypes" :theme-color="themeColor" :loading="loading"
                    :initial-value="selectedTypes" @filterChange="changeFilter" />
            </div>

            <div class="flex flex-column">
                <div class="tw-flex tw-flex-row" :class="[isCoachesGrid ? 'tw-justify-start' : 'tw-justify-end']">
                    <div class="flex flex-column grow pr-2 tw-w-full md:tw-max-w-[455px]">
                        <input id="catalogueSearch" v-model="searchTermInterface" ref="searchInput" type="text"
                            name="search" autocomplete="off" placeholder="Search..."
                            class="no-label dark:placeholder:tw-text-white tw-bg-white dark:tw-bg-transparent tw-py-0 tw-h-[45px] tw-px-[25px] tw-rounded-full tw-border focus:tw-ring-0 focus:tw-outline-none tw-text-[#00101D] tw-border-[#D4D4D8] dark:tw-border-[#445F74] dark:tw-text-white"
                            @keydown.enter="submitSearch($event)">
                    </div>

                    <button class="tw-btn-primary tw-btn-circle tw-flex-shrink-0 tw-w-[45px] tw-h-[45px] tw-mb-0"
                        :class="`tw-bg-${themeColor} hover:tw-bg-${themeColor}-600`" title="Search"
                        @click="submitSearch">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

            </div>
        </div>
        <div v-if="catalogueType !== 'coaches-grid'" class="flex flex-row pb-1">
            <p class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] font-italic">
                Displaying <span v-if="totalResults > 0">{{ currentResults }} of</span> {{ totalResults }} results.
            </p>
        </div>
    </div>
</template>
<script>
import CatalogueFilter from './_CatalogueFilter.vue';

export default {
    name: 'CatalogueSearch',
    components: {
        'catalogue-filter': CatalogueFilter,
    },
    props: {
        searchBarTitle: {
            type: String,
            default: '',
        },
        themeColor: {
            type: String,
            default: () => '',
        },
        loading: {
            type: Boolean,
            default: () => false,
        },
        includedTypes: {
            type: Array,
            default: () => [],
        },
        isCoachesGrid: {
            type: Boolean,
            default: () => false,
        },
        selectedTypes: {
            type: String,
            default: () => null,
        },
        searchTerm: {
            type: String,
            default: () => undefined,
        },
        currentPage: {
            type: [String, Number],
            default: () => 1,
        },
        catalogueType: {
            type: String,
            default: () => undefined,
        },
        limit: {
            type: [String, Number],
            default: () => 20,
        },
        totalResults: {
            type: [String, Number],
            default: () => 0,
        },
        infiniteScroll: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            search_term: this.searchTerm,
        };
    },
    computed: {
        searchTermInterface: {
            get() {
                return this.search_term === undefined ? this.searchTerm : this.search_term;
            },
            set(value) {
                this.search_term = value;
            },
        },

        currentResults() {
            return `${1 + (this.infiniteScroll ? 0 : ((this.currentPage * this.limit) - this.limit))}-${this.displayedLimit}`;
        },

        displayedLimit() {
            return this.currentPage * this.limit > this.totalResults ? this.totalResults : this.currentPage * this.limit;
        },

        parsedTypes() {
            const parsedArray = [];

            this.includedTypes.forEach((type) => {
                let displayName = type.replace(/-/g, ' ').replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
                parsedArray.push({
                    key: displayName,
                    value: type,
                });
            });

            return parsedArray;
        },
    },
    methods: {
        changeFilter(item) {
            this.$emit('typeChange', {
                key: item.key,
                value: item.value,
            });
        },

        submitSearch(e) {
            this.$emit('searchChange', {
                term: this.searchTermInterface,
            });
            //only blur the input on mobile (up to Tailwind sm breakpoint)
            let isMobile = window.matchMedia('(max-width: 639px)');
            if (isMobile.matches) {
                e.target.blur()
            }
        },
    },
};
</script>
<style lang="scss">
    @import '../../assets/sass/partials/variables';
</style>
