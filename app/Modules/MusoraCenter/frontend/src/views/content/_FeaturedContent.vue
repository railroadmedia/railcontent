<template>
    <v-card>
        <v-toolbar
            dark
            :color="brandColor"
        >
            <v-toolbar-title>
                {{ toCapitalCase(state.brand) }} Featured Content
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn
                    icon
                    dark
                    @click="openEditDialog(null)"
                >
                    <v-icon>add</v-icon>
                </v-btn>
            </v-toolbar-items>
            <template v-slot:extension>
                <v-row>
                    <v-col>
                        <v-autocomplete
                            v-model="selectedContentType"
                            label="Content Type"
                            color="white"
                            :items="availableContentTypes"
                            item-text="label"
                            item-value="type"
                            clearable
                        >
                        </v-autocomplete>
                    </v-col>
                </v-row>
            </template>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="featuredContent"
            no-results-text="No Results Found"
            hide-default-footer
            :loading="loading || false"
            class="elevation-1"
            :items-per-page="20"
        >
            <template v-slot:item="{ item }">
                <tr style="cursor:pointer;">
                    <td class="text-center">
                        {{ getItemPosition(item) }}
                    </td>

                    <td style="text-transform:capitalize;vertical-align:middle;">
                        <p style="margin:0;white-space:nowrap;">
                            <v-avatar
                                size="30"
                                :color="brandColor"
                                class="mr-2"
                            >
                                <v-icon
                                    size="14"
                                    dark
                                    style="vertical-align:middle;"
                                >
                                    {{ getContentTypeIcon(item.type) }}
                                </v-icon>
                            </v-avatar>
                            {{ item.type.replace(/-/g, ' ') }}
                        </p>
                    </td>

                    <td>
                        {{ item.title ? item.title.value : 'TBD' }}
                    </td>

                    <td class="text-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    dark
                                    color="success"
                                    class="mx-1"
                                    v-on="on"
                                    @click="openEditDialog(item)"
                                >
                                    <v-icon>
                                        edit
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Edit</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    dark
                                    color="error"
                                    class="mx-1"
                                    v-on="on"
                                    @click="removeItem(item)"
                                >
                                    <v-icon>
                                        close
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Remove Item</span>
                        </v-tooltip>
                    </td>
                </tr>
            </template>
        </v-data-table>

        <v-dialog
            v-model="editDialog"
            max-width="500px"
            persistent
        >
            <v-card>
                <v-toolbar
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title>
                        {{ isNew ? 'Add New Item' : 'Edit Item' }}
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-col class="pa-2">
                    <p class="caption mb-3">
                        {{ listHintMessage }}
                    </p>

                    <p v-if="editingPreview.id" class="caption mb-0">
                        Lesson Preview:
                    </p>
                    <v-list
                        v-if="editingPreview.id"
                        class="mb-3"
                    >
                        <v-list-item
                            :to="{name: 'content.edit', params: {brand: state.brand, id: editingPreview.id}}"
                            target="_blank"
                        >
                            <v-list-item-avatar>
                                <v-img :src="getEditPreviewProp('thumbnail_url')"></v-img>
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ getEditPreviewProp('title') }}
                                </v-list-item-title>

                                <v-list-item-subtitle>
                                    <v-icon
                                        size="14"
                                        dark
                                        style="vertical-align:middle;"
                                    >
                                        {{ getContentTypeIcon(editingPreview.type || 'show') }}
                                    </v-icon>

                                    {{ toCapitalCase(editingPreview.type) }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>

                    <v-form
                        :key="editingItem.id"
                        ref="form"
                        v-model="valid"
                    >
                        <v-text-field
                            v-model="$_id"
                            label="Content ID"
                            :loading="previewLoading"
                            :disabled="!isNew"
                            :readonly="!isNew"
                            :rules="contentIdValidationRules"
                            :color="brandColor"
                        ></v-text-field>

                        <v-text-field
                            v-model="$_position"
                            label="Position"
                            :rules="[v => !!v || 'Position is required.']"
                            :color="brandColor"
                        ></v-text-field>


                        <v-custom-file-input
                            v-model="$_background_image"
                            label="Header Background Image"
                            input-key="header_image_url"
                            :color="brandColor"
                            :rules="[v => !!v || 'Background Image is required.']"
                            :base-file-name="editingItem.id + '-header-image'"
                            upload-endpoint="/railcontent/remote"
                            class="mb-2"
                        ></v-custom-file-input>
                    </v-form>

                    <div class="text-right">
                        <v-btn
                            text
                            class="mr-1"
                            @click="cancelForm"
                        >
                            Cancel
                        </v-btn>

                        <v-btn
                            :color="brandColor"
                            dark
                            :disabled="!valid || editingPreview.id == null"
                            @click="submitForm"
                        >
                            Save
                        </v-btn>
                    </div>
                </v-col>
            </v-card>
        </v-dialog>
    </v-card>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import { Content as ContentHelpers, Utils } from '@musora/helper-functions';
import brandColors from '../../api/mixins.js';
import LinkableTD from '../../components/LinkableTD.vue';
import api from '../../api/content';
import CustomFileInput from '../../components/CustomFileInput';

const defaultEditingItem = () => ({
    id: null,
    home_staff_pick_rating: {},
    staff_pick_rating: {},
    header_image_url: {},
});

export default {
    name: 'FeaturedContent',
    components: {
        'linkable-td': LinkableTD,
        'v-custom-file-input': CustomFileInput,
    },
    mixins: [brandColors],
    props: {
        loading: {
            type: Boolean,
            default: false,
        },

        featuredContent: {
            type: Array,
            default: () => [],
        },

        featuredContentType: {
            type: String,
            default: () => '',
        },

        availableContentTypes: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            headers: [
                {
                    text: 'Position',
                    align: 'left',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Type',
                    align: 'left',
                    sortable: false,
                    width: 200,
                },
                {
                    text: 'Title',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    width: 120,
                },
            ],
            editDialog: false,
            editingItem: defaultEditingItem(),
            editingPreview: defaultEditingItem(),
            isNew: false,
            previewLoading: false,
            timeouts: {
                id: null,
            },
            valid: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
            auth: state => state.auth,
        }),

        selectedContentType: {
            cache: false,
            get() {
                return this.featuredContentType;
            },
            set(val) {
                this.$emit('changeContentType', val);
            },
        },

        $_id: {
            get() {
                return this.editingItem.id;
            },
            set(val) {
                if (val) {
                    clearTimeout(this.timeouts.id);

                    if (this.featuredContent.find(item => item.id == val)) {
                        this.editingPreview = defaultEditingItem();
                        this.previewLoading = false;

                        return false;
                    }

                    this.previewLoading = true;

                    this.timeouts.id = setTimeout(() => {
                        api.getContentById(val)
                            .then((response) => {
                                if (response.data.data.length) {
                                    if (response.data.data[0].id == val) {
                                        this.editingPreview = ContentHelpers.flattenContent(response.data.data)[0];
                                        this.editingItem = {
                                            ...this.editingItem,
                                            ...ContentHelpers.flattenContent(response.data.data)[0],
                                        };
                                    } else {
                                        this.$root.$emit('displayMessage', {
                                            color: 'error',
                                            text: 'Oops, something went wrong and that Content ID couldn\'t be found.',
                                        });
                                    }
                                } else {
                                    this.editingPreview = defaultEditingItem();
                                }

                                this.previewLoading = false;
                            });
                    }, 2000);
                } else {
                    clearTimeout(this.timeouts.id);

                    this.previewLoading = false;
                    this.editingPreview = defaultEditingItem();
                }
            },
        },

        $_position: {
            get() {
                if (this.selectedContentType) {
                    return this.editingItem.staff_pick_rating ? this.editingItem.staff_pick_rating.value : null;
                }

                return this.editingItem.home_staff_pick_rating ? this.editingItem.home_staff_pick_rating.value : null;
            },
            set(value) {
                if (this.selectedContentType) {
                    if (this.editingItem.staff_pick_rating.id) {
                        this.$set(this.editingItem.staff_pick_rating, 'value', value);
                    } else {
                        this.$set(this.editingItem, 'staff_pick_rating', {
                            value,
                        });
                    }
                } else {
                    if (this.editingItem.home_staff_pick_rating.id) {
                        this.$set(this.editingItem.home_staff_pick_rating, 'value', value);
                    } else {
                        this.$set(this.editingItem, 'home_staff_pick_rating', {
                            value,
                        });
                    }
                }
            },
        },

        $_background_image: {
            cache: false,
            get() {
                return this.editingItem.header_image_url ? this.editingItem.header_image_url.value : null;
            },
            set(value) {
                if (this.editingItem.header_image_url && this.editingItem.header_image_url.id) {
                    this.$set(this.editingItem.header_image_url, 'value', value);
                } else {
                    this.$set(this.editingItem, 'header_image_url', {
                        value,
                    });
                }
            },
        },

        contentIdValidationRules() {
            const validationRules = [
                v => !!v || 'Content ID is required.',
            ];

            if (this.isNew) {
                validationRules.push(
                    v => this.featuredContent.filter(item => item.id == v).length <= 0
                        || 'That content already exists in this list',
                );
            }

            if (this.selectedContentType) {
                validationRules.push(
                    () => this.editingPreview.type === this.selectedContentType
                        || 'This content is the wrong content type for this list',
                );
            }

            return validationRules;
        },

        listHintMessage() {
            if (this.selectedContentType) {
                return `This lesson will appear on the ${this.selectedContentType} list.`;
            }

            return 'This lesson will appear on the master home page list.';
        },
    },
    methods: {
        closeDialog() {
            this.$emit('closeDialog');
        },

        toCapitalCase: string => Utils.toCapitalCase(string),

        getContentTypeIcon: type => ContentHelpers.getContentTypeIcon(type),

        getItemPosition(item) {
            if (this.selectedContentType) {
                return item.staff_pick_rating ? item.staff_pick_rating.value : 0;
            }

            return item.home_staff_pick_rating ? item.home_staff_pick_rating.value : 0;
        },

        openEditDialog(item) {
            if (item) {
                this.editingItem = JSON.parse(JSON.stringify(item));
                this.editingPreview = JSON.parse(JSON.stringify(item));
                this.isNew = false;
            } else {
                this.editingItem = defaultEditingItem();
                this.editingPreview = defaultEditingItem();
                this.isNew = true;
            }

            this.$nextTick(() => {
                this.$forceUpdate();
                this.editDialog = true;
            });
        },

        submitForm() {
            const fieldToSubmit = this.selectedContentType ? 'staff_pick_rating' : 'home_staff_pick_rating';
            const ratingParams = {
                key: fieldToSubmit,
                value: this.$_position,
                type: 'integer',
                position: 1,
            };
            const imageParams = {
                key: 'header_image_url',
                value: this.$_background_image,
                type: 'string',
            };

            if (!this.isNew) {
                ratingParams.field_id = this.editingItem[fieldToSubmit].id;

                if (this.editingItem.header_image_url.id) {
                    imageParams.datum_id = this.editingItem.header_image_url.id;
                } else {
                    imageParams.content_id = this.$_id;
                }
            } else {
                ratingParams.content_id = this.$_id;
                imageParams.content_id = this.$_id;
            }

            this.$root.$emit('pageLoading');

            Promise.all([
                api.setContentField(ratingParams),
                api.setContentDatum(imageParams),
            ])
                .then((result) => {
                    const requestsFailed = result.filter(response => response == null).length > 0;

                    if (!requestsFailed) {
                        this.$emit('refreshList');
                        this.editDialog = false;

                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Featured content was successfully updated!',
                        });
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Oops, something went wrong. Featured content was likely not updated!',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        removeItem(item) {
            const fieldToDelete = this.selectedContentType ? 'staff_pick_rating' : 'home_staff_pick_rating';

            this.$root.$emit('pageLoading');

            api.setContentField({
                field_id: item[fieldToDelete].id,
                deleted: true,
            })
                .then((response) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Featured content was successfully removed!',
                        });
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Oops, something went wrong. Featured content was likely not removed!',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                    this.$emit('refreshList');
                });
        },

        cancelForm() {
            this.editDialog = false;

            this.$nextTick(() => {
                this.editingItem = defaultEditingItem();
                this.editingPreview = defaultEditingItem();
            });
        },

        getEditPreviewProp(prop) {
            return this.editingPreview[prop] ? this.editingPreview[prop].value : '';
        },
    },
};
</script>
