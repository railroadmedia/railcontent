

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
            // TODO: Test challenges breadcrumbs
            breadcrumb.pages.push({
                title: 'Challenges',
                url: `/${brand}/challenges`
            });
            breadcrumb.pages.push({
                title: data.parent_content_data?.[0]?.slug ?? '',
                url: `/${brand}/${data.parent_content_data?.[0]?.slug ?? ''}`
            });
            breadcrumb.pages.push({
                title: data.title
            });
        } else if (data.type === 'learning-path-lesson') {
            breadcrumb.pages.push({
                title: `${data.brand} Method`,
                url: `/${brand}/method/${data.parent_content_data?.[2]?.slug}/${data.parent_content_data?.[2]?.id}`
            });
            breadcrumb.pages.push({
                title: data.parent_content_data?.[0]?.slug ?? '',
                url: `/${brand}/method/${data.slug.current}/${data.id}/${data.parent_content_data?.[1]?.slug}/${data.parent_content_data?.[1]?.id}/${data.parent_content_data?.[0]?.slug}/${data.parent_content_data?.[0]?.id}`
            });
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
        } else if (data.parent_content_data?.[0]) {
            if (data.type === 'pack-bundle-lesson') {
                breadcrumb.pages.push({
                    title: 'Packs',
                    url: `/${brand}/packs`
                });
                breadcrumb.pages.push({
                    title: parseLessonTypeReadable(data.parent_content_data[0].slug) ?? '',
                    url: `/${brand}/packs/${data.parent_content_data[1].slug}/${data.parent_content_data[1]?.id}`
                });
                breadcrumb.pages.push({
                    title: data.title
                });
            } else if (data.type === 'course-part') {
                breadcrumb.pages.push({
                    title: 'Courses',
                    url: `/${brand}/courses`
                });
                breadcrumb.pages.push({
                    title: parseLessonTypeReadable(data.parent_content_data[0].slug) ?? '',
                    url: `/${brand}/courses/${data.parent_content_data[0].slug}/${data.parent_content_data[0].id}`
                });
                breadcrumb.pages.push({
                    title: data.title
                });
            } else {
                breadcrumb.pages.push({
                    title: parseLessonTypeReadable(data.parent_content_data[0].type, true),
                    url: `/${brand}/${data.type}/${data.parent_content_data[0].type}`
                });
                breadcrumb.pages.push({
                    title: data.parent_content_data[0].slug ?? '',
                    url: data.parent_content_data[0].url ?? ''
                });
                breadcrumb.pages.push({
                    title: data.title
                });
            }
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