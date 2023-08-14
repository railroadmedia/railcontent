<template>
    <v-container>
        <v-row
            
            align="center"
        >
            <v-col
                class="column"
                cols="12"
            >
                <v-custom-breadcrumbs
                    :breadcrumbs="breadcrumbs"
                ></v-custom-breadcrumbs>
            </v-col>

            <v-row justify="center">
                <v-col
                    class="column"
                    cols="2"
                >
                    <v-text-field
                        v-model="term"
                        label="Search"
                        :color="brandColor"
                        clearable
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-col
                class="column mt-2"
                cols="12"
            >
                <div class="text-center mb-2">
                    <v-pagination
                        v-model="page"
                        :length="state.totalPages"
                        :color="brandColor"
                        :total-visible="9"
                        v-if="!searchState"
                    ></v-pagination>

                    <v-pagination
                        v-model="searchPage"
                        :length="searchedTotoalPages"
                        :color="brandColor"
                        :total-visible="9"
                        v-if="searchState"
                    ></v-pagination>
                </div>

                <v-toolbar
                    text
                    dark
                    extended
                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        {{ toCapitalCase(state.brand) }} Content {{ searchState ? 'Search Results' : '' }}
                    </v-toolbar-title>
                    <v-spacer class="hidden-xs-only"></v-spacer>
                    <v-toolbar-items>
                        <v-tooltip left v-if="!searchState">
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    icon
                                    v-on="on"
                                    @click="openFeaturedContent"
                                >
                                    <v-icon>featured_play_list</v-icon>
                                </v-btn>
                            </template>

                            <span>Featured Content</span>
                        </v-tooltip>
                    </v-toolbar-items>

                    <template v-slot:extension>
                        <v-row class="px-2">
                            <v-col class="pl-1 xs6 sm4">
                                <v-autocomplete
                                    v-model="selectedType"
                                    label="Content Type"
                                    color="white"
                                    :items="availableContentTypes"
                                    item-text="label"
                                    item-value="type"
                                    clearable
                                    @change="handleChange(currentPage)"
                                >
                                </v-autocomplete>
                            </v-col>
                            <v-spacer class="sm4 hidden-xs-only"></v-spacer>
                            <v-col class="pr-1 xs6 sm4">
                                <!--<v-text-field-->
                                <!--label="Search"-->
                                <!--color="white"-->
                                <!--append-icon="search"-->
                                <!--v-model="searchTerm"-->
                                <!--single-line-->
                                <!--clearable-->
                                <!--hide-details-->
                                <!--@change="handleChange()"></v-text-field>-->
                            </v-col>
                        </v-row>
                    </template>

                </v-toolbar>

                <v-data-table
                    :headers="headers"
                    :items="flattenedContent"
                    no-results-text="No Results Found"
                    hide-default-footer
                    :loading="state.loading || searchLoading || false"
                    class="elevation-1"
                    :items-per-page="20"
                >
                    <template
                        v-slot:item="{ item }"
                    >
                        <tr style="cursor:pointer;">
                            <linkable-td
                                class="text-center"
                                :to="{ name: 'content.edit', params: { brand: state.brand, type: item.type, id: item.id }}"
                            >
                                <content-status :status="item.status"></content-status>
                            </linkable-td>

                            <linkable-td
                                style="text-transform:capitalize;vertical-align:middle;"
                                :to="{ name: 'content.edit', params: { brand: state.brand, type: item.type, id: item.id }}"
                            >
                                <p style="margin:0;white-space:nowrap;">
                                    <v-avatar
                                        size="30"
                                        :color="brandColor"
                                        class="mr-2"
                                    >
                                        <v-icon
                                            size="14"
                                            dark
                                            style="vertical-align:middle;"
                                        >
                                            {{ getContentTypeIcon(item.type) }}
                                        </v-icon>
                                    </v-avatar>
                                    {{ item.type.replace(/-/g, ' ') }}
                                </p>
                            </linkable-td>

                            <linkable-td :to="{ name: 'content.edit', params: { brand: state.brand, type: item.type, id: item.id }}">
                                {{ getPostTitle(item) }}
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'content.edit', params: { brand: state.brand, type: item.type, id: item.id }}"
                            >
                                {{ getPublishedOn(item) }}
                            </linkable-td>
                        </tr>
                    </template>
                </v-data-table>

                <div class="text-center">
                    <v-pagination
                        v-model="page"
                        :length="state.totalPages"
                        :color="brandColor"
                        :total-visible="9"
                        v-if="!searchState"
                    ></v-pagination>

                    <v-pagination
                        v-model="searchPage"
                        :length="searchedTotoalPages"
                        :color="brandColor"
                        :total-visible="9"
                        v-if="searchState"
                    ></v-pagination>
                </div>
            </v-col>


            <v-row
                class="floating-buttons"
            >
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            v-on="on"
                            class="white--text"
                            fab
                            :color="brandColor"
                            @click="newDialog = true"
                        >
                            <v-icon>add</v-icon>
                        </v-btn>
                    </template>

                    <span>Create Post</span>
                </v-tooltip>
            </v-row>

            <v-dialog
                v-model="newDialog"
                max-width="500px"
                persistent
            >
                <create-content-form @closeDialog="closeDialog"></create-content-form>
            </v-dialog>
        </v-row>

        <v-dialog
            v-model="featuredDialog"
            max-width="640px"
        >
            <featured-content
                :featured-content="featuredContent"
                :featured-content-type="featuredContentType"
                :available-content-types="availableContentTypes"
                :loading="featuredLoading"
                @closeDialog="featuredDialog = false"
                @changeContentType="handleContentTypeChange"
                @refreshList="getFeaturedContent"
            />
        </v-dialog>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import { Content as ContentHelpers, Utils } from '@musora/helper-functions';
import { DateTime } from 'luxon';
import ContentStatus from './_ContentStatus';
import CreateContent from './forms/_CreateContent';
import brandColors from '../../api/mixins.js';
import api from '../../api/content';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LinkableTD from '../../components/LinkableTD';
import Middleware from '../../middleware/auth';
import FeaturedContent from './_FeaturedContent.vue';

export default {
    name: 'ContentIndex',
    components: {
        'content-status': ContentStatus,
        'create-content-form': CreateContent,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'linkable-td': LinkableTD,
        'featured-content': FeaturedContent,
    },
    mixins: [brandColors],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'users'); });
    },
    data() {
        return {
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: this.toCapitalCase(this.$route.params.brand),
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Status',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Type',
                    align: 'left',
                    sortable: false,
                    width: 200,
                },
                {
                    text: 'Title',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Publish Date',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
            ],
            searchTerm: this.$route.query.term || '',
            searchDebounce: null,
            searchState: false,
            selectedType: this.$route.query.type || null,
            newSelectedType: null,
            newPostTitle: null,
            contentTypes: [
                {
                    key: 'All',
                    value: null,
                },
                {
                    key: 'Courses',
                    value: 'course',
                },
            ],
            currentPage: this.$route.query.page || 1,
            newDialog: false,
            featuredDialog: false,
            featuredContentType: this.$route.query.type || null,
            featuredContent: [],
            featuredLoading: false,
            searchedContent: [],
            currentSearchPage: this.$route.query.page || 1,
            searchedTotoalPages: 0,
            searchLoading: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
            auth: state => state.auth,
        }),

        flattenedContent() {
            if (this.searchState) {
                return this.searchedContent;
            } else {
                return this.state.content;
            }
        },

        availableContentTypes() {
            if (this.searchState) {
                return Utils.dynamicSort(api.getBrandSearchableContentTypes(this.state.brand), 'label');
            }

            return Utils.dynamicSort(ContentHelpers.getBrandSpecificTopLevelContentTypes(this.state.brand), 'label');
        },

        availableContentTypesValues() {
            return this.availableContentTypes.map(type => type.type);
        },

        parsedSelectedType() {
            return this.selectedType || '';
        },

        page: {
            get() {
                return Number(this.currentPage);
            },
            set(val) {
                this.currentPage = val;

                this.handleChange(this.currentPage);
            },
        },

        searchPage: {
            get() {
                return Number(this.currentSearchPage);
            },
            set(val) {
                this.currentSearchPage = val
                this.updateSearchState();
            },
        },

        term: {
            get() {
                return this.searchTerm;
            },
            set(val) {
                this.searchTerm = val;
                this.currentSearchPage = 1;

                clearTimeout(this.searchDebounce);

                this.searchDebounce = setTimeout(() => {
                    this.updateSearchState(1);
                }, 500);
            },
        },
    },
    methods: {
        ...mapActions('content', [
            'getContent',
            'getBrand',
        ]),

        getPublishedOn(item) {
            const dt = DateTime.fromSQL(item.published_on, { zone: 'utc' });
            return dt.setZone('America/Los_Angeles').toFormat('LLL dd, yyyy');
        },

        toCapitalCase: string => Utils.toCapitalCase(string),

        getContentTypeIcon: type => ContentHelpers.getContentTypeIcon(type),

        getParsedContentType(type) {
            return Utils.toCapitalCase(type ? type.replace(/-/g, ' ') : '');
        },

        getPostTitle(post) {
            if (post.type === 'instructor') {
                return post.name ? post.name.value : '';
            }

            return post.title ? post.title.value : '';
        },

        handleChange(page = 1) {
            const query = {};

            if (this.selectedType) {
                query.type = this.selectedType;
            }

            this.featuredContentType = this.selectedType || null;

            this.currentPage = page;
            query.page = page;

            const urlParams = new URLSearchParams(query);

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}?${urlParams.toString()}`,
            );

            this.getContent({
                brand: this.state.brand,
                page: this.currentPage,
                included_types: this.selectedType != null ? [this.selectedType] : this.availableContentTypesValues,
                statuses: ['draft', 'scheduled', 'published'],
                sort: '-published_on'
            });

            this.updateSearchContent();
        },

        goToPost(post) {
            this.$router.push({
                name: 'content.edit',
                params: {
                    brand: this.state.brand,
                    id: post.id,
                },
            });
        },

        closeDialog() {
            this.newDialog = false;
            this.newPostTitle = null;
        },

        openFeaturedContent() {
            this.getFeaturedContent();

            this.featuredDialog = true;
        },

        getFeaturedContent() {
            const fieldToUse = this.featuredContentType ? 'staff_pick_rating' : 'home_staff_pick_rating';

            this.featuredLoading = true;

            api.getContent({
                brand: this.state.brand,
                required_fields: [`${fieldToUse},0,integer,>`],
                included_types: this.featuredContentType ? [this.featuredContentType] : undefined,
            })
                .then((response) => {
                    if (response) {
                        this.featuredContent = ContentHelpers
                            .flattenContent(response.data.data)
                            .sort((a, b) => a[fieldToUse].value - b[fieldToUse].value);
                    }

                    this.featuredLoading = false;
                });
        },

        handleContentTypeChange(payload) {
            this.featuredContentType = payload || null;
            this.getFeaturedContent();

            this.$nextTick(() => {
                this.$forceUpdate();
            });
        },

        updateSearchState() {

            let newSearchState = this.searchTerm != '' && this.searchTerm != null;

            if (this.searchState != newSearchState) {
                if (newSearchState) {
                    this.searchState = true;
                } else {
                    this.searchState = false;
                }
            }

            const query = {};

            if (this.selectedType) {
                query.type = this.selectedType;
            }

            if (this.searchTerm) {
                query.term = this.searchTerm;
            }

            query.page = this.searchState ? this.currentSearchPage : this.currentPage;

            const urlParams = new URLSearchParams(query);

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}?${urlParams.toString()}`,
            );

            this.updateSearchContent();
        },

        updateSearchContent() {
            if (this.searchState) {
                this.searchLoading = true;
                api
                    .getSearchedContent({
                        brand: this.state.brand,
                        term: this.searchTerm,
                        included_types: this.selectedType != null ? [this.selectedType] : this.availableContentTypesValues,
                        page: this.currentSearchedPage || 1,
                        statuses: ['draft', 'scheduled', 'published']
                    })
                    .then((response) => {
                        this.searchLoading = false;
                        if (response) {
                            this.searchedContent = ContentHelpers.flattenContent(response.data.data);
                            this.searchedPage = response.data.meta.page;
                            this.searchedTotoalPages = Math.ceil(response.data.meta.totalResults / response.data.meta.limit);
                        }
                    });
            }
        },
    },
    mounted() {
        this.getBrand({
            router: this.$route,
        });

        this.getContent({
            brand: this.state.brand,
            page: this.currentPage,
            included_types: this.selectedType != null ? [this.selectedType] : this.availableContentTypesValues,
            statuses: ['draft', 'scheduled', 'published'],
            sort: '-published_on'
        });

        this.updateSearchState();
    },
};
</script>
