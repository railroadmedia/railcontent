<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Add/Remove Media</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip
                v-if="contentModel.sheet_music_image_url"
                left
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="newDialog = true"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Add Sheet Music</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form
                v-if="contentModel"
                ref="editForm"
            >
                <!-- THUMBNAIL -->
                <div
                    v-if="contentModel.original_thumbnail_url && $_original_thumbnail_url"
                    class="text-center mb-2"
                    style="margin:0 auto;"
                    :style="hasSquareThumb ? 'max-width:50%;' : 'max-width:75%;'"
                >
                    <v-img
                        :src="$_original_thumbnail_url"
                        position="center 16%"
                        :aspect-ratio="hasSquareThumb ? 1 : 1.77"
                    ></v-img>
                </div>
                <div
                    v-if="contentModel.original_thumbnail_url"
                    class="mt-4"
                >
                    <p class="text-left font-italic">* Please fill both thumbnail fields, you can use the same high-res image for both.</p>
                </div>

                <!-- THUMBNAIL -->
                <v-custom-file-input
                    v-if="contentModel.original_thumbnail_url"
                    v-model="$_original_thumbnail_url"
                    label="Primary High-Res Thumbnail Image"
                    input-key="thumbnail_url"
                    :color="brandColor"
                    :loading="contentModel.original_thumbnail_url.loading"
                    :base-file-name="thisPost.id + '-card-thumbnail-maxres'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>
                <v-custom-file-input
                    v-if="contentModel.thumbnail_url"
                    v-model="$_card_thumbnail"
                    label="Legacy Fallback Card Thumbnail Image"
                    input-key="thumbnail_url"
                    :color="brandColor"
                    :loading="contentModel.thumbnail_url.loading"
                    :base-file-name="thisPost.id + '-card-thumbnail'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>


                <!-- HEADER IMAGE -->
                <v-divider
                    v-if="contentModel.header_image_url"
                    class="mb-6"
                ></v-divider>

                <div
                    v-if="contentModel.header_image_url && $_header_image_url"
                    class="text-center mb-2"
                    style="max-width:75%;margin:0 auto;"
                >
                    <v-img
                        :src="$_header_image_url"
                        aspect-ratio="1.77"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.header_image_url"
                    v-model="$_header_image_url"
                    label="Header Background Image"
                    input-key="header_image_url"
                    :color="brandColor"
                    :loading="contentModel.header_image_url.loading"
                    :base-file-name="thisPost.id + '-header-image'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    hint="Set this image if the content is a Pack or part of the featured content list"
                    class="mb-2"
                ></v-custom-file-input>


                <!-- LOGO IMAGE -->
                <v-divider
                    v-if="contentModel.logo_image_url"
                    class="mb-6"
                ></v-divider>

                <div
                    v-if="contentModel.logo_image_url && $_logo_image_url"
                    class="text-center mb-2"
                    style="max-width:75%;margin:0 auto;"
                >
                    <v-img :src="$_logo_image_url"></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.logo_image_url"
                    v-model="$_logo_image_url"
                    label="Pack Logo"
                    input-key="logo_image_url"
                    :color="brandColor"
                    :loading="contentModel.logo_image_url.loading"
                    :base-file-name="thisPost.id + '-logo-image'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <!-- DRUMEO RUDIMENT SHEET MUSIC THUMB -->
                <div
                    v-if="contentModel.sheet_music_thumbnail_url && $_drum_chord_image_url"
                    class="text-center mb-2"
                    style="max-width:50%;margin:0 auto;"
                >
                    <v-img
                        :src="$_drum_chord_image_url"
                        aspect-ratio="3.75"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.sheet_music_thumbnail_url"
                    v-model="$_drum_chord_image_url"
                    label="Drum Rudiment Sheet Music Thumb"
                    input-key="sheet_music_thumbnail_url"
                    :color="brandColor"
                    :loading="contentModel.sheet_music_thumbnail_url.loading"
                    :base-file-name="thisPost.id + '-drum_sheet_music_url'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <!-- PIANO CHORD/SCALE CHART -->
                <div
                    v-if="contentModel.piano_keys_thumbnail_url && $_piano_keys_thumbnail_url"
                    class="text-center mb-2"
                    style="max-width:50%;margin:0 auto;"
                >
                    <v-img
                        :src="$_piano_keys_thumbnail_url"
                        aspect-ratio="3.75"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.piano_keys_thumbnail_url"
                    v-model="$_piano_keys_thumbnail_url"
                    label="Chord/Scale Chart"
                    input-key="piano_keys_thumbnail_url"
                    :color="brandColor"
                    :loading="contentModel.piano_keys_thumbnail_url.loading"
                    :base-file-name="thisPost.id + '-chord-scale-chart'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <!-- GUITAR CHORD/SCALE CHART -->
                <div
                    v-if="contentModel.guitar_chord_image_url && $_guitar_chord_image_url"
                    class="text-center mb-2"
                    style="max-width:50%;margin:0 auto;"
                >
                    <v-img
                        :src="$_guitar_chord_image_url"
                        aspect-ratio="1"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.guitar_chord_image_url"
                    v-model="$_guitar_chord_image_url"
                    label="Chord/Scale Chart"
                    input-key="guitar_chord_image_url"
                    :color="brandColor"
                    :loading="contentModel.guitar_chord_image_url.loading"
                    :base-file-name="thisPost.id + '-chord-scale-chart'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>


                <!-- INSTRUCTOR AVATAR IMAGE -->
                <div
                    v-if="contentModel.head_shot_picture_url && $_head_shot_picture_url"
                    class="text-center mb-2"
                    style="max-width:50%;margin:0 auto;"
                >
                    <v-avatar
                        :size="250"
                        :color="brandColor"
                    >
                        <v-img
                            :src="$_head_shot_picture_url"
                            aspect-ratio="1"
                        ></v-img>
                    </v-avatar>
                </div>

                <v-custom-file-input
                    v-if="contentModel.head_shot_picture_url"
                    v-model="$_head_shot_picture_url"
                    label="Avatar"
                    input-key="head_shot_picture_url"
                    :color="brandColor"
                    :loading="contentModel.head_shot_picture_url.loading"
                    :base-file-name="thisPost.id + '-avatar'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>


                <!-- coach_featured_image -->
                <div
                    v-if="contentModel.coach_featured_image && $_coach_featured_image"
                    class="text-center mb-2"
                    style="max-width:50%;margin:0 auto; margin-top: 50px;"
                >
                    <v-img
                        :src="$_coach_featured_image"
                        aspect-ratio="1.777777778"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.coach_featured_image"
                    v-model="$_coach_featured_image"
                    label="Coach Featured Image (shown as their featured card background, 16x9 ratio)"
                    input-key="coach_featured_image"
                    :color="brandColor"
                    :loading="contentModel.coach_featured_image.loading"
                    :base-file-name="thisPost.id + '-coach-featured-image'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <!-- coach_card_image -->
                <div
                    v-if="contentModel.coach_card_image && $_coach_card_image"
                    class="text-center mb-2"
                    style="max-width:60%;margin:0 auto; margin-top: 50px;"
                >
                    <v-img
                        :src="$_coach_card_image"
                        aspect-ratio="0.6875"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.coach_card_image"
                    v-model="$_coach_card_image"
                    label="Coach Card Image (shown as their generic vertical card background, 11x16 ratio)"
                    input-key="coach_card_image"
                    :color="brandColor"
                    :loading="contentModel.coach_card_image.loading"
                    :base-file-name="thisPost.id + '-coach-card-vertical-image'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <!-- coach_top_banner_image -->
                <div
                    v-if="contentModel.coach_top_banner_image && $_coach_top_banner_image"
                    class="text-center mb-2"
                    style="max-width:50%;margin:0 auto; margin-top: 50px;"
                >
                    <v-img
                        :src="$_coach_top_banner_image"
                        aspect-ratio="1.777777778"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.coach_top_banner_image"
                    v-model="$_coach_top_banner_image"
                    label="Coach Top Banner Image (in their top info section/banner, 16x9 ratio)"
                    input-key="coach_top_banner_image"
                    :color="brandColor"
                    :loading="contentModel.coach_top_banner_image.loading"
                    :base-file-name="thisPost.id + '-coach-bottom-banner-image'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <!-- coach_bottom_banner_image -->
                <div
                    v-if="contentModel.coach_bottom_banner_image && $_coach_bottom_banner_image"
                    class="text-center mb-2"
                    style="max-width:50%;margin:0 auto; margin-top: 50px;"
                >
                    <v-img
                        :src="$_coach_bottom_banner_image"
                        aspect-ratio="1.777777778"
                    ></v-img>
                </div>

                <v-custom-file-input
                    v-if="contentModel.coach_bottom_banner_image"
                    v-model="$_coach_bottom_banner_image"
                    label="Coach Bottom Banner Image (in their bottom info section, 16x9 ratio)"
                    input-key="coach_bottom_banner_image"
                    :color="brandColor"
                    :loading="contentModel.coach_bottom_banner_image.loading"
                    :base-file-name="thisPost.id + '-coach-bottom-banner-image'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <!-- SHEET MUSIC FILES -->
                <v-subheader
                    v-if="contentModel.sheet_music_image_url"
                    class="pl-0"
                >
                    Sheet Music Files
                </v-subheader>
                <p
                    v-if="contentModel.sheet_music_image_url && !thisPost.sheet_music_image_url[0]"
                    class="caption"
                >
                    No sheet music added yet. Click the + at the top of this section to get started.
                </p>
                <content-sheet-music
                    v-if="contentModel.sheet_music_image_url"
                    :this-post="thisPost"
                    :is-child="isChild"
                    :content-model="contentModel"
                    :items="thisPost.sheet_music_image_url"
                ></content-sheet-music>

                <v-dialog
                    v-if="contentModel.sheet_music_image_url"
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
                                New Sheet Music
                            </v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            cols="12"
                            class="pa-4 column"
                        >
                            <v-form ref="newResource">
                                <v-custom-file-input
                                    v-model="newSheetFile"
                                    label="Sheet Music Image"
                                    input-key="sheet_music_image_url"
                                    :color="brandColor"
                                    :loading="contentModel.sheet_music_image_url.loading"
                                    :base-file-name="thisPost.id + '-sheet-image'"
                                    upload-endpoint="/railcontent/remote"
                                    class="mb-2"
                                    @imageUploaded="handleUploaded"
                                ></v-custom-file-input>

                                <div class="text-right">
                                    <v-btn
                                        flat
                                        @click="newDialog = false"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                        class="white--text"
                                        :disabled="!newSheetFile"
                                        :color="brandColor"
                                        @click="submitSheetMusic"
                                    >
                                        Save
                                    </v-btn>
                                </div>
                            </v-form>
                        </v-col>
                    </v-card>
                </v-dialog>

                <!-- SOUNDSLICE FILES -->
                <v-custom-file-input
                    v-if="contentModel.soundslice_xml_file_url"
                    v-model="$_soundslice_xml_file_url"
                    label="Soundslice XML File"
                    input-key="soundslice_xml_file_url"
                    :color="brandColor"
                    :loading="contentModel.soundslice_xml_file_url.loading"
                    :base-file-name="thisPost.id + '-soundslice-xml-file'"
                    upload-endpoint="/railcontent/remote"
                    class="mb-2"
                    @imageUploaded="handleSoundsliceUpload"
                ></v-custom-file-input>

                <div
                    v-if="contentModel.soundslice_slug && $_soundslice_slug"
                    class="text-center mb-2"
                    style="max-width:75%;margin:0 auto;"
                >
                    <iframe
                        class="sample-slice"
                        :src="sliceEmbedUrl"
                        width="100%"
                        height="500"
                        frameBorder="0"
                        allowfullscreen
                    ></iframe>
                    <v-btn
                        :href="editUrl"
                        target="_blank"
                        :color="brandColor"
                        class="white--text"
                    >
                        <v-icon left>
                            edit
                        </v-icon>
                        Edit Slice
                    </v-btn>
                </div>

                <!-- MP3 FILES -->
                <v-subheader
                    v-if="contentModel.mp3_no_drums_no_click_url"
                    class="mt-6 pl-0"
                >
                    Mp3 Files
                </v-subheader>
                <v-custom-file-input
                    v-if="contentModel.mp3_no_drums_no_click_url"
                    v-model="$_mp3_no_drums_no_click_url"
                    label="❌ Click | ❌ Drums"
                    input-key="mp3_no_drums_no_click_url"
                    :color="brandColor"
                    :loading="contentModel.mp3_no_drums_no_click_url.loading"
                    :base-file-name="thisPost.id + '-mp3-no-drums-no-click'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <v-custom-file-input
                    v-if="contentModel.mp3_yes_drums_no_click_url"
                    v-model="$_mp3_yes_drums_no_click_url"
                    label="❌ Click | ✔️ Drums"
                    input-key="mp3_yes_drums_no_click_url"
                    :color="brandColor"
                    :loading="contentModel.mp3_yes_drums_no_click_url.loading"
                    :base-file-name="thisPost.id + '-mp3-yes-drums-no-click'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <v-custom-file-input
                    v-if="contentModel.mp3_no_drums_yes_click_url"
                    v-model="$_mp3_no_drums_yes_click_url"
                    label="✔️ Click | ❌ Drums"
                    input-key="mp3_no_drums_yes_click_url"
                    :color="brandColor"
                    :loading="contentModel.mp3_no_drums_yes_click_url.loading"
                    :base-file-name="thisPost.id + '-mp3-no-drums-yes-click'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <v-custom-file-input
                    v-if="contentModel.mp3_yes_drums_yes_click_url"
                    v-model="$_mp3_yes_drums_yes_click_url"
                    label="✔️ Click | ✔️ Drums"
                    input-key="mp3_yes_drums_yes_click_url"
                    :color="brandColor"
                    :loading="contentModel.mp3_yes_drums_yes_click_url.loading"
                    :base-file-name="thisPost.id + '-mp3-yes-drums-yes-click'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import CustomFileInput from '../../../components/CustomFileInput';
import ContentStore from '../../../mixins/content-store';
import ContentSheetMusic from './_ContentSheetMusic';
import api from '../../../api/content';

export default {
    name: 'MediaFields',
    components: {
        'v-custom-file-input': CustomFileInput,
        'content-sheet-music': ContentSheetMusic,
    },
    mixins: [brandColors, ContentStore],
    data() {
        return {
            newDialog: false,
            newSheetFile: null,
        };
    },
    computed: {
        hasSquareThumb() {
            return ['song', 'chord-and-scale'].includes(this.contentType);
        },


        $_card_thumbnail: {
            get() {
                return this.thisPost.thumbnail_url ? this.thisPost.thumbnail_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'thumbnail_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_original_thumbnail_url: {
            get() {
                return this.thisPost.original_thumbnail_url ? this.thisPost.original_thumbnail_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'original_thumbnail_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_header_image_url: {
            get() {
                return this.thisPost.header_image_url ? this.thisPost.header_image_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'header_image_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_logo_image_url: {
            get() {
                return this.thisPost.logo_image_url ? this.thisPost.logo_image_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'logo_image_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_piano_keys_thumbnail_url: {
            get() {
                return this.thisPost.piano_keys_thumbnail_url ? this.thisPost.piano_keys_thumbnail_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'piano_keys_thumbnail_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_drum_chord_image_url: {
            get() {
                return this.thisPost.sheet_music_thumbnail_url ? this.thisPost.sheet_music_thumbnail_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'sheet_music_thumbnail_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_guitar_chord_image_url: {
            get() {
                return this.thisPost.guitar_chord_image_url ? this.thisPost.guitar_chord_image_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'guitar_chord_image_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_soundslice_slug() {
            return this.thisPost.soundslice_slug.value;
        },

        $_soundslice_xml_file_url: {
            get() {
                return this.thisPost.soundslice_xml_file_url? this.thisPost.soundslice_xml_file_url.value : null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'soundslice_xml_file_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        sliceEmbedUrl() {
            return `https://www.soundslice.com/scores/${this.$_soundslice_slug}/embed/?api=1&scroll_type=2&branding=0&enable_mixer=0`;
        },


        $_head_shot_picture_url: {
            get() {
                return this.thisPost.head_shot_picture_url ? this.thisPost.head_shot_picture_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'head_shot_picture_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_coach_card_image: {
            get() {
                return this.thisPost.coach_card_image ? this.thisPost.coach_card_image.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'coach_card_image',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_coach_featured_image: {
            get() {
                return this.thisPost.coach_featured_image ? this.thisPost.coach_featured_image.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'coach_featured_image',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_coach_bottom_banner_image: {
            get() {
                return this.thisPost.coach_bottom_banner_image ? this.thisPost.coach_bottom_banner_image.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'coach_bottom_banner_image',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_coach_top_banner_image: {
            get() {
                return this.thisPost.coach_top_banner_image ? this.thisPost.coach_top_banner_image.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'coach_top_banner_image',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        editUrl() {
            return `https://soundslice.com/scores/${this.$_soundslice_slug}`;
        },

        $_mp3_no_drums_no_click_url: {
            get() {
                return this.thisPost.mp3_no_drums_no_click_url ? this.thisPost.mp3_no_drums_no_click_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'mp3_no_drums_no_click_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_mp3_yes_drums_no_click_url: {
            get() {
                return this.thisPost.mp3_yes_drums_no_click_url ? this.thisPost.mp3_yes_drums_no_click_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'mp3_yes_drums_no_click_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_mp3_no_drums_yes_click_url: {
            get() {
                return this.thisPost.mp3_no_drums_yes_click_url ? this.thisPost.mp3_no_drums_yes_click_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'mp3_no_drums_yes_click_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

        $_mp3_yes_drums_yes_click_url: {
            get() {
                return this.thisPost.mp3_yes_drums_yes_click_url ? this.thisPost.mp3_yes_drums_yes_click_url.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'mp3_yes_drums_yes_click_url',
                    val,
                    deleted: val.length === 0,
                    delay: 0,
                    child: this.isChild,
                });
            },
        },

    },
    watch: {
        newDialog() {
            if (!this.newDialog) {
                this.newSheetFile = null;
            }
        },
    },
    methods: {
        handleSoundsliceUpload(payload) {
            let thisSlug = null;

            api.createSoundslice({
                name: this.thisPost.title,
                brand: this.state.brand,
            })
                .then((response) => {
                    thisSlug = response.data.slug;

                    return api.setSoundsliceScore({
                        slug: thisSlug,
                        asset_url: payload.value,
                    });
                })
                .then((response) => {
                    this.sendSetFieldRequest({
                        key: 'soundslice_slug',
                        val: thisSlug,
                        deleted: thisSlug.length === 0,
                        delay: 1500,
                        child: this.isChild,
                    });
                });
        },

        handleUploaded(payload) {
            this.newSheetFile = payload.value;
        },

        submitSheetMusic() {
            api.setContentDatum({
                content_id: this.thisPost.id,
                key: 'sheet_music_image_url',
                value: this.newSheetFile,
                type: 'string',
            })
                .then((response) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Sheet Music successfully added!',
                        });
                        this.newDialog = false;

                        this.resetContentEditState(response.data.post);


                        // this.$nextTick(() => {
                        //     this.$forceUpdate();
                        // })
                    }
                });
        },
    },
};
</script>
