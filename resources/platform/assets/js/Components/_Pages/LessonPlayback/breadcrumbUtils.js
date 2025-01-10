const parseLessonTypeReadable = (type, plural = false) => {
    switch (type) {
        case 'course-part':
            return plural ? 'Courses' : 'Course';
        case 'song-part':
            return 'Songs';
        case 'play-along-part':
            return 'Play-Alongs';
        case 'recording':
            return 'Archives';
        case 'unit-part':
            return 'Learning Paths';
        case 'chord-and-scale':
            return 'Chords & Scales';
        case 'semester-pack':
        case 'semester-pack-lesson':
        case 'pack-bundle':
        case 'pack-bundle-lesson':
            return 'Pack';
        case 'student-review':
            return 'Student Reviews';
        case 'boot-camps':
            return 'Bootcamps';
        case 'odd-times':
            return 'Odd Times With Aaron Edgar';
        case 'tama':
            return 'Tama Drums';
        default:
            return type;
    }
};

export const getBreadcrumbs = (data, brand) => {
        const breadcrumb = {
            pages: [],
            // leaving the override for future reference, verify if this breaks anything
            breadcrumbClassOverride: ''
        };
        if (!data || Object.keys(data).length === 0) {
            return breadcrumb;
        }

        if (data.type === 'workout') {
            breadcrumb.pages.push({
                title: 'Workouts',
                url: `/${brand}/workouts`
            });
            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.type === 'student-focus') {
            breadcrumb.pages.push({
                title: 'Student Focus',
                url: `/${brand}/student-focus`
            });
            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.type === 'quick-tips') {
            breadcrumb.pages.push({
                title: 'Quick Tips',
                url: `/${brand}/quick-tips`
            });
            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.type === 'rudiment') {
            breadcrumb.pages.push({
                title: 'Rudiments',
                url: `/${brand}/rudiments`
            });
            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.type === 'challenge-part') {
            breadcrumb.pages.push({
                title: 'Challenges',
                url: `/${brand}/challenge`
            });

            const parentData = getParentData(data.parent_content_data);
            breadcrumb.pages = breadcrumb.pages.concat(parentData);

            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.type === 'learning-path-lesson') {
            const parentData = getParentData(data.parent_content_data);
            breadcrumb.pages = breadcrumb.pages.concat(parentData);

            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.type === 'coach-stream') {
            // how to test this?
            breadcrumb.pages.push({
                title: 'Coaches',
                url: `/${brand}/coaches`
            });
            const coachTitle = data.instructor?.[0]?.name;
            breadcrumb.pages.push({
                title: coachTitle,
                url: data.instructor?.[0]?.web_url_path ?? ''
            });
            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.parent_content_data && data.parent_content_data.length > 0) {
            if (data.type === 'pack-bundle-lesson') {
                breadcrumb.pages.push({
                    title: 'Packs',
                    url: `/${brand}/packs`
                });

            } else if (data.type === 'course-part') {
                breadcrumb.pages.push({
                    title: 'Courses',
                    url: `/${brand}/courses`
                });
            } else {
                breadcrumb.pages.push({
                    title: parseLessonTypeReadable(data.parent_content_data[0].type, true),
                    url: `/${brand}/${data.type}/${data.parent_content_data[0].type}`
                });
            }

            const parentData = getParentData(data.parent_content_data);
            breadcrumb.pages = breadcrumb.pages.concat(parentData);

            breadcrumb.pages.push({
                title: data.title
            });
        } else {
            const backUrl = data.url.split(data.slug.current)[0];
            breadcrumb.pages.push({
                title: parseLessonTypeReadable(data.type, true),
                url: backUrl
            });
            breadcrumb.pages.push({
                title: data.title
            });
        }

        // Todo: Verify if the breadcrumb override is used at all
        return breadcrumb.pages;
};

const getParentData = (data) => {
    const temp = [];
    data.forEach((parent) => {
        temp.push({
            title: parent.title,
            url: parent.web_url_path,
        });
    })
    return [...temp].reverse();
}
