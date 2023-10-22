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
            :items="userAccessPermissions"
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

                        <v-tooltip  v-if="item.status=='active'" top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="error"
                                    class="mx-1 white&#45;&#45;text"
                                    v-on="on"
                                    @click.stop="cancelUserPermission(item.id)"
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
                    <v-toolbar-title>
                        {{ this.editingUserAccessPermission.id ? 'Edit' : 'Add' }} User Access Permission
                    </v-toolbar-title>
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
                            ref="permissionInput"
                            v-model="$_permission_id"
                            label="Permission"
                            :color="brandColor"
                            :items="permissionsOptions"
                            item-text="name"
                            item-value="id"
                        >
                            <template
                                slot="item"
                                slot-scope="data"
                            >
                                <v-list-item-content>
                                    <v-list-item-title>{{ data.item.name }}</v-list-item-title>
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
                            :items="['active', 'revoked']"
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
import JsonApiMethods from '../../../mixins/json-api-methods';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';
import PermissionsApi from "../../../api/permissions";
import userPermissionsApi from '../../../api/ecommerce/user-permissions';

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

        userAccessPermissions: {
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
            permissionsOptions: [],
        };
    },
    computed: {
        $_permission_id: {
            get() {
                return this.editingUserAccessPermission.permission_id;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission, 'permission_id', value);
            },
        },

        $_is_lifetime: {
            get() {
                return this.editingUserAccessPermission.time_lifetime;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission, 'time_lifetime', value);
            },
        },

        $_nDays: {
            get() {
                return this.editingUserAccessPermission.time_days || 0;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission, 'time_days', value);
            },
        },

        $_nMonths: {
            get() {
                return this.editingUserAccessPermission.time_months || 0;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission, 'time_months', value);
            },
        },

        $_status:{
            get() {
                return this.editingUserAccessPermission.status;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission, 'status', value);
            },
        },

        $_start_time: {
            get() {
                return this.editingUserAccessPermission.start_date;
            },
            set(value) {
                this.$set(this.editingUserAccessPermission, 'start_date', value);
            },
        },
    },
    mounted() {
        PermissionsApi.getPermissions({
            limit: 100,
        })
            .then((response) => {
                 const options = response.data.data;
                 this.permissionsOptions = Utils.dynamicSort(options, 'name');
            });
    },
    methods: {
        ...mapActions('permissions', [
            'getPermissions',
        ]),

        getDefaultUserAccessPermission() {
            return {
                id: 0,
                status : 'active',
                start_date : this.moment(this.moment.now()).format('YYYY-MM-DD'),
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
            const thisUserAccessPermission = this.userAccessPermissions.find(userAccessPermission => userAccessPermission.id === id);

            if (id) {
                this.editingUserAccessPermission = Utils.createObjectCopy(thisUserAccessPermission);
            } else {
                this.editingUserAccessPermission = this.getDefaultUserAccessPermission();
            }

            this.dialog = true;
        },

        submitEditForm() {
            this.$root.$emit('pageLoading');

            const thisUserAccessPermission = this.userAccessPermissions.find(userAccessPermission => userAccessPermission.id === this.editingUserAccessPermission.id);

            userPermissionsApi.setUserPermission(this.editingUserAccessPermission.id, {
                user_id: this.userId,
                permission_id: this.$_permission_id.id,
                start_date: this.$_start_time,
                lifetime: this.$_is_lifetime,
                days: this.$_nDays,
                months: this.$_nMonths,
                status: this.$_status,
                revoked_at: (thisUserAccessPermission && thisUserAccessPermission.status != this.$_status && this.$_status=='revoked') ? this.moment(this.moment.now()).format('YYYY-MM-DD') : null,
            })
                .then((response) => {
                    if (response) {
                        this.$emit('userProductEdit');
                        this.$root.$emit('displayMessage', {
                            text: 'Permission successfully added to this user!',
                            color: 'success',
                        });

                        this.dialog = false;
                        this.editingUserAccessPermission = this.getDefaultUserAccessPermission();
                    } else {
                        this.$root.$emit('displayMessage', {
                            text: 'Oops! Something went wrong. Permission not added to this user.',
                            color: 'error',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        cancelUserPermission(id) {
            const confirmation = confirm('Are you sure you wish to revoke this User Permission?');

            if (confirmation) {
                const thisUserAccessPermission = this.userAccessPermissions.find(userAccessPermission => userAccessPermission.id === id);
                userPermissionsApi.setUserPermission(id, {
                    user_id: this.userId,
                    permission_id: thisUserAccessPermission.permission_id.id,
                    start_date: thisUserAccessPermission.start_date,
                    lifetime: thisUserAccessPermission.time_lifetime,
                    days: thisUserAccessPermission.time_days,
                    months: thisUserAccessPermission.time_months,
                    status: 'revoked',
                    revoked_at: this.moment(this.moment.now()).format('YYYY-MM-DD HH:mm:ss'),
                })
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'User Permission successfully canceled!',
                                color: 'success',
                            });

                            this.$emit('userProductEdit');
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops! Something went wrong. User Permission likely not canceled.',
                                color: 'error',
                            });
                        }
                    });
            }

        },
    },
};
</script>
