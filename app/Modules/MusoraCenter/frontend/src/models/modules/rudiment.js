import Content from './_default';

export default class Rudiment extends Content {
    constructor() {
        super();

        this.sheet_music_thumbnail_url = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.topic = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.instrument = {
            type: 'string',
            brands: ['drumeo'],
            loading: false,
            rules: [],
        };

        this.sort = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'singeo'],
            loading: false,
            rules: [],
            input_label: 'Sort Order Number'
        };
    }
}
