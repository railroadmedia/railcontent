<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Fields & Data</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form
                v-if="contentModel"
                ref="editForm"
            >
                <v-text-field
                    v-if="contentModel.title"
                    ref="title"
                    v-model="$_title"
                    label="Title"
                    :color="brandColor"
                    :loading="contentModel.title.loading"
                    :disabled="contentModel.title.loading"
                    :rules="contentModel.title.rules"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.difficulty"
                    v-model="$_difficulty"
                    label="Difficulty"
                    :color="brandColor"
                    :rules="contentModel.difficulty.rules"
                    :loading="contentModel.difficulty.loading"
                    :disabled="contentModel.difficulty.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.difficulty_range"
                    v-model="$_difficulty_range"
                    label="Difficulty Range"
                    :color="brandColor"
                    :rules="contentModel.difficulty_range.rules"
                    :loading="contentModel.difficulty_range.loading"
                    :disabled="contentModel.difficulty_range.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.soundslice_slug"
                    v-model="$_soundslice_slug"
                    label="Sound Slice Slug (https://www.soundslice.com/slices/XXXXXX/ <- the value where the XXXXs are)"
                    :color="brandColor"
                    :rules="contentModel.soundslice_slug.rules"
                    :loading="contentModel.soundslice_slug.loading"
                    :disabled="contentModel.soundslice_slug.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.xp"
                    v-model="$_xp"
                    label="XP"
                    :color="brandColor"
                    :rules="contentModel.xp.rules"
                    :loading="contentModel.xp.loading"
                    :disabled="contentModel.xp.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.total_xp"
                    v-model="$_total_xp"
                    label="Total XP"
                    :color="brandColor"
                    :rules="contentModel.total_xp.rules"
                    :loading="contentModel.total_xp.loading"
                    :disabled="contentModel.total_xp.loading"
                    required
                ></v-text-field>

                <v-combobox
                    v-if="contentModel.bpm"
                    :value="$_bpm"
                    :items="$_bpm"
                    :loading="contentModel.bpm.loading"
                    :disabled="contentModel.bpm.loading"
                    label="BPM"
                    :color="brandColor"
                    multiple
                    hide-selected
                    persistent-hint
                    item-text="value"
                    item-value="id"
                    small-chips
                    deletable-chips
                    @input="handleBPMChange"
                >
                </v-combobox>

                <v-combobox
                    v-if="contentModel.style"
                    :value="$_style"
                    :items="$_style"
                    :loading="contentModel.style.loading"
                    :disabled="contentModel.style.loading"
                    label="Style"
                    :color="brandColor"
                    multiple
                    hide-selected
                    persistent-hint
                    item-text="value"
                    item-value="id"
                    small-chips
                    deletable-chips
                    @input="handleStyleChange"
                >
                </v-combobox>

                <v-text-field
                    v-if="contentModel.artist"
                    v-model="$_artist"
                    label="Artist"
                    :color="brandColor"
                    :rules="contentModel.artist.rules"
                    :loading="contentModel.artist.loading"
                    :disabled="contentModel.artist.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.song_name"
                    v-model="$_song_name"
                    label="Song Name"
                    :color="brandColor"
                    :rules="contentModel.song_name.rules"
                    :loading="contentModel.song_name.loading"
                    :disabled="contentModel.song_name.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.released"
                    v-model="$_released"
                    label="Year Released"
                    :color="brandColor"
                    :rules="contentModel.released.rules"
                    :loading="contentModel.released.loading"
                    :disabled="contentModel.released.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.album"
                    v-model="$_album"
                    label="Album"
                    :color="brandColor"
                    :rules="contentModel.album.rules"
                    :loading="contentModel.album.loading"
                    :disabled="contentModel.album.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.transcriber_name"
                    v-model="$_transcriber_name"
                    label="Transcribed By"
                    :color="brandColor"
                    :rules="contentModel.transcriber_name.rules"
                    :loading="contentModel.transcriber_name.loading"
                    :disabled="contentModel.transcriber_name.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.sort"
                    v-model="$_episode_number"
                    type="number"
                    :label="contentModel.sort.input_label || 'Episode Number'"
                    :color="brandColor"
                    :rules="contentModel.sort.rules"
                    :loading="contentModel.sort.loading"
                    :disabled="contentModel.sort.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.registration_url"
                    v-model="$_registration_url"
                    label="Registration/Sales URL"
                    :color="brandColor"
                    :rules="contentModel.registration_url.rules"
                    :loading="contentModel.registration_url.loading"
                    :disabled="contentModel.registration_url.loading"
                    required
                ></v-text-field>

                <v-combobox
                    v-if="contentModel.topic"
                    :value="$_topic"
                    :items="$_topic"
                    :loading="contentModel.topic.loading"
                    :disabled="contentModel.topic.loading"
                    label="Topics"
                    :color="brandColor"
                    multiple
                    hide-selected
                    persistent-hint
                    item-text="value"
                    item-value="id"
                    small-chips
                    deletable-chips
                    @input="handleTopicChange"
                >
                </v-combobox>

                <v-autocomplete
                    v-if="contentModel.instructor"
                    :value="$_instructor"
                    :items="state.instructorOptions"
                    :rules="contentModel.instructor.rules"
                    :loading="contentModel.instructor.loading"
                    :disabled="contentModel.instructor.loading"
                    :color="brandColor"
                    :label="'Instructors'"
                    multiple
                    return-object
                    hide-selected
                    persistent-hint
                    item-text="name"
                    item-value="id"
                    chips
                    deletable-chips
                    @input="handleInstructorChange"
                >
                    <template
                        slot="selection"
                        slot-scope="data"
                    >
                        <v-chip
                            :key="JSON.stringify(data.item)"
                            :input-value="data.selected"
                            :disabled="data.disabled"
                            close
                            class="v-chip--select-multi "
                            @click:close="removeInstructor(data.item)"
                        >
                            <v-avatar class="accent white--text">
                                <img :src="data.item.head_shot_picture_url || 'https://dmmior4id2ysr.cloudfront.net/assets/images/avatar.jpg'">
                            </v-avatar>
                            {{ data.item.name }}
                        </v-chip>
                    </template>
                    <template
                        slot="item"
                        slot-scope="data"
                    >
                        <template>
                            <v-list-item-avatar>
                                <img :src="data.item.head_shot_picture_url || 'https://dmmior4id2ysr.cloudfront.net/assets/images/avatar.jpg'">
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title v-html="data.item.name"></v-list-item-title>
                            </v-list-item-content>
                        </template>
                    </template>
                </v-autocomplete>

                <v-switch
                    v-if="contentType == 'song'"
                    v-model="$_instrumentless"
                    label="Is instrumentless"
                    :color="brandColor"
                ></v-switch>

                <v-text-field
                    v-if="contentModel.week"
                    v-model="$_week"
                    label="Week Number"
                    :color="brandColor"
                    :rules="contentModel.week.rules"
                    :loading="contentModel.week.loading"
                    :disabled="contentModel.week.loading"
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.timecode"
                    v-model="$_timecode"
                    label="Timecode in Seconds"
                    :color="brandColor"
                    :rules="contentModel.timecode.rules"
                    :loading="contentModel.timecode.loading"
                    :disabled="contentModel.timecode.loading"
                    required
                ></v-text-field>

                <v-select
                    v-if="contentModel.sheet_music_image_type"
                    v-model="$_sheet_music_image_type"
                    label="Sheet Music Type"
                    :color="brandColor"
                    :items="['full-width', 'half-width', 'quarter-width']"
                    :loading="contentModel.sheet_music_image_type.loading"
                    :disabled="contentModel.sheet_music_image_type.loading"
                    required
                ></v-select>

                <v-select
                    v-if="contentModel.chord_or_scale"
                    v-model="$_chord_or_scale"
                    label="Chord Or Scale"
                    :color="brandColor"
                    :items="['chord', 'scale']"
                    :loading="contentModel.chord_or_scale.loading"
                    :disabled="contentModel.chord_or_scale.loading"
                    required
                ></v-select>

                <v-combobox
                    v-if="contentModel.key_pitch_type"
                    :value="$_key_pitch_type"
                    :items="keyPitchTypeOptions"
                    :color="brandColor"
                    label="Type"
                    multiple
                    persistent-hint
                    item-text="value"
                    item-value="value"
                    small-chips
                    deletable-chips
                    @input="handleKeyPitchTypeChange"
                >
                </v-combobox>

                <v-select
                    v-if="contentModel.key"
                    v-model="$_key"
                    label="Key"
                    :color="brandColor"
                    :items="['A', 'A#/Bb', 'B', 'C', 'C#/Db', 'D', 'D#/Eb', 'E', 'F', 'F#/Gb', 'G', 'G#/Ab']"
                    :loading="contentModel.key.loading"
                    :disabled="contentModel.key.loading"
                    required
                ></v-select>

                <v-text-field
                    v-if="contentModel.student_id"
                    v-model="$_student_id"
                    label="Student ID"
                    :color="brandColor"
                    :rules="contentModel.student_id.rules"
                    :loading="contentModel.student_id.loading"
                    :disabled="contentModel.student_id.loading"
                    required
                ></v-text-field>

                <v-custom-wysiwyg-editor
                    v-if="contentModel.description"
                    v-model="$_description"
                    label="Description"
                    :color="brandColor"
                    :loading="contentModel.description.loading"
                ></v-custom-wysiwyg-editor>

                <v-custom-wysiwyg-editor
                    v-if="contentModel.short_description"
                    v-model="$_short_description"
                    label="Short Description (on coach cards)"
                    :color="brandColor"
                    :loading="contentModel.short_description.loading"
                ></v-custom-wysiwyg-editor>

                <v-custom-wysiwyg-editor
                    v-if="contentModel.long_description"
                    v-model="$_long_description"
                    label="Long Description (shown on each coach's page)"
                    :color="brandColor"
                    :loading="contentModel.long_description.loading"
                ></v-custom-wysiwyg-editor>

                <!-- coaches -->
                <v-text-field
                    v-if="contentModel.name"
                    v-model="$_name"
                    label="Name"
                    :color="brandColor"
                    :rules="contentModel.name.rules"
                    :loading="contentModel.name.loading"
                    :disabled="contentModel.name.loading"
                    required
                ></v-text-field>

                <v-switch
                    v-if="contentModel.is_coach"
                    v-model="$_is_coach"
                    label="Is this person a coach that should be listed in the coaches list?"
                    :color="brandColor"
                ></v-switch>

                <v-switch
                    v-if="contentModel.is_coach_of_the_month"
                    v-model="$_is_coach_of_the_month"
                    label="Coach of the month - (puts coach in home page top banner (MUST UNSET PREVIOUS))"
                    :color="brandColor"
                ></v-switch>

                <v-switch
                    v-if="contentModel.is_featured"
                    v-model="$_is_featured"
                    :label="$_is_featured_input_label"
                    :color="brandColor"
                ></v-switch>

                <v-switch
                    v-if="contentModel.is_active"
                    v-model="$_is_active"
                    label="Active Coach - (can activate 0-10 total, shows in active coaches list)"
                    :color="brandColor"
                ></v-switch>

              <v-switch
                  v-if="contentModel.is_house_coach"
                  v-model="$_is_house_coach"
                  label="Is this person an internal coach?"
                  :color="brandColor"
              ></v-switch>

              <v-text-field
                  v-if="contentModel.associated_user_id"
                  v-model="$_associated_user_id"
                  label="Associated user id"
                  :color="brandColor"
                  :loading="contentModel.associated_user_id.loading"
              ></v-text-field>

                <v-text-field
                    v-if="contentModel.focus_text"
                    v-model="$_focus_text"
                    label="Coach Focus/Card Text - (On the coach cards, 3-8 words.)"
                    :color="brandColor"
                    :rules="contentModel.focus_text.rules"
                    :loading="contentModel.focus_text.loading"
                    :disabled="contentModel.focus_text.loading"
                    required
                    style="margin-top: 40px;"
                ></v-text-field>

                <v-combobox
                    v-if="contentModel.focus"
                    :value="$_focus"
                    :items="$_focus"
                    :loading="contentModel.focus.loading"
                    label="Focus Tags (used for filtering and search)"
                    :color="brandColor"
                    multiple
                    hide-selected
                    persistent-hint
                    item-text="value"
                    item-value="id"
                    small-chips
                    deletable-chips
                    @input="handleFocusChange"
                >
                </v-combobox>

                <v-text-field
                    v-if="contentModel.bands"
                    v-model="$_bands"
                    label="Coach Bands Text - (shown near their bio, should be less than 200 words)"
                    :color="brandColor"
                    :rules="contentModel.bands.rules"
                    :loading="contentModel.bands.loading"
                    :disabled="contentModel.bands.loading"
                    required
                    style="margin-top: 40px;"
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.endorsements"
                    v-model="$_endorsements"
                    label="Coach Endorsements Text - (shown near their bio, should be less than 200 words)"
                    :color="brandColor"
                    :rules="contentModel.endorsements.rules"
                    :loading="contentModel.endorsements.loading"
                    :disabled="contentModel.endorsements.loading"
                    required
                    style="margin-top: 40px;"
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.forum_thread_id"
                    v-model="$_forum_thread_id"
                    label="Coach Forum Thread ID - (forum thread database ID for 'Ask A Question' link)"
                    :color="brandColor"
                    :rules="contentModel.forum_thread_id.rules"
                    :loading="contentModel.forum_thread_id.loading"
                    :disabled="contentModel.forum_thread_id.loading"
                ></v-text-field>

                <v-custom-wysiwyg-editor
                    v-if="contentModel.short_bio"
                    v-model="$_short_bio"
                    label="Short Coach Bio <br>(Shown in header section under coach name. 1-3 short sentences. HTML allowed.)"
                    :color="brandColor"
                    :loading="contentModel.short_bio.loading"
                    style="margin-top: 30px;"
                ></v-custom-wysiwyg-editor>

                <v-custom-wysiwyg-editor
                    v-if="contentModel.long_bio"
                    v-model="$_long_bio"
                    label="Long Coach Bio <br>(Shown bottom coach information section. A paragraph or 2. HTML allowed.)"
                    :color="brandColor"
                    :loading="contentModel.long_bio.loading"
                    style="margin-top: 30px;"
                ></v-custom-wysiwyg-editor>

                <v-custom-wysiwyg-editor
                    v-if="contentModel.biography"
                    v-model="$_biography"
                    label="Legacy Instructor Biography <br>(pre-coaches, this is no longer used)"
                    :color="brandColor"
                    :loading="contentModel.biography.loading"
                    style="margin-top: 30px;"
                ></v-custom-wysiwyg-editor>

                <v-switch
                    v-if="contentType !== 'instructor'"
                    v-model="$_show_in_new_feed"
                    label="Show in New feed"
                    :color="brandColor"
                ></v-switch>

              <v-select
                  v-if="contentModel.instrument"
                  v-model="$_instrument"
                  :items="['Drum Set', 'Practice Pad']"
                  :rules="contentModel.instrument.rules"
                  :loading="contentModel.instrument.loading"
                  :disabled="contentModel.instrument.loading"
                  :color="brandColor"
                  label="Instrument"
              ></v-select>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import api from '../../../api/content';
import ContentStore from '../../../mixins/content-store';
import WYSIWYGEditor from '../../../components/CustomWYSIWYGEditor';

export default {
    name: 'ContentFields',
    components: {
        'v-custom-wysiwyg-editor': WYSIWYGEditor,
    },
    mixins: [brandColors, ContentStore],
    props: {
        contentType: {
            type: String,
        },
    },
    data() {
        return {
            // difficultyOptions: Utils.range(10, 1),
            type: this.contentType,
        };
    },
    computed: {
        brand() {
            return this.$route.params.brand;
        },

        difficultyOptions() {
            if (this.brand === 'drumeo') {
                if (this.contentType === 'song' || this.contentType === 'show') {
                    return [
                        'beginner',
                        'intermediate',
                        'advanced',
                        'all',
                    ];
                }
            }

            return Utils.range(10, 1);
        },

        keyPitchTypeOptions() {
            return {
                guitareo: ['major', 'minor', 'open', 'bar', '7'],
                pianote: ['major triads', 'minor triads', 'major scales', 'minor scales', 'major', 'minor', 'scale', 'triad'],
            }[this.brand];
        },

        $_title: {
            get() {
                return this.thisPost.title.value;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'title',
                    val,
                    deleted: this.isDeleted('title', val),
                    child: this.isChild,
                });
            },
        },

        $_name: {
            get() {
                return this.thisPost.name.value;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'name',
                    val,
                    deleted: this.isDeleted('name', val),
                    child: this.isChild,
                });
            },
        },

        $_difficulty: {
            get() {
                const value = Number(this.thisPost.difficulty.value);

                return isNaN(value) ? this.thisPost.difficulty.value : value;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'difficulty',
                    val,
                    deleted: this.isDeleted('difficulty', val),
                    child: this.isChild,
                });
            },
        },

        $_soundslice_slug: {
            get() {
                const value = String(this.thisPost.soundslice_slug.value);

                return isNaN(value) ? this.thisPost.soundslice_slug.value : value;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'soundslice_slug',
                    val,
                    deleted: this.isDeleted('soundslice_slug', val),
                    child: this.isChild,
                });
            },
        },

        $_difficulty_range: {
            get() {
                return this.thisPost.difficulty_range.value;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'difficulty_range',
                    val,
                    deleted: this.isDeleted('difficulty_range', val),
                    child: this.isChild,
                });
            },
        },

        $_xp: {
            get() {
                if (this.thisPost.xp && this.thisPost.xp.value) {
                    return this.thisPost.xp.value;
                }

                return null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'xp',
                    val,
                    deleted: this.isDeleted('xp', val),
                    child: this.isChild,
                });
            },
        },

        $_total_xp: {
            get() {
                if (this.thisPost.total_xp && this.thisPost.total_xp.value) {
                    return this.thisPost.total_xp.value;
                }

                return null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'total_xp',
                    val,
                    deleted: this.isDeleted('total_xp', val),
                    child: this.isChild,
                });
            },
        },

        // $_bpm: {
        //     get() {
        //         return this.thisPost.bpm.value;
        //     },
        //     set(val) {
        //         this.sendSetFieldRequest({
        //             key: 'bpm',
        //             val,
        //             deleted: this.isDeleted('bpm', val),
        //             child: this.isChild,
        //         });
        //     },
        // },

        $_artist: {
            get() {
                return this.thisPost.artist ? this.thisPost.artist.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'artist',
                    val,
                    deleted: this.isDeleted('artist', val),
                    child: this.isChild,
                });
            },
        },

        $_song_name: {
            get() {
                return this.thisPost.song_name.value;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'song_name',
                    val,
                    deleted: this.isDeleted('song_name', val),
                    child: this.isChild,
                });
            },
        },

        $_released: {
            get() {
                return this.thisPost.released ? this.thisPost.released.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'released',
                    val,
                    deleted: this.isDeleted('released', val),
                    child: this.isChild,
                });
            },
        },

        $_album: {
            get() {
                return this.thisPost.album ? this.thisPost.album.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'album',
                    val,
                    deleted: this.isDeleted('album', val),
                    child: this.isChild,
                });
            },
        },

        $_transcriber_name: {
            get() {
                return this.thisPost.transcriber_name ? this.thisPost.transcriber_name.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'transcriber_name',
                    val,
                    deleted: this.isDeleted('transcriber_name', val),
                    child: this.isChild,
                });
            },
        },

        $_episode_number: {
            get() {
                return this.thisPost.sort;
            },
            set(val) {
                this.sendSetContentPropertyRequest('sort', val, this.post_id, this.isChild);
            },
        },

        $_timecode: {
            get() {
                return this.thisPost.timecode ? this.thisPost.timecode.value : '';
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'timecode',
                    val,
                    deleted: this.isDeleted('timecode', val),
                    child: this.isChild,
                });
            },
        },


        $_registration_url: {
            get() {
                return this.thisPost.registration_url ? this.thisPost.registration_url.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'registration_url',
                    val,
                    deleted: this.isDeleted('registration_url', val),
                    child: this.isChild,
                });
            },
        },

        $_week: {
            get() {
                return this.thisPost.week ? this.thisPost.week.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'week',
                    val,
                    deleted: this.isDeleted('week', val),
                    child: this.isChild,
                });
            },
        },

        $_bands: {
            get() {
                return this.thisPost.bands ? this.thisPost.bands.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'bands',
                    val,
                    deleted: this.isDeleted('bands', val),
                    child: this.isChild,
                });
            },
        },

        $_endorsements: {
            get() {
                return this.thisPost.endorsements ? this.thisPost.endorsements.value : '';
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'endorsements',
                    val,
                    deleted: this.isDeleted('endorsements', val),
                    child: this.isChild,
                });
            },
        },

        $_instructor() {
            return this.thisPost.instructor.map(item => item.value);
        },

        $_bpm() {
            return this.thisPost.bpm;
        },

        $_style() {
            return this.thisPost.style;
        },

        $_tag() {
            return this.thisPost.tag;
        },

        $_topic() {
            return this.thisPost.topic;
        },

        $_focus() {
            return this.thisPost.focus;
        },

        $_sheet_music_image_type: {
            get() {
                return this.thisPost.sheet_music_image_type ? this.thisPost.sheet_music_image_type.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'sheet_music_image_type',
                    val,
                    deleted: this.isDeleted('sheet_music_image_type', val),
                    child: this.isChild,
                });
            },
        },

        $_chord_or_scale: {
            get() {
                return this.thisPost.chord_or_scale ? this.thisPost.chord_or_scale.value : null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'chord_or_scale',
                    val,
                    deleted: this.isDeleted('chord_or_scale', val),
                    child: this.isChild,
                });
            },
        },

        $_key_pitch_type() {
            return this.thisPost.key_pitch_type;
        },

        $_key: {
            get() {
                return this.thisPost.key ? this.thisPost.key.value : null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'key',
                    val,
                    deleted: this.isDeleted('key', val),
                    child: this.isChild,
                });
            },
        },

        $_student_id: {
            get() {
                return this.thisPost.student_id ? this.thisPost.student_id.value : null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'student_id',
                    val,
                    deleted: this.isDeleted('student_id', val),
                    child: this.isChild,
                });
            },
        },

        $_description: {
            get() {
                return this.thisPost.description ? this.thisPost.description.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'description',
                    val,
                    deleted: this.isDeleted('description', val),
                    child: this.isChild,
                });
            },
        },

        $_short_description: {
            get() {
                return this.thisPost.short_description ? this.thisPost.short_description.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'short_description',
                    val,
                    deleted: this.isDeleted('short_description', val),
                    child: this.isChild,
                });
            },
        },

        $_long_description: {
            get() {
                return this.thisPost.long_description ? this.thisPost.long_description.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'long_description',
                    val,
                    deleted: this.isDeleted('long_description', val),
                    child: this.isChild,
                });
            },
        },

        $_forum_thread_id: {
            get() {
                return this.thisPost.forum_thread_id ? this.thisPost.forum_thread_id.value : null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'forum_thread_id',
                    val,
                    deleted: this.isDeleted('forum_thread_id', val),
                    child: this.isChild,
                });
            },
        },

        $_focus_text: {
            get() {
                return this.thisPost.focus_text ? this.thisPost.focus_text.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'focus_text',
                    val,
                    deleted: this.isDeleted('focus_text', val),
                    child: this.isChild,
                });
            },
        },

        $_long_bio: {
            get() {
                return this.thisPost.long_bio ? this.thisPost.long_bio.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'long_bio',
                    val,
                    deleted: this.isDeleted('long_bio', val),
                    child: this.isChild,
                });
            },
        },

        $_short_bio: {
            get() {
                return this.thisPost.short_bio ? this.thisPost.short_bio.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'short_bio',
                    val,
                    deleted: this.isDeleted('short_bio', val),
                    child: this.isChild,
                });
            },
        },

        $_biography: {
            get() {
                return this.thisPost.biography ? this.thisPost.biography.value : null;
            },
            set(val) {
                this.sendSetDatumRequest({
                    key: 'biography',
                    val,
                    deleted: this.isDeleted('biography', val),
                    child: this.isChild,
                });
            },
        },

        $_show_in_new_feed: {
            get() {
                if (this.thisPost && this.thisPost.show_in_new_feed) {
                    return this.thisPost.show_in_new_feed.value == 1
                      || this.thisPost.show_in_new_feed.value == "1";
                }

                return null;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'show_in_new_feed',
                    val: val ? 1 : 0,
                    deleted: this.isDeleted('show_in_new_feed', val),
                    child: this.isChild,
                });
            },
        },

        $_is_coach: {
            get() {
                if (this.thisPost.is_coach) {
                    return this.thisPost.is_coach.value == 1
                      || this.thisPost.is_coach.value == "1";
                }

                return false;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'is_coach',
                    val: val ? 1 : 0,
                    deleted: this.isDeleted('is_coach', val),
                    child: this.isChild,
                });
            },
        },

        $_is_coach_of_the_month: {
            get() {
                if (this.thisPost.is_coach_of_the_month) {
                    return this.thisPost.is_coach_of_the_month.value == 1
                      || this.thisPost.is_coach_of_the_month.value == "1";
                }

                return false;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'is_coach_of_the_month',
                    val: val ? 1 : 0,
                    deleted: this.isDeleted('is_coach_of_the_month', val),
                    child: this.isChild,
                });
            },
        },

        $_is_featured: {
            get() {
                if (this.thisPost.is_featured) {
                    return this.thisPost.is_featured.value == 1
                      || this.thisPost.is_featured.value == "1";
                }

                return false;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'is_featured',
                    val: val ? 1 : 0,
                    deleted: this.isDeleted('is_featured', val),
                    child: this.isChild,
                });
            },
        },

        $_is_active: {
            get() {
                if (this.thisPost.is_active) {
                    return this.thisPost.is_active.value == 1
                      || this.thisPost.is_active.value == "1";
                }

                return false;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'is_active',
                    val: val ? 1 : 0,
                    deleted: this.isDeleted('is_active', val),
                    child: this.isChild,
                });
            },
        },

        $_is_house_coach: {
          get() {
            if (this.thisPost.is_house_coach) {
              return this.thisPost.is_house_coach.value == 1
                  || this.thisPost.is_house_coach.value == "1";
            }

            return false;
          },
          set(val) {
            this.sendSetFieldRequest({
              key: 'is_house_coach',
              val: val ? 1 : 0,
              deleted: this.isDeleted('is_house_coach', val),
              child: this.isChild,
            });
          },
        },

        $_associated_user_id: {
          get() {
            return this.thisPost.associated_user_id ? this.thisPost.associated_user_id.value : null;
          },
          set(val) {
            this.sendSetFieldRequest({
              key: 'associated_user_id',
              val,
              deleted: this.isDeleted('associated_user_id', val),
              child: this.isChild,
            });
          },
        },

        $_is_featured_input_label: {
            get() {
                if (this.thisPost.type === 'instructor') {
                    return 'Featured Coach - (can feature 0-3 total, shows in featured coaches list)';
                }

                return 'Feature in coach/instructor "Featured Lessons" list';
            },
            set(val) {

            },
        },
      $_instrument: {
        get() {
          return this.thisPost.instrument;
        },
        set(val) {
          this.sendSetContentPropertyRequest('instrument', val, this.thisPost.id);
        },
      },
        $_instrumentless: {
            get() {
                return this.thisPost.instrumentless;
            },
            set(val) {
                this.sendSetContentPropertyRequest('instrumentless', val, this.thisPost.id);
            },
        },
    },
    methods: {
        toCapitalCase: string => Utils.toCapitalCase(string),

        handleTagChange(newArray) {
            const changedField = Utils.getDifferingArrayKeys(newArray, this.$_tag);
            const val = changedField[changedField.length - 1].value || changedField[changedField.length - 1];

            api.handleArrayChange({
                oldArray: this.$_tag,
                newArray,
                onCreated: () => this.sendSetFieldRequest({
                    key: 'tag',
                    val,
                    deleted: false,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                    useFieldId: true,
                }),
                onDeleted: () => this.sendSetFieldRequest({
                    key: 'tag',
                    val,
                    deleted: true,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                    useFieldId: true,
                }),
            });
        },

        handleFocusChange(newArray) {
            const changedField = Utils.getDifferingArrayKeys(newArray, this.$_focus);
            const val = changedField[changedField.length - 1].value || changedField[changedField.length - 1];

            api.handleArrayChange({
                oldArray: this.$_focus,
                newArray,
                onCreated: () => this.sendSetFieldRequest({
                    key: 'focus',
                    val,
                    deleted: false,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                    useFieldId: true,
                }),
                onDeleted: () => this.sendSetFieldRequest({
                    key: 'focus',
                    val,
                    deleted: true,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                    useFieldId: true,
                }),
            });
        },

        handleTopicChange(newArray) {
            const changedField = Utils.getDifferingArrayKeys(newArray, this.$_topic);
            const val = changedField[changedField.length - 1].value || changedField[changedField.length - 1];

            api.handleArrayChange({
                oldArray: this.$_topic,
                newArray,
                onCreated: () => this.sendSetFieldRequest({
                    key: 'topic',
                    val,
                    deleted: false,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
                onDeleted: () => this.sendSetFieldRequest({
                    key: 'topic',
                    val,
                    deleted: true,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
            });
        },

        handleBPMChange(newArray) {
            const changedField = Utils.getDifferingArrayKeys(newArray, this.$_bpm);
            const val = changedField[changedField.length - 1].value || changedField[changedField.length - 1];

            api.handleArrayChange({
                oldArray: this.$_bpm,
                newArray,
                onCreated: () => this.sendSetFieldRequest({
                    key: 'bpm',
                    val,
                    deleted: false,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
                onDeleted: () => this.sendSetFieldRequest({
                    key: 'bpm',
                    val,
                    deleted: true,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
            });
        },

        handleStyleChange(newArray) {
            const changedField = Utils.getDifferingArrayKeys(newArray, this.$_style);
            const val = changedField[changedField.length - 1].value || changedField[changedField.length - 1];

            api.handleArrayChange({
                oldArray: this.$_style,
                newArray,
                onCreated: () => this.sendSetFieldRequest({
                    key: 'style',
                    val,
                    deleted: false,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
                onDeleted: () => this.sendSetFieldRequest({
                    key: 'style',
                    val,
                    deleted: true,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
            });
        },

        removeInstructor(instructor) {
            let contentInstructorField = this.thisPost.instructor.filter(item => item.value.id == instructor.id).pop();

            this.sendSetFieldRequest({
                key: 'instructor',
                val: contentInstructorField.value.id,
                deleted: true,
                multi: true,
                delay: 0,
                child: this.isChild,
            })
        },

        handleInstructorChange(selectedInstructors) {

            if (selectedInstructors.length > this.thisPost.instructor.length) {
                let currentContentInstructorIds = {};

                this.thisPost.instructor.forEach(contentInstructorField => {
                    currentContentInstructorIds[contentInstructorField.value.id] = true;
                });

                let newInstructor = selectedInstructors.filter(instructor => !currentContentInstructorIds[instructor.id]).pop();

                this.sendSetFieldRequest({
                    key: 'instructor',
                    val: newInstructor.id,
                    deleted: false,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                });
            } else if (selectedInstructors.length < this.thisPost.instructor.length) {

                let selectedInstructorsIds = {};

                selectedInstructors.forEach(selectedInstructor => {
                    selectedInstructorsIds[selectedInstructor.id] = true;
                });

                let removedInstructorField = this.thisPost.instructor.filter(
                        contentInstructorField => !selectedInstructorsIds[contentInstructorField.value.id]
                    ).pop();

                this.sendSetFieldRequest({
                    key: 'instructor',
                    val: removedInstructorField.id,
                    deleted: true,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                });
            }
        },

        handleKeyPitchTypeChange(newArray) {
            const changedField = Utils.getDifferingArrayKeys(newArray, this.$_key_pitch_type);
            const val = changedField[changedField.length - 1].value || changedField[changedField.length - 1];

            api.handleArrayChange({
                oldArray: this.$_key_pitch_type,
                newArray,
                onCreated: () => this.sendSetFieldRequest({
                    key: 'key_pitch_type',
                    val,
                    deleted: false,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
                onDeleted: () => this.sendSetFieldRequest({
                    key: 'key_pitch_type',
                    val,
                    deleted: true,
                    multi: true,
                    delay: 0,
                    child: this.isChild,
                }),
            });
        },

        getDownloadableResourceLength() {
            const nameLength = this.thisPost.resource_name.length;
            const urlLength = this.thisPost.resource_url.length;

            return nameLength > urlLength ? nameLength : urlLength;
        },
    },
};
</script>
