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
                <last-visited-users></last-visited-users>
            </v-col>

            <v-col
                class="column"
                cols="12"
            >
                <v-btn
                    text
                    href="/admin/download-drumeo-magazine-shipments"
                    class="primary"
                >
                    Export Drumeo Magazine List
                </v-btn>
            </v-col>

            <v-col
                class="column"
                cols="12"
            >
                <div class="text-center mb-2">
                    <v-pagination
                        v-model="$_page"
                        :length="totalPages"
                        :color="brandColor"
                        :total-visible="9"
                    ></v-pagination>
                </div>

                <v-toolbar
                    flat
                    dark
                    extended
                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        Shipping Fulfillment
                    </v-toolbar-title>
                    <v-spacer class="hidden-xs-only"></v-spacer>

                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn
                                text
                                icon
                                v-on="on"
                                @click="uploadDialog = !uploadDialog"
                            >
                                <v-icon>note_add</v-icon>
                            </v-btn>
                        </template>

                        <span>Fulfill Orders via CSV</span>
                    </v-tooltip>

                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn
                                text
                                icon
                                download
                                :href="csvDownloadUrl"
                                v-on="on"
                            >
                                <v-icon>cloud_download</v-icon>
                            </v-btn>
                        </template>

                        <span>Export Pending as CSV</span>
                    </v-tooltip>

                    <template v-slot:extension>
                        <v-row class="px-2">
                            <v-col class="px-0">
                                <v-text-field
                                    v-model="orderId"
                                    append-icon="search"
                                    label="Search by Order ID"
                                    color="white"
                                    single-line
                                    clearable
                                    hide-details
                                    @keyup.enter="fetchData()"
                                ></v-text-field>
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col>
                                <v-menu
                                    ref="startDatePicker"
                                    v-model="startDatePicker"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            slot="activator"
                                            label="Start Date"
                                            color="white"
                                            :value="moment(startDate).format('MMM DD, YYYY')"
                                            single-line
                                            readonly
                                            v-on="on"
                                            @keyup.enter="fetchData()"
                                        ></v-text-field>
                                    </template>

                                    <v-date-picker
                                        v-model="startDate"
                                        no-title
                                        scrollable
                                    ></v-date-picker>
                                </v-menu>
                            </v-col>

                            <v-col style="flex-basis:60px;max-width:60px;">
                                <v-icon class="mx-4">
                                    arrow_right_alt
                                </v-icon>
                            </v-col>

                            <v-col>
                                <v-menu
                                    ref="endDatePicker"
                                    v-model="endDatePicker"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            slot="activator"
                                            label="End Date"
                                            color="white"
                                            :value="moment(endDate).format('MMM DD, YYYY')"
                                            single-line
                                            readonly
                                            v-on="on"
                                            @keyup.enter="fetchData()"
                                        ></v-text-field>
                                    </template>

                                    <v-date-picker
                                        v-model="endDate"
                                        no-title
                                        scrollable
                                    ></v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-btn
                                light
                                class="mt-2"
                                @click="fetchData()"
                            >
                                Search
                            </v-btn>
                        </v-row>
                    </template>
                </v-toolbar>

                <v-dialog
                    v-model="uploadDialog"
                    max-width="500px"
                    persistent
                >
                    <v-card>
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                        >
                            <v-toolbar-title>Upload CSV</v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            cols="12"
                            class="pa-4 column"
                        >
                            <ul class="error--text">
                                <li
                                    v-for="(error, i) in csvErrors"
                                    :key="`csv-error-${i}`"
                                    class="mb-2"
                                >
                                    {{ error }}
                                </li>
                            </ul>

                            <v-form ref="uploadCSV">
                                <v-text-field
                                    ref="csvInput"
                                    label="CSV File"
                                    :color="brandColor"
                                    type="file"
                                ></v-text-field>

                                <div class="text-right">
                                    <v-btn
                                        text
                                        class="mr-1"
                                        @click="cancelUploadDialog"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                        class="white--text"
                                        :color="brandColor"
                                        @click="uploadCSV"
                                    >
                                        Save
                                    </v-btn>
                                </div>
                            </v-form>
                        </v-col>
                    </v-card>
                </v-dialog>

                <v-data-table
                    :headers="headers"
                    :items="shippingFulfillments"
                    :loading="loading"
                    :items-per-page="15"
                    :sort-by.sync="$_order_by_column"
                    :sort-desc.sync="$_order_by_direction"
                    class="elevation-1"
                    no-results-text="No Results Found"
                    hide-default-footer
                    :multi-sort="false"
                    :must-sort="true"
                >
                    <template v-slot:item="{ item }">
                        <tr
                            style="cursor:pointer;"
                            @click="showFulfillmentDetails(item.id)"
                        >
                            <td class="text-center">
                                {{ moment(item.attributes.created_at).format('MMM DD, YYYY') }}
                            </td>
                            <td class="text-center">
                                {{ item.id }}
                            </td>
                            <td class="text-center">
                                {{ item.relationships.order.data.id }}
                            </td>
                            <td>
                                {{ getShippingUser(item) }}
                            </td>
                            <td class="text-center">
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-icon
                                            slot="activator"
                                            :color="item.attributes.status === 'fulfilled' ? 'success' : 'warning'"
                                            v-on="on"
                                        >
                                            {{ item.attributes.status === 'fulfilled' ? 'check' : 'more' }}
                                        </v-icon>
                                    </template>

                                    <span>{{ item.attributes.status }}</span>
                                </v-tooltip>
                            </td>
                            <td class="text-center">
                                {{ item.attributes.fulfilled_on ?
                                    moment(item.attributes.fulfilled_on).format('MMM DD, YYYY') :
                                    'N/A' }}
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-col>

            <v-dialog
                v-model="dialog"
                max-width="750"
            >
                <v-card v-if="selectedFulfillment">
                    <v-toolbar
                        flat
                        dark
                        :color="brandColor"
                    >
                        <v-toolbar-title class="mr-4">
                            Order: {{ selectedFulfillment.id }}
                        </v-toolbar-title>

                        <v-spacer></v-spacer>

                        <v-toolbar-items>
                            <v-tooltip left>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        icon
                                        text
                                        v-on="on"
                                        @click="deleteFulfillment"
                                    >
                                        <v-icon>delete</v-icon>
                                    </v-btn>
                                </template>

                                <span>Delete Fulfillment</span>
                            </v-tooltip>
                        </v-toolbar-items>
                    </v-toolbar>

                    <v-row class="pa-4 mr-0 ml-0">
                        <v-col
                            cols="12"
                            sm="6"
                            class="pa-1"
                        >
                            <v-card>
                                <v-card-title>
                                    <h4>
                                        Order Data
                                    </h4>
                                </v-card-title>
                                <v-divider></v-divider>
                                <v-list dense>
                                    <v-list-item>
                                        <v-list-item-content>Order ID:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillment.relationships.order.data.id }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>SKU:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ getRelatedAttributesByTypeAndId(
                                                selectedFulfillmentOrderItem.relationships.product.data,
                                                shippingFulfillmentsIncludedData,
                                            ).attributes.sku }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Ordered On:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ moment(
                                                selectedFulfillment.attributes.created_at
                                            ).format('MMM DD, YYYY') }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Total Cost:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ formatPrice(selectedFulfillmentOrderItem.attributes.final_price) }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>User Email:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ getShippingUser(selectedFulfillment) }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Status:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillment.attributes.status }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-text-field
                                            v-model="$_tracking_number"
                                            label="Tracking Number"
                                            color="white"
                                            :disabled="selectedFulfillment.attributes.status === 'fulfilled'"
                                            :color="brandColor"
                                            single-line
                                        ></v-text-field>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-text-field
                                            v-model="$_shipping_company"
                                            label="Company"
                                            color="white"
                                            :color="brandColor"
                                            :disabled="selectedFulfillment.attributes.status === 'fulfilled'"
                                            single-line
                                        ></v-text-field>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content class="align-end">
                                            <v-btn
                                                :color="brandColor"
                                                :disabled="shippingCompany == null || trackingNumber == null"
                                                @click="fulfillOrderItem"
                                            >
                                                Fulfill Order Item
                                            </v-btn>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-card>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            class="pa-1"
                        >
                            <v-card>
                                <v-card-title>
                                    <h4>Shipping Data</h4>
                                </v-card-title>
                                <v-divider></v-divider>
                                <v-list dense>
                                    <v-list-item>
                                        <v-list-item-content>First Name:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.first_name }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Last Name:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.last_name }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Street Line 1:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.street_line_1 }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Street Line 2:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.street_line_2 }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Zip/Postal Code:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.zip }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>City:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.city }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Region:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.region }}
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>Country:</v-list-item-content>
                                        <v-list-item-content class="align-end">
                                            {{ selectedFulfillmentShippingAddress.attributes.country }}
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-card>
                        </v-col>
                    </v-row>

                    <v-col class="text-right pa-4">
                        <v-btn
                            text
                            class="mt-4"
                            @click="dialog = false"
                        >
                            Close
                        </v-btn>
                    </v-col>
                </v-card>
            </v-dialog>
        </v-row>
    </v-container>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import axios from 'axios';
import brandColors from '../../api/mixins.js';
import UploadCSV from './forms/UploadCSV.vue';
import DownloadCSV from './forms/DownloadCSV.vue';
import api from '../../api/ecommerce/shipping.js';
import Middleware from '../../middleware/auth';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import JsonApiMethods from '../../mixins/json-api-methods';
import JsonApiCollectionMethods from '../../mixins/json-api-collection-methods';

export default {
    name: 'ShippingFulfillmentIndex',
    components: {
        'upload-csv': UploadCSV,
        'download-csv': DownloadCSV,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors, JsonApiMethods, JsonApiCollectionMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'shipping-fulfillment'); });
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
                    text: 'Shipping Fulfillment',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Created At',
                    align: 'center',
                    sortable: true,
                    width: 150,
                    value: 'created_at',
                },
                {
                    text: 'Fullfillment ID',
                    align: 'center',
                    sortable: true,
                    value: 'id',
                },
                {
                    text: 'Order ID',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'User',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Status',
                    align: 'center',
                    sortable: true,
                    value: 'status',
                },
                {
                    text: 'Fulfilled On',
                    align: 'center',
                    sortable: true,
                    value: 'updated_at',
                },
            ],
            loading: false,
            dialog: false,
            uploadDialog: false,
            downloadDialog: false,
            selectedFulfillment: null,
            shippingFulfillments: [],
            shippingFulfillmentsIncludedData: [],
            endDatePicker: null,
            startDatePicker: null,
            endDate: '',
            startDate: '',
            trackingNumber: null,
            shippingCompany: null,
            csvErrors: [],
            orderId: '',
            orderIdSearch: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.shipping,
            auth: state => state.auth,
        }),

        $_tracking_number: {
            get() {
                return this.selectedFulfillment.attributes.tracking_number || this.trackingNumber;
            },
            set(value) {
                this.trackingNumber = value;
            },
        },

        $_shipping_company: {
            get() {
                return this.selectedFulfillment.attributes.company || this.shippingCompany;
            },
            set(value) {
                this.shippingCompany = value;
            },
        },

        selectedFulfillmentShippingAddress() {
            if (this.selectedFulfillment == null) {
                return { attributes: {}, relationships: {} };
            }

            return this.getRelatedAttributesByTypeAndId(
                this.getRelatedAttributesByTypeAndId(
                    this.selectedFulfillment.relationships.order.data,
                    this.shippingFulfillmentsIncludedData,
                ).relationships.shippingAddress.data,
                this.shippingFulfillmentsIncludedData,
            );
        },

        selectedFulfillmentOrderItem() {
            if (this.selectedFulfillment == null) {
                return { attributes: {}, relationships: {} };
            }

            return this.getRelatedAttributesByTypeAndId(
                this.selectedFulfillment.relationships.orderItem.data,
                this.shippingFulfillmentsIncludedData,
            );
        },

        csvDownloadUrl() {
            return axios.getUri({
                url: '/ecommerce/fulfillment',
                params: {
                    order_by_column: 'created_at',
                    order_by_direction: 'desc',
                    small_date_time: `${this.startDate} 00:00:00`,
                    big_date_time: `${this.endDate} 23:59:59`,
                    csv: 1,
                    status: ['pending'],
                },
            });
        },
    },
    methods: {
        ...mapActions('shipping', [
            'getShippingFulfillments',
        ]),

        showFulfillmentDetails(id) {
            this.selectedFulfillment = this.shippingFulfillments.find(item => item.id === id);
            this.dialog = true;
            this.trackingNumber = null;
            this.shippingCompany = null;
        },

        fetchData() {
            this.updateUrl();
            this.getShippingFulfillments();
        },

        getShippingFulfillments() {
            this.loading = true;

            let startDate = `${this.startDate} 00:00:00`;
            let endDate = `${this.endDate} 00:00:00`;

            if (this.orderId !== '') {
                startDate = '';
                endDate = '';
            }

            api.getShippingFulfillments({
                start_date: startDate,
                end_date: endDate,
                order_id: this.orderId,
                page: this.page,
                order_by_column: this.order_by_column,
                order_by_direction: this.order_by_direction,
            })
                .then((response) => {
                    if (response) {
                        this.shippingFulfillments = response.data.data;
                        this.shippingFulfillmentsIncludedData = response.data.included;
                        this.page = response.data.meta.pagination.current_page;
                        this.totalPages = response.data.meta.pagination.total_pages;
                    }

                    this.loading = false;
                });
        },

        fulfillOrderItem() {
            this.$root.$emit('pageLoading');

            api.fulfillOrderItem({
                tracking_number: this.$_tracking_number,
                shipping_company: this.$_shipping_company,
                fulfilled_on: this.moment(this.moment.now()).format('YYYY-MM-DD HH:mm:ss'),
                order_item_id: this.selectedFulfillmentOrderItem.id,
                order_id: this.selectedFulfillment.relationships.order.data.id,
            })
                .then((response) => {
                    if (response) {
                        this.dialog = false;

                        this.getShippingFulfillments();
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        uploadCSV() {
            const { csvInput } = this.$refs;
            const inputElement = csvInput.$el.querySelector('input[type="file"]');
            const thisFile = inputElement.files[0];

            const formData = new FormData();

            this.$root.$emit('pageLoading');

            formData.append('csv_file', thisFile);

            api.fulfillOrdersViaCSV(formData)
                .then((response) => {
                    if (response.errors) {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Oops! Something went wrong. Errors in the CSV file will be displayed in the dialog box',
                        });

                        this.csvErrors = response.errors;
                    } else {
                        this.uploadDialog = false;

                        this.getShippingFulfillments();

                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'CSV has been successfully uploaded and shipping has been fulfilled!',
                        });

                        this.csvErrors = [];
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        cancelUploadDialog() {
            const { csvInput } = this.$refs;
            const inputElement = csvInput.$el.querySelector('input[type="file"]');

            this.uploadDialog = false;
            this.csvErrors = [];

            this.$nextTick(() => this.$forceUpdate());
        },

        formatPrice(price) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
            }).format(price);
        },

        deleteFulfillment() {
            const confirmation = confirm('Are you sure you wish do delete this fulfillment?');

            if (confirmation) {
                api.deleteFulfillmentOrderItem(
                    this.selectedFulfillment.relationships.order.data.id,
                    this.selectedFulfillment.relationships.orderItem.data.id,
                )
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                color: 'success',
                                text: 'Fulfillment has successfully been deleted!',
                            });
                        } else {
                            this.$root.$emit('displayMessage', {
                                color: 'error',
                                text: 'Oops, something went wrong. Fulfillment likely not deleted.',
                            });
                        }

                        this.dialog = false;
                        this.getShippingFulfillments();
                    });
            }
        },

        getShippingUser(item) {
            const order = this.getRelatedAttributesByTypeAndId(
                item.relationships.order.data,
                this.shippingFulfillmentsIncludedData,
            );
            let user;

            if (order.relationships.user) {
                user = this.getRelatedAttributesByTypeAndId(
                    order.relationships.user.data,
                    this.shippingFulfillmentsIncludedData,
                );

                return user.attributes.email;
            }

            if (order.relationships.customer) {
                user = this.getRelatedAttributesByTypeAndId(
                    order.relationships.customer.data,
                    this.shippingFulfillmentsIncludedData,
                );

                return user.attributes.email;
            }

            return 'N/A';
        },

        updateUrl() {
            const query = {};

            if (this.$_page != 1) {
                query.page = this.$_page;
            }

            if (this.orderId) {
                query.order = this.orderId;
            }

            if (this.startDate) {
                query['start-date'] = this.startDate;
            }

            if (this.endDate) {
                query['end-date'] = this.endDate;
            }

            const urlParams = new URLSearchParams(query);

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}?${urlParams.toString()}`,
            );
        },
    },
    mounted() {
        this.page = this.$route.query.page ? Number(this.$route.query.page) : 1;
        this.orderId = this.$route.query.order || '';

        this.startDate = this.$route.query['start-date']
            || this.moment(this.moment.now()).subtract(1, 'months').format('YYYY-MM-DD');

        this.endDate = this.$route.query['end-date']
            || this.moment(this.moment.now()).add(1, 'day').format('YYYY-MM-DD');

        this.updateUrl();

        this.getShippingFulfillments();
    },
};
</script>
