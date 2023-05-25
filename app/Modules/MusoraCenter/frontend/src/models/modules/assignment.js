import Content from './_default';

export default class Assignment extends Content {
    constructor() {
        super();

        this.timecode = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.soundslice_xml_file_url = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.soundslice_slug = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.sheet_music_image_type = {
            type: 'string',
            brands: ['guitareo'],
            loading: false,
            rules: [],
        };

        this.sheet_music_image_url = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.permissions = null;
        this.difficulty = null;
        this.tag = null;
        this.vimeo_video_id = null;
        this.youtube_video_id = null;
        this.instructor = null;
        this.tags = null;
        this.thumbnail_url = null;
        this.original_thumbnail_url = null;
        this.resource_name = null;
        this.resource_url = null;
        this.chapter_timecode = null;
        this.chapter_description = null;
        this.is_featured = null;
    }
}
