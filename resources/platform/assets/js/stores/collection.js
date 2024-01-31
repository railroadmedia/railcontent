import axios from "axios";
import { defineStore } from 'pinia';
import { useUserStore } from "./user";
import ContentHelpers from '../vue/vuesora/assets/js/helper-functions/content';

export const useCollectionStore = defineStore({
    id: 'Collection',
    state: () => {
        return {
            data: [],
            endpoint: '/railcontent/content',
            fetching: false,
            filter: {
                activeTab: '',
                includedFields: [],
                limit: 10,
                params: {},
                searchTerm: '',
                sort: '',
                progress: '',
            },
            filterValues: {},
            filterColumns: [],
            filterableValues: [],
            isCoach: false,
            loading: false,
            searchEndpointUrl: '',
            searching: false, //for threads page
            sortOptions:[
                { value: '-published_on', name: 'Newest First', icon: 'sort-down', },
                { value: 'published_on', name: 'Oldest First', icon: 'sort-up', },
                { value: '-popularity', name: 'Most Popular', icon: 'sort-popularity', },
                { value: 'slug', name: 'Name: A to Z', icon: 'sort-name-asc', },
                { value: '-slug', name: 'Name: Z to A', icon: 'sort-name-desc', },
            ],
            tabData: {},
            totalPages: 0,
            totalResults: 0,
        }
    },
    actions: {
        applyFilter (param) {
            this.updateIncludedFields(param);
            this.setAllTabsToFilterNotApplied();
            this.setActiveTabToFilterApplied();
            this.getData();
        },

        setProgress (value) {
            this.filter = {
                ...this.filter,
                progress: value,
            };
            this.getData();
        },

        clearFilter () {
            this.resetFilterFields();
            this.setAllTabsToFilterNotApplied();
            this.setActiveTabToFilterApplied();
            this.getData();
        },

        coachEndpoint (){
            return `/railcontent/content?only_subscribed=${this.filter.activeTab === 'All Coaches' ? '' : 'true'}`;
        },

        getEndpoint (){
            return this.isCoach ? this.coachEndpoint() : ((this.filter.searchTerm && this.searchEndpointUrl) ? this.searchEndpointUrl : this.endpoint);
        },

        updateIncludedFields (param) {
            const itemIndex = this.filter.includedFields.findIndex(f => f === param);

            if (itemIndex === -1) this.filter.includedFields.push(param);
            else this.filter.includedFields.splice(itemIndex, 1);
        },

        resetFilterFields () {
            this.filter.includedFields = [];
        },

        formattedTabs () {
            return Array.isArray(this.tabData[this.filter.activeTab].key) ? this.tabData[this.filter.activeTab].key : [this.tabData[this.filter.activeTab].key];
        },

        async fetchData () {
            const userStore = useUserStore();
            try {
                const response = await axios
                    .get(
                        this.isCoach ? this.coachEndpoint() : this.getEndpoint(),
                        {
                            params: {
                                brand: userStore.brand,
                                limit: this.filter.limit,
                                page: this.tabData[this.filter.activeTab].currentPage,
                                sort: this.filter.sort,
                                ...this.filter.params,
                                included_fields: this.filter.includedFields,
                                count_filter_items: true,
                                ...(this.filter.searchTerm && { [this.filter.hasOwnProperty('term') ? 'term' : 'title']: this.filter.searchTerm} ),
                                ...(this.filter.activeTab && { tabs: this.formattedTabs() }),
                                ...(this.filter.progress && { included_user_states: [this.filter.progress] }),
                            },
                        })
                return response;
            } catch (e) {
                console.error(e);
                window.shownotification({
                    icon: 'error',
                    text: 'This is Embarrassing That didn\'t work. Refresh the page and try once more, if it happens again please let us know using the chat below.'
                })
            }
        },

        async getData (replace = true, displayLoading = true) {
            this.loading = displayLoading;
            this.fetching = true;

            if (replace) this.tabData[this.filter.activeTab].currentPage = 1;

            const response = await this.fetchData();
            this.setData(response, replace);
            this.setURLParams();
            this.fetching = false;
        },

        getURLParams () {
            const params = new URLSearchParams(window.location.search);

            //Get search params
            if (params.get('term')) {
                this.filter.searchTerm = params.get('term');
            } else if (params.get('title')) {
                this.filter.searchTerm = params.get('title');
            }

            //Get sort
            if (params.get('sort')) this.filter.sort = params.get('sort');

            //Get filters
            if (params.getAll('included_fields[]').length > 0) {
                this.filter.includedFields = params.getAll('included_fields[]');
            }
        },

        getFilterColumns () {
            let filters = [];
            for (const value of this.filterableValues){
                filters.push({
                    category: value,
                    items: this.filterValues[value]
                });
            }
            this.filterColumns = filters;
        },

        getFilterValues (values) {
            return ContentHelpers.flattenFilters(values);
        },

        getSortOptions () {
            if (this.tabData[this.filter.activeTab].groupByView) {
                return [
                    { value: 'slug', name: 'Name: A to Z', icon: 'sort-name-asc', },
                    { value: '-slug', name: 'Name: Z to A', icon: 'sort-name-desc', },
                ];
            } else {
                return this.sortOptions;
            }
        },

        loadMore () {
            if (!this.fetching) {
                this.tabData[this.filter.activeTab].currentPage++;
                this.getData(false, false);
            }
        },

        setAllTabsToFilterNotApplied () {
            Object.keys(this.tabData).forEach(tab => {
                this.tabData[tab].filterApplied = false;
            });
        },

        setActiveTabToFilterApplied () {
            if (this.tabData[this.filter.activeTab]) {
                this.tabData[this.filter.activeTab].filterApplied = true;
            }
        },

        setData (response, replace) {
            if (response) {
                if (replace) {
                    this.data = [...response.data.data];
                    this.tabData[this.filter.activeTab].totalPages = Math.ceil(
                        response.data.meta.totalResults / this.filter.limit
                    );
                } else {
                    this.data = [...this.data, ...response.data.data];
                    this.tabData[this.filter.activeTab].totalResults = response.data.meta.totalResults;
                }
                this.filterValues = this.getFilterValues(response.data?.meta?.filterOptions);
                this.getFilterColumns();
            }

            if (this.filter.searchTerm){
                this.searching = true;
            } else {
                this.searching = false;
            }
            this.loading = false;
        },

        setDefaults (defaults) {
            if (defaults.isCoach){
                this.isCoach = defaults.isCoach;
            }

            if (defaults.content) {
                this.data = defaults.content?.data || [];
                if(defaults.content.meta?.filterOptions){
                    this.filterValues = this.getFilterValues(defaults.content.meta.filterOptions);
                }
            }

            if (defaults.filter) {
                this.filter = { ...this.filter, ...defaults.filter };
            }

            if (defaults.endpoint) {
                this.endpoint = defaults.endpoint;
            }

            if (defaults.searchEndpointUrl) {
                this.searchEndpointUrl = defaults.searchEndpointUrl;
            }

            if (Array.isArray(defaults.sortOptions) && defaults.sortOptions.length > 0) {
                this.sortOptions = defaults.sortOptions;
            }

            //Set active tab
            if (defaults.tabOptions) {
                const params = new URLSearchParams(window.location.search);
                let tabParams = params.getAll('tabs[]');

                //Set active tab from URL
                if(tabParams && tabParams.length > 0){
                    if(tabParams.length === 1){
                        tabParams = tabParams[0];
                    }

                    const activeTab = defaults.tabOptions.find((tab) => {
                        return JSON.stringify(tab.key) === JSON.stringify(tabParams);
                    })

                    this.filter.activeTab = activeTab.value;
                    this.tabData[this.filter.activeTab] = { ...defaults.tabData, ...activeTab };

                //Set active tab as first tab from tabOptions
                } else {
                    this.filter.activeTab = defaults.tabOptions[0].value;
                    this.tabData[this.filter.activeTab] = { ...defaults.tabData, ...defaults.tabOptions[0] };
                }
            }

            if (defaults.filterableValues) {
                this.filterableValues = defaults.filterableValues;
                this.getFilterColumns();
            }
        },

        setURLParams () {
            const url = new URL(window.location.origin + window.location.pathname);

            this.filter.searchTerm && url.searchParams.set(this.filter.hasOwnProperty('term') ? 'term' : 'title', this.filter.searchTerm);
            url.searchParams.set('sort', this.filter.sort);

            if (this.filter.includedFields.length > 0) {
                this.filter.includedFields.map((field) => {
                    url.searchParams.append('included_fields[]', field);
                })
            }

            if(Array.isArray(this.tabData[this.filter.activeTab].key)){
                this.tabData[this.filter.activeTab].key.map((key) => {
                    key && url.searchParams.append('tabs[]', key);
                })
            } else {
                url.searchParams.set('tabs[]', this.tabData[this.filter.activeTab].key);
            }

            window.history.pushState({}, '', url);
        },

        setSearchTerm (term) {
            this.filter.searchTerm = term;
            this.setAllTabsToFilterNotApplied();
            this.setActiveTabToFilterApplied();
            this.getData();
        },

        sortData (item) {
            this.filter.sort = item;
            this.setAllTabsToFilterNotApplied();
            this.setActiveTabToFilterApplied();
            this.getData();
        },

        switchTab (tab) {
            //Save page data
            this.tabData[this.filter.activeTab] = {
                ...this.tabData[this.filter.activeTab],
                data: [...this.data],
                filterApplied: true,
            }

            this.filter.activeTab = tab.value;

            //When the tab data is stored
            if (this.tabData[this.filter.activeTab] && this.tabData[this.filter.activeTab].filterApplied) {
                this.data = ([...this.tabData[this.filter.activeTab].data]);
            //When the tab data is not stored
            } else {
                this.tabData[this.filter.activeTab] = { ...tab, filterApplied: true };
                //When the tab's groupByView is true set sort to by alphabet
                if  (this.tabData[this.filter.activeTab].groupByView) {
                    this.filter.sort = 'slug';
                }
                this.getData();
            }

            this.setURLParams()
        },
    },
});

