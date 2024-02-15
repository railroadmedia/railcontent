<template>
    <v-card class="mt-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Access Codes Claimed</v-toolbar-title>

            <v-spacer></v-spacer>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="accessCodes"
            :items-per-page="5"
            no-results-text="No Results Found"
            class="elevation-1"
        >
            <template v-slot:item="{ item }">
                <tr>
                    <td class="text-center">
                        <v-custom-brand-icon :brand="item.brand"></v-custom-brand-icon>
                    </td>

                    <td class="text-left">
                        {{ item.code }}
                    </td>

                    <td class="text-left">
                        <ul
                            class="pa-0"
                            style="list-style-type:none;"
                        >
                            <li
                                v-for="product in getAccessCodeProduct(item)"
                                :key="`${item.id}-${product}`"
                            >
                                {{ product }}
                            </li>
                        </ul>
                    </td>

                    <td class="text-left">
                        {{ item.source }}
                    </td>

                    <td class="text-center">
                        {{
                            item.claimed_on
                                ? moment(item.claimed_on).format('MMM D, Y')
                                : ''
                        }}
                    </td>

                    <td class="text-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    v-if="item.is_claimed"
                                    fab
                                    x-small
                                    raised
                                    color="error"
                                    class="mx-1 white--text"
                                    v-on="on"
                                    @click="releaseAccessCode(item.id)"
                                >
                                    <v-icon>
                                        close
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Release Access Code</span>
                        </v-tooltip>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-card>
</template>
<script>
import api from '../../../api/ecommerce/access-codes';
import brandColors from '../../../api/mixins.js';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';
import JsonApiMethods from '../../../mixins/json-api-methods';

export default {
    name: 'UserAccessCodes',
    components: {
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors, JsonApiMethods],
    props: {
        userId: {
            type: Number | String,
            default: () => 0,
        },
    },
    data() {
        return {
            loading: false,
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Code',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Product',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Source',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Claimed On',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
            ],
            accessCodes: [],
            accessCodesIncludedData: [],
            currentPage: 1,
            totalPages: 0,
        };
    },
    computed: {
    },
    mounted() {
        this.getAccessCodes();
    },
    methods: {
        fetchData() {
            this.getAccessCodes();
        },

        getAccessCodes() {
            this.loading = true;

            api
                .getAccessCodes({
                    page: this.currentPage,
                    claimer_id: this.userId,
                    limit: 1000,
                })
                .then((response) => {
                    if (response) {
                        this.accessCodes = response.data.data;
                        this.accessCodesIncludedData = response.data.included;
                        this.totalPages = response.data.meta.last_page;
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        getAccessCodeProduct(item) {
            return item.products.map(product => product.name);
        },

        releaseAccessCode(id) {
            const confirmation = confirm('Are you sure you wish to release this code? This action cannot be undone.');

            if (confirmation) {
                this.loading = true;

                api.releaseAccessCode(id)
                    .then((response) => {
                        this.handleResponse(response, 'released');
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        },

        handleResponse(response, action) {
            if (response) {
                this.getAccessCodes();

                this.$root.$emit('displayMessage', {
                    text: `Access Code successfully ${action}!`,
                    color: 'success',
                });
            } else {
                this.$root.$emit('displayMessage', {
                    text: `Oops! Something went wrong. Access Code likely not ${action}!`,
                    color: 'error',
                });
            }
        },
    },
};
</script>
