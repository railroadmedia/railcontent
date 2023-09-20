<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>User Details</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column text-center"
        >
                <v-avatar size="150px" v-if="thisUser.id">
                    <img :src="userAvatar">
                </v-avatar>

            <v-form
                ref="userDetails"
                v-model="valid"
                class="mt-5"
            >
                <!--                <v-text-field-->
                <!--                        label="Display Name"-->
                <!--                        :color="brandColor"-->
                <!--                        :rules="displayNameRules"-->
                <!--                        v-model="$_displayName"-->
                <!--                        required></v-text-field>-->

                <v-text-field
                    v-model="$_email"
                    label="E-mail"
                    :color="brandColor"
                    :rules="emailRules"
                    required
                ></v-text-field>

                <div class="text-right">
                    <v-btn
                        :color="brandColor"
                        class="white--text"
                        :disabled="!valid"
                        @click.stop="submitUserDetails"
                    >
                        Save
                    </v-btn>
                </div>
            </v-form>
        </v-col>
    </v-card>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import api from '../../../api/users';
import brandColors from '../../../api/mixins.js';

export default {
    name: 'UserDetailsForm',
    mixins: [brandColors],
    props: {
        thisUser: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            valid: false,
            userEmail: undefined,
            emailRules: [
                v => !!v || 'Email is Required',
                v => /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'E-mail must be valid',
            ],
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),

        $_email: {
            get() {
              console.log( this.userEmail || this.thisUser);
                return this.userEmail || this.thisUser.attributes.email;
            },
            set(value) {
                this.userEmail = value;
            },
        },

        userAvatar() {
            if (this.thisUser.id === 0) {
                return 'https://ui-avatars.com/api/?name=...&size=500&bold=true&background=00b0ff&color=FFFFFF';
            }

            const displayName = this.thisUser.attributes.display_name.replace(/ /, '+');

            return this.thisUser.attributes.profile_picture_url
                || `https://ui-avatars.com/api/?name=${displayName}&size=500&bold=true&background=00b0ff&color=FFFFFF`;
        },
    },
    methods: {
        ...mapActions('users', [
            'editUserField',
            'setUsers',
        ]),

        submitUserDetails() {
            if (!this.$refs.userDetails.validate()) {
                return false;
            }

            this.$root.$emit('pageLoading');

            api.setUserAttributes(this.thisUser.id, {
                email: this.$_email,
            })
                .then(({ response, error }) => {

                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'User Details successfully updated!',
                            color: 'success',
                        });

                        this.$root.$emit('formSuccess');
                    } else {
                      let message = 'Oops something went wrong. User details not saved.';

                      if (error && error.errors[0] && error.errors[0].detail) {
                        message = 'Error updating user: ' + error.errors[0].detail;
                      }

                      this.$root.$emit('displayMessage', {
                        text: message,
                        color: 'error',
                        timeout: 15000,
                      });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },
    },
};
</script>
