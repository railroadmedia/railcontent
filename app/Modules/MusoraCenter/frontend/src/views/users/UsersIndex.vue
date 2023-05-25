<template>
    <v-container>
        <v-scale-transition mode="out-in">
            <v-row
                align="center"
            >
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
                            Users
                        </v-toolbar-title>
                        <v-spacer class="hidden-xs-only"></v-spacer>

                        <v-col>
                            <v-text-field
                                v-model="searchTerm"
                                label="Search by email or display name."
                                color="white"
                                append-icon="search"
                                :loading="loading"
                                single-line
                                clearable
                                hide-details
                                @keyup.enter="requestUsers()"
                            ></v-text-field>
                        </v-col>
                        <v-btn light @click="requestUsers()">Search</v-btn>
                    </v-toolbar>
                    <v-data-table
                        :headers="headers"
                        :items="state.users"
                        hide-default-footer
                        class="elevation-1 membership"
                        :items-per-page="20"
                        :loading="loading"
                    >
                        <template v-slot:item="{ item }">
                            <tr
                                style="cursor:pointer;"
                                :class="getMembershipRowClasses(item)"
                                @mouseover="hoveredUserId = item.id"
                                @mouseleave="hoveredUserId = -1"
                            >
                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    class="text-center user-data-td"
                                    :rowspan="hasMembership(item) ? getMembership(item).length : 1"
                                >
                                    <v-avatar size="36px">
                                        <img :src="getUserAvatar(item)">
                                    </v-avatar>
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    class="text-center user-data-td"
                                    :rowspan="hasMembership(item) ? getMembership(item).length : 1"
                                >
                                    {{ item.attributes.email }}
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    class="user-data-td"
                                    :rowspan="hasMembership(item) ? getMembership(item).length : 1"
                                >
                                    {{ item.attributes.display_name }}
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    class="text-center user-data-td"
                                    :rowspan="hasMembership(item) ? getMembership(item).length : 1"
                                >
                                    {{ moment(item.attributes.created_at).format('MMM D, Y') }}
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    class="text-center user-data-td"
                                    :rowspan="hasMembership(item) ? getMembership(item).length : 1"
                                >
                                    {{ item.id }}
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    v-if="hasMembership(item)"
                                >
                                    <span
                                        :class="getMembershipStateColor(getMembership(item)[0])"
                                        >{{ getMembership(item)[0].attributes.subscription_state }}</span>&nbsp;
                                    <span>{{ getMembershipType(getMembership(item)[0]) }}</span>
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    v-if="hasMembership(item)"
                                    class="text-center"
                                >
                                    <v-custom-brand-icon :brand="getMembership(item)[0].attributes.brand">
                                    </v-custom-brand-icon>
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    v-if="hasMembership(item)"
                                    class="text-center"
                                >
                                    {{ getMembershipRenew(getMembership(item)[0]) }}
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    v-if="!hasMembership(item)"
                                    colspan="3"
                                >
                                    <em>No membership</em>
                                </linkable-td>
                            </tr>

                            <tr
                                style="cursor:pointer;"
                                class="user-membership-row"
                                v-if="hasMembership(item) && getMembership(item).length > 1"
                                v-for="(membership, index) in getMembership(item).slice(1)"
                                :key="membership.id"
                                :class="getMembershipRowClasses(item)"
                                @mouseover="hoveredUserId = item.id"
                                @mouseleave="hoveredUserId = -1"
                            >
                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                >
                                    <span
                                        :class="getMembershipStateColor(membership)"
                                        >{{ membership.attributes.subscription_state }}</span>&nbsp;
                                    <span>{{ getMembershipType(membership) }}</span>
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    v-if="hasMembership(item)"
                                    class="text-center"
                                >
                                    <v-custom-brand-icon :brand="membership.attributes.brand">
                                    </v-custom-brand-icon>
                                </linkable-td>

                                <linkable-td
                                    :to="{ name: 'users.edit', params: { id: item.id }}"
                                    v-if="hasMembership(item)"
                                    class="text-center"
                                >
                                    {{ getMembershipRenew(membership) }}
                                </linkable-td>
                            </tr>
                        </template>

                        <template v-slot:footer>
                            <div class="pa-4 caption text-center">
                                <em>Click on user row to show user details.</em><br>
                            </div>
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

                <v-row
                    class="floating-buttons"
                >
                    <v-col style="width:80px;">
                        <v-menu
                            offset-y
                            fixed
                            top
                            nudge-top="10"
                            style="position:fixed;bottom:82px;right:16px;"
                        >
                            <template v-slot:activator="{ on: menu }">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on: tooltip }">
                                        <v-btn
                                            slot="activator"
                                            fab
                                            color="grey"
                                            class="mb-2 white--text"
                                            v-on="{ ...tooltip, ...menu }"
                                        >
                                            <v-icon>history</v-icon>
                                        </v-btn>
                                    </template>

                                    <span>Show History</span>
                                </v-tooltip>
                            </template>

                            <user-history></user-history>
                        </v-menu>


                        <v-dialog
                            v-model="newUserDialog"
                            max-width="500px"
                        >
                            <template v-slot:activator="{ on: dialog }">
                                <v-tooltip
                                    slot="activator"
                                    top
                                >
                                    <template v-slot:activator="{ on: tooltip }">
                                        <v-btn
                                            slot="activator"
                                            class="white--text"
                                            fab
                                            color="success"
                                            v-on="{ ...dialog, ...tooltip }"
                                        >
                                            <v-icon>person_add</v-icon>
                                        </v-btn>
                                    </template>

                                    <span>Add New User</span>
                                </v-tooltip>
                            </template>

                            <v-card>
                                <v-toolbar
                                    flat
                                    dark
                                    :color="brandColor"
                                >
                                    <v-toolbar-title>Add New User</v-toolbar-title>
                                </v-toolbar>

                                <v-col
                                    cols="12"
                                    class="pa-4 column"
                                >
                                    <p class="caption grey--text lighten-5">
                                        Lets start with the basic information.
                                    </p>

                                    <v-form
                                        ref="newUser"
                                        v-model="validations.newUser"
                                    >
                                        <v-text-field
                                            v-model="newUserEmailAddress"
                                            label="Email Address"
                                            :color="brandColor"
                                            :rules="emailRules"
                                            validate-on-blur
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="newUserDisplayName"
                                            label="Display Name"
                                            :color="brandColor"
                                            :rules="displayNameRules"
                                            validate-on-blur
                                        ></v-text-field>

                                        <v-text-field
                                            ref="password_input"
                                            v-model="newUserPassword"
                                            label="Password"
                                            :color="brandColor"
                                            :rules="passwordRules"
                                            :append-icon="hidePassword ? 'visibility' : 'visibility_off'"
                                            :type="hidePassword ? 'password' : 'text'"
                                            @click:append="() => (hidePassword = !hidePassword)"
                                            @input="validateNewUserForm"
                                        ></v-text-field>

                                        <div class="text-right">
                                            <v-btn
                                                text
                                                class="mr-1"
                                                @click.stop="cancelAddNew"
                                            >
                                                Cancel
                                            </v-btn>
                                            <v-btn
                                                class="white--text"
                                                :color="brandColor"
                                                :disabled="!validations.newUser"
                                                @click="addNewUser"
                                            >
                                                Save
                                            </v-btn>
                                        </div>
                                    </v-form>
                                </v-col>
                            </v-card>
                        </v-dialog>
                    </v-col>
                </v-row>
            </v-row>
        </v-scale-transition>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import api from '../../api/users';
import CustomBrandIcon from '../../components/CustomBrandIcon.vue';
import UserHistory from './UserHistory';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import JsonApiMethods from '../../mixins/json-api-methods';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import LinkableTD from '../../components/LinkableTD';
import Middleware from '../../middleware/auth';

/*
Users data table has rowspan customized on user data fields, due to specs requirements
The table rows hover state has also been customized to work with rowspans
*/

export default {
    components: {
        'user-history': UserHistory,
        'v-custom-brand-icon': CustomBrandIcon,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'linkable-td': LinkableTD,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'users'); });
    },
    data() {
        return {
            hoveredUserId: -1,
            loading: false,
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Users',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Avatar',
                    align: 'center',
                    sortable: false,
                    value: 'profile_picture_image_url',
                    width: 60,
                },
                {
                    text: 'Email',
                    align: 'center',
                    sortable: false,
                    value: 'email',
                    width: 250,
                },
                {
                    text: 'Display Name',
                    align: 'left',
                    sortable: false,
                    value: 'display_name',
                },
                {
                    text: 'Member Since',
                    align: 'center',
                    sortable: false,
                    value: 'created_at',
                    width: 150,
                },
                {
                    text: 'ID',
                    align: 'center',
                    sortable: false,
                    value: 'id',
                    width: 50,
                },
                {
                    text: 'Membership',
                    align: 'left',
                    sortable: false,
                    width: 200,
                    value: ''
                },
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 150,
                    value: ''
                },
                {
                    text: 'Next Renewal',
                    align: 'center',
                    sortable: false,
                    width: 150,
                    value: ''
                },
            ],
            currentPage: this.$route.query.page ? Number(this.$route.query.page) : 1,
            newUserDialog: false,
            searchTerm: this.$route.query.search || '',
            newUserEmailAddress: '',
            newUserDisplayName: '',
            newUserPassword: '',
            hidePassword: true,
            validations: {
                newUser: false,
            },
            displayNameRules: [
                v => !!v || 'Display Name is Required',
            ],
            emailRules: [
                v => !!v || 'Email is Required',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid',
            ],
            passwordRules: [
                v => !!v || 'Password is Required',
            ],
            searchTimeout: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
            auth: state => state.auth,
        }),
        page: {
            get() {
                return this.currentPage;
            },
            set(val) {
                this.currentPage = val;
                this.requestUsers();
            },
        },
        totalPages() {
            return this.state.totalPages;
        },
    },
    methods: {
        ...mapActions('users', [
            'getUsers',
        ]),
        addNewUser() {
            if (this.validateNewUserForm) {
                api.addNewUser({
                    email: this.newUserEmailAddress,
                    display_name: this.newUserDisplayName,
                    password: this.newUserPassword,
                })
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'User created!',
                                color: 'success',
                            });
                            this.goToUser(response.data.data.id);
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops, something went wrong. User not created!',
                                color: 'error',
                            });
                        }

                        this.cancelAddNew();
                    });
            }
        },

        goToUser(id) {
            this.$router.push({ name: 'users.edit', params: { id } });
        },

        validateNewUserForm() {
            this.$refs.newUser.validate();
        },

        cancelAddNew() {
            this.newUserDialog = false;

            this.newUserEmailAddress = '';
            this.newUserDisplayName = '';
            this.newUserPassword = '';
            this.newUserConfirmPassword = '';
        },

        getUserAvatar(user) {
            const displayName = user.attributes.display_name.replace(/ /, '+');

            return user.attributes.profile_picture_url
                || `https://ui-avatars.com/api/?name=${displayName}&size=100&bold=true&background=00b0ff&color=FFFFFF`;
        },

        updateUrl() {
            const query = {};

            if (this.page != 1) {
                query.page = this.page;
            }

            if (this.searchTerm) {
                query.search = this.searchTerm;
            }

            const urlParams = new URLSearchParams(query);

            let queryString = urlParams.toString().length ? `?${urlParams.toString()}` : '';

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}${queryString}`,
            );
        },

        requestUsers() {
            this.loading = true;
            this.updateUrl();

            this.getUsers({
                page: this.page,
                search_term: this.searchTerm,
            })
                .then(() => {
                    this.loading = false;
                });
        },

        hasMembership(item) {
            return item.relationships && item.relationships.subscriptionRenewal;
        },

        getMembership(item) {
            if (this.state.usersIncluded) {
                return this.state.usersIncluded
                    .filter((included) => {
                        return included.type == 'subscriptionRenewal' && included.attributes.user_id == item.id;
                    });
            }

            return [];
        },

        getMembershipStateColor(item) {
            switch (item.attributes.subscription_state) {
                case 'active':
                    return 'success--text';
                case 'suspended':
                    return 'warning--text';
                default:
                    return 'error--text';
            }
        },

        getMembershipType(item) {
            switch (item.attributes.subscription_type) {
                case 'month_1':
                case 'monthly_1':
                    return 'monthly';
                case 'month_6':
                case 'monthly_6':
                    return 'semesterly';
                case 'year_1':
                case 'yearly_1':
                    return 'yearly';
                default:
                    return item.attributes.subscription_type;
            }
        },

        getMembershipRenew(item) {

            if (!item.attributes.next_renewal_due) {
                return 'not scheduled';
            }

            let due = this.moment(item.attributes.next_renewal_due);
            let diff = due.diff(this.moment(), 'days');

            return due.format('MMM D, Y') + (diff > 0 && diff < 30  ? ' | next renewal cycle' : '');
        },

        getMembershipRowClasses(item) {
            return {hovered: item.id == this.hoveredUserId};
        },
    },
    mounted() {
        this.requestUsers();
    },
};
</script>
<style lang="scss">
.theme--light.v-data-table.membership tbody tr.hovered:not(.v-data-table__expanded__content) {
    background: #eeeeee;
}
.theme--dark.v-data-table.membership tbody tr.hovered:not(.v-data-table__expanded__content) {
    background: #616161;
}
.theme--light.v-data-table tbody tr.user-membership-row:not(.overwrite) td:not(.v-data-table__mobile-row) {
    border-bottom: 1px solid rgba(0, 0, 0, 0.12);
}
.theme--dark.v-data-table tbody tr.user-membership-row:not(.overwrite) td:not(.v-data-table__mobile-row) {
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
}
</style>
