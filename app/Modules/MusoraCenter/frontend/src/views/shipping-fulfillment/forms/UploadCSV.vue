<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Upload CSV</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form ref="uploadCSV">
                <v-text-field
                    label="CSV File"
                    :color="brandColor"
                    type="file"
                    validate-on-blur
                ></v-text-field>

                <div class="text-right">
                    <v-btn
                        text
                        @click="cancelForm"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        class="white--text"
                        :color="brandColor"
                    >
                        Save
                    </v-btn>
                </div>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import brandColors from '../../../api/mixins.js';

export default {
    name: 'UploadCsv',
    mixins: [brandColors],
    methods: {
        cancelForm() {
            this.$refs.uploadCSV.reset();
            this.$emit('cancelForm');
        },
    },
};
</script>
