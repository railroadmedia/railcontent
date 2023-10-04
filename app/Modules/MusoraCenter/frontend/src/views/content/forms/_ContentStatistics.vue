<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Statistics</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>
        </v-toolbar>

        <v-col
            class="column"
            cols="12"
        >
            <v-data-table
                :headers="headers"
                :items="items"
                :loading="loading"
                no-results-text="No Results Found"
                hide-default-footer
            >

                <template
                    v-slot:item="{ item }"
                >
                    <tr>
                        <td class="text-left">
                            {{ item.period }}
                        </td>
                        <td class="text-center">
                            {{ item.total_starts }}
                        </td>
                        <td class="text-center">
                            {{ item.total_completes }}
                        </td>
                        <td class="text-center">
                            {{ item.total_comments }}
                        </td>
                        <td class="text-center">
                            {{ item.total_likes }}
                        </td>
                        <td class="text-center">
                            {{ item.total_added_to_list }}
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-col>
    </v-card>
</template>
<script>
import api from '../../../api/content';
import brandColors from '../../../api/mixins.js';
import { mapState, mapActions } from 'vuex';

export default {
    name: 'ContentStatistics',
    mixins: [brandColors],
    props: {
        thisPost: {
            type: Object,
        },
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),
    },
    data() {
        return {
            items: [],
            headers: [
                {
                    text: 'Period',
                    align: 'left',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Total Starts',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Total Completes',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Total Comments',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Total Likes',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Total Added to List',
                    align: 'center',
                    sortable: false,
                },
            ],
            loading: false
        };
    },
    methods: {
        getIntervalStatistics({
            small_date_time,
            big_date_time,
            textual_interval
        }) {

            const showError = (message) => {
                this.$root.$emit('displayMessage', {
                    color: 'error',
                    text: message
                });
            }

            return api
                .getIndividualContentStatistics({
                    content_id: this.thisPost.id,
                    small_date_time,
                    big_date_time
                })
                .catch(error => {
                    showError(`Failed retreiving ${textual_interval} content statistics`);
                });
        },

        getContentStats() {
            const fetchStats = this.getIntervalStatistics;
            const moment = this.moment;
            this.loading = true;

            fetchStats({textual_interval: 'Over all time'})
                .then(result => {
                    if (result) {
                        this.items.push({
                            'period': 'Over all time',
                            ...result,
                        });
                    }
                    return fetchStats({
                        small_date_time: moment(moment.now()).subtract(1, 'week').format('YYYY-MM-DD'),
                        big_date_time: moment(moment.now()).format('YYYY-MM-DD'),
                        textual_interval: 'Last 7 days'
                    });
                })
                .then(result => {
                    if (result) {
                        this.items.push({
                            'period': 'Last 7 days',
                            ...result,
                        });
                    }
                    return fetchStats({
                        small_date_time: moment(moment.now()).subtract(30, 'day').format('YYYY-MM-DD'),
                        big_date_time: moment(moment.now()).format('YYYY-MM-DD'),
                        textual_interval: 'Last 30 days'
                    });
                })
                .then(result => {
                    if (result) {
                        this.items.push({
                            'period': 'Last 30 days',
                            ...result,
                        });
                    }
                    this.loading = false;
                });
        },
    },
    mounted() {
        this.getContentStats();
    }
}
</script>