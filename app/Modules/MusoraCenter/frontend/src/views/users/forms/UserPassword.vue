<template>
    <v-col>
        <v-dialog
            v-model="dialog"
            max-width="500px"
        >
            <template v-slot:activator="{ on }">
                <v-btn
                    slot="activator"
                    color="error"
                    class="white--text"
                    v-on="on"
                >
                    Reset Password
                </v-btn>
            </template>

            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title>Edit Password</v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <p class="caption grey--text lighten-5">
                        Warning! This action cannot be reversed!
                    </p>

                    <v-form
                        ref="newPassword"
                        v-model="valid"
                    >
                        <v-text-field
                            v-model="password"
                            label="New Password"
                            :color="brandColor"
                            :append-icon="hidePassword ? 'visibility' : 'visibility_off'"
                            :type="hidePassword ? 'password' : 'text'"
                            :error-messages="passwordMatchError"
                            required
                            @click:append="() => (hidePassword = !hidePassword)"
                        ></v-text-field>

                        <v-text-field
                            v-model="confirmPassword"
                            label="New Password"
                            :color="brandColor"
                            :append-icon="hidePassword ? 'visibility' : 'visibility_off'"
                            :type="hidePassword ? 'password' : 'text'"
                            :error-messages="passwordMatchError"
                            required
                            @click:append="() => (hidePassword = !hidePassword)"
                        ></v-text-field>

                        <div class="text-right">
                            <v-btn
                                text
                                class="white--text"
                                @click.stop="dialog = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :color="brandColor"
                                :disabled="!valid"
                                @click="submitPasswordForm"
                            >
                                Save
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-col>
</template>
<script>
import api from '../../../api/users';
import brandColors from '../../../api/mixins.js';

export default {
    name: 'UserPasswordForm',
    mixins: [brandColors],
    props: {
        thisUser: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            dialog: false,
            valid: false,
            hidePassword: false,
            password: '',
            confirmPassword: '',
        };
    },
    computed: {
        passwordMatchError() {
            return (this.password === this.confirmPassword) ? [] : ['Passwords must match'];
        },
    },
    methods: {
        submitPasswordForm() {
            this.$root.$emit('pageLoading');

            api.setUserAttributes(this.thisUser.id, {
                password: this.password,
                password_confirmation: this.confirmPassword,
            })
                .then(({ response, error }) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'User Password successfully updated!',
                            color: 'success',
                        });
                    } else {
                      let message = 'Oops something went wrong. Password not saved.';

                      if (error && error.errors[0] && error.errors[0].detail) {
                        message = 'Error updating password: ' + error.errors[0].detail;
                      }

                      this.$root.$emit('displayMessage', {
                        text: message,
                        color: 'error',
                        timeout: 15000,
                      });
                    }

                    this.$root.$emit('pageLoaded');
                    this.password = '';
                    this.confirmPassword = '';
                    this.dialog = false;
                });
        },
    },
};
</script>
