import Content from './_default';

export default class Routine extends Content {
    constructor() {
        super();

        this.difficulty = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.difficulty_range = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.description = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [
                v => !!v || 'Description is required',
            ],
        };

        this.low_soundslice_slug = {
            type: 'string',
            brands: ['singeo'],
            loading: false,
            rules: [
                v => !!v || 'Low soundslice slug is required',
            ],
        };

        this.high_soundslice_slug = {
            type: 'string',
            brands: ['singeo'],
            loading: false,
            rules: [
                v => !!v || 'High soundslice slug is required',
            ],
        };
    }
};
