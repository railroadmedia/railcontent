<template>
    <v-data-table
        :headers="headers"
        :items="items"
        no-results-text="No Results Found"
        hide-default-footer
        :items-per-page="100"
    >
        <template
            v-slot:item="{ item }"
        >
            <tr
                style="cursor:pointer;"
                @click="openEditForm(item)"
            >
                <td class="text-center">
                    {{ item.timecode ? parseTimecode( item.timecode.value) : 'N/A' }}
                </td>
                <td class="text-left">
                    {{ item.title ? item.title.value : 'N/A' }}
                </td>
                <td class="text-left">
                    {{ item.soundslice_slug ? item.soundslice_slug.value : 'N/A' }}
                </td>
                <td
                    class="text-center"
                    @click.stop
                >
                    <v-custom-options-menu
                        :menu-item="item"
                        :menu-index="items.map(item => item.id).indexOf(item.id)"
                        :length="items.length"
                        :edit-button="true"
                        :delete-button="true"
                        @movedUp="moveChildUp"
                        @movedDown="moveChildDown"
                        @editItem="openEditForm"
                        @deleteItem="deleteContentLink"
                    ></v-custom-options-menu>
                </td>
            </tr>
        </template>
    </v-data-table>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../api/mixins.js';
import ContentStore from '../../mixins/content-store';
import api from '../../api/content';
import OptionsMenu from '../../components/CustomOptionsMenu';

export default {
    name: 'AssignmentsTable',
    components: {
        'v-custom-options-menu': OptionsMenu,
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
    },
    data() {
        return {
            headers: [
                {
                    text: 'Time',
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
                    text: 'Sound Slice Slug',
                    align: 'left',
                    sortable: false,
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
        openEditForm(child) {
            this.openChildEditForm({
                id: child.id,
            });
        },

        moveChildUp(child) {
            api.setContentHierarchy({
                parent_id: this.parentId,
                child_id: child.id,
                child_position: child.position - 1,
            })
                .then((response) => {
                    this.$emit('childEdited');
                });
        },

        moveChildDown(child) {
            api.setContentHierarchy({
                parent_id: this.parentId,
                child_id: child.id,
                child_position: child.position + 1,
            })
                .then((response) => {
                    this.$emit('childEdited');
                });
        },

        deleteContentLink(child) {
            api.deleteContentHierarchy({
                parent_id: this.parentId,
                child_id: child.id,
            })
                .then((response) => {
                    this.$emit('childDeleted');
                });
        },

        parseTimecode(timecode) {
            const duration = this.moment.duration(timecode * 1000);

            return this.moment.utc(duration.asMilliseconds()).format('m:ss');
        },
    },
};
</script>
