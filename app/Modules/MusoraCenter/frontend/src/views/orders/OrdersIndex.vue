<template>
    <v-container>
        <v-row align="center">
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
                    style="height: auto"
                    extension-height="auto"

                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        Orders
                    </v-toolbar-title>

                  <template v-slot:extension>
                    <v-container class="pa-0">
                      <v-row class="pa-2 pb-0 pt-0">
                        <v-col cols="12" md="4" sm="12" class="pt-0">
                          <v-menu
                              ref="startDatePicker"
                              v-model="startDatePicker"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              transition="scale-transition"
                              offset-y
                              min-width="290px"
                          >
                            <template v-slot:activator="{ on }">
                              <v-text-field
                                  slot="activator"
                                  v-model="startDate"
                                  label="Start Date"
                                  color="white"
                                  single-line
                                  clearable
                                  v-on="on"
                                  @keyup.enter="getOrders()"
                              ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="startDate"
                                no-title
                                scrollable
                            >
                              <v-spacer></v-spacer>
                              <v-btn
                                  text
                                  :color="brandColor"
                                  @click="startDatePicker = false"
                              >
                                Cancel
                              </v-btn>
                              <v-btn
                                  text
                                  :color="brandColor"
                                  @click="startDatePicker = false"
                              >
                                OK
                              </v-btn>
                            </v-date-picker>
                          </v-menu>
                        </v-col>
                        <v-col class="pt-0">
                          <v-menu
                              cols="12" md="4" sm="12"
                              ref="endDatePicker"
                              v-model="endDatePicker"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              transition="scale-transition"
                              offset-y
                              min-width="290px"
                          >
                            <template v-slot:activator="{ on }">
                              <v-text-field
                                  slot="activator"
                                  v-model="endDate"
                                  label="End Date"
                                  color="white"
                                  single-line
                                  clearable
                                  v-on="on"
                                  @keyup.enter="getOrders()"
                              ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="endDate"
                                no-title
                                scrollable
                            >
                              <v-spacer></v-spacer>
                              <v-btn
                                  text
                                  :color="brandColor"
                                  @click="endDatePicker = false"
                              >
                                Cancel
                              </v-btn>
                              <v-btn
                                  text
                                  :color="brandColor"
                                  @click="endDatePicker = false"
                              >
                                OK
                              </v-btn>
                            </v-date-picker>
                          </v-menu>
                        </v-col>
                        <v-col cols="12" md="4" sm="12" class="mb-1 pt-0">
                          <v-btn light @click="getOrders()">Search</v-btn>
                        </v-col>
                      </v-row>
                    </v-container>
                  </template>
                </v-toolbar>

                <v-data-table
                    :headers="headers"
                    :items="ordersData"
                    :loading="loading"
                    mobile-breakpoint="0"
                    hide-default-footer
                    class="elevation-1"
                    :items-per-page="20"
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <linkable-td
                                class="text-center"
                                :to="{ name: 'orders.edit', params: { id: item.id }}"
                            >
                                {{ item.id }}
                            </linkable-td>

                            <linkable-td :to="{ name: 'orders.edit', params: { id: item.id }}">
                                {{ getUserEmail(item) }}
                            </linkable-td>

                            <td>
                                {{ getType(item) }}
                            </td>

                            <linkable-td :to="{ name: 'orders.edit', params: { id: item.id }}">
                                <ul
                                    class="pa-0"
                                    style="list-style-type:none;"
                                >
                                    <li v-for="orderItem in item.relationships.orderItem.data">
                                        <!-- TODO: fucking lol -->
                                        {{ getOrderProducts(orderItem) }}
                                    </li>
                                </ul>
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'orders.edit', params: { id: item.id }}"
                            >
                                {{ Number(item.attributes.total_due || 0).toFixed(2) }}
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'orders.edit', params: { id: item.id }}"
                            >
                                {{ Number(item.attributes.total_paid || 0).toFixed(2) }}
                            </linkable-td>

                            <linkable-td
                                class="text-center"
                                :to="{ name: 'orders.edit', params: { id: item.id }}"
                            >
                                {{ moment.tz(item.attributes.created_at, 'UTC').tz("America/Los_Angeles").format('MMM D, Y - h:mm A') }}
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
    </v-container>
</template>
<script>
import { mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import api from '../../api/ecommerce/orders';
import LinkableTD from '../../components/LinkableTD';
import JsonApiMethods from '../../mixins/json-api-methods';
import Middleware from '../../middleware/auth';

export default {
    name: 'OrdersIndex',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'linkable-td': LinkableTD,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'orders'); });
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
                    text: 'Orders',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'ID',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Email',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Type',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Products',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Total Due',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Total Paid',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Ordered On',
                    align: 'center',
                    sortable: false,
                },
            ],
            startDatePicker: false,
            endDatePicker: false,
            startDate: '',
            endDate: '',
            ordersData: [],
            includedOrdersData: [],
            currentPage: 1,
            totalPages: 0,
            dateTimeout: null,
        };
    },
    computed: {
        ...mapState({
            auth: state => state.auth,
        }),

        page: {
            get() {
                return this.currentPage;
            },
            set(val) {
                this.currentPage = val;
                this.getOrders();
            },
        },

    },
    mounted() {
        this.currentPage = this.$route.query.page ? Number(this.$route.query.page) : 1;
        this.startDate = this.$route.query['start-date'] ||
            this.moment(this.moment.now()).subtract(1, 'week').format('YYYY-MM-DD');

        this.endDate = this.$route.query['end-date'] ||
            this.moment(this.moment.now()).add(1, 'days').format('YYYY-MM-DD');

        this.getOrders();
    },
    methods: {
        getOrders() {
            this.loading = true;

            this.updateUrl();

            api.getUserOrderHistory({
                page: this.currentPage,
                start_date: this.startDate,
                end_date: this.endDate,
            })
                .then((response) => {
                    if (response) {
                        this.ordersData = response.data.data;
                        this.includedOrdersData = response.data.included;
                        this.totalPages = response.data.meta.pagination.total_pages;
                    }

                    this.loading = false;
                });
        },

        getUserEmail(item){
            const userType = item.relationships.customer ? 'customer' : 'user';

            console.log(this.getRelatedAttributesByTypeAndId(
                item.relationships[userType].data,
                this.includedOrdersData
            ));

            return this.getRelatedAttributesByTypeAndId(
                item.relationships[userType].data,
                this.includedOrdersData
            ).attributes.email || 'N/A';
        },

        getType(item) {
            return item.relationships.customer ? 'customer/guest' : 'user';
        },

        getOrderProducts(item){
            const orderItem = this.getRelatedAttributesByTypeAndId(item, this.includedOrdersData);

            if(orderItem.relationships){
                return this.getRelatedAttributesByTypeAndId(
                    orderItem.relationships.product.data,
                    this.includedOrdersData,
                ).attributes.name || 'N/A';
            }

            return 'N/A';
        },

        updateUrl() {
            const query = {};

            if (this.page != 1) {
                query.page = this.page;
            }

            if (this.startDate) {
                query['start-date'] = this.startDate;
            }

            if (this.endDate) {
                query['end-date'] = this.endDate;
            }

            const urlParams = new URLSearchParams(query);

            let queryString = urlParams.toString().length ? `?${urlParams.toString()}` : '';

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}${queryString}`,
            );
        }
    },
};
</script>
