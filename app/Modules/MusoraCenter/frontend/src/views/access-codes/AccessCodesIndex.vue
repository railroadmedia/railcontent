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
                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        Access Codes
                    </v-toolbar-title>
                    <v-spacer class="hidden-xs-only" />

                    <v-text-field
                        v-model="searchTerm"
                        append-icon="search"
                        :loading="loading"
                        label="Search"
                        color="white"
                        single-line
                        hide-details
                        @keyup.enter="pullAccessCodes()"
                    />
                    <v-btn light @click="pullAccessCodes()" class="ml-4">Search</v-btn>
                </v-toolbar>

                <v-data-table
                    :headers="headers"
                    :items="accessCodes"
                    :loading="loading"
                    class="elevation-1"
                    :items-per-page="20"
                    hide-default-footer
                    item-key="item.id"
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <td class="text-center">
                                <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                            </td>

                            <td class="text-center">
                                <v-icon :color="!item.attributes.is_claimed ? 'green' : 'red'">
                                    {{ !item.attributes.is_claimed ? 'check_circle' : 'cancel' }}
                                </v-icon>
                            </td>

                            <td>
                                {{ item.attributes.code }}
                            </td>

                            <td>
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
                            <td>
                                {{ item.attributes.source }}
                            </td>

                            <td>
                                {{
                                    item.attributes.claimed_on
                                        ? moment(item.attributes.claimed_on).format('MMM D, Y')
                                        : ''
                                }}
                            </td>

                            <td>
                                {{ getAccessCodeClaimant(item) }}
                            </td>

                            <td class="text-center">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-if="item.attributes.is_claimed"
                                            fab
                                            x-small
                                            raised
                                            :color="brandColor"
                                            class="mx-1 white--text"
                                            :to="{ name: 'users.edit', params: {
                                                id: item.relationships.claimer
                                                    ? item.relationships.claimer.data.id
                                                    : 0
                                            }}"
                                            v-on="on"
                                        >
                                            <v-icon>
                                                person
                                            </v-icon>
                                        </v-btn>
                                    </template>

                                    <span>Go to User</span>
                                </v-tooltip>

                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-if="!item.attributes.is_claimed"
                                            fab
                                            x-small
                                            raised
                                            color="success"
                                            class="mx-1 white--text"
                                            v-on="on"
                                            @click="openClaimForm(item)"
                                        >
                                            <v-icon>
                                                outlined_flag
                                            </v-icon>
                                        </v-btn>
                                    </template>

                                    <span>Claim Access Code</span>
                                </v-tooltip>

                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-if="item.attributes.is_claimed"
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

        <v-dialog
            v-model="dialog"
            max-width="500px"
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    grow
                    :color="brandColor"
                >
                    <v-toolbar-title>Claim Access Code</v-toolbar-title>
                </v-toolbar>
                <v-col>
                    <v-form
                        ref="claimForm"
                        v-model="formValid"
                    >
                        <v-text-field
                            v-model="newAccessCode"
                            label="Access Code"
                            :color="brandColor"
                            validate-on-blur
                            outlined
                            readonly
                            class="mt-5"
                        ></v-text-field>

                        <v-divider class="my-5"></v-divider>

                        <v-text-field
                            v-model="$_user_id"
                            label="User ID"
                            :color="brandColor"
                            :loading="userLoading"
                            :error-messages="userPreviewError ? ['No User found'] : []"
                            validate-on-blur
                        ></v-text-field>

                        <v-list
                            v-if="userPreview"
                            two-line
                            dense
                            class="mb-6"
                        >
                            <v-list-item
                                :to="{name: 'users.edit', params:{id: userPreview.id}}"
                                target="_blank"
                            >
                                <v-list-item-avatar>
                                    <img
                                        :src="userPreview.attributes.profile_picture_url ||
                                            'https://dmmior4id2ysr.cloudfront.net/assets/images/avatar.jpg'"
                                    >
                                </v-list-item-avatar>

                                <v-list-item-content>
                                    <v-list-item-title v-html="userPreview.attributes.email"></v-list-item-title>
                                    <v-list-item-subtitle v-html="userPreview.attributes.display_name"></v-list-item-subtitle>
                                </v-list-item-content>

                                <v-list-item-action>
                                    <v-icon>open_in_new</v-icon>
                                </v-list-item-action>
                            </v-list-item>
                        </v-list>

                        <div class="text-right">
                            <v-btn
                                text
                                class="mr-1"
                                @click="cancelForm"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :color="brandColor"
                                :disabled="!userId || userPreviewError"
                                @click="submitForm"
                            >
                                Redeem
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
import { mapState } from 'vuex';
import brandColors from '../../api/mixins';
import JsonApiMethods from '../../mixins/json-api-methods';
import Middleware from '../../middleware/auth';
import api from '../../api/ecommerce/access-codes';
import usersApi from '../../api/users';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import CustomBrandIcon from '../../components/CustomBrandIcon.vue';

export default {
    name: 'AccessCodesIndex',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'v-custom-brand-icon': CustomBrandIcon,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'access-codes'); });
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
                    text: 'Access Codes',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Available',
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
                    align: 'left',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Claimed By',
                    align: 'left',
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
            validationRules: {
                accessCode: [
                    v => !!v || 'Access Code is Required',
                ],
                userId: [
                    v => !!v || 'User ID is Required',
                ],
            },
            dialog: false,
            tab: null,
            currentPage: 1,
            totalPages: 0,
            searchTerm: '',
            searchTimeout: null,
            userIdTimeout: null,
            userLoading: false,
            accessCodes: [],
            accessCodesIncludedData: [],
            formValid: false,
            hidePassword: true,
            newAccessCode: null,
            userId: null,
            userPreview: null,
            userPreviewError: false,
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

                this.pullAccessCodes();
            },
        },

        $_user_id: {
            get() {
                return this.userId;
            },
            set(val) {
                clearTimeout(this.userIdTimeout);
                this.userLoading = true;

                this.userIdTimeout = setTimeout(() => {
                    this.userId = val;

                    this.getUser();

                    this.userIdTimeout = null;
                }, 1500);
            },
        },
    },
    mounted() {
        if (this.$route.query.term) this.searchTerm = this.$route.query.term;
        if (this.$route.query.page) this.currentPage = Number(this.$route.query.page);

        if (this.searchTerm) {
            this.searchAccessCodes();
        } else {
            this.getAccessCodes();
        }
    },
    methods: {
        getAccessCodes() {
            this.loading = true;

            api.getAccessCodes({
                page: this.currentPage,
            })
                .then((response) => {
                    if (response) {
                        this.accessCodes = response.data.data;
                        this.accessCodesIncludedData = response.data.included;
                        this.totalPages = response.data.meta.pagination.total_pages;
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        searchAccessCodes() {
            this.loading = true;

            api.searchAccessCodes({
                page: this.currentPage,
                term: this.searchTerm,
            })
                .then((response) => {
                    if (response) {
                        this.accessCodes = response.data.data;
                        this.accessCodesIncludedData = response.data.included;
                        this.totalPages = response.data.meta.pagination.total_pages;
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        getAccessCodeClaimant(item) {
            if (!item.relationships || !item.relationships.claimer) {
                return '';
            }

            const user = this.getRelatedAttributesByTypeAndId(
                item.relationships.claimer.data,
                this.accessCodesIncludedData,
            );

            return user.attributes.email;
        },

        getAccessCodeProduct(item) {

            if (!item.relationships || !item.relationships.product) {
                return ['N/A'];
            }

            const products = item.relationships.product.data.map(
                product => this.getRelatedAttributesByTypeAndId(
                    product,
                    this.accessCodesIncludedData,
                ),
            );

            return products.map(product => product.attributes.name);
        },

        getUser() {
            if (this.userId) {
                usersApi.getUserById(this.userId)
                    .then((response) => {
                        if (response) {
                            this.userPreview = response.data.data;
                            this.userPreviewError = false;
                        } else {
                            this.userPreviewError = true;
                            this.userPreview = null;
                        }

                        this.userLoading = false;
                    });
            } else {
                this.userPreview = null;
                this.userPreviewError = false;
                this.userLoading = false;
            }
        },

        openClaimForm(item) {
            this.dialog = true;
            this.newAccessCode = item.attributes.code;
        },

        cancelForm() {
            this.dialog = false;

            this.$refs.claimForm.reset();
            this.userPreview = null;
        },

        submitForm() {
            this.$root.$emit('pageLoading');

            api.claimAccessCode(
                this.userId,
                this.newAccessCode,
            )
                .then((response) => {
                    this.handleResponse(response, 'claimed');
                })
                .finally(() => {
                    this.$root.$emit('pageLoaded');
                });
        },

        releaseAccessCode(id) {
            const confirmation = confirm('Are you sure you wish to release this code? This action cannot be undone.');

            if (confirmation) {
                this.$root.$emit('pageLoading');

                api.releaseAccessCode(id)
                    .then((response) => {
                        this.handleResponse(response, 'released');
                    })
                    .finally(() => {
                        this.$root.$emit('pageLoaded');
                    });
            }
        },

        handleResponse(response, action) {
            if (response) {
                this.getAccessCodes();
                this.cancelForm();

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

        updateUrl() {
            const query = {};

            if (this.page != 1) {
                query.page = this.page;
            }

            if (this.searchTerm) {
                query.term = this.searchTerm;
            }

            const urlParams = new URLSearchParams(query);

            let queryString = urlParams.toString().length ? `?${urlParams.toString()}` : '';

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}${queryString}`,
            );
        },

        pullAccessCodes() {

            this.updateUrl();

            if (this.searchTerm.length > 0) {
                this.searchAccessCodes();
            } else {
                this.getAccessCodes();
            }
        },
    },
};
</script>
