<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>
                Create Order: {{ thisUser.attributes.email }}
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn
                icon
                text
                @click="cancelOrder"
            >
                <v-icon>close</v-icon>
            </v-btn>
        </v-toolbar>

        <v-container>
            <v-row
                class="align-top"
            >
                <v-col
                    cols="12"
                    sm="6"
                    class="pa-4 column"
                >
                    <v-card class="edit-form mb-12">
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                        >
                            <v-toolbar-title>Order Data</v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            v-if="isCustomer"
                            class="pa-4 text-center"
                        >
                            <p class="mb-0 font-weight-bold">
                                * WARNING: This is a guest customer without an account.
                                Do not place orders with digital items for guest customers.
                            </p>
                        </v-col>


                        <v-stepper
                            v-model="stepper"
                            vertical
                            style="background:none;"
                            :color="brandColor"
                        >
                            <v-stepper-step
                                :complete="stepper > 1"
                                step="1"
                            >
                                Add Products
                            </v-stepper-step>
                            <v-stepper-content step="1">
                                <add-products
                                    :products="products"
                                    @productAdded="addProductToCart"
                                    @bulkAddProductSkusToCart="bulkAddProductSkusToCart"
                                />

                                <div class="text-right mt-12">
                                    <v-btn
                                        :color="brandColor"
                                        :disabled="cartData.items.length === 0"
                                        class="white--text"
                                        @click="stepper = 2"
                                    >
                                        Next
                                        <v-icon
                                            right
                                            dark
                                        >
                                            keyboard_arrow_right
                                        </v-icon>
                                    </v-btn>
                                </div>
                            </v-stepper-content>

                            <v-stepper-step
                                v-if="cartRequiresShippingAddress"
                                :complete="stepper > 2"
                                step="2"
                            >
                                Set Shipping Address
                                <small>Required</small>
                            </v-stepper-step>
                            <v-stepper-content
                                v-if="cartRequiresShippingAddress"
                                step="2"
                            >
                                <shipping-address-form
                                    ref="shippingForm"
                                    :shipping-addresses="userShippingAddresses"
                                    :shipping-address-state="shippingAddressState"
                                    :address="shippingAddress"
                                    @updateCart="updateCart"
                                    @updateShippingAddressState="handleShippingAddressState"
                                />

                                <v-row class="mt-12">
                                    <v-col class="text-left">
                                        <v-btn
                                            text
                                            @click="stepper = 1"
                                        >
                                            <v-icon
                                                left
                                                dark
                                            >
                                                keyboard_arrow_left
                                            </v-icon>
                                            Back
                                        </v-btn>
                                    </v-col>
                                    <v-col class="text-right">
                                        <v-btn
                                            :color="brandColor"
                                            :disabled="!shippingFormValid"
                                            class="white--text"
                                            @click="stepper = 3"
                                        >
                                            Next
                                            <v-icon
                                                right
                                                dark
                                            >
                                                keyboard_arrow_right
                                            </v-icon>
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-stepper-content>

                            <v-stepper-step
                                :complete="cartRequiresShippingAddress ? stepper > 3 : stepper > 2"
                                :step="cartRequiresShippingAddress ? '3' : '2'"
                            >
                                Set Payment Information
                            </v-stepper-step>
                            <v-stepper-content :step="cartRequiresShippingAddress ? '3' : '2'">
                                <payment-form
                                    ref="paymentForm"
                                    :payment-method-state="paymentState"
                                    :user-payment-methods="userPaymentMethods"
                                    :user-payment-methods-included-data="userPaymentMethodsIncludedData"
                                    :payment-plan-options="paymentPlanOptions"
                                    :order-total="cartData.totals.due"
                                    :cart-contains-subscription="cartContainsSubscription"
                                    @goBack="cartRequiresShippingAddress ? stepper = 2 : stepper = 1"
                                    @paymentStateChange="handlePaymentStateChange"
                                    @formSubmit="submitForm"
                                />
                            </v-stepper-content>
                        </v-stepper>
                    </v-card>
                </v-col>

                <v-col
                    cols="12"
                    sm="6"
                    class="pa-4 column"
                >
                    <v-card class="edit-form mb-12">
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                            :loading="true"
                        >
                            <v-toolbar-title>Cart</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-tooltip left v-if="cartIsClearable">
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        text
                                        icon
                                        v-on="on"
                                        slot="activator"
                                        @click="clearCart()"
                                    >
                                        <v-icon>delete</v-icon>
                                    </v-btn>
                                </template>

                                <span>Clear all cart data</span>
                            </v-tooltip>
                        </v-toolbar>

                        <v-col
                            v-if="cartData.items.length === 0"
                            class="pa-4 text-center"
                        >
                            <p class="mb-0">
                                There are no items in the cart yet.
                            </p>
                        </v-col>

                        <v-list three-line>
                            <cart-item
                                v-for="item in cartData.items"
                                :key="item.sku"
                                :item="item"
                                :price-override="priceOverrides[item.sku]"
                                @deleteItem="deleteItemFromCart"
                                @updateItemQuantity="updateCartItemQuantity"
                                @updatePriceOverride="updatePriceOverride"
                            ></cart-item>
                        </v-list>

                        <v-row
                            v-if="cartData.items.length > 0"
                            class="pa-4"
                        >
                            <v-col>
                                <v-text-field
                                    v-model="$_shipping_displayed"
                                    style="width:200px;"
                                    type="number"
                                    single-line
                                    class="mb-0"
                                    hide-details
                                    prefix="Shipping:"
                                    :append-icon="hasShippingDueOverride ? 'undo' : ''"
                                    :color="hasShippingDueOverride ? 'warning' : brandColor"
                                    @click:append="$_shipping_displayed = cartData.totals.shipping_before_override"
                                ></v-text-field>

                                <v-text-field
                                    v-model="$_product_tax_displayed"
                                    style="width:200px;"
                                    type="number"
                                    single-line
                                    class="mb-0"
                                    hide-details
                                    prefix="Product Tax:"
                                    disabled
                                ></v-text-field>

                                <v-text-field
                                    v-model="$_shipping_tax_displayed"
                                    style="width:200px;"
                                    type="number"
                                    single-line
                                    class="mb-4"
                                    hide-details
                                    prefix="Shipping Tax:"
                                    disabled
                                ></v-text-field>

                                <p class="mb-0 headline">
                                    <strong class="pr-6">Total:</strong> ${{ Number(cartData.totals.due || 0).toFixed(2) }}
                                </p>

                                <v-textarea
                                    v-model="orderNote"
                                    label="Notes"
                                    :color="brandColor"
                                    multi-line
                                    outline
                                    no-resize
                                    hide-details
                                    class="mt-6"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-card>
</template>
<script>
import {mapState} from 'vuex';
import brandColors from '../../../../api/mixins.js';
import AddProducts from './_AddProducts';
import cartApi from '../../../../api/ecommerce/cart';
import ordersApi from '../../../../api/ecommerce/orders';
import ShippingAddressForm from './_ShippingAddressForm';
import PaymentForm from './_PaymentForm';
import JsonApiMethods from '../../../../mixins/json-api-methods';
import CartItem from './_CartItem';

export default {
    name: 'CreateOrder',
    components: {
        'add-products': AddProducts,
        'shipping-address-form': ShippingAddressForm,
        'payment-form': PaymentForm,
        'cart-item': CartItem,

    },
    mixins: [brandColors, JsonApiMethods],
    props: {
        userId: {
            type: [String, Number],
            default: () => null,
        },

        thisUser: {
            type: Object,
            default: () => ({}),
        },

        products: {
            type: Array,
            default: () => [],
        },

        userAddresses: {
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

        isCustomer: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            cartData: {
                items: [],
                totals: {},
            },
            updateTimeout: null,
            quantityTimeout: null,
            stepper: 1,
            shippingAddress: {
                id: 0,
                attributes: {},
            },
            shippingAddressState: {},
            paymentState: {
                brand: 'pianote',
            },
            priceOverrides: {},
            taxTimeout: null,
            shippingTimeout: null,
            productTaxDueOverride: null,
            shippingTaxDueOverride: null,
            shippingDueOverride: null,
            orderNote: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),

        userShippingAddresses() {
            // I had to filter out addresses that don't have required data, unfortunately some
            // users have addresses like that attached to their account
            //
            // Curtis - Aug 2019

            return this.userAddresses
                .filter(address => address.attributes.type === 'shipping')
                .filter(address => address.attributes.country != null
                        && address.attributes.street_line_1 != null
                        && address.attributes.zip != null);
        },

        userBillingAddresses() {
            return this.userAddresses.filter(address => address.attributes.type === 'billing');
        },

        cartRequiresShippingAddress() {
            return this.cartData.items.filter(item => item.requires_shipping === true).length > 0;
        },

        cartContainsSubscription() {
            return this.cartData.items.filter(item => !!item.subscription_interval_count).length > 0;
        },

        paymentPlanOptions() {
            return this.cartData.payment_plan_options || [];
        },

        cartIsClearable() {
            return this.cartData.totals.shipping != this.cartData.totals.shipping_before_override
                || this.cartData.totals.shipping_taxes != this.cartData.totals.shipping_taxes_before_override
                || this.cartData.totals.product_taxes != this.cartData.totals.product_taxes_before_override;
        },

        hasShippingDueOverride() {
            return this.cartData.totals.shipping != this.cartData.totals.shipping_before_override;
        },

        hasShippingTaxOverride() {
            return this.cartData.totals.shipping_taxes != this.cartData.totals.shipping_taxes_before_override;
        },

        hasProductTaxOverride() {
            return this.cartData.totals.product_taxes != this.cartData.totals.product_taxes_before_override;
        },

        shippingFormValid: {
            cache: false,
            get() {
                if (this.cartRequiresShippingAddress) {
                    if (this.$refs.shippingForm) {
                        return this.$refs.shippingForm.valid;
                    }

                    return false;
                }

                return true;
            },
        },

        paymentFormValid: {
            cache: false,
            get() {
                if (this.$refs.paymentForm) {
                    return this.$refs.paymentForm.valid;
                }

                return false;
            },
        },

        $_shipping_displayed: {
            get() {
                return this.shippingDueOverride || this.cartData.totals.shipping;
            },
            set(value) {
                clearTimeout(this.shippingTimeout);

                if (value == this.cartData.totals.shipping_before_override) {
                    this.shippingDueOverride = null;
                } else {
                    this.shippingDueOverride = value;
                }

                this.shippingTimeout = setTimeout(() => {
                    this.updateTotalOverrides();
                }, 750);
            },
        },

        $_product_tax_displayed: {
            get() {
                return this.productTaxDueOverride || this.cartData.totals.product_taxes;
            },
            set(value) {
                clearTimeout(this.taxTimeout);

                if (value == this.cartData.totals.product_taxes_before_override) {
                    this.productTaxDueOverride = null;
                } else {
                    this.productTaxDueOverride = value;
                }

                this.taxTimeout = setTimeout(() => {
                    this.updateTotalOverrides();
                }, 750);
            },
        },

        $_shipping_tax_displayed: {
            get() {
                return this.shippingTaxDueOverride || this.cartData.totals.shipping_taxes;
            },
            set(value) {
                clearTimeout(this.taxTimeout);

                if (value == this.cartData.totals.shipping_taxes_before_override) {
                    this.shippingTaxDueOverride = null;
                } else {
                    this.shippingTaxDueOverride = value;
                }

                this.taxTimeout = setTimeout(() => {
                    this.updateTotalOverrides();
                }, 750);
            },
        },
    },

    mounted() {
        this.getCart();
    },
    methods: {
        getCart() {
            cartApi.getCart(this.userId)
                .then((response) => {
                    if (response) {
                        this.updateCart(response.data.meta.cart);

                        if (response.data.meta.cart.shipping_address) {
                            this.shippingAddressState = {
                                shipping_city: this.cartData.shipping_address.city,
                                shipping_country: this.cartData.shipping_address.country,
                                shipping_first_name: this.cartData.shipping_address.first_name,
                                shipping_last_name: this.cartData.shipping_address.last_name,
                                shipping_region: this.cartData.shipping_address.region,
                                shipping_address_line_1: this.cartData.shipping_address.street_line_one,
                                shipping_address_line_2: this.cartData.shipping_address.street_line_two,
                                shipping_zip_or_postal_code: this.cartData.shipping_address.zip_or_postal_code,
                            };
                        }
                    }
                });
        },

        updateCart(payload) {
            this.cartData = payload;

            this.$nextTick(() => {
                this.shippingDueOverride = this.hasShippingDueOverride ? this.cartData.totals.shipping : null;
                this.shippingTaxDueOverride = this.hasShippingTaxOverride ? this.cartData.totals.shipping_taxes : null;
                this.productTaxDueOverride = this.hasProductTaxOverride ? this.cartData.totals.product_taxes : null;

                this.$forceUpdate();
            });
        },

        cancelOrder() {
            this.$emit('cancelOrder');
        },

        clearCart() {
            cartApi.clearCart()
                .then(response => {
                    this.updateCart(response.data.meta.cart);
                });
        },

        addProductToCart(payload) {
            this.$root.$emit('pageLoading');

            cartApi.addProductToCart({
                sku: payload.sku,
                quantity: payload.quantity,
                userId: this.userId,
            })
                .then((response) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Item successfully added to the cart!',
                        });

                        this.updateCart(response.data.meta.cart);
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Oops something went wrong! Item likely not added to the cart.',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        bulkAddProductSkusToCart(payload) {
            this.$root.$emit('pageLoading');

            const skusAndQuantitiesArrayOfObjects = payload.bulkProductSkusToAddString.split(',')
                .map((string) => {
                    const skuAndQuantity = string.trim().split('=');
                    return {
                        sku: skuAndQuantity[0],
                        quantity: skuAndQuantity[1],
                    };
                });

            cartApi.addProductsToCart(skusAndQuantitiesArrayOfObjects)
                .then((response) => {
                    if (response) {
                        this.getCart();

                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Items successfully added to the cart!',
                        });
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Oops something went wrong! Items likely not added to the cart.',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        updateCartItemQuantity({ quantity, sku }) {
            clearTimeout(this.quantityTimeout);

            this.quantityTimeout = setTimeout(() => {
                this.$root.$emit('pageLoading');

                cartApi.updateProductQuantity({ sku, quantity })
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                color: 'success',
                                text: 'Item quantity updated!',
                            });

                            this.updateCart(response.data.meta.cart);
                        } else {
                            this.$root.$emit('displayMessage', {
                                color: 'error',
                                text: 'Oops something went wrong! Item quantity likely not changed.',
                            });
                        }

                        this.$root.$emit('pageLoaded');
                    });
            }, 750);
        },

        updatePriceOverride({ sku, amount }) {
            const price = this.cartData.items.find(item => item.sku === sku).price_after_discounts;

            if (price == amount) {
                if (this.priceOverrides[sku] != null) {
                    delete this.priceOverrides[sku];
                }
            } else {
                this.$set(this.priceOverrides, sku, amount);
            }

            this.updateTotalOverrides();
        },

        updateTotalOverrides() {
            cartApi.updateTotalOverridesInSession({
                product_taxes_due_override: this.productTaxDueOverride,
                shipping_taxes_due_override: this.shippingTaxDueOverride,
                shipping_due_override: this.shippingDueOverride,
                order_items_due_overrides: Object.keys(this.priceOverrides).map(key => ({
                    sku: key,
                    amount: this.priceOverrides[key],
                })),
            })
                .then((response) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'Cart successfully updated!',
                            color: 'success',
                        });

                        this.updateCart(response.data.meta.cart);
                    } else {
                        this.$root.$emit('displayMessage', {
                            text: 'Oops! Something went wrong. Cart likely not updated.',
                            color: 'error',
                        });
                    }

                    this.$nextTick(() => { this.$forceUpdate(); });
                });
        },

        deleteItemFromCart(sku) {
            this.$root.$emit('pageLoading');

            cartApi.deleteItemFromCart(sku, this.userId)
                .then((response) => {
                    if (response) {
                        this.updateCart(response.data.meta.cart);

                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Item successfully removed from the cart!',
                        });

                        if (this.priceOverrides[sku] != null) {
                            delete this.priceOverrides[sku];

                            this.updateTotalOverrides();
                        }

                        if (this.stepper === 2 && !this.cartRequiresShippingAddress) {
                            this.stepper = 1;
                        }
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Something went wrong. Item likely not removed from the cart.',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        handleShippingAddressState({ key, value }) {
            if (key === 'shipping_address_id') {
                this.shippingAddressState = {};
            } else {
                this.shippingAddressState.shipping_address_id = undefined;
            }

            this.$set(this.shippingAddressState, key, value);

            clearTimeout(this.updateTimeout);

            this.updateTimeout = setTimeout(() => {
                this.updateAddressesInSession();
            }, 750);
        },

        handlePaymentStateChange({ key, value }) {
            if (key === 'payment_method_id') {
                const paymentMethod = this.userPaymentMethods.find(method => method.id === value);
                const billingAddress = this.getRelatedAttributesByTypeAndId(
                    paymentMethod.relationships.billingAddress.data,
                    this.userPaymentMethodsIncludedData,
                );

                this.paymentState.billing_address_id = billingAddress.id;
            } else if (key !== 'payment_plan_number_of_payments') {
                this.paymentState.payment_method_id = undefined;
                this.paymentState.billing_address_id = undefined;
            }

            this.$set(this.paymentState, key, value);

            clearTimeout(this.updateTimeout);

            this.updateTimeout = setTimeout(() => {
                this.updateAddressesInSession();
            }, 750);
        },

        updateAddressesInSession() {
            cartApi.updateAddressesInSession({
                ...this.shippingAddressState,
                ...this.paymentState,
            })
                .then((response) => {
                    if (response) {
                        this.shippingDueOverride = null;
                        this.productTaxDueOverride = null;
                        this.shippingTaxDueOverride = null;

                        this.updateCart(response.data.meta.cart);
                    }
                });
        },

        submitForm(payload) {
            this.$root.$emit('pageLoading');

            console.log(this.constructOrderPayload(payload));

            ordersApi.createOrder(this.constructOrderPayload(payload))
                .then((response) => {
                    if (response && response.data && response.data.data && response.data.data.type == 'order') {
                        this.$root.$emit('displayMessage', {
                            text: 'Order successfully submit!',
                            color: 'success',
                        });

                        this.getCart();
                        this.stepper = 1;
                        this.$emit('formSuccess');

                        this.shippingAddressState = {};
                        this.paymentState = { brand: 'pianote' };
                        this.shippingDueOverride = null;
                        this.productTaxDueOverride = null;
                        this.shippingTaxDueOverride = null;
                    } else {
                        let message = 'Oops something went wrong! Order likely not submit.';

                        if (response && response.data && response.data.errors && response.data.errors.detail) {
                            message = 'An error occurred while processing the order: ' + response.data.errors.detail;
                        }

                        this.$root.$emit('displayMessage', {
                            text: message,
                            color: 'error',
                            timeout: 15000,
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        constructOrderPayload(payload) {
            let data = {
                note: this.orderNote
            };

            if (this.productTaxDueOverride) {
                data = {
                    ...data,
                    product_taxes_due_override: this.productTaxDueOverride
                };
            }

            if (this.shippingTaxDueOverride) {
                data = {
                    ...data,
                    shipping_taxes_due_override: this.shippingTaxDueOverride
                };
            }

            if (this.shippingDueOverride) {
                data = {
                    ...data,
                    shipping_due_override: this.shippingDueOverride
                };
            }

            if (this.isCustomer) {
                data = {
                    ...data,
                    customer_id: this.userId,
                };
            } else {
                data = {
                    ...data,
                    user_id: this.userId,
                };
            }

            // If we need a shipping address then we should take the shipping state
            if (this.cartRequiresShippingAddress) {
                data = {
                    ...data,
                    ...this.shippingAddressState,
                };
            }

            // If we have a selected payment method use that, otherwise use the form data
            if (this.paymentState.payment_method_id != null) {
                data = {
                    ...data,
                    brand: this.paymentState.brand,
                    payment_method_id: this.paymentState.payment_method_id || undefined,
                };
            } else {
                data = {
                    ...data,
                    ...this.paymentState,
                    payment_method_type: 'credit_card',
                    card_token: payload.stripeToken,
                };
            }

            if (payload.dontUsePaymentMethod) {
                delete data.payment_method_type;
            }

            if (this.paymentState.payment_plan_number_of_payments != null) {
                data = {
                    ...data,
                    payment_plan_number_of_payments: this.paymentState.payment_plan_number_of_payments,
                };
            }

            // If we have any price overrides then we need to include them
            const priceOverrides = Object.keys(this.priceOverrides);
            if (priceOverrides.length > 0) {
                const order_items_due_overrides = priceOverrides.map(sku => ({
                    sku,
                    amount: this.priceOverrides[sku],
                }));

                data = {
                    ...data,
                    order_items_due_overrides,
                };
            }

            return data;
        },
    },
};
</script>
