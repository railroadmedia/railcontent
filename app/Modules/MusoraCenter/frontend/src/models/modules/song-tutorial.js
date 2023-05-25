import Content from './_default';

export default class SongTutorial extends Content {
    constructor() {
        super();

        this.topic = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [
                v => !!v || 'Topic is required',
            ],
        };

        this.bpm = {
            type: 'string',
            brands: ['drumeo', 'singeo'],
            loading: false,
            rules: [
                v => !!v || 'BPM is required',
            ],
        };

        this.artist = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'singeo'],
            loading: false,
            rules: [],
        };

        this.style = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'singeo'],
            loading: false,
            rules: [],
        };

        this.song_name = {
            type: 'string',
            brands: ['pianote', 'singeo'],
            loading: false,
            rules: [],
        };

        this.released = {
            type: 'string',
            brands: ['drumeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.album = {
            type: 'string',
            brands: ['drumeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.transcriber_name = {
            type: 'string',
            brands: ['drumeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.is_featured = null;
    }
}
