<template>
    <v-data-table
        :headers="headers"
        :items="items"
        no-results-text="No Results Found"
        hide-default-footer
        :items-per-page="100"
    >
        <template v-slot:item="{ item }">
            <tr style="cursor:pointer;">
                <linkable-td
                    class="text-center"
                    :to="{ name: 'content.edit', params:{ brand: state.brand, type: childType, id: item.id }}"
                >
                    <content-status :status="item.status"></content-status>
                </linkable-td>

                <linkable-td
                    class="text-left"
                    :to="{ name: 'content.edit', params:{ brand: state.brand, type: childType, id: item.id }}"
                >
                    {{ item.title ? item.title.value : 'N/A' }}
                </linkable-td>

                <linkable-td
                    class="text-center"
                    :to="{ name: 'content.edit', params:{ brand: state.brand, type: childType, id: item.id }}"
                >
                    {{ getPublishedOn(item) }}
                </linkable-td>

                <td
                    class="text-center"
                    @click.stop
                >
                    <v-menu
                        bottom
                        left
                    >
                        <template v-slot:activator="{ on }">
                            <v-btn
                                icon
                                v-on="on"
                            >
                                <v-icon>more_vert</v-icon>
                            </v-btn>
                        </template>

                        <v-list dense>
                            <v-list-item
                                v-if="items.map(item => item.id).indexOf(item.id) !== 0"
                                @click="moveChildUp(item)"
                            >
                                <v-list-item-content>Move Up</v-list-item-content>
                                <v-list-item-action>
                                    <v-icon>keyboard_arrow_up</v-icon>
                                </v-list-item-action>
                            </v-list-item>
                            <v-list-item
                                v-if="items.map(item => item.id).indexOf(item.id) !== (items.length - 1)"
                                @click="moveChildDown(item)"
                            >
                                <v-list-item-content>Move Down</v-list-item-content>
                                <v-list-item-action>
                                    <v-icon>keyboard_arrow_down</v-icon>
                                </v-list-item-action>
                            </v-list-item>
                            <v-list-item @click="openEditForm(item.id)">
                                <v-list-item-content>Edit</v-list-item-content>
                                <v-list-item-action>
                                    <v-icon>edit</v-icon>
                                </v-list-item-action>
                            </v-list-item>
                            <v-list-item @click="deleteContentLink(item)">
                                <v-list-item-content>Delete</v-list-item-content>
                                <v-list-item-action>
                                    <v-icon color="error">
                                        delete
                                    </v-icon>
                                </v-list-item-action>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </td>
            </tr>
        </template>
    </v-data-table>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import { DateTime } from 'luxon';
import brandColors from '../../api/mixins.js';
import ContentStatus from './_ContentStatus';
import ContentStore from '../../mixins/content-store';
import api from '../../api/content';
import LinkableTD from '../../components/LinkableTD';

export default {
    name: 'ContentTable',
    components: {
        'content-status': ContentStatus,
        'linkable-td': LinkableTD,
    },
    mixins: [brandColors, ContentStore],
    props: {
        items: {
            type: Array,
            default: () => [],
        },
        parentId: {
            type: String | Number,
        },
        childType: {
            type: String,
        },
    },
    data() {
        return {
            headers: [
                {
                    text: 'Status',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Title',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Publish Date',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
            ],
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),
    },
    methods: {
        ...mapActions('content', [
            'getContentChildren',
        ]),

        getPublishedOn(item) {
            const dt = DateTime.fromSQL(item.published_on, { zone: 'utc' });
            return dt.setZone('America/Los_Angeles').toFormat('LLL dd, yyyy');
        },

        openEditForm(id) {
            this.openChildEditForm({
                id,
            });
        },

        moveChildUp(child) {
            api.setContentHierarchy({
                parent_id: this.parentId,
                child_id: child.id,
                child_position: child.position - 1,
            })
                .then(this.moveHandler);
        },

        moveChildDown(child) {
            api.setContentHierarchy({
                parent_id: this.parentId,
                child_id: child.id,
                child_position: child.position + 1,
            })
                .then(this.moveHandler);
        },

        moveHandler(response) {
            if (response) {
                this.$root.$emit('displayMessage', {
                    color: 'success',
                    text: 'Child lesson successfully moved!',
                });

                this.$emit('childMoved');
            } else {
                this.$emit('displayMessage', {
                    color: 'error',
                    text: 'Something went wrong. Lesson likely not moved.',
                });
            }
        },

        deleteContentLink(child) {
            const confirmation = confirm(`Are you sure you wish to delete this ${this.childType}`);

            if (confirmation) {
                api.deleteContentHierarchy({
                    parent_id: this.parentId,
                    child_id: child.id,
                })
                    .then((response) => {
                        this.$emit('childDeleted');
                    });
            }
        },
    },
};
</script>
