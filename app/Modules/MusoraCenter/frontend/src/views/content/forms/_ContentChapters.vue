<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Chapters</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip
                v-if="!chaptersError"
                left
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="openEditForm(null)"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Create New Chapter</span>
            </v-tooltip>
            <v-tooltip
                v-if="chaptersError"
                left
            >
                <v-btn
                    slot="activator"
                    icon
                    text
                    class="mx-0"
                    color="error"
                >
                    <v-icon>add</v-icon>
                </v-btn>

                <span>There is an issue with the chapters below! <br>
                    Check that all chapters have a timecode and description before adding a new one!</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            class="column"
            cols="12"
        >
            <v-data-table
                :headers="headers"
                :items="$_chapters"
                no-results-text="No Results Found"
                hide-default-footer
                :items-per-page="100"
            >

                <template
                    v-slot:item="{ item }"
                >
                    <tr
                        style="cursor:pointer;"
                        @click="openEditForm(item, item.index)"
                    >
                        <td class="text-center">
                            {{ parseTimecode(item.time.value) }}
                        </td>
                        <td
                            class="text-left"
                            v-html="item.description.value"
                        >
                            {{ item.description.value }}
                        </td>
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
                                        slot="activator"
                                        class="white--text"
                                        icon
                                        v-on="on"
                                    >
                                        <v-icon>more_vert</v-icon>
                                    </v-btn>
                                </template>

                                <v-list dense>
                                    <v-list-item
                                        v-if="item.index !== 0"
                                        @click="moveChapter(item, true)"
                                    >
                                        <v-list-item-content>Move Up</v-list-item-content>
                                        <v-list-item-action>
                                            <v-icon>keyboard_arrow_up</v-icon>
                                        </v-list-item-action>
                                    </v-list-item>
                                    <v-list-item
                                        v-if="item.index !== (chapters.length - 1)"
                                        @click="moveChapter(item)"
                                    >
                                        <v-list-item-content>Move Down</v-list-item-content>
                                        <v-list-item-action>
                                            <v-icon>keyboard_arrow_down</v-icon>
                                        </v-list-item-action>
                                    </v-list-item>
                                    <v-list-item @click="openEditForm(item, item.index)">
                                        <v-list-item-content>Edit</v-list-item-content>
                                        <v-list-item-action>
                                            <v-icon>edit</v-icon>
                                        </v-list-item-action>
                                    </v-list-item>
                                    <v-list-item @click="deleteChapter(item)">
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
        </v-col>

        <v-dialog
            v-model="editDialog"
            max-width="500px"
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title style="text-transform:capitalize;">
                        Edit/Create Chapter
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form ref="newResource">
                        <v-text-field
                            v-model="editChapterTime"
                            label="Time in Seconds"
                            :color="brandColor"
                        ></v-text-field>

                        <v-textarea
                            v-model="editChapterDescription"
                            label="Description"
                            :color="brandColor"
                            multi-line
                            no-resize
                        ></v-textarea>

                        <!--<v-custom-wysiwyg-editor v-if="editDialog"-->
                        <!--label="Description"-->
                        <!--:color="brandColor"-->
                        <!--v-model="editChapterDescription"></v-custom-wysiwyg-editor>-->

                        <div class="text-right">
                            <v-btn
                                text
                                class="mr-1"
                                @click="closeEditForm"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :disabled="!editChapterTime || !editChapterDescription"
                                :color="brandColor"
                                @click="submitEditForm"
                            >
                                Save
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../../api/mixins.js';
import api from '../../../api/content';
import ContentStore from '../../../mixins/content-store';
import WYSIWYGEditor from '../../../components/CustomWYSIWYGEditor';

export default {
    name: 'ContentChapters',
    components: {
        'v-custom-wysiwyg-editor': WYSIWYGEditor,
    },
    mixins: [brandColors, ContentStore],
    data() {
        return {
            childPosts: [],
            headers: [
                {
                    text: 'Time',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Description',
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
            chapters: [],
            editDialog: false,
            editChapterTime: null,
            editChapterDescription: null,
            editChapterPosition: null,
            chaptersError: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        $_chapters: {
            get() {
                const times = this.thisPost.chapter_timecode;
                const descriptions = this.thisPost.chapter_description;

                this.chapters = [];

                times.forEach((time, index) => {
                    this.chapters.push({
                        time,
                        description: descriptions[index] ? descriptions[index] : '',
                        index,
                    });

                    this.chaptersError = time == null || descriptions[index] == null;
                });

                return this.chapters;
            },
            set() {
                return this.chapters;
            },
        },

        postId() {
            return this.thisPost.id;
        },
    },
    methods: {
        ...mapActions('content', [
            'getContentChildren',
        ]),

        parseTimecode(timecode) {
            const duration = this.moment.duration(timecode * 1000);

            return this.moment.utc(duration.asMilliseconds()).format('m:ss');
        },

        openEditForm(chapter, index) {
            this.editChapterTime = chapter ? chapter.time.value : null;
            this.editChapterDescription = chapter ? chapter.description.value : null;
            this.editChapterPosition = index + 1;
            this.editDialog = true;
        },

        closeEditForm() {
            this.editChapterTime = null;
            this.editChapterDescription = null;
            this.editChapterPosition = null;
            this.editDialog = false;
        },

        moveChapter(payload, up = false) {
            const newPosition = up ? payload.time.position - 1 : payload.time.position + 1;
            const timeId = payload.time.id;
            const descriptionId = payload.description.id;

            api.setContentDatum({
                datum_id: timeId,
                content_id: this.thisPost.id,
                key: 'chapter_timecode',
                position: newPosition,
                type: 'string',
            })
                .then((response) => {
                    if (response) {
                        api.setContentDatum({
                            datum_id: descriptionId,
                            content_id: this.thisPost.id,
                            key: 'chapter_description',
                            position: newPosition,
                            type: 'string',
                        })
                            .then((resolved) => {
                                if (resolved) {
                                    this.$root.$emit('displayMessage', {
                                        color: 'success',
                                        text: 'Chapter successfully moved!',
                                    });
                                    this.closeEditForm();

                                    this.resetContentEditState(resolved.data.post);
                                }
                            });
                    }
                });
        },

        submitEditForm() {
            const thisChapter = this.editChapterPosition ? this.chapters[this.editChapterPosition - 1] : null;
            const timeId = thisChapter ? thisChapter.time.id : null;
            const descriptionId = thisChapter ? thisChapter.description.id : null;

            api.setContentDatum({
                datum_id: timeId,
                content_id: this.thisPost.id,
                key: 'chapter_timecode',
                value: this.editChapterTime,
                position: this.editChapterPosition,
                type: 'string',
            })
                .then((response) => {
                    if (response) {
                        api.setContentDatum({
                            datum_id: descriptionId,
                            content_id: this.thisPost.id,
                            key: 'chapter_description',
                            value: this.editChapterDescription,
                            position: this.editChapterPosition,
                            type: 'string',
                        })
                            .then((resolved) => {
                                if (resolved) {
                                    this.$root.$emit('displayMessage', {
                                        color: 'success',
                                        text: `Chapter successfully ${this.editChapterPosition ? 'edited' : 'created'}!`,
                                    });
                                    this.closeEditForm();

                                    this.resetContentEditState(resolved.data.post);
                                }
                            });
                    }
                });
        },

        deleteChapter(payload) {
            const confirmation = confirm('Are you sure you wish to delete this Chapter?');
            const timeId = payload.time.id;
            const descriptionId = payload.description.id;

            if (confirmation) {
                api.setContentDatum({
                    datum_id: timeId,
                    content_id: this.thisPost.id,
                    deleted: true,
                })
                    .then((response) => {
                        if (response) {
                            api.setContentDatum({
                                datum_id: descriptionId,
                                content_id: this.thisPost.id,
                                deleted: true,
                            })
                                .then((resolved) => {
                                    if (resolved) {
                                        this.$root.$emit('displayMessage', {
                                            color: 'success',
                                            text: 'Chapter successfully deleted!',
                                        });

                                        this.resetContentEditState(resolved.data.post);

                                        this.$nextTick(() => {
                                            this.$forceUpdate();
                                        });
                                    }
                                });
                        }
                    });
            }
        },
    },
};
</script>
