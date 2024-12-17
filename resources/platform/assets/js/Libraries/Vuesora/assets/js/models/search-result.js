import ContentModel from './_default';
import { contentTypes } from '../../../../../utils';

export default class StudentFocusContentModel extends ContentModel {
    constructor({ brand = 'drumeo', post }) {
        super({
            brand,
            post,
        });

        const fallBackThumb = 'https://dmmior4id2ysr.cloudfront.net/assets/images/drumeo_fallback_thumb.jpg';

        this.list.content_type = contentTypes[this.post.type] ? contentTypes[this.post.type].singular : this.postType;
        this.list.color_title = this.postInstructor ? this.postInstructor : '';
        this.list.thumbnail = this.post?.thumbnail_url ? this.post.thumbnail_url : fallBackThumb;

        this.list.column_data = [
            this.getPostDuration(),
            this.postPublisedOn,
        ];
    }
}
