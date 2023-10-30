<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Shipping/Billing Addresses</v-toolbar-title>

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

                <span>Add New Address</span>
            </v-tooltip>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="userAddresses"
            :items-per-page="5"
            class="elevation-1"
        >
            <template v-slot:item="{ item }">
                <tr :class="{'deleted-table-row': !!item.attributes.deleted_at}">
                    <td class="text-center">
                        <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                    </td>

                    <td class="text-center">
                        {{ item.attributes.type }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.street_line_1 }}
                        <br>
                        {{ item.attributes.street_line_2 }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.city }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.region }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.country }}
                    </td>

                    <td class="text-center">
                        {{ moment(item.attributes.created_at).format('MMM D, Y') }}
                    </td>

                    <td class="text-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="success"
                                    class="mx-1 white--text"
                                    v-on="on"
                                    @click="copyAddressToClipboard(item)"
                                >
                                    <v-icon>
                                        file_copy
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Copy to Clipboard</span>
                        </v-tooltip>

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

                            <span>Edit Address</span>
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
                    <v-toolbar-title>
                        {{ editingAddress ? 'Edit' : 'Add New' }} Address
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    v-if="editingAddress != null"
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form
                        ref="form"
                        v-model="valid"
                    >
                        <v-select
                            v-model="$_type"
                            label="Type"
                            :color="brandColor"
                            :items="['shipping', 'billing']"
                            :rules="validationRules.type"
                            required
                        ></v-select>

                        <v-select
                            v-model="$_brand"
                            label="Brand"
                            :color="brandColor"
                            :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                            :rules="validationRules.brand"
                            required
                        ></v-select>

                        <v-text-field
                            v-model="$_first_name"
                            label="First Name"
                            :color="brandColor"
                            :rules="$_type === 'shipping' ? validationRules.first_name : []"
                            :required="$_type === 'shipping'"
                        ></v-text-field>

                        <v-text-field
                            v-model="$_last_name"
                            label="Last Name"
                            :color="brandColor"
                            :rules="$_type === 'shipping' ? validationRules.last_name : []"
                            :required="$_type === 'shipping'"
                        ></v-text-field>

                        <v-text-field
                            v-model="$_street_line_1"
                            label="Street Line 1"
                            :color="brandColor"
                            :rules="$_type === 'shipping' ? validationRules.street_line_1 : []"
                            :required="$_type === 'shipping'"
                        ></v-text-field>

                        <v-text-field
                            v-model="$_street_line_2"
                            label="Street Line 2"
                            :color="brandColor"
                            :required="$_type === 'shipping'"
                        ></v-text-field>

                        <v-text-field
                            v-model="$_zip"
                            label="Zip/Postal Code"
                            :color="brandColor"
                            :rules="$_type === 'shipping' ? validationRules.zip : []"
                            :required="$_type === 'shipping'"
                        ></v-text-field>

                        <v-text-field
                            v-model="$_city"
                            label="City"
                            :color="brandColor"
                            :rules="$_type === 'shipping' ? validationRules.city : []"
                            :required="$_type === 'shipping'"
                        ></v-text-field>

                        <v-select
                            v-model="$_country"
                            label="Country"
                            :color="brandColor"
                            :items="countries"
                            item-value="name"
                            item-text="name"
                            :rules="validationRules.country"
                            required
                        ></v-select>

                        <v-select
                            v-if="$_country === 'Canada'"
                            v-model="$_region"
                            label="Province"
                            :color="brandColor"
                            :items="provinces"
                            :rules="validationRules.region"
                        ></v-select>

                        <v-text-field
                            v-if="$_country !== 'Canada'"
                            v-model="$_region"
                            label="Region"
                            :color="brandColor"
                            :rules="validationRules.region"
                        ></v-text-field>

                        <div class="text-right">
                            <v-btn
                                text
                                class="mr-1"
                                @click.stop="cancelForm"
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
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>

        <input
            ref="clipboardInput"
            type="text"
            style="position:absolute;top:-9000px;left:-9000px"
            :value="clipboard"
        >
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import api from '../../../api/ecommerce/addresses';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';

export default {
    name: 'UserAddresses',
    components: {
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors],
    props: {
        userId: {
            type: Number | String,
            default: () => null,
        },
        customerId: {
            type: Number | String,
            default: () => null,
        },
        userAddresses: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            dialog: false,
            valid: false,
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Type',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Address',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'City',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Region',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Country',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Created',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    width: 120,
                },
            ],
            validationRules: {
                type: [
                    v => !!v || 'Type is required.',
                ],
                brand: [
                    v => !!v || 'Brand is required.',
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
            editingAddress: null,
            clipboard: '',
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

        $_type: {
            cache: false,
            get() {
                return this.editingAddress.attributes.type;
            },
            set(value) {
                this.$nextTick(() => { this.$forceUpdate(); });
                this.editingAddress.attributes.type = value;
            },
        },

        $_brand: {
            cache: false,
            get() {
                return this.editingAddress.attributes.brand;
            },
            set(value) {
                this.editingAddress.attributes.brand = value;
            },
        },

        $_first_name: {
            cache: false,
            get() {
                return this.editingAddress.attributes.first_name;
            },
            set(value) {
                return this.editingAddress.attributes.first_name = value;
            },
        },

        $_last_name: {
            cache: false,
            get() {
                return this.editingAddress.attributes.last_name;
            },
            set(value) {
                this.editingAddress.attributes.last_name = value;
            },
        },

        $_street_line_1: {
            cache: false,
            get() {
                return this.editingAddress.attributes.street_line_1;
            },
            set(value) {
                this.editingAddress.attributes.street_line_1 = value;
            },
        },

        $_street_line_2: {
            cache: false,
            get() {
                return this.editingAddress.attributes.street_line_2;
            },
            set(value) {
                this.editingAddress.attributes.street_line_2 = value;
            },
        },

        $_city: {
            cache: false,
            get() {
                return this.editingAddress.attributes.city;
            },
            set(value) {
                this.editingAddress.attributes.city = value;
            },
        },

        $_zip: {
            cache: false,
            get() {
                return this.editingAddress.attributes.zip;
            },
            set(value) {
                this.editingAddress.attributes.zip = value;
            },
        },

        $_region: {
            cache: false,
            get() {
                return this.editingAddress.attributes.region;
            },
            set(value) {
                this.editingAddress.attributes.region = value;
            },
        },

        $_country: {
            cache: false,
            get() {
                return this.editingAddress.attributes.country;
            },
            set(value) {
                this.$_region = null;
                this.editingAddress.attributes.country = value;

                this.$nextTick(() => { this.$forceUpdate(); });
            },
        },
    },
    methods: {

        openEditForm(id) {
            this.dialog = true;

            if (id) {
                this.editingAddress = this.userAddresses.find(address => address.id === id);
            } else {
                this.editingAddress = {
                    id: 0,
                    attributes: {},
                    relationships: {},
                };
            }
        },

        submitForm() {
            if (this.$refs.form.validate()) {
                api.setUserAddress(this.editingAddress.id, {
                    user_id: this.userId,
                    customer_id: this.customerId,
                    type: this.$_type,
                    brand: this.$_brand,
                    first_name: this.$_first_name,
                    last_name: this.$_last_name,
                    street_line_1: this.$_street_line_1,
                    street_line_2: this.$_street_line_2,
                    zip: this.$_zip,
                    city: this.$_city,
                    region: this.$_region,
                    country: this.$_country,
                })
                    .then(({ response, error }) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: `User ${this.$_type} address successfully
                                        ${this.editingAddress.id === 0 ? 'created.' : 'updated.'}`,
                                color: 'success',
                            });

                            if (this.editingAddress.id === 0) {
                                this.cancelForm();
                            } else {
                                this.$refs.form.resetValidation();
                            }

                            this.$parent.getUserAddresses();
                        } else {
                            let message = 'Oops something went wrong. Address not created.';

                            if (error && error.errors[0] && error.errors[0].detail && error.errors[0].title) {
                                message = 'Error setting address: ' + error.errors[0].title + ' - ' + error.errors[0].detail;
                            }

                            this.$root.$emit('displayMessage', {
                              text: message,
                              color: 'error',
                              timeout: 15000,
                            });
                          }
                    });
            }
        },

        cancelForm() {
            this.$refs.form.resetValidation();
            this.dialog = false;
            this.editingAddress = null;
        },

        copyAddressToClipboard(item) {
            const { attributes } = item;
            const { clipboardInput } = this.$refs;

            this.clipboard = `${attributes.first_name} ${attributes.last_name} ${attributes.street_line_1} ${attributes.street_line_2} ${attributes.city} ${attributes.region} ${attributes.country} ${attributes.zip}`;

            setTimeout(() => {
                clipboardInput.select();
                document.execCommand('copy');

                this.$root.$emit('displayMessage', {
                    color: 'success',
                    text: 'Address Copied to your Clipboard!',
                });
            }, 50);
        },
    },
};
</script>
