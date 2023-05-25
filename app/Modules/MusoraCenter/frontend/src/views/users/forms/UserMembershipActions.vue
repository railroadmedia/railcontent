<template>
    <v-card class="mb-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Membership Actions</v-toolbar-title>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="userMembershipActions"
            :items-per-page="5"
            class="elevation-1"
        >
            <template v-slot:item="{ item }">
                <tr :class="{'deleted-table-row': !!item.attributes.deleted_at}">
                    <td class="text-center">
                        <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                    </td>

                    <td class="text-center">
                        {{ getSubscriptionId(item) }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.action }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.action_amount }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.action_reason }}
                    </td>

                    <td class="text-center">
                        {{ item.attributes.note }}
                    </td>

                    <td class="text-center">
                        {{ moment(item.attributes.created_at).format('MMM D, Y') }}
                    </td>
                </tr>
            </template>
        </v-data-table>

    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../../api/mixins.js';
import JsonApiMethods from '../../../mixins/json-api-methods';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';

export default {
    name: 'UserMembershipActions',
    components: {
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors, JsonApiMethods],
    props: {
        userId: {
            type: Number | String,
            default: () => 0,
        },
        userMembershipActions: {
            type: Array,
            default: () => [],
        },
        includedData: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Subscription ID',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Action',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Amount',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Reason',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Note',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Created',
                    align: 'center',
                    sortable: true,
                    width: 150,
                },
            ],
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),
    },
    methods: {
        getSubscriptionId(item) {
            if (item.relationships.subscription) {
                const subscription = this.getRelatedAttributesByTypeAndId(
                    item.relationships.subscription.data,
                    this.includedData,
                );

                return subscription.id;
            }

            return '';
        },
    },
};
</script>
