<template>
    <v-card class="mb-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Employee MC Permissions</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form>
                <v-row
                    align="center"
                >
                    <v-col
                        class="column xs-6"
                    >
                        <v-select
                            v-model="$_user_permissions"
                            :items="items"
                            item-text="label"
                            item-value="value"
                            multiple
                        >
                        </v-select>
                    </v-col>
                </v-row>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import api from '../../../api/users';
import brandColors from '../../../api/mixins.js';

export default {
    name: 'UserPermissionsForm',
    mixins: [brandColors],
    props: {
        userRoles: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            items: [
                {value: 'accounting', label: 'Accounting Reports Access'},
                {value: 'administrator', label: 'General Administrator Access To MC And Brands'},
                {value: 'all_content_access', label: 'All Content Access'},
                {value: 'it', label: 'IT Access'},
                {value: 'live_chat_moderator', label: 'Live Chat Moderator'},
                {value: 'membership_stats', label: 'Membership Statistics Access'},
                {value: 'moderator', label: 'Forum/Comment Moderation Access'},
                {value: 'payment_recovery', label: 'Payment Recovery Tool Access'},
                {value: 'retention_stats', label: 'Retention Stats Access'},
                {value: 'shipping_fulfillment', label: 'Shipping Fulfillment Tool Access'},
                {value: 'view_daily_stats', label: 'Daily Stats Report Access'},
            ],
            userPermissions: [],
            editUpdateTimeout: null,
            editUpdateDelay: 1500, // when a role is added/removed, wait this miliseconds amount before making BE request
        };
    },
    mounted() {
        this.userPermissions = [...this.userRoles];
    },
    watch: {
        userRoles: function (val) {
            this.userPermissions = [...val];
        },
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),

        $_user_permissions: {
            cache: false,
            get() {
                return this.userPermissions;
            },
            set(val) {
                this.userPermissions = val;

                this.runUpdate();
            },
        },
    },
    methods: {
        ...mapActions('users', [
            'getUserById',
            'setUsers',
            'editUserField',
        ]),

        runUpdate() {
            clearTimeout(this.editUpdateTimeout);

            this.editUpdateTimeout = setTimeout(() => {
                this.$emit('updateUserRoles', { roles: this.userPermissions });
            }, this.editUpdateDelay);
        },
    },
};
</script>
