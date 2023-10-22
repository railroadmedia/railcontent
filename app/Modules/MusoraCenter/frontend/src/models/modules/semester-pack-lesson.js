import Content from './_default';

export default class SemesterPackLesson extends Content {
    constructor() {
        super();

        this.week = {
            type: 'string',
            brands: ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
            loading: false,
            rules: [],
        };

        this.difficulty = null;
        this.style = null;
    }
}
