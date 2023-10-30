import Content from './_default';

export default class PackBundleLesson extends Content {
    constructor() {
        super();

        this.total_xp = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.live_event_start_time = {
            type: 'datetime',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.live_event_end_time = {
            type: 'datetime',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.live_event_youtube_id = {
            type: 'string',
            brands: ['pianote', 'guitareo', 'drumeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.tag = null;
        this.difficulty = null;
    }
}
