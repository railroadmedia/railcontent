<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Download CSV</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <ul class="caption grey--text lighten-5 mb-4">
                <li>Leave Dates Blank to download all unfulfilled shipments</li>
                <li>If you only want 1 day, make the Start Date and End Date the same</li>
            </ul>

            <v-form ref="downloadCSV">
                <v-menu
                    ref="menu"
                    v-model="startDatePicker"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                >
                    <v-text-field
                        slot="activator"
                        v-model="startDate"
                        label="Start Date"
                        :color="brandColor"
                        readonly
                    ></v-text-field>

                    <v-date-picker
                        v-model="startDate"
                        no-title
                        scrollable
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            flat
                            color="primary"
                            @click="startDatePicker = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            flat
                            color="primary"
                            @click="startDatePicker = false"
                        >
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>

                <v-menu
                    ref="menu"
                    v-model="endDatePicker"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                >
                    <v-text-field
                        slot="activator"
                        v-model="endDate"
                        label="End Date"
                        :color="brandColor"
                        readonly
                    ></v-text-field>

                    <v-date-picker
                        v-model="endDate"
                        no-title
                        scrollable
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            flat
                            color="primary"
                            @click="endDatePicker = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            flat
                            color="primary"
                            @click="endDatePicker = false"
                        >
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>

                <div class="text-right">
                    <v-btn
                        flat
                        @click="cancelForm"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        class="white--text"
                        :color="brandColor"
                    >
                        Download
                    </v-btn>
                </div>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import brandColors from '../../../api/mixins.js';

export default {
    name: 'DownloadCsv',
    mixins: [brandColors],
    data() {
        return {
            startDatePicker: false,
            startDate: '',
            endDatePicker: false,
            endDate: '',
        };
    },
    methods: {
        cancelForm() {
            this.$refs.downloadCSV.reset();
            this.$emit('cancelForm');
        },
    },
};
</script>
