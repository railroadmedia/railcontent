<template>
    <v-card class="mb-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Top Level Permission: must be administrator for mc access</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-tooltip
                v-model="help"
                left
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        icon
                        v-on="on"
                        @click="help = !help"
                    >
                        <v-icon>help</v-icon>
                    </v-btn>
                </template>
                <span>
                    These permissions override the users subscription and give them elevated access.
                    <br>
                    <br>
                    <strong>Admin</strong> - Allows the user to see all content and edit comments or forum posts.
                </span>
            </v-tooltip>
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
                            v-model="$_permission_level"
                            label="Special Permission Level"
                            :color="brandColor"
                            :items="[null, 'administrator']"
                        ></v-select>

                        <div class="text-right">
                            <v-btn
                                v-if="isChanged"
                                :color="brandColor"
                                class="white--text"
                                @click="sendPermission"
                            >
                                Save
                            </v-btn>
                        </div>
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
import Utils from '../../../api/utils';

export default {
    name: 'UserSpecialPermissionsForm',
    mixins: [brandColors],
    props: {
        thisUser: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            help: false,
            initialVal: this.thisUser.attributes.permission_level,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),

        isChanged() {
            return this.$_permission_level !== this.initialVal;
        },

        $_permission_level: {
            cache: false,
            get() {
                return this.thisUser.attributes.permission_level;
            },
            set(val) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'permission_level',
                    value: val,
                });
            },
        },
    },
    methods: {
        ...mapActions('users', [
            'getUserById',
            'setUsers',
            'editUserField',
        ]),

        sendPermission() {
            const isAdmin = this.initialVal === 'administrator';

            const confirmationMessage = isAdmin
                ? 'Removing this role will take away this user\'s elevated permissions,'
                : 'Adding this role will give this user elevated permissions,';
            const confirmation = confirm(`${confirmationMessage} Are you sure you wish to do this?`);

            if (confirmation) {
                api.setUserAttributes(this.thisUser.id, {
                    permission_level: isAdmin ? null : 'administrator',
                })
                    .then(() => {
                        this.initialVal = this.$_permission_level;
                    });
            } else {
                return false;
            }
        },
    },
};
</script>
