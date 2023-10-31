<template>
    <v-container>
        <v-row
            
            align="center"
        >
            <v-breadcrumbs divider="/">
                <v-breadcrumbs-item
                    :to="{ name: 'home' }"
                    :active-class="brandTextColor"
                >
                    Home
                </v-breadcrumbs-item>

                <v-breadcrumbs-item disabled>
                    Shipping
                </v-breadcrumbs-item>
            </v-breadcrumbs>

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
                        Shipping Options
                    </v-toolbar-title>
                    <v-spacer class="hidden-xs-only"></v-spacer>
                </v-toolbar>

                <v-data-table
                    :headers="headersShippingOptions"
                    :items="state.shippingOptions"
                    hide-default-footer
                    class="elevation-1"
                >
                    <template
                        slot="items"
                        slot-scope="props"
                    >
                        <tr
                            style="cursor:pointer;"
                            @click="showWeightRanges(props)"
                        >
                            <td class="text-center">
                                <v-icon :color="props.item.active ? 'green' : 'red'">
                                    {{ props.item.active ? 'check_circle' : 'cancel' }}
                                </v-icon>
                            </td>
                            <td>{{ toCapitalCase(props.item.country) }}</td>

                            <td class="text-center">
                                {{ props.item.priority }}
                            </td>


                            <td class="text-center">
                                <v-tooltip bottom>
                                    <v-btn
                                        slot="activator"
                                        icon
                                        @click.stop="editShippingOption(props.item)"
                                    >
                                        <v-icon :color="brandColor">
                                            edit
                                        </v-icon>
                                    </v-btn>
                                    <span>Edit Shipping Option</span>
                                </v-tooltip>
                                <v-tooltip bottom>
                                    <v-btn
                                        slot="activator"
                                        icon
                                        @click.stop="deleteShippingOption(props.item)"
                                    >
                                        <v-icon color="red">
                                            delete
                                        </v-icon>
                                    </v-btn>
                                    <span>Delete Shipping Option</span>
                                </v-tooltip>
                                <v-tooltip bottom>
                                    <v-btn
                                        slot="activator"
                                        icon
                                        @click.stop="addWeightRange(props.item)"
                                    >
                                        <v-icon color="green">
                                            add
                                        </v-icon>
                                    </v-btn>
                                    <span>Add Weight range</span>
                                </v-tooltip>
                            </td>
                        </tr>
                    </template>

                    <template
                        slot="expand"
                        slot-scope="props"
                    >
                        <v-col class="pl-6">
                            <v-data-table
                                :headers="headersWeightRages"
                                :items="displayedWeightRanges"
                                hide-default-footer
                                class="nested-table"
                            >
                                <template
                                    slot="items"
                                    slot-scope="props"
                                >
                                    <tr>
                                        <td class="text-center">
                                            {{ props.item.min }}
                                        </td>
                                        <td class="text-center">
                                            {{ props.item.max }}
                                        </td>
                                        <td>{{ props.item.price }}</td>
                                        <td class="text-center">
                                            <v-tooltip bottom>
                                                <v-btn
                                                    slot="activator"
                                                    icon
                                                    @click.stop="editWeightRange(props.item)"
                                                >
                                                    <v-icon :color="brandColor">
                                                        edit
                                                    </v-icon>
                                                </v-btn>
                                                <span>Edit Weight Range</span>
                                            </v-tooltip>
                                            <v-tooltip bottom>
                                                <v-btn
                                                    slot="activator"
                                                    icon
                                                    @click.stop="deleteWeightRange(props.item)"
                                                >
                                                    <v-icon color="red">
                                                        delete
                                                    </v-icon>
                                                </v-btn>
                                                <span>Delete Weight Range</span>
                                            </v-tooltip>
                                        </td>
                                    </tr>
                                </template>
                            </v-data-table>
                        </v-col>
                    </template>

                    <template slot="footer">
                        <td
                            colspan="100%"
                            class="text-center"
                        >
                            <em>Click on an item to show the weight ranges.</em>
                        </td>
                    </template>
                </v-data-table>
            </v-col>

            <v-row column>
                <v-dialog
                    v-model="editShippingOptionDialog"
                    max-width="500px"
                >
                    <v-card v-if="editShippingOptionDialog">
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                        >
                            <v-toolbar-title>Edit Shipping Option</v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            cols="12"
                            class="pa-4 column"
                        >
                            <p class="caption grey--text lighten-5 pa-2">
                                All fields are required
                            </p>

                            <shipping-option-form
                                :shipping-option="shippingOption"
                            ></shipping-option-form>
                        </v-col>
                    </v-card>
                </v-dialog>
            </v-row>

            <v-row column>
                <v-dialog
                    v-model="weightRangeDialog"
                    max-width="500px"
                >
                    <v-card v-if="weightRangeDialog">
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                        >
                            <v-toolbar-title>{{ weightRangeTile }}</v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            cols="12"
                            class="pa-4 column"
                        >
                            <p class="caption grey--text lighten-5 pa-2">
                                All fields are required
                            </p>

                            <weight-range-form
                                :weight-range="weightRange"
                                :shipping-option-id="shippingOptionId"
                            ></weight-range-form>
                        </v-col>
                    </v-card>
                </v-dialog>
            </v-row>

            <v-row
                column
                class="floating-buttons"
            >
                <v-dialog
                    v-model="newShippingOptionDialog"
                    max-width="500px"
                >
                    <v-tooltip
                        slot="activator"
                        top
                    >
                        <v-btn
                            slot="activator"
                            fab
                            color="success white--text"
                        >
                            <v-icon>add</v-icon>
                        </v-btn>

                        <span>Add New Shipping Option</span>
                    </v-tooltip>

                    <v-card>
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                        >
                            <v-toolbar-title>Add New Shipping Option</v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            cols="12"
                            class="pa-4 column"
                        >
                            <p class="caption grey--text lighten-5 pa-2">
                                All fields are required
                            </p>

                            <shipping-option-form></shipping-option-form>
                        </v-col>
                    </v-card>
                </v-dialog>
            </v-row>
        </v-row>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import ShippingOptionForm from './forms/ShippingOption';
import WeightRangeForm from './forms/WeightRange';
import api from '../../api/ecommerce/shipping';
import Utils from '../../api/utils';
import Middleware from '../../middleware/auth';

export default {
    name: 'ShippingIndex',
    components: {
        'shipping-option-form': ShippingOptionForm,
        'weight-range-form': WeightRangeForm,
    },
    mixins: [brandColors],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'shipping'); });
    },
    data() {
        return {
            newShippingOptionDialog: false,
            editShippingOptionDialog: false,
            weightRangeDialog: false,
            shippingOption: {},
            headersShippingOptions: [
                {
                    text: 'Active',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Country',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Priority',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Controls',
                    align: 'center',
                    sortable: false,
                    width: 225,
                },
            ],
            expandedItem: null,
            headersWeightRages: [
                {
                    text: 'Min',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Max',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Price',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Controls',
                    align: 'center',
                    sortable: false,
                    width: 225,
                },
            ],
            weightRange: {},
            weightRangeTile: '',
            openedProp: null,
            shippingOptionId: 0,
        };
    },
    computed: {
        ...mapState({
            state: state => state.shipping,
            auth: state => state.auth,
        }),

        displayedWeightRanges() {
            return this.expandedItem.weightRanges;
        },
    },
    beforeDestroy() {
        this.weightRangeSave = null;
        this.openedProp = null;
    },
    methods: {
        ...mapActions('shipping', [
            'getShippingOptions',
        ]),

        toCapitalCase: string => Utils.toCapitalCase(string),

        editShippingOption(shippingOption) {
            this.shippingOption = shippingOption;
            this.editShippingOptionDialog = true;
        },

        editWeightRange(weightRange) {
            this.weightRange = weightRange;
            this.weightRangeTile = 'Edit Weight Range';
            this.weightRangeDialog = true;
        },

        addWeightRange(shippingOption) {
            this.shippingOption = shippingOption;
            this.shippingOptionId = shippingOption.id;
            this.weightRangeTile = 'Add new Weight Range';
            this.weightRangeDialog = true;
        },

        showWeightRanges(props) {
            if (!props.expanded) {
                this.expandedItem = props.item;
                props.expanded = true;
                this.openedProp = props;
            } else {
                props.expanded = false;
                this.expandedItem = null;
                this.openedProp = null;
            }
        },

        deleteShippingOption(shippingOption) {
            api
                .deleteShippingOption(shippingOption.id)
                .then(this.handleDeleteShippingOption);
        },

        deleteWeightRange(weightRange) {
            api
                .deleteWeightRange(weightRange.id)
                .then(this.handleDeleteWeightRange);
        },

        handleDeleteShippingOption(response) {
            if (response.status >= 200) {
                this.$root.$emit('displayMessage', {
                    text: 'Shipping Option deleted!',
                    color: 'success',
                });

                this.getShippingOptions();
            }
        },

        handleDeleteWeightRange(response) {
            if (response.status >= 200) {
                this.$root.$emit('displayMessage', {
                    text: 'Weight Range deleted!',
                    color: 'success',
                });

                this.$nextTick(this.refreshMainTable);
            }
        },

        refreshMainTable() {
            if (this.openedProp) {
                this.openedProp.expanded = false;
                this.openedProp = null;
            }

            this.getShippingOptions();
        },
    },
    created() {
        this.getShippingOptions();
    },
    mounted() {
        this.$root.$on('shippingFormCanceled', () => {
            this.newShippingOptionDialog = false;
        });

        this.$root.$on('shippingOptionCreated', (discount) => {
            this.newShippingOptionDialog = false;

            this.refreshMainTable();
        });

        this.$root.$on('shippingOptionUpdated', (discount) => {
            this.editShippingOptionDialog = false;
            this.shippingOption = {};

            this.refreshMainTable();
        });

        this.$root.$on('shippingOptionFormCanceled', (discount) => {
            this.newShippingOptionDialog = false;
            this.editShippingOptionDialog = false;
            this.shippingOption = {};
        });

        this.$root.$on('weightRangeCreated', (discount) => {
            this.weightRangeDialog = false;
            this.shippingOptionId = 0;

            this.refreshMainTable();
        });

        this.$root.$on('weightRangeUpdated', (discount) => {
            this.weightRangeDialog = false;
            this.weightRange = {};

            this.refreshMainTable();
        });

        this.$root.$on('weightRangeFormCanceled', (discount) => {
            this.weightRangeDialog = false;
            this.weightRange = {};
            this.shippingOptionId = 0;
        });
    },
};
</script>
