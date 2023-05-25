import Content from './_default';

export default class Coach extends Content {
    constructor() {
        super();

        this.head_shot_picture_url = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.short_description = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.long_description = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.instructor = null;
        this.description = null;
        this.video = null;
        this.xp = null;
        this.tag = null;
        this.difficulty = null;
        this.chapter_timecode = null;
        this.chapter_description = null;
        this.is_featured = null;
    }
}
