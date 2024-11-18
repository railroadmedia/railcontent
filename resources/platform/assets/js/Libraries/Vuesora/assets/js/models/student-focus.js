import ContentModel from './_default';

export default class StudentFocusContentModel extends ContentModel {
    constructor({ brand = 'drumeo', post }) {
        super({
            brand,
            post,
        });

        const fallBackThumb = 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dmmior4id2ysr.cloudfront.net/assets/images/drumeo_fallback_thumb.jpg';


        this.card.color_title = this.postInstructor ? this.postInstructor : '';
        this.card.grey_title = this.postPublisedOn;
        this.card.content_type = `${this.card.content_type} Lesson`;

        this.list.color_title = this.postInstructor ? this.postInstructor : '';
        this.list.thumbnail = this.post?.thumbnail_url ? this.post.thumbnail_url : fallBackThumb;
        this.list.column_data = [
            this.getPostDuration(),
            this.postPublisedOn,
        ];
    }
}
