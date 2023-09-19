export default class Content {
    constructor() {
        this.permissions = {
            type: 'array',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.status = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.published_on = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.video = {
            type: 'content_id',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.lower_video = {
            type: 'content_id',
            brands: ['singeo'],
            loading: false,
            rules: [],
        };

        this.low_video = {
            type: 'content_id',
            brands: ['singeo'],
            loading: false,
            rules: [],
        };

        this.original_video = {
            type: 'content_id',
            brands: ['singeo'],
            loading: false,
            rules: [],
        };

        this.high_video = {
            type: 'content_id',
            brands: ['singeo'],
            loading: false,
            rules: [],
        };

        this.higher_video = {
            type: 'content_id',
            brands: ['singeo'],
            loading: false,
            rules: [],
        };

        this.vimeo_video_id = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.youtube_video_id = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.captions = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.title = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [
                v => !!v || 'Title is required.',
                v => (v || '').length <= 80 || 'Maximum 80 characters',
            ],
        };

        this.difficulty = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
            errors: [],
        };

        this.xp = {
            type: 'integer',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.instructor = {
            type: 'content_id',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.description = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.is_featured = {
            type: 'boolean',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.tag = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.thumbnail_url = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.original_thumbnail_url = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };


        this.resource_name = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.resource_url = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.chapter_timecode = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.chapter_description = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.staff_pick_rating = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'singeo'],
            loading: false,
            rules: [],
        };

        this.home_staff_pick_rating = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'singeo'],
            loading: false,
            rules: [],
        };

        this.header_image_url = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.show_in_new_feed = {
            type: 'integer',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };
    }
}
