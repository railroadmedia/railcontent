import Content from './_default';

export default class LearningPathLevel extends Content {
    constructor() {
        super();

        this.topic = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.tag = {
            type: 'string',
            brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            loading: false,
            rules: [],
        };

        this.chapter_timecode = null;
        this.chapter_description = null;
    }
}
