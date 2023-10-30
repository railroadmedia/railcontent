import Content from './_default';

export default class PlayAlong extends Content {
    constructor() {
        super();

        this.topic = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.bpm = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.artist = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.style = {
            type: 'string',
            brands: ['drumeo', 'guitareo'],
            loading: false,
            rules: [],
        };

        this.mp3_no_drums_no_click_url = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.mp3_yes_drums_no_click_url = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.mp3_no_drums_yes_click_url = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.mp3_yes_drums_yes_click_url = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.is_featured = null;
    }
}
