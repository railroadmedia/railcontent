import ContentModel from './_default';

export default class PackBundleLessonContentModel extends ContentModel {
    constructor({ brand = 'drumeo', post }) {
        super({
            brand,
            post,
        });

        this.card.grey_title = this.getPostDuration();
        this.card.color_title = this.postInstructor ? this.postInstructor : '';

        this.list.color_title = this.postInstructor ? this.postInstructor : '';
        this.list.thumbnail = this.post.thumbnail || this.post.thumbnail_url;
        this.list.column_data = [
            this.getPostDuration(),
        ];
    }
}
