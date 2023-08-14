<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Downloadable Resources</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip
                v-if="!resourcesError"
                left
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="newDialog = true"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Add New Resource</span>
            </v-tooltip>
            <v-tooltip
                v-if="resourcesError"
                left
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        color="error"
                        v-on="on"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>There is an issue with the resources below! <br>
                    Check that all resources have a name and url before adding a new one!</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form
                v-if="thisPost.resource_name.length"
                ref="editForm"
            >
                <v-row
                    v-for="(resource, i) in $_resources"
                    :key="resource.name.value + resource.name.id"
                >
                    <v-col>
                        <v-custom-keyed-file-input
                            :file-name="resource.name.value"
                            :file-url="resource.url.value"
                            :color="brandColor"
                            :position="i + 1"
                            upload-endpoint="/railcontent/remote"
                            :required="true"
                            @change="handleChange"
                        ></v-custom-keyed-file-input>
                    </v-col>
                    <v-col
                        align-self="center"
                        class="mb-2"
                        style="max-width:56px;"
                    >
                        <v-custom-options-menu
                            :menu-item="resource"
                            :menu-index="i"
                            :length="resources.length"
                            :delete-button="true"
                            @movedUp="handleMoveUp"
                            @movedDown="handleMoveDown"
                            @deleteItem="handleItemDelete"
                        ></v-custom-options-menu>
                    </v-col>
                </v-row>
            </v-form>
            <p
                v-else
                class="ma-0 text-center"
            >
                No Downloadable Resources added yet.
            </p>
        </v-col>

        <v-dialog
            v-model="newDialog"
            max-width="500px"
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title style="text-transform:capitalize;">
                        New Downloadable Resource
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form ref="newResource">
                        <v-text-field
                            v-model="newResourceTitle"
                            label="Title"
                            :color="brandColor"
                        ></v-text-field>

                        <v-custom-file-input
                            ref="newFileInput"
                            v-model="newResourceFile"
                            label="File URL"
                            input-key="resource_url"
                            :color="brandColor"
                            :base-file-name="thisPost.id + '-resource'"
                            upload-endpoint="/railcontent/remote"
                            class="mb-2"
                        ></v-custom-file-input>

                        <div class="text-right">
                            <v-btn
                                text
                                class="mr-1"
                                @click="newDialog = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :disabled="!newResourceTitle || !newResourceFile"
                                :color="brandColor"
                                @click="submitNewResource"
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
import { Content as ContentHelpers } from '@musora/helper-functions';
import brandColors from '../../../api/mixins.js';
import CustomKeyedFileInput from '../../../components/CustomKeyedFileInput';
import CustomFileInput from '../../../components/CustomFileInput';
import ContentStore from '../../../mixins/content-store';
import api from '../../../api/content';
import OptionsMenu from '../../../components/CustomOptionsMenu';

export default {
    name: 'DownloadableResources',
    components: {
        'v-custom-keyed-file-input': CustomKeyedFileInput,
        'v-custom-file-input': CustomFileInput,
        'v-custom-options-menu': OptionsMenu,
    },
    mixins: [brandColors, ContentStore],
    data() {
        return {
            resources: [],
            newDialog: false,
            newResourceTitle: null,
            newResourceFile: null,
            resourcesError: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        $_resources: {
            get() {
                const names = this.thisPost.resource_name;
                const urls = this.thisPost.resource_url;

                this.resources = [];

                names.forEach((name, index) => {
                    this.resources.push({
                        name,
                        url: urls[index] ? urls[index] : '',
                    });

                    this.resourcesError = names == null || urls[index] == null;
                });

                return this.resources;
            },
            set() {
                return this.resources;
            },
        },
    },
    watch: {
        newDialog() {
            if (!this.newDialog) {
                this.newResourceTitle = null;
                this.newResourceFile = null;
                this.$refs.newFileInput.permValue = null;
            }
        },
    },
    methods: {
        appendNewResource(event) {
            this.resources.push({
                name: {
                    value: '',
                    position: this.resources.length,
                    id: 0,
                },
                url: {
                    value: '',
                    position: this.resources.length,
                    id: 0,
                },
            });

            this.$emit('appendNewResource', event);
        },

        submitNewResource() {
            this.$root.$emit('pageLoading');

            this.handleChange({
                file_name: this.newResourceTitle,
                file_url: this.newResourceFile,
                position: undefined,
                created: true,
            });
        },

        handleChange(payload) {
            const nameId = this.resources[payload.position - 1] ? this.resources[payload.position - 1].name.id : null;
            const fileId = this.resources[payload.position - 1] ? this.resources[payload.position - 1].url.id : null;

            this.resources = [];

            api.setContentDatum({
                datum_id: nameId,
                content_id: this.thisPost.id,
                key: 'resource_name',
                value: payload.file_name,
                position: payload.position,
                type: 'string',
            })
                .then((response) => {
                    if (response) {
                        api.setContentDatum({
                            datum_id: fileId,
                            content_id: this.thisPost.id,
                            key: 'resource_url',
                            value: payload.file_url,
                            position: payload.position,
                            type: 'string',
                        })
                            .then((resolved) => {
                                this.handleResponses(resolved, payload.created ? 'created' : 'edited');
                            });
                    }
                });
        },

        handleMove(payload, down = false) {
            const newPosition = down ? payload.name.position + 1 : payload.name.position - 1;

            api.setContentDatum({
                datum_id: payload.name.id,
                content_id: this.thisPost.id,
                key: 'resource_name',
                position: newPosition,
                type: 'string',
            })
                .then((response) => {
                    if (response) {
                        api.setContentDatum({
                            datum_id: payload.url.id,
                            content_id: this.thisPost.id,
                            key: 'resource_url',
                            position: newPosition,
                            type: 'string',
                        })
                            .then((resolved) => {
                                this.handleResponses(resolved, 'moved');
                            });
                    }
                });
        },

        handleMoveUp(payload) {
            this.handleMove(payload);
        },

        handleMoveDown(payload) {
            this.handleMove(payload, true);
        },

        handleItemDelete(payload) {
            api.setContentDatum({
                datum_id: payload.name.id,
                content_id: this.thisPost.id,
                deleted: true,
                type: 'string',
            })
                .then((response) => {
                    if (response) {
                        api.setContentDatum({
                            datum_id: payload.url.id,
                            content_id: this.thisPost.id,
                            deleted: true,
                            type: 'string',
                        })
                            .then((resolved) => {
                                this.handleResponses(resolved, 'deleted');
                            });
                    }
                });
        },

        handleResponses(response, action = 'edited') {
            if (response) {
                this.$root.$emit('displayMessage', {
                    color: 'success',
                    text: `Downloadable Resource successfully ${action}!`,
                });
                this.newDialog = false;

                this.resetContentEditState(response.data.post);
            }

            this.$root.$emit('pageLoaded');
            this.$nextTick(() => {
                this.$forceUpdate();
            });
        },
    },
};
</script>
