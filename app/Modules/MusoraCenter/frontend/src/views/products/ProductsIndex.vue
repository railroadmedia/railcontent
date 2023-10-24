<template>
    <v-container>
        <v-row

            align="center"
        >
            <v-col
                class="column"
                cols="12"
            >
                <v-custom-breadcrumbs :breadcrumbs="breadcrumbs" />
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
                        Products
                    </v-toolbar-title>

                    <v-spacer class="hidden-xs-only" />

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
                    :items="state.products"
                    class="elevation-1"
                    :search="searchTerm"
                    :items-per-page="15"
                    :page.sync="$_page"
                    :loading="loading"
                    must-sort
                    sort-desc
                    sort-by="attributes.created_at"
                >
                    <template
                        v-slot:item="{ item }"
                    >
                        <tr style="cursor:pointer;">
                            <linkable-td
                                class="text-center"
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
                                <v-avatar size="36px">
                                    <img :src="item.attributes.thumbnail_url">
                                </v-avatar>
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
                                <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                            </linkable-td>

                            <linkable-td
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
                                {{ item.id }}
                            </linkable-td>


                            <linkable-td :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}">
                                {{ item.attributes.name }}
                            </linkable-td>

                            <linkable-td
                                class="caption"
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
                                {{ item.attributes.sku }}
                            </linkable-td>


                            <linkable-td
                                class="caption"
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
                                {{ item.attributes.fulfillment_sku }}
                            </linkable-td>

                            <linkable-td
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
                                {{ formatPrice(item.attributes.price) }}
                            </linkable-td>

                            <linkable-td
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
                                {{ item.attributes.stock }}
                            </linkable-td>

                            <linkable-td
                                :to="{ name: 'products.edit', params: { brand: state.brand, id: item.id }}"
                            >
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
                    v-model="dialog"
                    max-width="500px"
                >
                    <template v-slot:activator="{ on: menu }">
                        <v-tooltip
                            slot="activator"
                            top
                        >
                            <template v-slot:activator="{ on: tooltip }">
                                <v-btn
                                    fab
                                    color="success white--text"
                                    v-on="{ ...tooltip, ...menu }"
                                >
                                    <v-icon>add</v-icon>
                                </v-btn>
                            </template>

                            <span>Add New Product</span>
                        </v-tooltip>
                    </template>

                    <product-details-form
                        :key="state.currentProduct.id"
                        :this-product="state.currentProduct"
                        :is-new-product="true"
                        @formClosed="closeForm"
                    ></product-details-form>
                </v-dialog>
            </v-row>
        </v-row>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import brandColors from '../../api/mixins.js';
import Utils from '../../api/utils';
import api from '../../api/ecommerce/products';
import ProductDetailsForm from './forms/ProductDetailsForm.vue';
import LinkableTD from '../../components/LinkableTD';
import Middleware from '../../middleware/auth';
import CustomBrandIcon from '../../components/CustomBrandIcon.vue';

export default {
    components: {
        'product-details-form': ProductDetailsForm,
        'linkable-td': LinkableTD,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'products'); });
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
                    text: 'Products',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Thumb',
                    align: 'center',
                    sortable: false,
                    value: 'profile_picture_image_url',
                    width: 60,
                },
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    value: 'attributes.brand',
                    width: 60,
                },
                {
                    text: 'ID',
                    align: 'left',
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
                    text: 'Marketing SKU',
                    align: 'left',
                    sortable: true,
                    value: 'attributes.sku',
                    width: 200,
                },
                {
                    text: 'Inventory/Fulfillment Name',
                    align: 'left',
                    sortable: true,
                    value: 'attributes.fulfillment_sku',
                    width: 200,
                },
                {
                    text: 'Price',
                    align: 'left',
                    sortable: false,
                    value: 'attributes.price',
                    width: 80,
                },
                {
                    text: 'Stock (FN)',
                    align: 'left',
                    sortable: false,
                    value: 'attributes.price',
                    width: 100,
                },
                {
                    text: 'Created On',
                    align: 'left',
                    sortable: true,
                    value: 'attributes.created_at',
                    width: 150,
                },
            ],
            dialog: false,
            currentPage: 1,
            totalPages: 0,
            defaultProduct: {
                name: null,
                sku: null,
                fulfillment_sku: null,
                price: null,
                thumbnail_url: null,
                type: null,
                active: false,
                is_physical: false,
                weight: null,
                stock: null,
                subscription_interval_type: null,
                subscription_interval_count: null,
            },
            searchTerm: '',
            searchBuffer: '',
            loading: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.products,
            auth: state => state.auth,
        }),

        $_page: {
            get() {
                return this.currentPage;
            },
            set(val) {
                this.currentPage = val;

                this.updateUrl();
            },
        },
    },
    methods: {
        ...mapActions('products', [
            'getProducts',
            'setCurrentProduct',
        ]),

        goToProduct(id) {
            this.$router.push({ name: 'products.edit', params: { brand: this.state.brand, id } });
        },

        toCapitalCase: string => Utils.toCapitalCase(string),

        closeForm() {
            this.dialog = false;
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
        this.setCurrentProduct({ id: 0, attributes: {} });

        this.loading = true;

        this.getProducts()
            .then(() => {
                this.loading = false;
                this.$nextTick(() => {
                    const searched = this.$route.query.search;
                    const paged = this.$route.query.page;

                    if (searched) {
                        this.$_searchTerm = searched;
                    }

                    if (paged) {
                        this.$_page = Number(paged);
                    }
                });
            });
    },
};
</script>
