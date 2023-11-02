import Content from './_default';

export default class Song extends Content {
    constructor() {
        super();

        this.qna_video = {
            type: 'content_id',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.topic = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.sort = {
            type: 'string',
            brands: ['drumeo', 'pianote'],
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
    }
}
