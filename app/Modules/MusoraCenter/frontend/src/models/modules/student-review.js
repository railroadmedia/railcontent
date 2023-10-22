import Content from './_default';

export default class StudentReview extends Content {
    constructor() {
        super();
        this.student_id = {
            type: 'string',
            brands: ['recordeo'],
            loading: false,
            rules: [],
        };

        this.staff_pick_rating = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote'],
            loading: false,
            rules: [],
        };

        this.home_staff_pick_rating = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote'],
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

        this.topic = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };
    }
}
