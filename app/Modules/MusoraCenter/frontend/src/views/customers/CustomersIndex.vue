<template>
    <v-container>
        <v-scale-transition mode="out-in">
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

                <v-col class="column" cols="12">

                    <last-visited-users></last-visited-users>
                </v-col>

                <v-col
                    class="column"
                    cols="12"
                >
                    <v-toolbar
                        flat
                        dark
                        :color="brandColor"
                    >
                        <v-toolbar-title class="mr-4">
                            Customers
                        </v-toolbar-title>
                        <v-spacer class="hidden-xs-only"></v-spacer>

                        <v-col>
                            <v-text-field
                                v-model="searchTerm"
                                label="Search by email"
                                color="white"
                                append-icon="search"
                                :loading="searchLoading"
                                single-line
                                clearable
                                hide-details
                                @keyup.enter="getCustomers()"
                            ></v-text-field>
                        </v-col>
                        <v-btn light @click="getCustomers()">Search</v-btn>
                    </v-toolbar>
                    <v-data-table
                        :headers="headers"
                        :items="customers"
                        hide-default-footer
                        class="elevation-1"
                        :items-per-page="20"
                        :loading="loading"
                    >
                        <template v-slot:item="{ item }">
                            <tr style="cursor:pointer;">
                                <linkable-td
                                    class="text-center"
                                    :to="{ name: 'customers.edit', params: { id: item.id }}"
                                >
                                    <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                                </linkable-td>

                                <linkable-td
                                    class="text-center"
                                    :to="{ name: 'customers.edit', params: { id: item.id }}"
                                >
                                    {{ item.id }}
                                </linkable-td>

                                <linkable-td :to="{ name: 'customers.edit', params: { id: item.id }}">
                                    {{ item.attributes.email }}
                                </linkable-td>

                                <linkable-td
                                    class="text-center"
                                    :to="{ name: 'customers.edit', params: { id: item.id }}"
                                >
                                    {{ moment(item.attributes.created_at).format('MM/DD/YYYY') }}
                                </linkable-td>
                            </tr>
                        </template>
                    </v-data-table>

                    <div
                        v-if="totalPages > 1"
                        class="text-center"
                    >
                        <v-pagination
                            v-model="page"
                            :length="totalPages"
                            :color="brandColor"
                            :total-visible="9"
                        ></v-pagination>
                    </div>
                </v-col>
            </v-row>
        </v-scale-transition>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import api from '../../api/users';
import UserHistory from '../users/UserHistory';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import LinkableTD from '../../components/LinkableTD';
import Middleware from '../../middleware/auth';
import CustomBrandIcon from '../../components/CustomBrandIcon.vue';

export default {
    name: 'CustomersIndex',
    components: {
        'user-history': UserHistory,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'v-custom-brand-icon': CustomBrandIcon,
        'linkable-td': LinkableTD,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'customers'); });
    },
    data() {
        return {
            loading: false,
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Customers',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    value: 'attributes.brand',
                    width: 100,
                },
                {
                    text: 'ID',
                    align: 'center',
                    sortable: false,
                    value: 'id',
                    width: 100,
                },
                {
                    text: 'Email',
                    align: 'left',
                    sortable: false,
                    value: 'attributes.email',
                },
                {
                    text: 'Customer Since',
                    align: 'center',
                    sortable: false,
                    value: 'created_at',
                    width: 150,
                },
            ],
            customers: [],
            currentPage: this.$route.query.page ? Number(this.$route.query.page) : 1,
            totalPages: 0,
            newUserDialog: false,
            searchTerm: this.$route.query.search || '',
            searchTimeout: null,
            searchLoading: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
            auth: state => state.auth,
        }),
        page: {
            get() {
                return this.currentPage;
            },
            set(val) {
                this.currentPage = val;
                this.getCustomers();
            },
        },
    },
    mounted() {
        this.getCustomers();
    },
    methods: {
        ...mapActions('users', [
            'getUsers',
        ]),

        getCustomers() {
            this.loading = true;
            this.updateUrl();

            api.getCustomers({
                page: this.page,
                term: this.searchTerm,
            })
                .then((response) => {
                    if (response) {
                        this.customers = response.data.data;
                        this.totalPages = response.data.meta.pagination.total_pages;
                    }

                    this.loading = false;
                });
        },

        updateUrl() {
            const query = {};

            if (this.page != 1) {
                query.page = this.page;
            }

            if (this.searchTerm) {
                query.search = this.searchTerm;
            }

            const urlParams = new URLSearchParams(query);

            let queryString = urlParams.toString().length ? `?${urlParams.toString()}` : '';

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}${queryString}`,
            );
        },
    },
};
</script>
