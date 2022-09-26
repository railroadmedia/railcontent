<template>
    <div class="flex flex-row flex-wrap align-v-center tw-mt-8">
        <div class="flex flex-column tw-w-fit tw-shrink-0">
            <div class="flex flex-row flex-wrap filter-tabs align-v-center">
                <!-- Added Tab -->
                <div class="heading-tab pointer tw-mr-5 tw-mb-2 md:tw-mb-3 tw-flex tw-w-fit">
                    <a :href="'/' + brand + '/lists/my-list'">
                        <h3 class="tw-text-2xl md:tw-text-3xl tw-font-bold hover:tw-text-[#00101D] dark:hover:tw-text-white tw-leading-none"
                            :class="selected_tab === 'my-list' ? ('tw-text-[#00101D] dark:tw-text-white bb-' + themeColor + '-2') : 'tw-text-[#A1A1A9] dark:tw-text-[#445F74] '"
                        >
                            Added
                        </h3>
                    </a>
                </div>
                <!-- In Progress Tab -->
                <div class="heading-tab pointer tw-mr-5 tw-mb-2 md:tw-mb-3 tw-flex tw-w-fit">
                    <a :href="'/' + brand + '/lists/in-progress'">
                        <h3 class="tw-text-2xl md:tw-text-3xl tw-font-bold hover:tw-text-[#00101D] dark:hover:tw-text-white tw-leading-none"
                            :class="selected_tab === 'started' ? ('tw-text-[#00101D] dark:tw-text-white bb-' + themeColor + '-2') : 'tw-text-[#A1A1A9] dark:tw-text-[#445F74] '"
                        >
                            In Progress
                        </h3>
                    </a>
                </div>
                <!-- Completed Tab -->
                <div class="heading-tab pointer tw-mr-5 tw-mb-2 md:tw-mb-3 tw-flex tw-w-fit">
                    <a :href="'/' + brand + '/lists/completed'">
                        <h3 class="tw-text-2xl md:tw-text-3xl tw-font-bold hover:tw-text-[#00101D] dark:hover:tw-text-white tw-leading-none"
                            :class="selected_tab === 'completed' ? ('tw-text-[#00101D] dark:tw-text-white bb-' + themeColor + '-2') : 'tw-text-[#A1A1A9] dark:tw-text-[#445F74] '"
                        >
                            Complete
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        <!-- Catalog -->
        <div class="flex flex-column xs-12 sm-4 pv-1 align-v-center">
            <div class="flex flex-row nmh-1">
                <catalogue-filter
                    filter-name="type"
                    :item="parsedTypes"
                    :theme-color="themeColor"
                    :loading="loading"
                    :initial-value="selected_types"
                    @filterChange="changeFilter"
                ></catalogue-filter>
            </div>
        </div>
    </div>
</template>
<script>
import * as QueryString from 'query-string';
import CatalogueFilter from './_CatalogueFilter.vue';

export default {
    name: 'CataloguePlaylistTabs',
    components: {
        'catalogue-filter': CatalogueFilter,
    },
    props: {
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
        searchTerm: {
            type: String,
            default: () => undefined,
        },
        brand: {
            type: String,
            default: 'drumeo',
        }
    },
    data() {
        return {
            selected_types: null,
            selected_tab: 'added',
        };
    },
    computed: {
        searchTermInterface: {
            get() {
                return this.search_term;
            },
            set(value) {
                this.$emit('searchChange', {
                    term: value,
                });
            },
        },
        parsedTypes() {
            return this.includedTypes.map(type => ({
                key: this.formatOption(type),
                value: type,
            }));
        },
    },
    methods: {
        changeFilter(item) {
            const params = window.location.search;
            const query_object = QueryString.parse(params, {arrayFormat: 'bracket'});

            if (item.value) {
                query_object.type = item.value;
            } else if (query_object.type) {
                delete query_object.type;
            }

            window.location.href = `${location.protocol}//${location.host
            }${location.pathname}?${QueryString.stringify(query_object)}`;
        },

        changeTab(tab) {
            const params = window.location.search;
            const query_object = QueryString.parse(params, {arrayFormat: 'bracket'});

            if (tab !== 'added') {
                query_object.state = tab;
            } else if (query_object.state) {
                delete query_object.state;
            }

            window.location.href = `${location.protocol}//${location.host
            }${location.pathname}?${QueryString.stringify(query_object)}`;
        },

        formatOption(option) {
            return option.replace(/-/g, ' ').replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase());
        },
    },
    mounted() {
        const urlPath = window.location.pathname;

        if (urlPath.includes('my-list')) {
            this.selected_tab = 'my-list';
        } else if (urlPath.includes('in-progress')) {
            this.selected_tab = 'started';
        } else if (urlPath.includes('completed')) {
            this.selected_tab = 'completed';
        }
    },
};
</script>
