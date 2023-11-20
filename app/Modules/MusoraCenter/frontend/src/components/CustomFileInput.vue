<template>
    <v-list
        style="background:none;margin-bottom:0!important;"
        class="pa-0"
    >
        <v-list-item
            class="file-input pa-0"
        >
            <v-list-item-content class="pa-0">
                <v-text-field
                    :name="name"
                    :label="label"
                    :color="color"
                    :required="required"
                    :value="permValue"
                    :rules="rules"
                    :loading="uploading || loading"
                    :disabled="uploading || loading"
                    :hint="hint"
                    :persistent-hint="hint != null"
                    @input="emitInput"
                    @change="emitChange"
                ></v-text-field>
            </v-list-item-content>

            <v-list-item-action style="width:40px;">
                <v-row class="pl-2">
                    <v-btn
                        class="white--text"
                        small
                        :color="color"
                        fab
                        @click="triggerFileInput"
                    >
                        <v-icon flat>
                            cloud_upload
                        </v-icon>
                    </v-btn>
                </v-row>
            </v-list-item-action>
            <input
                ref="fileInput"
                type="file"
                accept="*"
                @change="asyncUpload"
            >
        </v-list-item>
    </v-list>
</template>
<script>
import { mapState } from 'vuex';
import Utils from '../api/utils';
import OptionsMenu from '../components/CustomOptionsMenu';

export default {
    name: 'VCustomFileInput',
    components: {
        'v-custom-options-menu': OptionsMenu,
    },
    props: {
        value: {
            type: String,
            default() {
                return '';
            },
        },
        position: {
            type: Number,
            default() {
                return 1;
            },
        },
        name: {
            type: String,
            default() {
                return '';
            },
        },
        color: {
            type: String,
            default() {
                return 'blue darken-4';
            },
        },
        required: {
            type: Boolean,
            default() {
                return false;
            },
        },
        label: {
            type: String,
            default() {
                return '';
            },
        },
        multi: {
            type: Boolean,
            default() {
                return false;
            },
        },
        rules: {
            type: Array,
        },
        inputKey: {
            type: String,
            default: () => '',
        },
        uploadEndpoint: {
            type: String,
            default: '',
        },
        baseFileName: {
            type: String,
            default: 'content-image',
        },
        loading: {
            type: Boolean,
            default: () => false,
        },
        hint: {
            type: String,
            default: () => null,
        },
    },
    data() {
        return {
            uploading: false,
            permValue: this.value,
            optionsMenu: false,
        };
    },
    computed: {
        ...mapState({
            auth: state => state.auth,
        }),
    },
    methods: {

        triggerFileInput() {
            this.$refs.fileInput.click();
        },

        emitInput(value) {
            this.$emit('input', value);
        },

        emitChange(value) {
            this.$emit('change', value);
        },

        asyncUpload(event) {
            if (event) {
                const thisFile = event.target.files[0];
                const formData = new FormData();
                const timeStamp = Math.round((new Date()).getTime() / 1000);
                const fileExtension = thisFile.name.split('.').pop();
                const originalFileName = thisFile.name.split('.')[0];
                const newFileName = `${originalFileName}-${timeStamp}.${fileExtension}`;

                formData.append('file', thisFile, newFileName);
                formData.append('target', newFileName);
                formData.append('_method', 'PUT');

                this.uploading = true;

                Utils.uploadImageToRemoteServer({
                    url: this.uploadEndpoint,
                    form_data: formData,
                    csrf_token: this.auth.currentUser.csrf_token,
                })
                    .then((response) => {
                        if (response) {
                            this.permValue = response.data.data[0].url;

                            this.$emit('imageUploaded', {
                                key: this.inputKey,
                                value: this.permValue,
                            });

                            this.$root.$emit('displayMessage', {
                                text: 'Image Uploaded to S3. Input should now have the URL.',
                                color: 'success',
                            });
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops! Something went wrong. Image not uploaded',
                                color: 'error',
                            });
                        }

                        this.emitInput(this.permValue);
                        this.emitChange(this.permValue);

                        this.uploading = false;
                    });
            }
        },
    },
};
</script>
