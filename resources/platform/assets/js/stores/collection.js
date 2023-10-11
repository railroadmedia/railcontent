import { defineStore } from 'pinia';
import axios from "axios";
import Toasts from "../vue/vuesora/assets/js/classes/toasts";

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
                searchTerm: '',
                sort: 'slug',
            },
            loading: false,
            tabData: {},
            totalPages: 0,
        }
    },
    actions:{
        coachEndpoint(){
            return this.filter.activeTab === "allCoaches" ? '/railcontent/content?only_subscribed=' : '/railcontent/content?only_subscribed=true';
        },
        async fetchData(){
            try {
                const response = await axios
                    .get( this.coachEndpoint(), {
                        params: {
                            brand: this.brand,
                            limit: this.filter.limit,
                            page: this.filter.currentPage,
                            sort: this.filter.sort,
                            ...this.filter.params,
                            [this.filter.hasOwnProperty('term') ? 'term' : 'title']: this.filter.searchTerm,
                        },
                    })
                return response;
            } catch (e) {
                console.error(e);
                Toasts.push({
                    icon: "doh",
                    themeColor: this.brand,
                    title: "This is Embarrassing That didn't work",
                    message:
                        "Refresh the page and try once more, if it happens again please let us know using the chat below. ",
                });
            }
        },
        getData(replace = true, displayLoading = true){
            this.loading = displayLoading;
            this.fetching = true;
            if (replace) this.filter.currentPage = 1;

            this.fetchData().then((response)=>{
                this.setData(response, replace);
                this.fetching = false;
            })
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
        },
        setSearchTerm(term){
            this.filter.searchTerm = term;
            this.getData();
        },
        sortData(item){
            this.filter.sort = item;
            this.getData();
        },
        switchTab(tab){
            //Save page data
            this.tabData[this.filter.activeTab] = {
                data: [...this.data],
                currentPage: this.filter.currentPage,
                totalPages: this.totalPages,
            }

            if(this.tabData[tab]){
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

