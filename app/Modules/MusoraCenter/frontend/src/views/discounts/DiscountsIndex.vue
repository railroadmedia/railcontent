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
                        Discounts
                    </v-toolbar-title>
                    <v-spacer class="hidden-xs-only"></v-spacer>

                    <v-text-field
                        v-model="searchBuffer"
                        append-icon="search"
                        label="Search"
                        color="white"
                        single-line
                        hide-details
                        @keyup.enter="search()"
                    ></v-text-field>

                    <v-btn light @click="search()" class="ml-4">Search</v-btn>
                </v-toolbar>

                <v-data-table
                    :headers="headers"
                    :items="discounts"
                    :loading="loading"
                    class="elevation-1"
                    :search="searchTerm"
                    :items-per-page="15"
                    :page.sync="$_page"
                    must-sort
                    sort-desc
                    sort-by="attributes.created_at"
                >
                    <template v-slot:item="{ item }">
                        <tr style="cursor:pointer;">
                            <linkable-td
                                class="text-center"
                                :to="{ name: 'discounts.edit', params: { id: item.id }}">
                                {{ item.id }}
                            </linkable-td>

                            <linkable-td :to="{ name: 'discounts.edit', params: { id: item.id }}">
                                {{ item.attributes.name }}
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'discounts.edit', params: { id: item.id }}"
                            >
                                {{ item.relationships.product ? getRelatedAttributesByTypeAndId(
                                    item.relationships.product.data, state.includedData
                                ).attributes.name : 'N/A' }}
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'discounts.edit', params: { id: item.id }}"
                            >
                                {{ formatPrice(item.attributes.amount) }}
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'discounts.edit', params: { id: item.id }}"
                            >
                                <v-icon :color="item.attributes.active ? 'green' : 'red'">
                                    {{ item.attributes.active ? 'check_circle' : 'cancel' }}
                                </v-icon>
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'discounts.edit', params: { id: item.id }}"
                            >
                                <v-icon :color="item.attributes.visible ? 'green' : 'red'">
                                    {{ item.attributes.visible ? 'check_circle' : 'cancel' }}
                                </v-icon>
                            </linkable-td>

                            <linkable-td :to="{ name: 'discounts.edit', params: { id: item.id }}">
                                {{ moment(item.attributes.created_at).format('MM/DD/YYYY') }}
                            </linkable-td>
                        </tr>
                    </template>
                </v-data-table>
            </v-col>

            <v-row
                column
                class="floating-buttons"
            >
                <v-dialog
                    v-model="newDiscountDialog"
                    max-width="500px"
                >
                    <template v-slot:activator="{ on: dialog }">
                        <v-tooltip top>
                            <template v-slot:activator="{ on: tooltip }">
                                <v-btn
                                    fab
                                    color="success white--text"
                                    v-on="{...tooltip, ...dialog}"
                                >
                                    <v-icon>add</v-icon>
                                </v-btn>
                            </template>

                            <span>Add New Discount</span>
                        </v-tooltip>
                    </template>

                    <v-card>
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                        >
                            <v-toolbar-title>Add New Discount</v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            cols="12"
                            class="pa-4 column"
                        >
                            <discount-details
                                :key="state.currentDiscount.id"
                                @formSuccess="goToDiscount"
                                @cancelForm="resetForm"
                            />
                        </v-col>
                    </v-card>
                </v-dialog>
            </v-row>
        </v-row>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import DiscountDetails from './forms/DiscountDetails';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import LinkableTD from '../../components/LinkableTD';
import JsonApiMethods from '../../mixins/json-api-methods';
import Middleware from '../../middleware/auth';

export default {
    name: 'DiscountsIndex',
    components: {
        'discount-details': DiscountDetails,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'linkable-td': LinkableTD,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'discounts'); });
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
                    text: 'Discounts',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Id',
                    align: 'center',
                    sortable: true,
                    value: 'id',
                    width: 80,
                },
                {
                    text: 'Name',
                    align: 'left',
                    sortable: true,
                    value: 'attributes.name',
                },
                {
                    text: 'Product',
                    align: 'center',
                    sortable: false,
                    value: 'relationships.product',
                    width: 200,
                },
                {
                    text: 'Amount',
                    align: 'center',
                    sortable: true,
                    value: 'attributes.amount',
                    width: 100,
                },
                {
                    text: 'Active',
                    align: 'center',
                    sortable: false,
                    value: 'attributes.active',
                    width: 60,
                },
                {
                    text: 'Visible',
                    align: 'center',
                    sortable: false,
                    value: 'attributes.visible',
                    width: 60,
                },
                {
                    text: 'Created At',
                    align: 'left',
                    sortable: true,
                    value: 'attributes.created_at',
                    width: 120,
                },
            ],
            loading: false,
            newDiscountDialog: false,
            currentPage: 1,
            totalPages: 0,
            searchTerm: '',
            searchBuffer: '',
        };
    },
    computed: {
        ...mapState({
            state: state => state.discounts,
            auth: state => state.auth,
        }),

        discounts() {
            return this.state.discounts;
        },

        $_page: {
            get() {
                return this.currentPage;
            },
            set(val) {
                this.currentPage = val;

                this.updateUrl();
            },
        },

        $_searchTerm: {
            get() {
                return this.searchTerm;
            },
            set(val) {
                this.searchTerm = val;

                this.updateUrl();
            },
        },
    },
    methods: {
        ...mapActions('discounts', [
            'getDiscounts',
            'setCurrentDiscount',
        ]),

        resetForm() {
            this.newDiscountDialog = false;

            this.setCurrentDiscount({ id: 0, attributes: {}, relationships: { product: { data: {} } } });
        },

        goToDiscount({ id }) {
            this.$router.push({ name: 'discounts.edit', params: { id } });
        },

        formatPrice(price) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
            }).format(price);
        },

        updateUrl() {
            const query = {};

            if (this.$_page != 1) {
                query.page = this.$_page;
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

        search() {
            this.searchTerm = this.searchBuffer;
            this.updateUrl();
        },
    },
    mounted() {
        this.resetForm();

        this.loading = true;

        this.getDiscounts({ page: 1, limit: 1000 })
            .then(() => {
                this.loading = false;
                this.$nextTick(() => {
                    const searched = this.$route.query.search;
                    const paged = this.$route.query.page;

                    if (searched) {
                        this.searchTerm = searched;
                    }

                    if (paged) {
                        this.$_page = Number(paged);
                    }
                });
            });
    },
};
</script>
<style>
</style>
