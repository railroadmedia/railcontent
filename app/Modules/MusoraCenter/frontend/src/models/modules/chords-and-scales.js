import Content from './_default';

export default class ChordAndScale extends Content {
    constructor() {
        super();

        this.tag = null;
        this.topic = null;

        this.chord_or_scale = {
            type: 'string',
            brands: ['guitareo', 'pianote'],
            loading: false,
            rules: [],
        };

        this.key_pitch_type = {
            type: 'string',
            brands: ['guitareo', 'pianote'],
            loading: false,
            rules: [],
        };

        this.key = {
            type: 'string',
            brands: ['guitareo', 'pianote'],
            loading: false,
            rules: [],
        };

        this.guitar_chord_image_url = {
            type: 'string',
            brands: ['guitareo'],
            loading: false,
            rules: [],
        };

        this.piano_keys_thumbnail_url = {
            type: 'string',
            brands: ['pianote'],
            loading: false,
            rules: [],
        };
    }
}
