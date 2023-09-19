<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>User Products</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="openEditForm(0)"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Add New Level</span>
            </v-tooltip>
        </v-toolbar>

        <v-data-table
            :headers="headings"
            :items="userProducts"
            :items-per-page="5"
        >
            <template
                v-slot:item="{ item }"
            >
                <tr :class="{'deleted-table-row': !!item.attributes.deleted_at}">
                    <td class="text-center">
                        <v-custom-brand-icon :brand="getProductBrand(item.relationships.product.data)"></v-custom-brand-icon>
                    </td>

                    <td class="text-left">
                        {{ getProductName(item.relationships.product.data) }}
                    </td>

                    <td class="text-left">
                        {{ getStartDate(item.attributes.start_date) }}
                    </td>

                    <td class="text-left">
                        {{ getActiveUntil(item.attributes.expiration_date) }}
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
                                    @click="openEditForm(item.id)"
                                >
                                    <v-icon>
                                        edit
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Edit User Product</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="error"
                                    class="mx-1 white--text"
                                    v-on="on"
                                    @click.stop="cancelUserProduct(item.id)"
                                >
                                    <v-icon>
                                        cancel
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Expire</span>
                        </v-tooltip>
                    </td>
                </tr>
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
                    <v-toolbar-title>Add User Level</v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form
                        ref="newPassword"
                        lazy-validation
                    >
                        <v-combobox
                            v-model="$_product_id"
                            label="Product"
                            :color="brandColor"
                            :items="products"
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

                        <v-text-field
                            v-model="$_quantity"
                            type="number"
                            label="Quantity"
                            :color="brandColor"
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
                                    v-model="$_expiration_date"
                                    label="Expires On"
                                    :color="brandColor"
                                    hint="Leave blank to never expire."
                                    clearable
                                    persistent-hint
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="$_expiration_date"
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


                        <v-menu
                            ref="menu"
                            v-model="pausedUntilDatepicker"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    slot="activator"
                                    v-model="$_paused_until_date"
                                    label="Paused Until"
                                    :color="brandColor"
                                    hint="Leave blank to not prevent access before a date."
                                    clearable
                                    persistent-hint
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="$_paused_until_date"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click.stop="pausedUntilDatepicker = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    :color="brandColor"
                                    @click.stop="pausedUntilDatepicker = false"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>

                        <div class="text-right">
                            <v-btn
                                text
                                @click.stop="dialog = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :color="brandColor"
                                @click.stop="submitEditForm"
                            >
                                Save
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
import api from '../../../api/ecommerce/user-products';
import JsonApiMethods from '../../../mixins/json-api-methods';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';

const defaultUserProduct = () => ({
    id: 0,
    attributes: {},
    relationships: {
        user: { data: {} },
        product: { data: {} },
    },
});

export default {
    name: 'UserProducts',
    mixins: [brandColors, JsonApiMethods],
    components: {
        'v-custom-brand-icon': CustomBrandIcon,
    },
    props: {
        userId: {
            type: Number | String,
            default: () => 0,
        },

        userProducts: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            dialog: false,
            datepicker: false,
            pausedUntilDatepicker: false,
            headings: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Name',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Paused Until',
                    align: 'left',
                    sortable: false,
                    width: 190,
                },
                {
                    text: 'Active Until',
                    align: 'left',
                    sortable: false,
                    width: 190,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    width: 120,
                },
            ],
            editingUserProduct: this.getDefaultUserProduct(),
        };
    },
    computed: {
        ...mapState({
            permissionsOptions: state => state.permissions.permissions,
            products: state => state.products.products,
        }),

        $_product_id: {
            get() {
                return this.editingUserProduct.relationships.product.data.id;
            },
            set({ id }) {
                this.$set(this.editingUserProduct.relationships.product.data, 'id', id);
            },
        },

        $_quantity: {
            get() {
                return this.editingUserProduct.attributes.quantity || 1;
            },
            set(value) {
                this.$set(this.editingUserProduct.attributes, 'quantity', value);
            },
        },

        $_paused_until_date: {
            get() {
                return this.editingUserProduct.attributes.start_date;
            },
            set(value) {
                this.$set(this.editingUserProduct.attributes, 'start_date', value);
            },
        },

        $_expiration_date: {
            get() {
                return this.editingUserProduct.attributes.expiration_date;
            },
            set(value) {
                this.$set(this.editingUserProduct.attributes, 'expiration_date', value);
            },
        },
    },
    methods: {
        ...mapActions('permissions', [
            'getPermissions',
        ]),

        getDefaultUserProduct() {
            return {
                id: 0,
                attributes: {},
                relationships: {
                    user: { data: {} },
                    product: { data: {} },
                },
            };
        },

        getActiveUntil(date) {
            if (date) {
                return this.moment(date).format('MMM D, Y - HH:mm');
            }

            return 'Forever';
        },

        getStartDate(date) {
            if (date) {
                return this.moment(date).format('MMM D, Y - HH:mm');
            }

            return '-';
        },

        openEditForm(id) {
            const thisUserProduct = this.userProducts.find(userProduct => userProduct.id === id);

            if (id) {
                this.editingUserProduct = Utils.createObjectCopy(thisUserProduct);
            } else {
                this.editingUserProduct = this.getDefaultUserProduct();
            }

            this.dialog = true;
        },

        submitEditForm() {
            this.$root.$emit('pageLoading');

            api.setUserProduct(this.editingUserProduct.id, {
                user_id: this.userId,
                product_id: this.$_product_id,
                quantity: this.$_quantity,
                expiration_date: this.$_expiration_date || null,
                start_date: this.$_paused_until_date || null,
            })
                .then((response) => {
                    if (response) {
                        this.$emit('userProductEdit');
                        this.$root.$emit('displayMessage', {
                            text: 'Product successfully added to this user!',
                            color: 'success',
                        });

                        this.dialog = false;
                        this.editingUserProduct = this.getDefaultUserProduct();
                    } else {
                        this.$root.$emit('displayMessage', {
                            text: 'Oops! Something went wrong. Product not added to this user.',
                            color: 'error',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        getProductName(data) {
            return this.getRelatedAttributesByTypeAndId(
                data,
                this.userPaymentMethodsIncludedData,
            ).attributes.name || 'N/A';
        },

        getProductBrand(data) {
            return this.getRelatedAttributesByTypeAndId(
                data,
                this.userPaymentMethodsIncludedData,
            ).attributes.brand || 'N/A';
        },

        cancelUserProduct(user_product_id) {
            const confirmation = confirm('Are you sure you wish to expire this User Product?');

            if (confirmation) {
                api.setUserProduct(user_product_id, {
                    expiration_date: this.moment(this.moment.now()).subtract(1, 'days').format('YYYY-MM-DD'),
                })
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'User Product successfully canceled!',
                                color: 'success',
                            });

                            this.$emit('userProductEdit');
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops! Something went wrong. User Product likely not canceled.',
                                color: 'error',
                            });
                        }
                    });
            }

        },
    },
};
</script>
