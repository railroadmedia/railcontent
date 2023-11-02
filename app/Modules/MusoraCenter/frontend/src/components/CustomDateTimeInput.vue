<template>
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
                slot="activator"
                :label="label"
                :color="color"
                :loading="loading"
                :disabled="disabled"
                :value="formattedValue"
                readonly
                v-on="on"
                @input="emitInput"
            ></v-text-field>
        </template>

        <v-card>
            <v-tabs
                v-model="tabs"
                :color="color"
                dark
                centered
                grow
                slider-color="white"
            >
                <v-tab ripple>
                    <v-icon>calendar_today</v-icon>
                </v-tab>
                <v-tab-item>
                    <v-date-picker
                        v-model="$_date"
                        :color="color"
                        scrollable
                        style="box-shadow:none;"
                    ></v-date-picker>
                </v-tab-item>
                <v-tab ripple>
                    <v-icon>access_time</v-icon>
                </v-tab>
                <v-tab-item>
                    <v-time-picker
                        v-model="$_time"
                        :color="color"
                        scrollable
                    ></v-time-picker>
                </v-tab-item>
            </v-tabs>

            <v-col class="px-4">
                <v-text-field
                    :color="color"
                    :value="formattedCombinedDateTimeStrings"
                    disabled
                ></v-text-field>
            </v-col>
            <v-col class="text-right">
                <v-btn
                    text
                    @click="menu = false"
                >
                    Cancel
                </v-btn>
                <v-btn
                    class="white--text"
                    :color="color"
                    :disabled="!hasBothTempValues"
                    @click="submitDateTime"
                >
                    OK
                </v-btn>
            </v-col>
        </v-card>
    </v-menu>
</template>
<script>
import { DateTime } from 'luxon';

export default {
    name: 'VCustomDatetimeInput',
    props: {
        color: {
            type: String,
            default: () => 'primary',
        },
        label: {
            type: String,
            default: () => '',
        },
        inputKey: {
            type: String,
            default: () => '',
        },
        value: {
            type: String,
            default: () => undefined,
        },
        loading: {
            type: Boolean,
            default: () => false,
        },
        disabled: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            menu: false,
            tabs: 0,
            tempDate: '',
            tempTime: '',
            permDateTime: this.value,
        };
    },
    computed: {
        $_date: {
            get() {
                if (this.tempDate) {
                    return this.tempDate;
                }

                return this.value ? this.moment(this.value).format('YYYY-MM-DD') : '';
            },
            set(val) {
                this.tabs = 1;
                this.tempDate = val;
            },
        },
        $_time: {
            get() {
                if (this.tempDate) {
                    return this.tempTime;
                }

                return this.value ? this.moment(this.value).format('HH:mm:ss') : '';
            },
            set(val) {
                this.tempTime = val ? `${val}:00` : '';
            },
        },

        formattedValue() {
            return this.value ? this.convertUtcToPst(this.value) : '';
        },

        hasBothTempValues() {
            return !!this.tempDate && !!this.tempTime;
        },

        combinedDateTimeStrings() {
            return `${this.tempDate} ${this.tempTime}`;
        },

        formattedCombinedDateTimeStrings() {
            return DateTime.fromSQL(this.combinedDateTimeStrings).toFormat('LLL dd \- h:mm a');
        },
    },
    watch: {
        menu() {
            this.tabs = 0;
        },
    },
    methods: {
        convertUtcToPst(date) {
            const dt = DateTime.fromSQL(date, { zone: 'utc' });
            return dt.setZone('America/Los_Angeles').toFormat('LLL dd \- h:mm a');
        },

        submitDateTime() {
            const date = DateTime.fromSQL(this.combinedDateTimeStrings, { zone: 'America/Los_Angeles' });

            this.menu = false;
            this.permDateTime = date.setZone('utc').toFormat('yyyy-LL-dd HH:mm:ss');

            this.emitInput(this.permDateTime);
        },

        emitInput(val) {
            this.$emit('datechange', {
                key: this.inputKey,
                value: val,
            });
        },
    },
};
</script>
