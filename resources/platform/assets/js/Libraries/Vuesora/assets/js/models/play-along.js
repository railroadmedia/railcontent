import ContentModel from './_default';

export default class PlayAlongContentModel extends ContentModel {
    constructor({ brand = 'drumeo', post }) {
        super({
            brand,
            post,
        });

        this.card.color_title = this.post.style ? this.post.style.join(', ') : '';
        this.list.color_title = this.post.style ? this.post.style.join(', ') : '';
        this.list.column_data = [
            this.post.bpm ? `${this.post.bpm} BPM` : ' ',
        ];

        if (this.brand === 'guitareo') {
            this.card.color_title = this.getTypeWithIcon();
            this.card.grey_title = `${this.postInstructor}, ${this.post.difficulty_string} ${this.post.difficulty}`;

            this.list.color_title = null;
            this.list.column_data = [
                this.postInstructor,
                this.postChildLessonCount,
                this.postPublisedOn,
            ];
        }
    }
}
