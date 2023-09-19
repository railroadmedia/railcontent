<template>
	<div>
        <h2 style="margin-top: 25px; margin-bottom: 10px;" v-if="!showRangeSelector">
            <strong style="text-transform:capitalize;">{{ range }} Range Video</strong>
        </h2>

        <v-select
            v-if="showRangeSelector"
            v-model="videoRange"
            :items="availableRanges"
            :disabled="hasAnyVideo"
            label="Video Range"
        ></v-select>

		<v-select
            v-if="hasRange"
            v-model="videoType"
            :items="['vimeo', 'youtube']"
            :disabled="hasAnyVideo"
            label="Type"
        ></v-select>

        <v-text-field
            v-if="isVimeo && hasRange"
            v-model="$_vimeo_video_id"
            label="Vimeo Video ID"
            :color="brandColor"
            :loading="loading"
            :disabled="loading"
            clearablebrandColor
            required
        ></v-text-field>

        <v-text-field
            v-if="isYoutube && hasRange"
            v-model="$_youtube_video_id"
            label="Youtube Video ID"
            :color="brandColor"
            :loading="loading"
            :disabled="loading"
            clearable
            required
        ></v-text-field>

        <v-custom-file-input
            v-if="hasAnyVideo"
            v-model="$_captions"
            label="Subtitles"
            input-key="captions_url"
            :color="brandColor"
            :loading="loading"
            :base-file-name="contentId + '-english-captions'"
            upload-endpoint="/railcontent/remote"
            :required="true"
            class="mb-2"
        ></v-custom-file-input>
	</div>
</template>

<script>
import brandColors from '../../../api/mixins';
import ContentStore from '../../../mixins/content-store';
import CustomFileInput from '../../../components/CustomFileInput.vue';

export default {
	name: 'ContentVideosRange',
	components: {
        'v-custom-file-input': CustomFileInput,
    },
    mixins: [brandColors, ContentStore],
    props: {
        range: {
            type: String,
            default: () => '',
        },
        vimeoVideoId: {
            type: String,
            default: () => '',
        },
        youtubeVideoId: {
            type: String,
            default: () => '',
        },
        availableRanges: {
            type: Array,
            default: () => [],
        },
        showRangeSelector:{
            type: Boolean,
            default: () => false,
        },
        loading: {
            type: Boolean,
        },
        contentId: {
            type: Number,
        },
        videoCaption: {
            type: String,
            default: () => '',
        },
    },
	data() {
        return {
            videoType: 'vimeo',
            videoRange: '',
            vimeoId: '',
            youtubeId: '',
            caption: '',
            typingTimeout: {
                video: null,
                captions: null,
            },
        }
    },
    mounted() {
        this.vimeoId = this.vimeoVideoId;
        this.youtubeId = this.youtubeVideoId;
        this.caption = this.videoCaption;

        if (this.vimeoVideoId) {
            this.videoType = 'vimeo';
        } else if (this.youtubeVideoId) {
            this.videoType = 'youtube';
        }
    },
    computed: {
        $_vimeo_video_id: {
            get() {
                return this.vimeoId;
            },
            set(val) {
                this.vimeoId = val;
                this.videoValueUpdated('vimeo');
            }
        },
        $_youtube_video_id: {
            get() {
                return this.youtubeId;
            },
            set(val) {
                this.youtubeId = val;
                this.videoValueUpdated('youtube');
            }
        },
        $_captions: {
            get() {
                return this.caption;
            },
            set(val) {
                this.caption = val;
                this.videoCaptionUpdated();
            }
        },
        hasRange() {
            return this.range != '' || this.videoRange != '';
        },
        hasAnyVideo() {
            return !!this.vimeoId || !!this.youtubeId;
        },
        isYoutube() {
            return this.videoType === 'youtube';
        },
        isVimeo() {
            return this.videoType === 'vimeo';
        },
    },
    watch: {
        vimeoVideoId(val) {
            this.vimeoId = val;
            if (this.videoType != 'vimeo') {
                this.videoType = 'vimeo';
            }
        },
        youtubeVideoId(val) {
            this.youtubeId = val;
            if (this.videoType != 'youtube') {
                this.videoType = 'youtube';
            }
        },
        videoCaption(val) {
            this.caption = val;
        },
    },
    methods: {
        videoValueUpdated(type) {
            clearTimeout(this.typingTimeout.video);

            this.typingTimeout.video = setTimeout(() => {
                let videoId = type == 'vimeo' ? this.vimeoId : this.youtubeId;
                let range = this.range != '' ? this.range : this.videoRange;
                let eventName = this.range != '' ? 'videoValueUpdated' : 'addVideoRange';
                this.$emit(eventName, { type, videoId, range });
            }, 1500);
        },
        videoCaptionUpdated() {
            clearTimeout(this.typingTimeout.captions);

            this.typingTimeout.captions = setTimeout(() => {
                let range = this.range != '' ? this.range : this.videoRange;
                this.$emit('videoCaptionUpdated', { caption: this.caption, range });
            }, 1500);
        },
    },
}
</script>