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
                limit: 10,
                params: {},
                fields: {},
            },
            loading: false,
            tabData: {},
            totalPages: 0,
            totalResults: 0,
        }
    },
    actions: {
        applyFilter (category, item) {
            this.updateFilterFields(category, item);
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

        updateFilterFields (category, item) {
            const existingCategory = this.filter.fields[category];

            if (!existingCategory) {
                this.filter.fields[category] = [item];
                return;
            }

            const itemIndex = existingCategory.findIndex(p => p.key === item.key);

            if (itemIndex === -1) {
                existingCategory.push(item);
            } else {
                existingCategory.splice(itemIndex, 1);

                if (existingCategory.length === 0) {
                    delete this.filter.fields[category];
                }
            }
        },

        resetFilterFields () {
            this.filter.fields = {};
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
                                sort: this.tabData[this.filter.activeTab].sort,
                                ...this.filter.params,
                                included_fields: this.getIncludedFields(),
                                [this.filter.hasOwnProperty('term') ? 'term' : 'title']: this.tabData[this.filter.activeTab].searchTerm,
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

            this.fetching = false;
        },
        getIncludedFields () {
            let fields = [...this.filter.params.included_fields];

            if (Object.keys(this.filter.fields).length > 0) {
                Object.keys(this.filter.fields).forEach((category) => {
                    this.filter.fields[category].forEach((item) => {
                        fields.push(`${category},${item.key}`);
                    })
                })
            }

            return fields;
        },
        getParams () {
            const params = new URLSearchParams(window.location.search);

            if (params.get('term')) this.tabData[this.filter.activeTab].searchTerm = params.get('term') || '';
            this.tabData[this.filter.activeTab].sort = params.get('sort') || 'slug';

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
        setParams () {
            const url = new URL(window.location.origin + window.location.pathname);

            url.searchParams.set(this.filter.hasOwnProperty('term') ? 'term' : 'title', this.tabData[this.filter.activeTab].searchTerm);
            url.searchParams.set('sort', this.tabData[this.filter.activeTab].sort);

            window.history.pushState({}, '', url);
        },
        setSearchTerm (term) {
            this.tabData[this.filter.activeTab].searchTerm = term;
            this.tabData[this.filter.activeTab].currentPage = 1;
            this.getData();
        },
        sortData (item) {
            this.tabData[this.filter.activeTab].sort = item;
            this.getData();
        },
        switchTab (tab) {
            //Save page data
            this.tabData[this.filter.activeTab] = {
                ...this.tabData[this.filter.activeTab],
                data: [...this.data],
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

