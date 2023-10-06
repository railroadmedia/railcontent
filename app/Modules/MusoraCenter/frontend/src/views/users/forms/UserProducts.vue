<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>User Access Permissions</v-toolbar-title>

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

                <span>Add User Access Permission</span>
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
                <tr>
                    <td class="text-center">
                        <v-custom-brand-icon :brand="item.brand"></v-custom-brand-icon>
                    </td>

                    <td class="text-left">
                        {{ item.permission_name }}
                    </td>
                    <td class="text-left">
                        {{ item.duration }}
                    </td>
                    <td class="text-left">
                        {{ getStartDate(item.start_time) }}
                    </td>

                    <td class="text-left">
                        {{ getActiveUntil(item.expiration_time) }}
                    </td>

                    <td class="text-left">
                        {{ item.source }}
                    </td>

                    <td class="text-left">
                        {{ item.status }}
                    </td>

                    <td class="text-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    :color="brandColor"
                                    class="mx-1 white&#45;&#45;text"
                                    v-on="on"
                                    @click="openEditForm(item.id)"
                                >
                                    <v-icon>
                                        edit
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Edit User Access Permission</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="error"
                                    class="mx-1 white&#45;&#45;text"
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
                    <v-toolbar-title>Add User Access Permission</v-toolbar-title>
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
                            v-model="$_permission_id"
                            label="Permission"
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
                                    v-model="$_start_time"
                                    label="Start Time"
                                    :color="brandColor"
                                    hint="Time user is granted access.  Actual active time may differ if permissions overlap."
                                    clearable
                                    persistent-hint
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>

                            <v-date-picker
                                v-model="$_start_time"
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
                        <v-checkbox
                            v-model="$_is_lifetime"
                            label="Lifetime"
                            :color="brandColor"
                        ></v-checkbox>
                        <v-text-field
                            v-model="$_nDays"
                            v-if="!$_is_lifetime"
                            type="number"
                            label="# Days"
                            hint="Number of days until access revoked.  Used to calculate access Expiration Time."
                            :color="brandColor"
                        ></v-text-field>
                        <v-text-field
                            v-model="$_nMonths"
                            v-if="!$_is_lifetime"
                            type="number"
                            label="# Months"
                            hint="Number of months until access revoked.  Used to calculate access Expiration Time."
                            :color="brandColor"
                        ></v-text-field>
                        <v-select
                            v-model="$_status"
                            label="Status"
                            :color="brandColor"
                            :items="['Active', 'Revoked']"
                        ></v-select>
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
                    width: 100,
                },
                {
                    text: 'Name',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Duration',
                    align: 'left',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Active From',
                    align: 'left',
                    sortable: false,
                    width: 190,
                },
                {
                    text: 'Expires On',
                    align: 'left',
                    sortable: false,
                    width: 190,
                },
                {
                    text: 'Source',
                    align: 'left',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Status',
                    align: 'left',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    width: 120,
                },
            ],
            editingUserAccessPermission: this.getDefaultUserAccessPermission(),
        };
    },
    computed: {
        ...mapState({
            permissionsOptions: state => state.permissions.permissions,
            products: state => state.products.products,
        }),

        $_permission_id: {
            get() {
                return this.editingUserAccessPermission.attributes.id;
            },
            set({ id }) {
                this.$set(this.editingUserAccessPermission.attributes, 'id', id);
            },
        },

        $_is_lifetime: {
            get() {
                return this.editingUserAccessPermission.attributes.time_lifetime;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission.attributes, 'time_lifetime', value);
            },
        },

        $_nDays: {
            get() {
                return this.editingUserAccessPermission.attributes.time_days || 0;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission.attributes, 'time_days', value);
            },
        },

        $_nMonths: {
            get() {
                return this.editingUserAccessPermission.attributes.time_months || 0;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission.attributes, 'time_months', value);
            },
        },

        $_status:{
            get() {
                return this.editingUserAccessPermission.attributes.status;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission.attributes, 'status', value);
            },
        },

        $_start_time: {
            get() {
                return this.editingUserAccessPermission.attributes.start_time;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission.attributes, 'start_time', value);
            },
        },
    },
    methods: {
        ...mapActions('permissions', [
            'getPermissions',
        ]),

        getDefaultUserAccessPermission() {
            return {
                id: 0,
                attributes: {
                    status : 'Active',
                    start_time : this.moment(this.moment.now()).format('YYYY-MM-DD'),
                },
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

            return '-';
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
                this.editingUserAccessPermission = Utils.createObjectCopy(thisUserProduct);
            } else {
                this.editingUserAccessPermission = this.getDefaultUserAccessPermission();
            }

            this.dialog = true;
        },

        submitEditForm() {
            this.$root.$emit('pageLoading');

            api.setUserProduct(this.editingUserAccessPermission.id, {
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
                        this.editingUserAccessPermission = this.getDefaultUserAccessPermission();
                    } else {
                        this.$root.$emit('displayMessage', {
                            text: 'Oops! Something went wrong. Product not added to this user.',
                            color: 'error',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
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
