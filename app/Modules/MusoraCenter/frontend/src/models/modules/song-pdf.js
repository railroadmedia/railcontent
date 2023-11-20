import Content from './_default';

export default class SongPdf extends Content {
    constructor() {
        super();

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
    }
}
