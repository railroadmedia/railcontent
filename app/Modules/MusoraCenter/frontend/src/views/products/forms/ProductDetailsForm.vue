<template>
    <!--<v-flex column xs12 md6 class="mt-4 mb-2 text-xs-center mb-12 px-4"-->
    <!--style="margin:0 auto;">-->
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>
                {{ formTitle }}
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
                <v-text-field
                    v-model="$_product_name"
                    label="Name"
                    :color="brandColor"
                    :rules="validationRules.name"
                    :validate-on-blur="false"
                    :required="true"
                ></v-text-field>
                <v-select
                    v-model="$_product_brand"
                    label="Brand"
                    :color="brandColor"
                    :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora']"
                    :rules="validationRules.brand"
                    required
                    @change="getPermissionsByBrand()"
                ></v-select>
<!--                <v-text-field-->
<!--                    v-model="$_product_sku"-->
<!--                    label="SKU"-->
<!--                    :color="brandColor"-->
<!--                    :rules="validationRules.sku"-->
<!--                    hint="Marketing/Sales SKU. Must be unique, do not edit this for existing products unless you know what you are doing"-->
<!--                    persistent-hint-->
<!--                    class="mb-4"-->
<!--                    :required="true"-->
<!--                ></v-text-field>-->

<!--                <v-text-field-->
<!--                    v-model="$_fulfillment_sku"-->
<!--                    label="Inventory/Fulfillment Name"-->
<!--                    :color="brandColor"-->
<!--                    :rules="validationRules.fulfillment_sku"-->
<!--                    hint="This is used by out shipping company to figure out which products are which."-->
<!--                    persistent-hint-->
<!--                    class="mb-4"-->
<!--                    :required="false"-->
<!--                ></v-text-field>-->

<!--                <v-text-field-->
<!--                    v-model="$_inventory_control_sku"-->
<!--                    label="Inventory Control SKU"-->
<!--                    :color="brandColor"-->
<!--                    :rules="validationRules.inventory_control_sku"-->
<!--                    hint="Used by accounting."-->
<!--                    persistent-hint-->
<!--                    class="mb-4"-->
<!--                    :required="false"-->
<!--                ></v-text-field>-->

<!--                <v-text-field-->
<!--                    v-model="$_product_price"-->
<!--                    label="Price"-->
<!--                    :color="brandColor"-->
<!--                    :rules="validationRules.price"-->
<!--                    :required="true"-->
<!--                ></v-text-field>-->

<!--                <v-custom-file-input-->
<!--                    v-model="$_product_thumbnail"-->
<!--                    label="Thumbnail Image"-->
<!--                    input-key="Thumbnail Image"-->
<!--                    :color="brandColor"-->
<!--                    :base-file-name="thisProduct.id + '-product-thumb-'"-->
<!--                    upload-endpoint="/railcontent/remote"-->
<!--                    :required="true"-->
<!--                ></v-custom-file-input>-->

<!--                <v-textarea-->
<!--                    v-model="$_product_description"-->
<!--                    label="Description"-->
<!--                    :color="brandColor"-->
<!--                    multi-line-->
<!--                    no-resize-->
<!--                    class="mt-4"-->
<!--                ></v-textarea>-->

<!--                <v-select-->
<!--                    v-model="$_product_type"-->
<!--                    label="Type"-->
<!--                    :color="brandColor"-->
<!--                    :items="['digital subscription', 'digital one time', 'physical one time']"-->
<!--                    :rules="validationRules.type"-->
<!--                    required-->
<!--                ></v-select>-->
<!--                <v-text-field-->
<!--                    v-model="$_product_category"-->
<!--                    label="Category"-->
<!--                    :color="brandColor"-->
<!--                    :rules="validationRules.category"-->
<!--                    :required="true"-->
<!--                ></v-text-field>-->

<!--                <v-text-field-->
<!--                    v-model="$_sales_page_url"-->
<!--                    label="Sales Page URL"-->
<!--                    :color="brandColor"-->
<!--                ></v-text-field>-->

<!--                <v-switch-->
<!--                    v-model="$_is_active"-->
<!--                    label="Is Active"-->
<!--                    :color="brandColor"-->
<!--                ></v-switch>-->

<!--                <v-switch-->
<!--                    v-model="$_is_physical"-->
<!--                    label="Is Physical"-->
<!--                    :color="brandColor"-->
<!--                ></v-switch>-->

<!--                <v-text-field-->
<!--                    v-if="$_is_physical"-->
<!--                    v-model="$_product_weight"-->
<!--                    label="Weight"-->
<!--                    :color="brandColor"-->
<!--                    suffix="lbs."-->
<!--                    :disabled="!$_is_physical"-->
<!--                    class="mb-4"-->
<!--                    required-->
<!--                ></v-text-field>-->

<!--                <v-divider class="mt-5 mb-5"></v-divider>-->

<!--                <v-text-field-->
<!--                    v-model="$_public_stock_count"-->
<!--                    label="Public Stock Count (for visual marketing purposes, students can see this on sales pages)"-->
<!--                    :color="brandColor"-->
<!--                    :rules="validationRules.public_stock_count"-->
<!--                    :required="true"-->
<!--                ></v-text-field>-->

<!--                <v-divider class="mt-5 mb-5"></v-divider>-->

<!--                <v-label>-->
<!--                  Do not edit the 'Stock Count' or 'Min Stock Level'-->
<!--                  values unless you know what are you are doing. If you are a marketer-->
<!--                  and looking to update the public facing stock number that people see on the sales pages, edit the-->
<!--                  "Public Stock Count" value above.-->
<!--                </v-label>-->

<!--                <v-switch-->
<!--                    v-model="unlockStockCount"-->
<!--                    label="Unlock Stock Count Editing (FINANCE TEAM ONLY)"-->
<!--                    :color="brandColor"-->
<!--                ></v-switch>-->

<!--                <v-text-field-->
<!--                    :disabled="!unlockStockCount"-->
<!--                    v-model.number="$_product_stock"-->
<!--                    label="Stock Count (MUST LEAVE EMPTY FOR NON-PHYSICAL ITEMS)"-->
<!--                    :color="brandColor"-->
<!--                ></v-text-field>-->

<!--                <v-text-field-->
<!--                    :disabled="!unlockStockCount"-->
<!--                    v-model="$_min_stock_level"-->
<!--                    label="Min Stock Level (product will not be purchasable once stock count reaches this level)"-->
<!--                    :color="brandColor"-->
<!--                    :rules="validationRules.min_stock_level"-->
<!--                    :required="true"-->
<!--                ></v-text-field>-->

<!--                <v-divider class="mt-5 mb-5"></v-divider>-->
                <v-text-field
                    v-model="$_product_shopify_id"
                    label="Shopify Id"
                    :color="brandColor"
                    :required="false"
                ></v-text-field>
                <v-select
                    v-model="$_digital_access_permission_names"
                    label="Permission names"
                    multiple
                    :color="brandColor"
                    :value="$_digital_access_permission_names"
                    :items="permissionsOptions"
                    item-text="name"
                    :rules="validationRules.digital_access_permission_names"
                ></v-select>
                <v-text-field
                    v-model="$_digital_access_time_interval_length"
                    label="Digital access time interval length (1, 3, 6, etc)"
                    :color="brandColor"
                    :rules="validationRules.digital_access_time_interval_length"
                    :required="false"
                ></v-text-field>
                <v-text-field
                    v-model="$_digital_access_time_interval_type"
                    label="Digital access time interval type (day, month, year)"
                    :color="brandColor"
                    :rules="validationRules.digital_access_time_interval_type"
                    :required="false"
                ></v-text-field>
                <v-text-field
                    v-model="$_digital_access_time_type"
                    label="Digital access time type (recurring, one time, lifetime)"
                    :color="brandColor"
                    :rules="validationRules.digital_access_time_type"
                    :required="false"
                ></v-text-field>
                <v-text-field
                    v-model="$_digital_access_type"
                    label="Digital acccess type (all content access, basic content access, specific content access)"
                    :color="brandColor"
                    :rules="validationRules.digital_access_type"
                    :required="false"
                ></v-text-field>
                <v-menu
                    ref="menu"
                    v-model="datepicker"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                          slot="activator"
                          v-model="$_digital_membership_access_expiration_date"
                          label="Digital Membership Access Expiration Date"
                          hint="Acquiring this product will give the user bonus Musora+ Membership access until the specified date. Leave blank for no Membership access."
                          :color="brandColor"
                          clearable
                          persistent-hint
                          readonly
                          v-on="on"
                      ></v-text-field>
                    </template>

                    <v-date-picker
                        v-model="$_digital_membership_access_expiration_date"
                        no-title
                        scrollable
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            :color="brandColor"
                            @click.stop="datepicker = false"
                        >
                          Cancel
                        </v-btn>
                        <v-btn
                            text
                            :color="brandColor"
                            @click.stop="datepicker = false"
                        >
                          OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>
                <v-select
                    v-if="$_product_type === 'digital subscription'"
                    v-model="$_subscription_interval_type"
                    label="Subscription Interval Type  (day, month, year)"
                    :color="brandColor"
                    :items="['month', 'year']"
                    :rules="validationRules.interval_type"
                    :disabled="$_product_type !== 'digital subscription'"
                    required
                ></v-select>

                <v-text-field
                    v-if="$_product_type === 'digital subscription'"
                    v-model="$_subscription_interval_count"
                    label="Subscription Interval Count (1, 3, 6, etc)"
                    :color="brandColor"
                    :rules="validationRules.interval_count"
                    :disabled="$_product_type !== 'digital subscription'"
                    hint="Interval Count refers to the amount of times a user is charged per Interval Type"
                    persistent-hint
                    class="mb-2"
                    required
                ></v-text-field>
                  <div class="text-right">
                    <v-btn
                        text
                        class="mr-1"
                        @click="cancelEditForm"
                    >
                        Cancel
                    </v-btn>

                    <v-btn
                        :color="brandColor"
                        class="white--text"
                        :disabled="!valid"
                        @click="submitForm"
                    >
                        Save
                    </v-btn>
                </div>
            </v-form>
        </v-col>
    </v-card>
    <!--</v-flex>-->
</template>
<script>
import { mapActions, mapState } from 'vuex';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils.js';
import CustomFileInput from '../../../components/CustomFileInput';
import api from '../../../api/ecommerce/products';
import PermissionsApi from '@/api/permissions';

const defaultProduct = {
    name: undefined,
    sku: undefined,
    fulfillment_sku: undefined,
    inventory_control_sku: undefined,
    price: undefined,
    thumbnail_url: undefined,
    type: undefined,
    active: 0,
    is_physical: 0,
    weight: undefined,
    stock: undefined,
    min_stock_level: 0,
    subscription_interval_type: undefined,
    subscription_interval_count: undefined,
    digital_access_permission_names: [],
    public_stock_count: 0,
    digital_access_time_interval_length: 0,
    digital_access_time_type: undefined,
    digital_access_time_interval_type: undefined,
    digital_access_type: undefined,
    $_digital_membership_access_expiration_date: undefined,
};

export default {
    name: 'ProductDetailsForm',
    components: {
        'v-custom-file-input': CustomFileInput,
    },
    mixins: [brandColors],
    props: {
        thisProduct: {
            type: Object,
            default: () => null,
        },
        isNewProduct: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            original_data: this.thisProduct,
            this_product: this.thisProduct || { id: 0, attributes: {} },
            valid: false,
            permissionsOptions: [],
            unlockStockCount: false,
            datepicker: false,
            validationRules: {
                name: [
                    v => !!v || 'Name is required.',
                ],
                brand: [
                    v => !!v || 'Name is required.',
                ],
                sku: [
                    v => !!v || 'SKU is required.',
                ],
                fulfillment_sku: [
                ],
                inventory_control_sku: [
                ],
                price: [
                    v => (!!v || v === 0) || 'Price is required.',
                    v => (/^(\d|-)?(\d|,)*\.?\d*$/).test(v) || 'Price must be a valid number',
                ],
                type: [
                    v => !!v || 'Type is required.',
                ],
                weight: [
                    v => (!!v || v === 0) || 'Weight is required.',
                    v => (/^(\d|-)?(\d|,)*\.?\d*$/).test(v) || 'Weight must be a valid number',
                ],
                stock: [
                    v => (!!v || v === 0) || 'Stock is required.',
                    v => (/^(\d|-)?(\d|,)*\.?\d*$/).test(v) || 'Stock must be a valid number',
                ],
                min_stock_level: [
                    v => (/^(\d|-)?(\d|,)*\.?\d*$/).test(v) || 'Min stock level count must be a valid number',
                ],
                interval_type: [
                    v => !!v || 'Interval Type is required.',
                ],
                interval_count: [
                    v => !!v || 'Interval Count is required.',
                ],
                digital_access_permission_names: [
                ],
                public_stock_count: [
                    v => (/^(\d|-)?(\d|,)*\.?\d*$/).test(v) || 'Public stock count must be a valid number',
                ],
                digital_access_time_interval_length: [
                ],
                digital_access_time_type: [
                ],
                digital_access_time_interval_type: [
                ],
                digital_access_type: [
                ],
                digital_membership_access_expiration_date:[
                ],
            },
        };
    },
    computed: {
        ...mapState({
            state: state => state.products,
        }),

        formTitle() {
            if (this.isNewProduct) {
                return 'Add New Product';
            }

            return `Edit Product: ${this.thisProduct.attributes.name}`;
        },

        $_product_name: {
            cache: false,
            get() {
                return this.thisProduct.attributes.name || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'name',
                    value: val,
                });
            },
        },

        $_product_brand: {
            cache: false,
            get() {
                return this.thisProduct.attributes.brand || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'brand',
                    value: val,
                });
            },
        },

        $_product_sku: {
            cache: false,
            get() {
                return this.thisProduct.attributes.sku || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'sku',
                    value: val,
                });
            },
        },

        $_fulfillment_sku: {
            cache: false,
            get() {
                return this.thisProduct.attributes.fulfillment_sku || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'fulfillment_sku',
                    value: val,
                });
            },
        },

        $_inventory_control_sku: {
            cache: false,
            get() {
                return this.thisProduct.attributes.inventory_control_sku || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'inventory_control_sku',
                    value: val,
                });
            },
        },

        $_product_price: {
            cache: false,
            get() {
                return this.thisProduct.attributes.price || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'price',
                    value: val,
                });
            },
        },

        $_product_description: {
            cache: false,
            get() {
                return this.thisProduct.attributes.description || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'description',
                    value: val,
                });
            },
        },

        $_product_thumbnail: {
            cache: false,
            get() {
                return this.thisProduct.attributes.thumbnail_url || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'thumbnail_url',
                    value: val,
                });
            },
        },

        $_product_type: {
            cache: false,
            get() {
                return this.thisProduct.attributes.type || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'type',
                    value: val,
                });

                this.$nextTick(() => {
                    this.$forceUpdate();
                });
            },
        },

        $_product_category: {
            cache: false,
            get() {
                return this.thisProduct.attributes.category || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'category',
                    value: val,
                });
            },
        },

        $_sales_page_url: {
            cache: false,
            get() {
                return this.thisProduct.attributes.sales_page_url || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'sales_page_url',
                    value: val,
                });
            },
        },

        $_is_active: {
            cache: false,
            get() {
                return this.thisProduct.attributes.active || false;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'active',
                    value: val,
                });
            },
        },

        $_is_physical: {
            cache: false,
            get() {
                return this.thisProduct.attributes.is_physical || false;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'is_physical',
                    value: val,
                });
            },
        },

        $_product_weight: {
            cache: false,
            get() {
                return this.thisProduct.attributes.weight || 0;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'weight',
                    value: val,
                });
            },
        },

        $_product_stock: {
            cache: false,
            get() {
                if (this.$_product_type !== 'physical one time') {
                    return null;
                }

                if (Number.isInteger(this.thisProduct.attributes.stock)) {
                    return this.thisProduct.attributes.stock;
                } else {
                    return null;
                }
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'stock',
                    value: val,
                });
            },
        },

        $_min_stock_level: {
            cache: false,
            get() {
                return this.thisProduct.attributes.min_stock_level || 0;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'min_stock_level',
                    value: val,
                });
            },
        },

        $_subscription_interval_type: {
            cache: false,
            get() {
                return this.thisProduct.attributes.subscription_interval_type;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'subscription_interval_type',
                    value: val,
                });
            },
        },

        $_subscription_interval_count: {
            cache: false,
            get() {
                return this.thisProduct.attributes.subscription_interval_count;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'subscription_interval_count',
                    value: val,
                });
            },
        },
        $_digital_access_permission_names: {
            cache: false,
            get() {
                return this.thisProduct.attributes.digital_access_permission_names;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'digital_access_permission_names',
                    value: val,
                });
            },
        },
        $_public_stock_count: {
            cache: false,
            get() {
                return this.thisProduct.attributes.public_stock_count || 0;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'public_stock_count',
                    value: val,
                });
            },
        },
        $_digital_access_time_interval_length: {
            cache: false,
            get() {
                return this.thisProduct.attributes.digital_access_time_interval_length || 0;
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'digital_access_time_interval_length',
                    value: val,
                });
            },
        },
        $_digital_access_time_type: {
            cache: false,
            get() {
                return this.thisProduct.attributes.digital_access_time_type || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'digital_access_time_type',
                    value: val,
                });
            },
        },
        $_digital_access_time_interval_type: {
            cache: false,
            get() {
                return this.thisProduct.attributes.digital_access_time_interval_type || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'digital_access_time_interval_type',
                    value: val,
                });
            },
        },
        $_digital_access_type: {
            cache: false,
            get() {
                return this.thisProduct.attributes.digital_access_type || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'digital_access_type',
                    value: val,
                });
            },
        },
        $_digital_membership_access_expiration_date: {
            cache: false,
            get() {
                return this.thisProduct.attributes.digital_membership_access_expiration_date || '';
            },
            set(val) {
                this.setCurrentProductAttribute({
                    key: 'digital_membership_access_expiration_date',
                    value: val,
                });
            },
        },
        $_product_shopify_id: {
            cache: false,
            get() {
                return this.thisProduct.attributes.shopify_id || '';
            },
        },

    },
    mounted() {
        this.$_digital_access_permission_names_original = this.$_digital_access_permission_names;
        this.$_product_brand_original = this.$_product_brand;
        this.getPermissionsByBrand();
    },
    methods: {
        ...mapActions('products', [
            'setCurrentProduct',
            'setCurrentProductAttribute',
        ]),

        submitForm() {
            api.setProduct(this.this_product.id, this.isNewProduct ? 'put' : 'patch', {
                name: this.$_product_name,
                brand: this.$_product_brand,
                sku: this.$_product_sku,
                fulfillment_sku: this.$_fulfillment_sku,
                inventory_control_sku: this.$_inventory_control_sku,
                price: this.$_product_price,
                type: this.$_product_type,
                category: this.$_product_category,
                sales_page_url: this.$_sales_page_url,
                active: this.$_is_active,
                is_physical: this.$_is_physical,
                weight: this.$_product_weight,
                stock: this.$_product_stock,
                min_stock_level: this.$_min_stock_level,
                thumbnail_url: this.$_product_thumbnail,
                description: this.$_product_description,
                subscription_interval_type: this.$_subscription_interval_type,
                subscription_interval_count: this.$_subscription_interval_count,
                digital_access_permission_names: this.$_digital_access_permission_names,
                public_stock_count: this.$_public_stock_count,
                digital_access_time_interval_length: this.$_digital_access_time_interval_length,
                digital_access_time_type: this.$_digital_access_time_type,
                digital_access_time_interval_type: this.$_digital_access_time_interval_type,
                digital_access_type: this.$_digital_access_type,
                digital_membership_access_expiration_date: this.$_digital_membership_access_expiration_date,
            })
                .then((response) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: `Product successfully ${this.isNewProduct ? 'created.' : 'edited.'}`,
                            color: 'success',
                        });

                        if (this.isNewProduct) {
                            this.$router.push({
                                name: 'products.edit',
                                params: {
                                    id: response.data.data.id,
                                },
                            });
                        } else {
                            this.$emit('formSuccess', response.data.data);
                        }
                    } else {
                        this.$root.$emit('displayMessage', {
                            text: `Oops! Something went wrong. Product not ${this.isNewProduct ? 'created.' : 'edited.'}`,
                            color: 'error',
                        });
                    }

                    this.$nextTick(() => {
                        this.$forceUpdate();
                    });
                });
        },
        getPermissionsByBrand() {
            if (this.$_product_brand) {
                PermissionsApi.getPermissions({
                    limit: 100,
                })
                    .then((response) => {
                        const options = response.data.data.filter(data => data.brand === this.$_product_brand || data.brand === 'musora');
                        this.permissionsOptions = Utils.dynamicSort(options, 'name');
                    });

                if (this.$_product_brand === this.$_product_brand_original) {
                    this.$_digital_access_permission_names = this.$_digital_access_permission_names_original;
                } else {
                    this.$_digital_access_permission_names = [];
                }
            }
        },
        cancelEditForm() {
            if (this.isNewProduct) {
                this.this_product = Utils.createObjectCopy(defaultProduct);
                this.$refs.form.reset();
                this.$emit('formClosed');
            } else {
                this.$router.push({ name: 'products' });
            }
        },
    },
};
</script>
