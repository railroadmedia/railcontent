import { DateTime, Duration } from 'luxon';
import ContentHelpers from "../helper-functions/content.js";

export default class ContentModel {
    constructor({ brand = 'drumeo', post }) {
        this.brand = brand;
        this.post = post;
        this.id = post.id;

        this.card = {
            thumbnail: this.getPostThumbnail(),
            logo_image: this.getPostLogoImage(),
            color_title: this.postInstructor || this.postType,
            content_type: this.getTypeWithIcon(),
            black_title: this.getPostField('title') || this.post.title,
            description: this.post.description,
            sheet_music: null,
            grey_title: ContentModel.mapDifficulty(this.post),
        };

        this.list = {
            thumbnail: this.getPostThumbnail(),
            color_title: this.postInstructor,
            black_title: this.post.title,
            description: this.post.description,
            sheet_music: null,
            column_data: [
                this.getPostDuration(),
                this.postPublisedOn,
            ],
        };

        this.schedule = {
            thumbnail: this.getPostThumbnail(),
            color_title: this.postType,
            black_title: this.getPostField('title'),
            column_data: [
                this.postInstructor,
                ContentModel.mapDifficulty(this.post),
            ],
        };
    }

    getPostField(key) {
        const postField = this.post?.fields?.find(field => field.key === key);

        return postField ? postField.value : '';
    }

    getPostFieldMulti(key) {
        const postFields = this.post.fields?.filter(field => field.key === key) || '';

        return postFields.length ? postFields.map(field => field.value) : '';
    }

    getPostDatum(key) {
        const datum = this.post?.data?.find(data => data.key === key);

        return datum && datum.value ? datum.value : '';
    }

    get postInstructor() {
        const instructor = this.getPostField('instructor') || this.post.instructors;

        if(Array.isArray(instructor)){
            return instructor.join(', ');
        }

        return [];
    }

    getInstructors() {
        const instructors = this.post.instructors;
        let mappedInstructors;

        if (instructors.length) {
            mappedInstructors = instructors
                // Get all the instructor fields
                .map((instructor) => instructor.fields
                    // Find only the name field
                    .find((field) => field.key === 'name'))
                // Map the field values
                .map((field) => field.value)
                // Join them with a comma
                .join(', ');
        }

        return mappedInstructors;
    }

    getPostDuration() {
        const video = this.post?.fields?.find(field => field.key === 'video');

        if (video) {
            let duration = 0;
            const videoLength = video.value.fields.find(field => field.key === 'length_in_seconds');

            if (videoLength) {
                duration = videoLength.value;
            }

            const parsedDuration = Math.round(Duration.fromMillis((duration * 1000)).as('minutes'));

            return `${parsedDuration} mins`;
        } else if (this.post?.length_in_seconds) {
            const duration = this.post?.length_in_seconds;

            const parsedDuration = Math.round(Duration.fromMillis((duration * 1000)).as('minutes'));
            return `${parsedDuration} mins`;
        }

        return '';
    }

    get postPublisedOn() {
        const dateString = this.post.published_on;

        // handle null
        if (!dateString) return null;

        // handle invalid
        const date = new Date(dateString);
        if (isNaN(date)) return null;

        const formatter = new Intl.DateTimeFormat('en-US', {
            month: 'short',
            day: 'numeric',
            year: '2-digit',
        });

        return formatter.format(date);
    }

    get postType() {
        if(this.post.type) return this.post.type.replace('bundle-', '').replace(/-/g, ' ');
    }

    getTypeWithIcon() {
        const icon = ContentHelpers.getContentTypeIcon(this.post.type);
        const type = this.postType;

        if (type === 'song' && this.post.brand !== 'guitareo') {
            return `${this.getPostField('artist')}`;
        }

        return `${type}`;
    }

    getPostDifficulty() {
        return ContentModel.mapDifficulty(this.post);
    }

    get episodeNumber() {
        return this.post.sort ? `Episode #${this.post.sort}` : '';
    }

    get postChildLessonCount() {
        return this.post.lesson_count ? `${this.post.lesson_count} Lessons` : '';
    }

    getPostThumbnail() {
        const defaults = {
            drumeo: 'https://dmmior4id2ysr.cloudfront.net/assets/images/drumeo_fallback_thumb.jpg',
            pianote: 'https://dmmior4id2ysr.cloudfront.net/assets/images/pianote_fallback_thumb.jpg',
            guitareo: 'https://dmmior4id2ysr.cloudfront.net/assets/images/guitareo_fallback_thumb.jpg',
            singeo: 'https://dmmior4id2ysr.cloudfront.net/assets/images/singeo_fallback_thumb.jpg',
        };

        let thumb = this.post.image;

        if (this.postType === 'learning-path' && this.brand === 'drumeo') {
            thumb = this.getPostDatum('background_image_url');
        }

        if (this.postType === 'chord and scale' && this.brand === 'guitareo') {
            thumb = this.getPostDatum('guitar_chord_image_url');
        }

        return thumb || defaults[this.brand];
    }

    getPostLogoImage() {
        let imageUrl = this.getPostDatum('logo_image_url');
        return imageUrl === '' ? null : imageUrl;
    }

    static mapDifficulty(post) {
        const difficulty = post.difficulty;

        if (!difficulty) {
            return '';
        }

        if (difficulty <= 3) {
            return `beginner ${difficulty}`;
        }
        if (difficulty > 3 && difficulty <= 6) {
            return `intermediate ${difficulty}`;
        }
        if (difficulty > 6) {
            return `advanced ${difficulty}`;
        }
        // Some content has difficulty already parsed as a word so we return that,
        // if its falsey, just default it to ''
        return difficulty || '';
    }

    parseInstructors() {
        const instructors = this.getInstructors();

        return instructors ? instructors.replace(/,(?=[^,]*$)/, ' &') : '';
    }
}
