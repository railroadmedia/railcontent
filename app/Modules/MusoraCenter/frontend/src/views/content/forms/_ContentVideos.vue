<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Video Files</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip left>
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

                <span>Add New Video</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            v-if="contentModel && !isSingeoSong"
            cols="12"
            class="pa-4 column"
            :dark="!hasAnyVideo"
            :class="hasAnyVideo || 'red lighten-2'"
        >
            <v-form ref="editForm">
                <v-select
                    v-model="videoTypeInterface"
                    :items="['vimeo', 'youtube']"
                    :disabled="hasAnyVideo"
                    label="Type"
                ></v-select>

                <v-text-field
                    v-if="isVimeo"
                    v-model="$_vimeo_video_id"
                    label="Vimeo Video ID"
                    :color="brandColor"
                    :loading="contentModel.video.loading"
                    :disabled="contentModel.video.loading"
                    clearable
                    required
                ></v-text-field>

                <v-text-field
                    v-if="isYoutube"
                    v-model="$_youtube_video_id"
                    label="Youtube Video ID"
                    :color="brandColor"
                    :loading="contentModel.video.loading"
                    :disabled="contentModel.video.loading"
                    clearable
                    required
                ></v-text-field>

                <v-text-field
                    v-if="contentModel.qna_video && hasAnyVideo"
                    v-model="$_qna_video_id"
                    label="QA Video ID"
                    :color="brandColor"
                    :loading="contentModel.qna_video.loading"
                    :disabled="contentModel.qna_video.loading"
                    clearable
                ></v-text-field>


                <v-custom-file-input
                    v-if="thisPost.id && hasAnyVideo"
                    v-model="$_captions"
                    label="Subtitles"
                    input-key="captions_url"
                    :color="brandColor"
                    :loading="captionsLoading"
                    :base-file-name="thisPost.id + '-english-captions'"
                    upload-endpoint="/railcontent/remote"
                    :required="true"
                    class="mb-2"
                ></v-custom-file-input>

                <v-divider style="margin-top: 30px;"></v-divider>

                <div
                    v-if="this.thisPost.video.id !== undefined && this.thisPost.video.vimeo_video_id !== undefined"
                    style="text-align: left;"
                >
                    <h2 style="margin-top: 25px; margin-bottom: 10px;">
                        <strong>Rev Subtitle Info</strong>
                    </h2>

                    <div v-if="revSubtitleStatus !== null && revSubtitleStatus !== 'ordering'">
                        <p>
                            Order Number: <strong>{{ revSubtitleData.order_number }}</strong><br>
                            Price (USD): <strong>${{ revSubtitleData.price }}</strong><br>
                            Status: <strong>{{ revSubtitleData.status }}</strong><br>
                            Video Length: <strong>{{ Math.round(revSubtitleData.video_length / 60) }}
                                minutes</strong><br>
                            <strong><a :href="revSubtitleData.rev_admin_url">Admin Edit Link</a></strong><br>
                            <strong><a :href="revSubtitleData.rev_download_url">Caption File Download Link</a></strong>
                        </p>
                        <p style="font-size: 10pt;">
                            * IMPORTANT NOTE: If you edit the subtitles manually on the REV website,
                            you must manually download
                            the new subtitle file and upload it using the above 'Subtitles' field. Edited subtitles
                            inside rev will NOT automatically be updated in our system.
                        </p>
                    </div>

                    <!-- Order New -->
                    <div>
                        <h2 style="margin-top: 25px; margin-bottom: 10px;">
                            <strong>Create New Order</strong>
                        </h2>
                        <p style="font-size: 10pt;">
                            * Existing completed or processing subtitles will be abandoned.
                            Existing processing orders will NOT be automatically cancelled.
                        </p>

                        <v-btn
                            color="primary"
                            :disabled="this.revSubtitleStatus === 'ordering'"
                            @click="submitRevCaptionOrder"
                        >
                            Order Subtitles
                        </v-btn>

                        <p style="font-size: 10pt; margin-top: 15px">
                            * Please wait for up to 30 seconds of loading time
                            for the order to submit.
                        </p>

                        <p style="margin-top: 15px;">
                            Estimate cost ($1.25 USD/min): <strong>${{
                                Math.round(((this.thisPost.video.length_in_seconds.value/60 || 0) * (1.25)), 2) }}
                                USD</strong>
                        </p>
                    </div>

                    <!-- Cancel Current Order -->
                    <div
                        v-if="this.revSubtitleStatus === 'processing'"
                        style="margin-top: 25px;"
                        @click="cancelRevCaptionOrder"
                    >
                        <h2 style="margin-top: 25px; margin-bottom: 10px;">
                            <strong>Cancel Pending Order</strong>
                        </h2>

                        <v-btn
                            color="error"
                        >
                            Cancel Order
                        </v-btn>
                    </div>
                </div>
            </v-form>
        </v-col>

        <v-col
            v-if="contentModel && isSingeoSong"
            cols="12"
            class="pa-4 column"
            :dark="singeoSongVideoRangesCount != 3"
            :class="(singeoSongVideoRangesCount == 3) || 'red lighten-2'"
        >
            <v-form ref="editForm">

                <content-videos-range
                    v-if="hasLowerRange"
                    range="lower"
                    :content-id="thisPost.id"
                    :vimeo-video-id="$_lower_range_video.vimeoId"
                    :youtube-video-id="$_lower_range_video.youtubeId"
                    :video-caption="$_lower_range_video_caption"
                    :loading="$_loading"
                    @videoValueUpdated="videoValueUpdated"
                    @videoCaptionUpdated="videoCaptionUpdated"
                ></content-videos-range>

                <content-videos-range
                    v-if="hasLowRange"
                    range="low"
                    :content-id="thisPost.id"
                    :vimeo-video-id="$_low_range_video.vimeoId"
                    :youtube-video-id="$_low_range_video.youtubeId"
                    :video-caption="$_low_range_video_caption"
                    :loading="$_loading"
                    @videoValueUpdated="videoValueUpdated"
                    @videoCaptionUpdated="videoCaptionUpdated"
                ></content-videos-range>

                <content-videos-range
                    v-if="hasOriginalRange"
                    range="original"
                    :content-id="thisPost.id"
                    :vimeo-video-id="$_original_range_video.vimeoId"
                    :youtube-video-id="$_original_range_video.youtubeId"
                    :video-caption="$_original_range_video_caption"
                    :loading="$_loading"
                    @videoValueUpdated="videoValueUpdated"
                    @videoCaptionUpdated="videoCaptionUpdated"
                ></content-videos-range>

                <content-videos-range
                    v-if="hasHighRange"
                    range="high"
                    :content-id="thisPost.id"
                    :vimeo-video-id="$_high_range_video.vimeoId"
                    :youtube-video-id="$_high_range_video.youtubeId"
                    :video-caption="$_high_range_video_caption"
                    :loading="$_loading"
                    @videoValueUpdated="videoValueUpdated"
                    @videoCaptionUpdated="videoCaptionUpdated"
                ></content-videos-range>

                <content-videos-range
                    v-if="hasHigherRange"
                    range="higher"
                    :content-id="thisPost.id"
                    :vimeo-video-id="$_higher_range_video.vimeoId"
                    :youtube-video-id="$_higher_range_video.youtubeId"
                    :video-caption="$_higher_range_video_caption"
                    :loading="$_loading"
                    @videoValueUpdated="videoValueUpdated"
                    @videoCaptionUpdated="videoCaptionUpdated"
                ></content-videos-range>

                <div v-if="singeoSongVideoRangesCount < 3">
                    <h2 style="margin-top: 25px; margin-bottom: 10px;">
                        <strong style="text-transform:capitalize;" v-if="singeoSongVideoRangesCount == 0">No Range Video defined</strong><strong style="text-transform:capitalize;" v-if="singeoSongVideoRangesCount > 0">Only {{ singeoSongVideoRangesCount }} Range Video defined</strong>, add a new range:
                    </h2>
                    <content-videos-range
                        :loading="$_loading"
                        :show-range-selector="true"
                        :available-ranges="undefinedSingeoSongVideoRanges"
                        :content-id="thisPost.id"
                        @addVideoRange="addVideoRange"
                    ></content-videos-range>
                </div>
            </v-form>
        </v-col>

        <v-dialog
            v-model="newDialog"
            max-width="500px"
        >
            <v-card>
                <v-toolbar
                    flat
                    darkmake
                    sure
                    your
                    compiling
                    with
                    the
                    proper
                    prod
                    f-e
                    :color="brandColor"
                >
                    <v-toolbar-title style="text-transform:capitalize;">
                        New Video
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form ref="newResource">
                        <p><strong>NOTE:</strong> This form should only be used in emergencies for videos that aren't syncing properly. It won't always work - the video needs to exist on either Youtube or Vimeo and <strong>MUST BE PUBLIC/UNLISTED</strong></p>

                        <v-select
                            v-if="isSingeoSong"
                            v-model="newVideoRange"
                            :items="ranges"
                            label="Video Range"
                        ></v-select>

                        <v-select
                            v-model="newVideoType"
                            :items="['vimeo-video', 'youtube-video']"
                            label="Type"
                        ></v-select>

                        <v-text-field
                            v-model="newVideoId"
                            label="Video ID"
                            :color="brandColor"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="newVideoLengthInSeconds"
                            label="Video Length in Seconds"
                            hint="THIS IS NOT AN ARBITRARY NUMBER. Failure to set this number properly means progress tracking and xp will not function properly on this lesson"
                            :color="brandColor"
                            required
                        ></v-text-field>
                    </v-form>

                    <div class="text-right">
                        <v-btn
                            text
                            @click="newDialog = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            class="white--text"
                            :disabled="(isSingeoSong && !newVideoRange) || !newVideoType || !newVideoId || !newVideoLengthInSeconds"
                            :color="brandColor"
                            @click="submitNewVideo"
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
import brandColors from '../../../api/mixins';
import ContentStore from '../../../mixins/content-store';
import ContentVideosRange from './_ContentVideosRange.vue';
import CustomFileInput from '../../../components/CustomFileInput.vue';
import api from '../../../api/content';

export default {
    name: 'ContentVideos',
    components: {
        'v-custom-file-input': CustomFileInput,
        'content-videos-range': ContentVideosRange,
    },
    mixins: [brandColors, ContentStore],
    data() {
        return {
            loading: false,
            videoType: '',
            inputTimeout: null,
            newDialog: false,
            newVideoRange: null,
            newVideoType: null,
            newVideoId: null,
            newVideoLengthInSeconds: null,
            captions: null,
            captionsLoading: false,

            // can be null, 'ordering', 'processing', 'complete'
            revSubtitleStatus: null,
            revSubtitleData: {
                order_number: String(),
                price: Number(),
                status: String(),
                video_length: Number(),
                rev_admin_url: String(),
                rev_download_url: String(),
            },

            ranges: ['lower', 'low', 'original', 'high', 'higher'],
        };
    },
    computed: {
        $_vimeo_video_id: {
            get() {
                return this.thisPost.video.vimeo_video_id ? this.thisPost.video.vimeo_video_id.value : null;
            },
            set(val) {
                if (!val) {
                    const confirmation = confirm('Are you sure you wish to remove this video?');

                    if (confirmation) {
                        this.sendSetFieldRequest({
                            key: 'video',
                            deleted: true,
                            delay: 0,
                            child: this.isChild,
                        });
                    }
                } else {
                    clearTimeout(this.inputTimeout);

                    this.inputTimeout = setTimeout(() => {
                        this.getVideoById(val, 'vimeo_video_id')
                            .then((response) => {
                                if (response) {
                                    this.sendSetFieldRequest({
                                        key: 'video',
                                        val: response.id,
                                        delay: 0,
                                        child: this.isChild,
                                    });
                                }
                            });
                    }, 1500);
                }
            },
        },

        $_youtube_video_id: {
            get() {
                return this.thisPost.video.youtube_video_id ? this.thisPost.video.youtube_video_id.value : null;
            },
            set(val) {
                if (!val) {
                    const confirmation = confirm('Are you sure you wish to remove this video?');

                    if (confirmation) {
                        this.sendSetFieldRequest({
                            key: 'video',
                            deleted: true,
                            delay: 0,
                            child: this.isChild,
                        });
                    }
                } else {
                    clearTimeout(this.inputTimeout);

                    this.inputTimeout = setTimeout(() => {
                        this.getVideoById(val, 'youtube_video_id')
                            .then((response) => {
                                if (response) {
                                    this.sendSetFieldRequest({
                                        key: 'video',
                                        val: response.id,
                                        delay: 0,
                                        child: this.isChild,
                                    });
                                }
                            });
                    }, 1500);
                }
            },
        },

        $_qna_video_id: {
            get() {
                return this.thisPost.qna_video ? this.thisPost.qna_video.vimeo_video_id.value : null;
            },
            set(val) {
                console.log(val);
            },
        },

        $_captions: {
            cache: false,
            get() {
                if (this.captions) {
                    return this.captions.value;
                }

                return '';
            },
            set(value) {
                clearTimeout(this.typingTimeout.captions);

                this.typingTimeout.captions = setTimeout(() => {
                    this.setCaptions(value);
                }, 1500);
            },
        },

        videoTypeInterface: {
            get() {
                if (this.$_vimeo_video_id != null) {
                    this.videoType = 'vimeo';
                } else if (this.$_youtube_video_id != null) {
                    this.videoType = 'youtube';
                }

                return this.videoType;
            },
            set(val) {
                this.videoType = val;
            },
        },

        isYoutube() {
            return this.videoType === 'youtube';
        },

        isVimeo() {
            return this.videoType === 'vimeo';
        },

        hasAnyVideo() {
            return this.$_vimeo_video_id != null || this.$_youtube_video_id != null;
        },

        isSingeoSong() {
            return this.state.brand == 'singeo' && this.thisPost.type == 'song';
        },

        hasLowerRange: {
            cache: false,
            get() {
                return this.thisPost.hasOwnProperty('lower_video');
            }
        },

        $_lower_range_video() {
            return {
                youtubeId: this.thisPost.lower_video.youtube_video_id ? this.thisPost.lower_video.youtube_video_id.value : null,
                vimeoId: this.thisPost.lower_video.vimeo_video_id ? this.thisPost.lower_video.vimeo_video_id.value : null,
            };
        },

        $_lower_range_video_caption: {
            cache: false,
            get() {
                let captions = this.getVideoRangeCaption('lower');

                if (captions != null) {
                    return captions.value;
                }

                return '';
            }
        },

        hasLowRange: {
            cache: false,
            get() {
                return this.thisPost.hasOwnProperty('low_video');
            }
        },

        $_low_range_video() {
            return {
                youtubeId: this.thisPost.low_video.youtube_video_id ? this.thisPost.low_video.youtube_video_id.value : null,
                vimeoId: this.thisPost.low_video.vimeo_video_id ? this.thisPost.low_video.vimeo_video_id.value : null,
            };
        },

        $_low_range_video_caption: {
            cache: false,
            get() {
                let captions = this.getVideoRangeCaption('low');

                if (captions != null) {
                    return captions.value;
                }

                return '';
            }
        },

        hasOriginalRange: {
            cache: false,
            get() {
                return this.thisPost.hasOwnProperty('original_video');
            }
        },

        $_original_range_video() {
            return {
                youtubeId: this.thisPost.original_video.youtube_video_id ? this.thisPost.original_video.youtube_video_id.value : null,
                vimeoId: this.thisPost.original_video.vimeo_video_id ? this.thisPost.original_video.vimeo_video_id.value : null,
            };
        },

        $_original_range_video_caption: {
            cache: false,
            get() {
                let captions = this.getVideoRangeCaption('original');

                if (captions != null) {
                    return captions.value;
                }

                return '';
            }
        },

        hasHighRange: {
            cache: false,
            get() {
                return this.thisPost.hasOwnProperty('high_video');
            }
        },

        $_high_range_video() {
            return {
                youtubeId: this.thisPost.high_video.youtube_video_id ? this.thisPost.high_video.youtube_video_id.value : null,
                vimeoId: this.thisPost.high_video.vimeo_video_id ? this.thisPost.high_video.vimeo_video_id.value : null,
            };
        },

        $_high_range_video_caption: {
            cache: false,
            get() {
                let captions = this.getVideoRangeCaption('high');

                if (captions != null) {
                    return captions.value;
                }

                return '';
            }
        },

        hasHigherRange: {
            cache: false,
            get() {
                return this.thisPost.hasOwnProperty('higher_video');
            }
        },

        $_higher_range_video() {
            return {
                youtubeId: this.thisPost.higher_video.youtube_video_id ? this.thisPost.higher_video.youtube_video_id.value : null,
                vimeoId: this.thisPost.higher_video.vimeo_video_id ? this.thisPost.higher_video.vimeo_video_id.value : null,
            };
        },

        $_higher_range_video_caption: {
            cache: false,
            get() {
                let captions = this.getVideoRangeCaption('higher');

                if (captions != null) {
                    return captions.value;
                }

                return '';
            }
        },

        $_loading: {
            cache: false,
            get() {
                return !!this.contentModel.video.loading;
            }
        },

        singeoSongVideoRangesCount: {
            cache: false,
            get() {
                let currentRanges = this.ranges.filter(range => { return this.thisPost.hasOwnProperty(range + '_video'); });

                return currentRanges.length;
            }
        },

        undefinedSingeoSongVideoRanges: {
            cache: false,
            get() {
                return this.ranges.filter(range => { return !this.thisPost.hasOwnProperty(range + '_video'); });
            }
        },
    },
    watch: {
        newDialog() {
            if (this.newDialog === false) {
                this.newVideoRange = null;
                this.newVideoType = null;
                this.newVideoId = null;
                this.newVideoLengthInSeconds = null;
            }
        },
    },
    created() {
        //this.getCaptions();
        //this.getRevCaptionsStatus();
    },
    methods: {

        videoCaptionUpdated({ caption, range }) {
            const videoContentId = this.thisPost.fields.find(field => field.key === `${range}_video`).value.id;
            let captionObject = this.getVideoRangeCaption(range);

            this.captionsLoading = true;

            if (caption) {
                api.setContentDatum({
                    content_id: videoContentId,
                    datum_id: captionObject ? captionObject.id : undefined,
                    key: 'captions',
                    value: caption,
                    type: 'string',
                })
                    .then(this.handleCaptionsRequest);
            } else {
                api.setContentDatum({
                    datum_id: this.captions.id,
                    deleted: true,
                })
                    .then(this.handleCaptionsRequest);
            }
        },

        getVideoRangeCaption(range) {
            const videoField = this.thisPost.fields.find(field => field.key === `${range}_video`);

            if (videoField != null) {
                return videoField.value.data.find(data => data.key === 'captions');
            }

            return null;
        },

        videoValueUpdated({ type, videoId, range }) {
            if (!videoId) {
                const confirmation = confirm('Are you sure you wish to remove this video?');

                if (confirmation) {
                    this.sendSetFieldRequest({
                        key: range + '_video',
                        deleted: true,
                        delay: 0,
                        child: this.isChild,
                    });
                }
            } else {

                let key = type == 'vimeo' ? 'vimeo_video_id' : 'youtube_video_id';

                this.getVideoById(videoId, key)
                    .then((response) => {
                        if (response) {
                            this.sendSetFieldRequest({
                                key: range + '_video',
                                val: response.id,
                                delay: 0,
                                child: this.isChild,
                            });
                        }
                    });
            }
        },

        addVideoRange({ type, videoId, range }) {
            let key = type == 'vimeo' ? 'vimeo_video_id' : 'youtube_video_id';

            this.getVideoById(videoId, key)
                .then((response) => {
                    if (response) {
                        return api.setContentField({
                            content_id: this.thisPost.id,
                            key: range + '_video',
                            value: response.id,
                            type: 'content_id',
                        });
                    } else {
                        throw new Error('Invalid result of video search by id');
                    }
                })
                .then(() => {
                    this.$root.$emit('displayMessage', {
                        color: 'success',
                        text: 'Video Range Successfully added!',
                    });
                })
                .catch(error => {
                    this.$root.$emit('displayMessage', {
                        color: 'error',
                        text: 'Something went wrong. Video Range not added.',
                    });
                })
                .finally(() => {
                    this.$root.$emit('reloadContent', {});
                });
        },

        cancelRevCaptionOrder() {
            this.revSubtitleStatus = 'ordering';
            this.$root.$emit('pageLoading');

            api.cancelRevCaptions(this.thisPost.id)
                .then((response) => {
                    console.log(response);

                    this.revSubtitleStatus = null;
                    this.getRevCaptionsStatus();

                    let message = 'Failed to cancel subtitle order, please contact developers.';

                    if (response.data.success && response.data.success === true) {
                        message = 'Successfully cancelled subtitle order.';
                    }

                    this.$root.$emit('displayMessage', {
                        color: (response.data.success && response.data.success === true) ? 'success' : 'error',
                        text: message,
                    });

                    this.$root.$emit('pageLoaded');
                });
        },

        submitRevCaptionOrder() {
            this.revSubtitleStatus = 'ordering';
            this.$root.$emit('pageLoading');

            api.orderRevCaptions(this.thisPost.id)
                .then((response) => {
                    console.log(response);

                    this.revSubtitleStatus = null;
                    this.getRevCaptionsStatus();

                    let message = 'Failed to place subtitle order, please contact developers.';

                    if (response.data.success && response.data.success === true) {
                        message = 'Successfully placed subtitle order.';
                    }

                    this.$root.$emit('displayMessage', {
                        color: (response.data.success && response.data.success === true) ? 'success' : 'error',
                        text: message,
                    });

                    this.$root.$emit('pageLoaded');
                });
        },

        getRevCaptionsStatus() {
            api.getRevCaptionsStatus(this.thisPost.id)
                .then((response) => {
                    if (!response.data.exists) {
                        this.revSubtitleStatus = null;
                    } else if (response.data.order_details) {
                        this.revSubtitleData.status = response.data.order_details.status;
                        this.revSubtitleData.order_number = response.data.order_details.order_number;
                        this.revSubtitleData.price = response.data.order_details.price;
                        this.revSubtitleData.video_length = response.data.order_details.caption.total_length_seconds;
                        this.revSubtitleData.rev_admin_url = `https://www.rev.com/account/orders/orderdetail/${response.data.order_details.order_number}`;
                        this.revSubtitleData.rev_download_url = `https://www.rev.com/account/orders/downloadfile/${response.data.order_details.order_number}`;

                        if (response.data.order_details.status === 'In Progress') {
                            this.revSubtitleStatus = 'processing';
                        } else if (response.data.order_details.status === 'Complete') {
                            this.revSubtitleStatus = 'complete';
                        } else {
                            this.revSubtitleStatus = null;
                        }
                    }
                });
        },

        getVideoById(id, type) {
            return new Promise((resolve) => {
                api.getInternalVideoId({
                    brand: this.state.brand,
                    type,
                    id,
                })
                    .then((response) => {
                        const thisVideo = response.data.data[0];

                        if (thisVideo) {
                            resolve(thisVideo);
                        } else {
                            resolve(false);
                            this.$root.$emit('displayMessage', {
                                color: 'error',
                                text: 'Could not find that Video ID in our system.',
                            });
                        }
                    });
            });
        },

        async submitNewVideo() {
            const slug = `${this.newVideoType}-${this.newVideoId}`;
            const now = this.moment.utc(this.moment.now()).format('YYYY-MM-DD HH:mm:ss');

            this.$root.$emit('pageLoading');

            const newVideo = await api.setContent({
                title: slug,
                type: this.newVideoType,
                status: 'published',
                published_on: now,
                brand: this.state.brand,
            });

            const newVideoContentId = newVideo.data.data[0].id;
            const videoFieldKey = this.newVideoType === 'vimeo-video' ? 'vimeo_video_id' : 'youtube_video_id';

            if (newVideoContentId) {
                const newVideoIdField = await api.setContentField({
                    content_id: newVideoContentId,
                    key: videoFieldKey,
                    value: this.newVideoId,
                    type: 'string',
                });

                const newVideoLengthInSecondsField = await api.setContentField({
                    content_id: newVideoContentId,
                    key: 'length_in_seconds',
                    value: this.newVideoLengthInSeconds,
                    type: 'string',
                });

                if (newVideoIdField && newVideoLengthInSecondsField) {
                    this.newDialog = false;
                    this.$root.$emit('displayMessage', {
                        color: 'success',
                        text: 'Video Successfully created!',
                    });

                    if (this.isSingeoSong) {
                        let type = this.newVideoType === 'vimeo-video' ? 'vimeo' : 'youtube';
                        this.addVideoRange({ type, videoId: this.newVideoId, range: this.newVideoRange })
                    } else {
                        this.appendNewFieldsToInputs(this.newVideoType, this.newVideoId);
                    }
                } else {
                    this.newDialog = false;
                    this.$root.$emit('displayMessage', {
                        color: 'error',
                        text: 'Something went wrong. Video not created.',
                    });
                }
            } else {
                this.newDialog = false;
                this.$root.$emit('displayMessage', {
                    color: 'error',
                    text: 'Something went wrong. Video not created.',
                });
            }

            this.$root.$emit('pageLoaded');
        },

        appendNewFieldsToInputs(type, id) {
            this.videoTypeInterface = type.replace('-video', '');

            if (type === 'vimeo-video') {
                this.$_vimeo_video_id = id;
            }

            if (type === 'youtube-video') {
                this.$_youtube_video_id = id;
            }
        },

        getCaptions() {
            const videoField = this.thisPost.fields.find(field => field.key === 'video');

            if (videoField != null) {
                this.captions = videoField.value.data.find(data => data.key === 'captions');
            } else {
                this.captions = null;
            }

            this.$nextTick(() => this.$forceUpdate());
        },

        setCaptions(value) {
            const videoContentId = this.thisPost.fields.find(field => field.key === 'video').value.id;

            this.captionsLoading = true;

            if (value.length) {
                api.setContentDatum({
                    content_id: videoContentId,
                    datum_id: this.captions ? this.captions.id : undefined,
                    key: 'captions',
                    value,
                    type: 'string',
                })
                    .then(this.handleCaptionsRequest);
            } else {
                api.setContentDatum({
                    datum_id: this.captions.id,
                    deleted: true,
                })
                    .then(this.handleCaptionsRequest);
            }
        },

        handleCaptionsRequest(response) {
            if (response) {
                this.captions = response.data.datum;

                this.$root.$emit('displayMessage', {
                    text: 'Captions successfully edited!',
                    color: 'success',
                });
            } else {
                this.$root.$emit('displayMessage', {
                    text: 'Oops! Something went wrong, captions likely not edited!',
                    color: 'error',
                });
            }

            api.getContentById(this.post_id)
                .then((resolved) => {
                    this.resetContentEditState(resolved.data.data[0]);

                    this.$nextTick(() => {
                        this.captionsLoading = false;
                    });
                });
        },
    },
};
</script>
