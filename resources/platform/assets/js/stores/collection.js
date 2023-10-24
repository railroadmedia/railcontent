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
            },
            loading: false,
            tabData: {},
            totalPages: 0,
            totalResults: 0,
        }
    },
    actions:{
        async applyFilter(param){
            const index = this.tabData[this.filter.activeTab].included_fields.findIndex(p => p === param);
            if (index === -1 || !index){
                this.tabData[this.filter.activeTab].included_fields.push(param);
            } else {
                this.filter.params.included_fields.splice(index,1);
            }

            this.getData();
        },
        async fetchData(){
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
                                included_fields: this.tabData[this.filter.activeTab].included_fields,
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
        async getData(replace = true, displayLoading = true){
            this.loading = displayLoading;
            this.fetching = true;

            const response = await this.fetchData();
            this.setData(response, replace);
            this.fetching = false;
        },
        getParams(){
            const params = new URLSearchParams(window.location.search);

            if (params.get('term')) this.tabData[this.filter.activeTab].searchTerm = params.get('term') || '';
            this.tabData[this.filter.activeTab].sort = params.get('sort') || 'slug';

        },
        loadMore(){
            if (!this.fetching){
                this.tabData[this.filter.activeTab].currentPage++;
                this.getData(false , false);
            }
        },
        setData(response, replace){
            if(response){
                if(replace){
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
        setDefaults(defaults){
          if(defaults.data){
              this.data = defaults.data;
          }

          if(defaults.filter){
              this.filter = {...this.filter, ...defaults.filter};
          }

          if(defaults.tabData){
              this.tabData = {...defaults.tabData};
          }
        },
        setParams(){
            const url = new URL(window.location.origin + window.location.pathname);

            url.searchParams.set(this.filter.hasOwnProperty('term') ? 'term' : 'title', this.tabData[this.filter.activeTab].searchTerm);
            url.searchParams.set('sort', this.tabData[this.filter.activeTab].sort);

            window.history.pushState({}, '', url);
        },
        setSearchTerm(term){
            this.tabData[this.filter.activeTab].searchTerm = term;
            this.getData();
        },
        sortData(item){
            this.tabData[this.filter.activeTab].sort = item;
            this.getData();
        },
        switchTab(tab){
            //Save page data
            this.tabData[this.filter.activeTab] = {
                ...this.tabData[this.filter.activeTab],
                data: [...this.data],
            }

            if(this.tabData[tab].data){
                this.filter.activeTab = tab;
                this.data = ([...this.tabData[this.filter.activeTab].data]);

            } else {
                this.filter.activeTab = tab;
                this.getData();
            }
        },
    },
});

