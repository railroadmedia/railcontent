<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>User Fields</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form
                ref="userFields"
                v-model="valid"
            >
                <v-text-field
                    v-model="$_displayName"
                    label="Display Name"
                    :color="brandColor"
                    required
                ></v-text-field>

                <v-custom-file-input
                    v-if="thisUser"
                    v-model="$_profile_picture_url"
                    label="Avatar Photo"
                    input-key="profile_picture_url"
                    :color="brandColor"
                    :loading="avatarLoading"
                    :base-file-name="thisUser.id + '-profile-picture'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <v-text-field
                    v-model="$_first_name"
                    label="First Name"
                    :color="brandColor"
                ></v-text-field>

                <v-text-field
                    v-model="$_last_name"
                    label="Last Name"
                    :color="brandColor"
                ></v-text-field>

                <v-combobox
                    v-model="$_country"
                    label="Country"
                    :color="brandColor"
                    :items="countries"
                ></v-combobox>

                <v-text-field
                    v-model="$_region"
                    label="Region"
                    :color="brandColor"
                ></v-text-field>

                <v-text-field
                    v-model="$_city"
                    label="City"
                    :color="brandColor"
                ></v-text-field>

                <v-text-field
                    v-model="$_phone_number"
                    label="Phone Number"
                    :color="brandColor"
                ></v-text-field>

                <v-combobox
                    v-model="$_timezone"
                    label="Timezone"
                    :items="timezones"
                ></v-combobox>

                <v-select
                    v-model="$_gender"
                    label="Gender"
                    :color="brandColor"
                    :items="['male', 'female']"
                ></v-select>

                <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="$_birthday"
                            label="Birthday"
                            :color="brandColor"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>

                    <v-date-picker
                        v-model="$_birthday"
                        no-title
                        scrollable
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            color="primary"
                            @click="menu = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            text
                            color="primary"
                            @click="menu = false"
                        >
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>

                <v-textarea
                    v-model="$_biography"
                    label="Bio"
                    :color="brandColor"
                    multi-line
                    no-resize
                ></v-textarea>

                <div class="text-right">
                    <v-btn
                        :color="brandColor"
                        class="white--text"
                        :disabled="!valid"
                        @click.stop="submitUserFields"
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
import Utils from '@musora/helper-functions/modules/utils';
import api from '../../../api/users';
import brandColors from '../../../api/mixins.js';
import CustomFileInput from "../../../components/CustomFileInput";

const defaultUser = {
    full_name: null,
    country: null,
    gender: null,
    birthday: null,
    bio: null,
};

export default {
    name: 'UserFieldsForm',
    components: {
        'v-custom-file-input': CustomFileInput,
    },
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
            menu: false,
            avatarLoading: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),

        countries() {
            return window.countryList.map(country => country.name);
        },

        timezones() {
            return Utils.timezones();
        },

        /**
             * Turning the cache off on all these computed properties.
             * If they do not exist, Vue will cache them as undefined,
             * And they wont react any longer
             *
             * - Curtis, July 2018
             */
        $_displayName: {
            get() {
                return this.thisUser.attributes.display_name;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'display_name',
                    value,
                });
            },
        },

        $_first_name: {
            cache: false,
            get() {
                return this.thisUser.attributes.first_name;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'first_name',
                    value,
                });
            },
        },

        $_last_name: {
            cache: false,
            get() {
                return this.thisUser.attributes.last_name;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'last_name',
                    value,
                });
            },
        },

        $_country: {
            cache: false,
            get() {
                return this.thisUser.attributes.country;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'country',
                    value,
                });
            },
        },

        $_region: {
            cache: false,
            get() {
                return this.thisUser.attributes.region;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'region',
                    value,
                });
            },
        },

        $_city: {
            cache: false,
            get() {
                return this.thisUser.attributes.city;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'city',
                    value,
                });
            },
        },

        $_gender: {
            cache: false,
            get() {
                return this.thisUser.attributes.gender;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'gender',
                    value,
                });
            },
        },

        $_timezone: {
            cache: false,
            get() {
                return this.thisUser.attributes.timezone;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'timezone',
                    value,
                });
            },
        },

        $_phone_number: {
            cache: false,
            get() {
                return this.thisUser.attributes.phone_number;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'phone_number',
                    value,
                });
            },
        },

        $_birthday: {
            cache: false,
            get() {
                return this.thisUser.attributes.birthday;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'birthday',
                    value,
                });
            },
        },

        $_biography: {
            cache: false,
            get() {
                return this.thisUser.attributes.biography;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'biography',
                    value,
                });
            },
        },

        $_profile_picture_url: {
            cache: false,
            get() {
                return this.thisUser.attributes.profile_picture_url;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'profile_picture_url',
                    value,
                });
            },
        },
    },
    methods: {
        ...mapActions('users', [
            'editUserField',
            'setUsers',
        ]),

        submitUserFields() {
            if (this.$refs.userFields.validate()) {
                this.$root.$emit('pageLoading');

                api.setUserAttributes(this.thisUser.id, {
                    display_name: this.$_displayName,
                    first_name: this.$_first_name,
                    last_name: this.$_last_name,
                    country: this.$_country,
                    region: this.$_region,
                    city: this.$_city,
                    gender: this.$_gender,
                    birthday: this.$_birthday,
                    biography: this.$_biography,
                    profile_picture_url: this.$_profile_picture_url,
                })
                    .then(({response, error}) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'User Fields successfully updated!',
                                color: 'success',
                            });

                            this.$emit('formSuccess');
                        } else {
                          let message = 'Oops something went wrong. Fields not saved.';

                          if (error && error.errors[0] && error.errors[0].detail) {
                            message = 'Error updating fields: ' + error.errors[0].detail;
                          }

                          this.$root.$emit('displayMessage', {
                            text: message,
                            color: 'error',
                            timeout: 15000,
                          });
                        }

                        this.$root.$emit('pageLoaded');
                    });
            }
        },
    },
};
</script>
