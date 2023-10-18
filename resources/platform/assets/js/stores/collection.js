import { defineStore } from 'pinia';
import axios from "axios";

export const useCollectionStore = defineStore({
    id: 'Collection',
    state: () => {
        return {
            brand: '',
            data: [],
            fetching: false,
            filter: {
                activeTab: '',
                currentPage: 1,
                limit: 10,
                params: {},
            },
            loading: false,
            tabData: {},
            totalPages: 0,
        }
    },
    actions:{
        async fetchData(){
            try {
                const response = await axios
                    .get(
                        this.tabData[this.filter.activeTab].endpoint,
                        {
                            params: {
                                brand: this.brand,
                                limit: this.filter.limit,
                                page: this.filter.currentPage,
                                sort: this.tabData[this.filter.activeTab].sort,
                                ...this.filter.params,
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
            if (replace) this.filter.currentPage = 1;

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
                this.filter.currentPage++;
                this.getData(false , false);
            }
        },
        setData(response, replace){
            if(response){
                if(replace){
                    this.data = [...response.data.data];
                    this.totalPages = Math.ceil(
                        response.data.meta.totalResults / this.filter.limit
                    );
                } else {
                    this.data = [...this.data, ...response.data.data];
                }
            }

            this.loading = false;
        },
        setDefaults(defaults){
          if(defaults.data){
              this.data = defaults.data;
          }

          if(defaults.brand){
              this.brand = defaults.brand;
          }

          if(defaults.totalPages){
              this.totalPages = defaults.totalPages;
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
                currentPage: this.filter.currentPage,
                totalPages: this.totalPages,
            }

            if(this.tabData[tab].data){
                this.filter.activeTab = tab;
                this.data = ([...this.tabData[this.filter.activeTab].data]);
                this.filter.currentPage = this.tabData[tab].currentPage;
                this.totalPages = this.tabData[tab].totalPages;

            } else {
                this.filter.activeTab = tab;
                this.filter.currentPage = 1;
                this.getData();
            }
        },
    },
});

