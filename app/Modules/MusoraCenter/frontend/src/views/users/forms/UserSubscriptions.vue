<template>
    <v-card class="mb-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Subscriptions & Payment Plans</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="openEditForm(0)"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Add New Subscription</span>
            </v-tooltip>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="userSubscriptions"
            :loading="loading"
            :expanded.sync="expanded"
            item-key="id"
            :items-per-page="10"
            class="elevation-1"
        >
            <template v-slot:item="{ item }">
                <tr
                    style="cursor:pointer;"
                    :class="[displayedPaymentsId === item.id ? 'selected-highlighted-item' : '',
                             {'deleted-table-row': !!item.attributes.deleted_at}]"
                    @click="showPayments(item)"
                >
                    <td class="text-center">
                        <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                    </td>

                    <td class="text-center">
                        {{ item.id }}
                    </td>

                    <td class="text-center">
                        <span :class="getStateData(item).class">{{ getStateData(item).state }}</span>
                        <div v-if="getStateData(item).state == 'Canceled'">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <span v-on="on">{{ moment(item.attributes.canceled_on).format('MMM D, Y') }}</span>
                                </template>
                                <span>{{ item.attributes.cancellation_reason || 'No cancelation reason specified' }}</span>
                            </v-tooltip>
                        </div>
                    </td>

                    <td class="text-center">
                        {{ item.attributes.type }}
                    </td>

                    <td
                        class="text-left"
                    >
                        <ul
                            class="pa-0"
                            style="list-style-type:none;"
                        >
                            <li
                                v-for="product in getSubscriptionProduct(item)"
                                :key="`${item.id}-${product}`"
                            >
                                {{ product }}
                            </li>
                        </ul>
                    </td>

                    <td class="text-center">
                        {{ item.attributes.currency }}
                    </td>

                    <td class="text-center">
                        {{ formatPrice(item.attributes.total_price) }}
                    </td>


                    <td class="text-center">
                        {{ formatPrice(item.attributes.tax) }}
                    </td>

                    <td
                        class="text-center"
                        v-html="getPaymentMethodData(item)">
                    </td>

                    <td class="text-center">
                        {{ moment(item.attributes.paid_until).format('MMM D, Y') }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.total_cycles_paid }}
                        <strong >&nbsp;/&nbsp;</strong>
                        {{ item.attributes.total_cycles_due || '∞' }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.renewal_attempt }}
                    </td>

                    <td class="text-center">
                        {{ moment.tz(item.attributes.start_date, 'UTC').tz("America/Los_Angeles").format('MMM D, Y - h:mm A') }}
                    </td>

                    <td class="text-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    :color="brandColor"
                                    class="mx-1 white--text"
                                    v-on="on"
                                    @click.stop="openEditForm(item.id)"
                                >
                                    <v-icon>
                                        edit
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Edit Subscription</span>
                        </v-tooltip>
                    </td>
                </tr>
            </template>

            <template v-slot:expanded-item="{ headers, item }">
                <td :colspan="headers.length" class="pa-0">
                    <user-payments
                        :payments="displayedPayments"
                        :item_id="item.id"
                        payment-type="subscription"
                        @reloadData="reloadPaymentData"
                    ></user-payments>
                </td>
            </template>

            <template v-slot:footer>
                <div class="pa-4 caption">
                    <em>Click on a subscription to show the payments and issue refunds.</em><br>
                    <em>Hover subscription cancelation date to show the reason.</em>
                </div>
            </template>
        </v-data-table>

        <v-dialog
            v-model="dialog"
            max-width="500px"
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title>
                        {{ editingSubscription.id ? 'Edit' : 'Add New' }} Subscription
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form
                        ref="form"
                        v-model="valid"
                    >
                        <v-select
                            v-model="$_type"
                            label="Type*"
                            :color="brandColor"
                            :items="['subscription', 'payment plan']"
                        ></v-select>

                        <v-select
                            v-model="$_brand"
                            label="Brand"
                            :color="brandColor"
                            :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora']"
                        ></v-select>

                        <v-checkbox
                            v-model="$_is_active"
                            label="Active?"
                            :color="brandColor"
                        ></v-checkbox>

                        <v-checkbox
                            v-model="$_stopped"
                            label="Stopped?"
                            :color="brandColor"
                        ></v-checkbox>

                        <v-combobox
                            v-if="$_type === 'subscription'"
                            ref="productInput"
                            v-model="$_product_id"
                            label="Product"
                            :color="brandColor"
                            :items="products.products"
                            item-text="attributes.name"
                            item-value="id"
                        >
                            <template
                                slot="item"
                                slot-scope="data"
                            >
                                <v-list-item-content>
                                    <v-list-item-title>{{ data.item.attributes.name }}:</v-list-item-title>
                                    <v-list-item-subtitle>{{ data.item.attributes.sku }}</v-list-item-subtitle>
                                </v-list-item-content>
                            </template>
                        </v-combobox>

                        <v-select
                            v-model="$_interval_type"
                            label="Payment Interval"
                            :color="brandColor"
                            :rules="validationRules.interval_type"
                            :items="['year', 'month']"
                        ></v-select>

                        <v-text-field
                            v-model="$_interval_count"
                            label="Interval Renewal"
                            :color="brandColor"
                            :rules="validationRules.interval_count"
                            type="number"
                            hint="This affects how many intervals need to pass before the user is billed.
                                If the interval is set to 'Monthly' and this number is set to 6,
                                user will be billed every 6 months."
                        ></v-text-field>

                        <v-select
                            v-model="$_currency"
                            label="Currency"
                            :color="brandColor"
                            :rules="validationRules.currency"
                            :items="currencies"
                        ></v-select>

                        <v-text-field
                            v-model="$_total_price"
                            label="Price Per Payment"
                            :color="brandColor"
                            :rules="validationRules.total_price"
                            :prefix="currencySymbol($_currency)"
                            hint="You have to manually add taxes if necessary"
                        ></v-text-field>

                        <v-select
                            v-model="$_payment_method_id"
                            label="Payment Method"
                            :color="brandColor"
                            :rules="validationRules.payment_method_id"
                            :items="userPaymentMethods"
                            item-value="id"
                        >
                            <template
                                slot="selection"
                                slot-scope="{ item }"
                            >
                                <div class="input-group__selections__comma">
                                    {{ getPaymentMethodData(item) }}
                                </div>
                            </template>

                            <template
                                slot="item"
                                slot-scope="{ item }"
                            >
                                <v-list-item-content>
                                    <v-list-item-title>{{ getPaymentMethodData(item) }}</v-list-item-title>
                                </v-list-item-content>
                            </template>
                        </v-select>

                        <v-text-field
                            v-model="$_total_cycles_due"
                            label="Total Cycles Due"
                            :color="brandColor"
                            type="number"
                            hint="Leave this blank to make it infinite"
                        ></v-text-field>

                        <v-text-field
                            v-model="$_total_cycles_paid"
                            label="Total Cycles Paid"
                            :color="brandColor"
                            type="number"
                        ></v-text-field>

                        <v-menu
                            ref="start_date_picker"
                            v-model="start_date_picker"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="$_start_date"
                                    label="Start Date"
                                    :color="brandColor"
                                    :rules="validationRules.start_date"
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="$_start_date"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click="start_date_picker = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click="start_date_picker = false"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>

                        <v-menu
                            ref="paid_until_picker"
                            v-model="paid_until_picker"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="$_paid_until"
                                    label="Paid Until"
                                    :color="brandColor"
                                    :rules="validationRules.paid_until"
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="$_paid_until"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click="paid_until_picker = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click="paid_until_picker = false"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>

                        <v-text-field
                                v-model="$_renewal_attempt"
                                label="Current Renewal Attempt"
                                :color="brandColor"
                                type="number"
                                hint="There are a total of 4 renewal attempts. If this number is below 5 it will automatically try to re-bill."
                        ></v-text-field>

                        <v-menu
                            ref="canceled_on_picker"
                            v-model="canceled_on_picker"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="$_canceled_on"
                                    label="Canceled On"
                                    :color="brandColor"
                                    clearable
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="$_canceled_on"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click="canceled_on_picker = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click="canceled_on_picker = false"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>

                        <v-textarea
                            v-model="$_note"
                            label="Notes"
                            :color="brandColor"
                            multi-line
                            outline
                            no-resize
                            class="mt-4"
                        ></v-textarea>

                        <div class="text-right">
                            <v-btn
                                text
                                class="mr-1"
                                @click="cancelForm"
                            >
                                Cancel
                            </v-btn>

                            <v-btn
                                :color="brandColor"
                                class="white--text"
                                :disabled="!valid"
                                @click.stop="submitForm"
                            >
                                Save
                            </v-btn>
                        </div>

                        <v-divider
                            v-if="editingSubscription.id !== 0"
                            class="my-4"
                        ></v-divider>

                        <div
                            v-if="editingSubscription.id !== 0"
                            class="text-center"
                        >
                            <v-btn
                                small
                                text
                                color="success"
                                @click="renewSubscription"
                            >
                                Renew This Subscription
                            </v-btn>

                            <v-btn
                                small
                                text
                                color="error"
                                @click="cancelSubscription"
                            >
                                Cancel This Subscription
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import api from '../../../api/ecommerce/subscriptions';
import paymentsApi from '../../../api/ecommerce/payments';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import UserPayments from './UserPayments';
import JsonApiMethods from '../../../mixins/json-api-methods';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';

const defaultSubscription = {
    id: 0,
    attributes: {},
    relationships: {
        order: { data: {} },
        paymentMethod: { data: {} },
        product: { data: {} },
        user: { data: {} },
    },
};

export default {
    name: 'UserSubscriptions',
    components: {
        'user-payments': UserPayments,
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors, JsonApiMethods],
    props: {
        userId: {
            type: [Number, String],
            default: () => 0,
        },

        userSubscriptions: {
            type: Array,
            default: () => [],
        },

        userPaymentMethods: {
            type: Array,
            default: () => [],
        },

        userPaymentMethodsIncludedData: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            expanded: [],
            dialog: false,
            valid: false,
            start_date_picker: false,
            paid_until_picker: false,
            canceled_on_picker: false,
            loading: false,
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'ID',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'State',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Type',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Product SKU',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Currency',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Price',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Taxes',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Attached Payment Method',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Paid Until',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Paid/Due',
                    align: 'center',
                    value: 'attributes.total_cycles_paid',
                    sortable: true,
                    width: 100,
                },
                {
                    text: 'Renewal Attempts',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Start Date',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Edit',
                    align: 'center',
                    sortable: false,
                },
            ],
            editingSubscription: JSON.parse(JSON.stringify(defaultSubscription)),
            validationRules: {
                type: [
                    v => !!v || 'Type is required',
                ],
                brand: [
                    v => !!v || 'Brand is required',
                ],
                interval_type: [
                    v => !!v || 'Interval Type is required',
                ],
                interval_count: [
                    v => !!v || 'Interval Count is required',
                ],
                currency: [
                    v => !!v || 'Currency is required',
                ],
                total_price: [
                    v => !!v || 'Price is required',
                    v => /^[0-9]+(\.[0-9]{1,2})?$/.test(v) || 'Must be a valid price',
                ],
                payment_method_id: [
                    v => !!v || 'Payment Method is required',
                ],
                start_date: [
                    v => !!v || 'Start Date is required',
                ],
                paid_until: [
                    v => !!v || 'Paid Until is required',
                ],
            },
            displayedPaymentsId: null,
            displayedPayments: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
            products: state => state.products,
        }),

        currencies() {
            return Utils.currencies();
        },

        subscriptions() {
            return this.userSubscriptions;
        },

        $_brand: {
            get() {
                return this.editingSubscription.attributes.brand;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'brand', val);
            },
        },

        $_type: {
            get() {
                return this.editingSubscription.attributes.type;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'type', val);
            },
        },

        $_is_active: {
            get() {
                return this.editingSubscription.attributes.is_active;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'is_active', val);
            },
        },

        $_stopped: {
            get() {
                return this.editingSubscription.attributes.stopped;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'stopped', val);
            },
        },

        $_product_id: {
            get() {
                if (this.$_type === 'subscription' && this.editingSubscription.relationships.product) {
                    return this.editingSubscription.relationships.product.data.id;
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.relationships, 'product', { data: { type: 'product', id: val.id } });
            },
        },

        $_interval_type: {
            get() {
                return this.editingSubscription.attributes.interval_type;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'interval_type', val);
            },
        },

        $_interval_count: {
            get() {
                return this.editingSubscription.attributes.interval_count;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'interval_count', val);
            },
        },

        $_currency: {
            get() {
                return this.editingSubscription.attributes.currency;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'currency', val);
            },
        },

        $_total_price: {
            get() {
                return this.editingSubscription.attributes.total_price;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'total_price', val);
            },
        },

        $_payment_method_id: {
            get() {
                if (this.editingSubscription.relationships.paymentMethod) {
                    return this.editingSubscription.relationships.paymentMethod.data.id;
                }

                return null;
            },
            set(val) {
                this.$set(
                    this.editingSubscription.relationships,
                    'paymentMethod',
                    { data: { type: 'paymentMethod', id: val } },
                );
            },
        },

        $_total_cycles_due: {
            get() {
                return this.editingSubscription.attributes.total_cycles_due;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'total_cycles_due', val);
            },
        },

        $_total_cycles_paid: {
            get() {
                return this.editingSubscription.attributes.total_cycles_paid;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'total_cycles_paid', val);
            },
        },

        $_start_date: {
            get() {
                if (this.editingSubscription.attributes.start_date) {
                    return this.moment(this.editingSubscription.attributes.start_date).format('Y-MM-DD');
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'start_date', val);
            },
        },

        $_paid_until: {
            get() {
                if (this.editingSubscription.attributes.paid_until) {
                    return this.moment(this.editingSubscription.attributes.paid_until).format('Y-MM-DD');
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'paid_until', val);
            },
        },

        $_renewal_attempt: {
            get() {
                return this.editingSubscription.attributes.renewal_attempt;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'renewal_attempt', val);
            },
        },

        $_canceled_on: {
            get() {
                if (this.editingSubscription.attributes.canceled_on) {
                    return this.moment(this.editingSubscription.attributes.canceled_on).format('Y-MM-DD');
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'canceled_on', val);
            },
        },

        $_note: {
            get() {
                return this.editingSubscription.attributes.note;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'note', val);
            },
        },
    },
    methods: {
        ...mapActions('products', [
            'getProducts',
        ]),

        getPaymentMethodData(item) {
            if (item.relationships.paymentMethod) {
                const paymentMethod = this.getRelatedAttributesByTypeAndId(item.relationships.paymentMethod.data);
                const method = this.getRelatedAttributesByTypeAndId(paymentMethod.relationships.method.data);

                if (method.type === 'paypalBillingAgreement') {

                    return `PayPal Agreement ID: <br>${method.attributes.external_id}`;

                } else if (method.type === 'creditCard') {

                    return `${method.attributes.company_name}:
                    ${(String(method.attributes.last_four_digits)).padStart(4, '0')} -
                    ${this.moment(method.attributes.expiration_date).format('MM/DD')}
                    <br>Stripe Card ID: ${method.attributes.external_id}`;

                }
            } else if (item.type == 'paymentMethod') {
                const method = this.getRelatedAttributesByTypeAndId(
                                    item.relationships.method.data,
                                    this.userPaymentMethodsIncludedData
                                );

                let brand = method.attributes.payment_gateway_name;
                brand = brand.charAt(0).toUpperCase() + brand.slice(1); // capitalized

                if (method.type === 'paypalBillingAgreement') {

                    return `PayPal Agreement ID: ${method.attributes.external_id} (${brand})`;

                } else if (method.type === 'creditCard') {

                    return `${method.attributes.company_name}:
                    ${(String(method.attributes.last_four_digits)).padStart(4, '0')} -
                    ${this.moment(method.attributes.expiration_date).format('MM/DD')} (${brand})`;

                }
            }

            return 'N/A';
        },

        openEditForm(id) {
            this.dialog = true;

            if (id !== 0) {
                // Stringifying and parsing will allow me to create a copy of the object rather than a reference
                this.editingSubscription = JSON.parse(JSON.stringify(this.findSubscriptionById(id)));
            } else {
                this.editingSubscription = JSON.parse(JSON.stringify(defaultSubscription));
            }

            this.$nextTick(() => {
                this.$refs.form.resetValidation();
            });

        },

        findSubscriptionById(id) {
            return this.userSubscriptions.filter(subscription => subscription.id === id)[0];
        },

        cancelForm() {
            this.$refs.form.resetValidation();
            this.dialog = false;
            this.editingSubscription = JSON.parse(JSON.stringify(defaultSubscription));
        },

        submitForm() {
            setTimeout(() => {
                if (this.$refs.form.validate()) {
                    api.setUserSubscription(this.editingSubscription.id, {
                        user_id: this.userId,
                        brand: this.$_brand,
                        type: this.$_type,
                        product_id: this.$_product_id,
                        interval_type: this.$_interval_type,
                        interval_count: this.$_interval_count,
                        total_cycles_due: this.$_total_cycles_due,
                        total_cycles_paid: this.$_total_cycles_paid,
                        is_active: this.$_is_active,
                        stopped: this.$_stopped,
                        note: this.$_note,
                        payment_method_id: this.$_payment_method_id,
                        currency: this.$_currency,
                        total_price: this.$_total_price,
                        start_date: this.$_start_date,
                        paid_until: this.$_paid_until,
                        renewal_attempt: this.$_renewal_attempt,
                        canceled_on: this.$_canceled_on,
                    })
                        .then((response) => {
                            if (response) {
                                // Cancel the form and pull the users subscriptions
                                this.$parent.getUserSubscriptions();
                                this.cancelForm();

                                this.$root.$emit('displayMessage', {
                                    text: 'Subscription successfuly edited',
                                    color: 'success',
                                });
                            } else {
                                this.$root.$emit('displayMessage', {
                                    text: 'Oops, something went wrong. Subscription not edited',
                                    color: 'error',
                                });
                            }
                        });
                }
            }, 100);
        },

        cancelSubscription() {
            const confirmation = confirm('Are you sure you want to cancel this user\'s subscription?');

            if (confirmation) {
                api.setUserSubscription(this.editingSubscription.id, {
                    brand: this.editingSubscription.brand,
                    user_id: this.userId,
                    is_active: false,
                    canceled_on: this.moment(Date.now()).format('Y-MM-DD'),
                })
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'Subscription successfuly canceled',
                                color: 'success',
                            });

                            // Cancel the form and pull the users subscriptions
                            this.$parent.getUserSubscriptions();
                            this.cancelForm();
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops, something went wrong. Subscription not cancelled',
                                color: 'error',
                            });
                        }
                    });
            }
        },

        renewSubscription() {
            const confirmation = confirm('Are you sure you want to renew this user\'s subscription? '
                    + 'This will charge the payment method attached to this subscription.');

            if (confirmation) {
                api.renewUserSubscription(this.editingSubscription.id)
                    .then(({ response, error }) => {
                        if (
                            response
                            && response.data
                            && response.data.data
                            && (
                                response.data.data.type == 'subscription'
                                || response.data.data.type == 'payment plan'
                            )
                        ) {
                            // Cancel the form and pull the users subscriptions
                            this.$parent.getUserSubscriptions();
                            this.cancelForm();

                            this.$root.$emit('displayMessage', {
                                text: 'Subscription successfuly renewed!',
                                color: 'success',
                            });
                        } else {
                            let message = 'Oops something went wrong! Subscription was not renewed.';

                            if (error && error.errors && error.errors.detail) {
                                message = 'Error renewing subscription: ' + error.errors.detail;
                            }

                            this.$root.$emit('displayMessage', {
                                text: message,
                                color: 'error',
                                timeout: 7000,
                            });
                        }
                    });
            }
        },

        currencySymbol(currency) {
            const currencyMap = {
                CAD: '$',
                USD: '$',
                GBP: '£',
                EUR: '€',
            };

            return currencyMap[currency];
        },

        formatPrice(price) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
            }).format(price);
        },

        showPayments(item) {
            this.loading = true;

            paymentsApi.getPayments({
                subscription_id: item.id,
            })
                .then((response) => {
                    this.loading = false;

                    if (response) {
                        this.expanded = [item];
                        this.displayedPayments = response.data;
                        this.displayedPaymentsId = item.id;
                    }
                });
        },

        reloadPaymentData(payload) {
            this.displayedPayments = payload;
        },

        getSubscriptionProduct(item) {
            if (item.attributes.type === 'payment plan' && item.relationships.order !== undefined) {
                let orderItems;
                const order = this.getRelatedAttributesByTypeAndId(
                    item.relationships.order.data,
                );

                if (order.relationships.orderItem) {
                    orderItems = order.relationships.orderItem.data.map(
                        relatedOrderItem => this.getRelatedAttributesByTypeAndId(
                            relatedOrderItem,
                        ),
                    );

                    const products = orderItems.map(
                        orderItem => this.getRelatedAttributesByTypeAndId(
                            orderItem.relationships.product.data,
                        ),
                    );

                    if (products.length) {
                        return products.map(product => product.attributes.sku);
                    }

                    return [];
                }

                return [];
            }

            if (item.relationships.product) {
                const product = this.getRelatedAttributesByTypeAndId(item.relationships.product.data);

                return product ? [product.attributes.sku] : [];
            }

            return [];
        },

        getSubscriptionPaymentMethod(item) {
            if (item.relationships.paymentMethod) {
                const paymentMethod = this.getRelatedAttributesByTypeAndId(item.relationships.paymentMethod.data);
                const method = this.getRelatedAttributesByTypeAndId(paymentMethod.relationships.method.data);

                if (paymentMethod.attributes.method_type === 'paypal') {
                    return `paypal - ${method.attributes.external_id}`;
                }

                return `${method.attributes.company_name} - ${method.attributes.last_four_digits}`;
            }

            return 'N/A';
        },

        subscriptionIsInactive(item) {
            return !!item.attributes.canceled_on || !item.attributes.is_active;
        },

        getStateData(item) {
            if (item.attributes.state === 'canceled') {
                return {
                    icon: 'close',
                    class: 'error--text',
                    state: 'Canceled',
                };
            }

            if (item.attributes.state === 'suspended') {
                return {
                    icon: 'pause',
                    class: 'warning--text',
                    state: 'Suspended',
                };
            }

            if (item.attributes.state === 'stopped') {
                return {
                    icon: 'pause',
                    class: 'warning--text',
                    state: 'Stopped',
                };
            }

            return {
                icon: 'check',
                class: 'success--text',
                state: 'Active',
            };
        },
    },
    mounted() {
        this.getProducts();
    },
};
</script>
