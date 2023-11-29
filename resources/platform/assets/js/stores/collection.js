import { defineStore } from 'pinia';
import axios from "axios";
import { useUserStore } from "./user";

export const useCollectionStore = defineStore({
    id: 'Collection',
    state: () => {
        return {
            data: [],
            fetching: false,
            filter: {
                activeTab: '',
                includedFields: [],
                limit: 10,
                params: {},
                searchTerm: '',
                sort: 'slug',
            },
            loading: false,
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

        clearFilter () {
            this.resetFilterFields();
            this.setAllTabsToFilterNotApplied();
            this.setActiveTabToFilterApplied();
            this.getData();
        },

        updateIncludedFields (param) {
            const itemIndex = this.filter.includedFields.findIndex(f => f === param);

            if (itemIndex === -1) this.filter.includedFields.push(param);
            else this.filter.includedFields.splice(itemIndex, 1);
        },

        resetFilterFields () {
            this.filter.includedFields = [];
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
        async fetchData () {
            const userStore = useUserStore();

            try {
                const response = await axios
                    .get(
                        this.tabData[this.filter.activeTab].endpoint,
                        {
                            params: {
                                brand: userStore.brand,
                                limit: this.filter.limit,
                                page: this.tabData[this.filter.activeTab].currentPage,
                                sort: this.filter.sort,
                                ...this.filter.params,
                                included_fields: this.filter.includedFields,
                                [this.filter.hasOwnProperty('term') ? 'term' : 'title']: this.filter.searchTerm,
                                tab: this.filter.activeTab
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

            if (params.get('term')) this.filter.searchTerm = params.get('term');
            if (params.get('sort')) this.filter.sort = params.get('sort');
            if (params.getAll('included_fields[]').length > 0) {
                this.filter.includedFields = params.getAll('included_fields[]');
            }
        },
        loadMore () {
            if (!this.fetching) {
                this.tabData[this.filter.activeTab].currentPage++;
                this.getData(false, false);
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
            }

            this.loading = false;
        },
        setDefaults (defaults) {
            if (defaults.data) {
                this.data = defaults.data;
            }

            if (defaults.filter) {
                this.filter = { ...this.filter, ...defaults.filter };
            }

            if (defaults.tabData) {
                this.tabData = { ...defaults.tabData };
            }
        },
        setURLParams () {
            const url = new URL(window.location.origin + window.location.pathname);

            url.searchParams.set(this.filter.hasOwnProperty('term') ? 'term' : 'title', this.filter.searchTerm);
            url.searchParams.set('sort', this.filter.sort);

            if (this.filter.includedFields.length > 0) {
                this.filter.includedFields.map((field) => {
                    url.searchParams.append('included_fields[]', field);
                })
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

            this.filter.activeTab = tab;
            if (this.tabData[tab].filterApplied) {
                this.data = ([...this.tabData[this.filter.activeTab].data]);
            } else {
                this.getData();
                this.tabData[tab].filterApplied = true;
            }
        },
    },
});

