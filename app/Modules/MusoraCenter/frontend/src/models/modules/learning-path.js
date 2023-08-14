import Content from './_default';

export default class LearningPath extends Content {
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

        this.xp = {
            type: 'integer',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [
                v => !!v || 'XP is required',
            ],
        };

        this.description = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [
                v => !!v || 'Description is required',
            ],
        };

        this.tag = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.header_image_url = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.logo_image_url = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };
    }
}
