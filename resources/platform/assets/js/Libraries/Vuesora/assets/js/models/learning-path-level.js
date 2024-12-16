import ContentModel from './_default';

export default class LearningPathLevelContentModel extends ContentModel {
    constructor({ brand = 'drumeo', post }) {
        super({
            brand,
            post,
        });
        this.card.grey_title = this.postChildLessonCount;
        this.list.thumbnail = this.post.thumbnail_url;
        this.list.thumb_title = this.levelNumber;
        this.list.thumb_logo = this.getThumbLogo();
        this.list.color_title = null;
        this.list.grey_title = `with ${this.getInstructors()}`;
        this.list.column_data = [
            this.postChildLessonCount,
            `${this.post.total_xp} xp`,
        ];
        this.list.description = this.post.description;
    }

    get postChildLessonCount() {
        if (this.brand === 'singeo' || this.brand === 'guitareo') {
            return this.post.child_count ? `${this.post.child_count} Lessons` : '';
        }
        return this.post.child_count ? `${this.post.child_count} Courses` : '';
    }

    get levelNumber() {
        return `Level ${this.post.position}`;
    }

    getThumbLogo() {
        if (this.brand === 'singeo') {
            return 'https://d2vyvo0tyx8ig5.cloudfront.net/logo/singeo-method.png';
        }

        if (this.brand === 'guitareo') {
            return 'https://d38h3dn806jqj1.cloudfront.net/logos/guitareo_method_logo.svg';
        }

        if (this.brand === 'pianote') {
            return 'https://d2vyvo0tyx8ig5.cloudfront.net/icons/pianote-method.png';
        }

        return 'https://dpwjbsxqtam5n.cloudfront.net/pack-logos/drumeo-method-logo.png';
    }

    getInstructors() {
        const instructors = this.post.instructor?.map(instructor => instructor.name);
        return instructors?.join(', ');
    }
}
