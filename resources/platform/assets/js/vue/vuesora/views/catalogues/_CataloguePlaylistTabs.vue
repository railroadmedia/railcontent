<template>
    <div class="flex flex-row flex-wrap align-v-center">
        <div class="flex flex-column xs-12 sm-8 pv-3">
            <div class="flex flex-row flex-wrap filter-tabs align-v-center">
                <!-- Added Tab -->
                <a class="heading-tab pointer mr-3 flex flex-auto"
                   :href="`/${brand}/lists/my-list`"
                >
                    <h3 class="heading flex-auto hover-text-black"
                        :class="isActive(`/${brand}/lists/my-list`) ? ('text-black bb-' + themeColor + '-2') : 'text-grey-3 font-regular'"
                    >
                        Added
                    </h3>
                </a>
                <!-- In Progress Tab -->
                <a class="heading-tab pointer mr-3 flex flex-auto"
                   :href="`/${brand}/lists/in-progress`"
                >
                    <h3 class="heading flex-auto hover-text-black"
                        :class="isActive(`/${brand}/lists/in-progress`) ? ('text-black bb-' + themeColor + '-2') : 'text-grey-3 font-regular'"
                    >
                        In Progress
                    </h3>
                </a>
                <!-- Completed Tab -->
                <a class="heading-tab pointer mr-3 flex flex-auto"
                   :href="`/${brand}/lists/completed`"
                >
                    <h3 class="heading flex-auto hover-text-black"
                        :class="isActive(`/${brand}/lists/completed`) ? ('text-black bb-' + themeColor + '-2') : 'text-grey-3 font-regular'"
                    >
                        Complete
                    </h3>
                </a>
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
            const query_object = QueryString.parse(params, { arrayFormat: 'bracket' });

            console.log(item.value);

            if (item.value) {
                query_object.type = item.value;
            } else if (query_object.type) {
                delete query_object.type;
            }

            window.location.href = `${location.protocol}//${location.host 
            }${location.pathname}?${QueryString.stringify(query_object)}`;
        },
        formatOption(option) {
            return option.replace(/-/g, ' ').replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase());
        },
        isActive(path) {
            return window.location.pathname === path;
        }
    },
};
</script>
