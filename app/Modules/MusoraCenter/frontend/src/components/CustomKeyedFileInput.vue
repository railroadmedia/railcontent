<template>
    <v-row
        align="center"
    >
        <v-col class="pr-1">
            <v-list style="background:none;">
                <v-list-item
                    class="file-input pa-0"
                >
                    <v-list-item-content>
                        <v-text-field
                            v-model="file_name"
                            label="Name"
                            :color="color"
                            required
                            @change="handleInputChange"
                        ></v-text-field>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-col>
        <v-col class="pl-1">
            <v-custom-file-input
                v-model="file_url"
                label="File"
                :color="color"
                :upload-endpoint="uploadEndpoint"
                :required="true"
                @change="handleInputChange"
            ></v-custom-file-input>
        </v-col>
    </v-row>
</template>
<script>
import CustomFileInput from './CustomFileInput';

export default {
    name: 'VCustomKeyedFileInput',
    components: {
        'v-custom-file-input': CustomFileInput,
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
        rules: {
            type: Array,
        },
        uploadEndpoint: {
            type: String,
            default: '',
        },
        fileName: {
            type: String,
            default: () => null,
        },
        fileUrl: {
            type: String,
            default: () => null,
        },
    },
    data() {
        return {
            loading: false,
            file_name: this.fileName,
            file_url: this.fileUrl,
        };
    },
    methods: {
        handleInputChange() {
            if (this.file_name && this.file_url) {
                this.$emit('change', {
                    file_name: this.file_name,
                    file_url: this.file_url,
                    position: this.position,
                });
            }
        },
    },
};
</script>
