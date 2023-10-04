<template>
    <v-form
        ref="form"
        v-model="valid"
    >
        <v-checkbox
            v-if="shippingAddresses.length > 0"
            v-model="useExistingShippingAddress"
            label="Use Existing Shipping Address"
        ></v-checkbox>

        <div v-if="useExistingShippingAddress">
            <v-select
                v-model="$_shipping_address_id"
                label="Shipping Address"
                :color="brandColor"
                :items="shippingAddresses"
                :rules="validationRules.shippingAddress"
                item-value="id"
            >
                <template
                    slot="selection"
                    slot-scope="data"
                >
                    <div class="input-group__selections__comma">
                        {{ data.item.attributes.street_line_1 || 'N/A' }}
                        {{ data.item.attributes.street_line_2 }} -
                        {{ data.item.attributes.city || 'N/A' }}
                        {{ data.item.attributes.region || 'N/A' }},
                        {{ data.item.attributes.country || 'N/A' }}
                    </div>
                </template>

                <template
                    slot="item"
                    slot-scope="data"
                >
                    <template>
                        <v-list-item-content>
                            <span>
                                {{ data.item.attributes.street_line_1 || 'N/A' }}
                                {{ data.item.attributes.street_line_2 }} -
                                {{ data.item.attributes.city || 'N/A' }}
                                {{ data.item.attributes.region || 'N/A' }},
                                {{ data.item.attributes.country || 'N/A' }}
                            </span>
                        </v-list-item-content>
                    </template>
                </template>
            </v-select>
        </div>
        <div v-else>
            <v-text-field
                v-model="$_first_name"
                label="First Name"
                :color="brandColor"
                :rules="validationRules.first_name"
            ></v-text-field>

            <v-text-field
                v-model="$_last_name"
                label="Last Name"
                :color="brandColor"
                :rules="validationRules.last_name"
            ></v-text-field>

            <v-text-field
                v-model="$_street_line_1"
                label="Street Line 1"
                :color="brandColor"
                :rules="validationRules.street_line_1"
            ></v-text-field>

            <v-text-field
                v-model="$_street_line_2"
                label="Street Line 2"
                :color="brandColor"
            ></v-text-field>

            <v-text-field
                v-model="$_zip"
                label="Zip/Postal Code"
                :color="brandColor"
                :rules="validationRules.zip"
            ></v-text-field>

            <v-text-field
                v-model="$_city"
                label="City"
                :color="brandColor"
                :rules="validationRules.city"
            ></v-text-field>

            <v-select
                v-model="$_country"
                label="Country"
                :color="brandColor"
                :items="countries"
                item-value="name"
                item-text="name"
                :rules="validationRules.country"
            ></v-select>

            <v-select
                v-if="$_country === 'Canada'"
                v-model="$_region"
                label="State/Province"
                :color="brandColor"
                :items="provinces"
                :rules="validationRules.region"
            ></v-select>

            <v-text-field
                v-if="$_country !== 'Canada'"
                v-model="$_region"
                label="State/Province"
                :color="brandColor"
                :rules="validationRules.region"
            ></v-text-field>
        </div>
    </v-form>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Utils from '@musora/helper-functions/modules/utils';
import cartApi from '../../../../api/ecommerce/cart';
import brandColors from '../../../../api/mixins.js';

export default {
    name: 'ShippingAddressForm',
    mixins: [brandColors],
    props: {
        address: {
            type: Object,
            default: () => null,
        },

        userId: {
            type: String | Number,
            default: () => 0,
        },

        shippingAddresses: {
            type: Array,
            default: () => [],
        },

        shippingAddressState: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            valid: false,
            validationRules: {
                shippingAddress: [
                    v => !!v || 'Shipping Address is required.',
                ],
                type: [
                    v => !!v || 'Type is required.',
                ],
                first_name: [
                    v => !!v || 'First Name is required.',
                ],
                last_name: [
                    v => !!v || 'Last Name is required.',
                ],
                street_line_1: [
                    v => !!v || 'Street Line 1 is required.',
                ],
                zip: [
                    v => !!v || 'Zip/Postal Code is required.',
                ],
                country: [
                    v => !!v || 'Country is required.',
                ],
                city: [
                    v => !!v || 'City is required',
                ],
                region: [
                    v => !!v || 'Province is required.',
                ],
            },
            editingAddress: {},
            useExistingShippingAddress: false,
            selectedShippingAddress: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),

        countries() {
            return window.countryList;
        },

        provinces() {
            return Utils.provinces();
        },

        $_first_name: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_first_name;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_first_name',
                    value,
                });
            },
        },

        $_last_name: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_last_name;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_last_name',
                    value,
                });
            },
        },

        $_street_line_1: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_address_line_1;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_address_line_1',
                    value,
                });
            },
        },

        $_street_line_2: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_address_line_2;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_address_line_2',
                    value,
                });
            },
        },

        $_city: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_city;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_city',
                    value,
                });
            },
        },

        $_zip: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_zip_or_postal_code;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_zip_or_postal_code',
                    value,
                });
            },
        },

        $_country: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_country;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_country',
                    value,
                });

                this.$_region = undefined;
                this.$nextTick(() => this.$forceUpdate());
            },
        },

        $_region: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_region;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_region',
                    value,
                });
            },
        },

        $_shipping_address_id: {
            cache: false,
            get() {
                return this.shippingAddressState.shipping_address_id;
            },
            set(value) {
                this.$emit('updateShippingAddressState', {
                    key: 'shipping_address_id',
                    value,
                });
            },
        },
    },
    methods: {
        getDefaultAddress: () => ({
            id: 0,
            attributes: {},
            relationships: {},
        }),

        submitForm() {
            if (this.$refs.form.validate()) {
                this.$emit('formSubmit', this.editingAddress);
            }
        },

        updateSessionWithExistingAddress(id) {
            const existingAddress = this.shippingAddresses.find(address => address.id === id);

            cartApi.updateAddressesInSession({
                shipping_first_name: existingAddress.attributes.first_name,
                shipping_last_name: existingAddress.attributes.last_name,
                shipping_address_line_1: existingAddress.attributes.street_line_1,
                shipping_address_line_2: existingAddress.attributes.street_line_2,
                shipping_city: existingAddress.attributes.city,
                shipping_country: existingAddress.attributes.country,
                shipping_region: existingAddress.attributes.region,
                shipping_zip_or_postal_code: existingAddress.attributes.zip,
            })
                .then((response) => {
                    if (response) {
                        this.$emit('updateCart', response.data.meta.cart);
                    }
                });
        },

        cancelForm() {
            this.editingAddress = null;
            this.$refs.form.resetValidation();

            this.$emit('formCancel');
        },
    },
};
</script>
