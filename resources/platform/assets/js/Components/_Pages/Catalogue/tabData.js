export const getTabData = (type) => {
    switch(type){
        case 'courses':
            return [
                {
                    name: 'Courses',
                    short_name: 'COURSES',
                    value: [''],
                },
                {
                    name: 'Instructors',
                    short_name: 'INSTRUCTORS',
                    is_group_by: true,
                    value: ['instructor'],
                },
                {
                    name: 'Genres',
                    short_name: 'Genres',
                    is_group_by: true,
                    value: ['style'],
                },
            ];

        case 'play-alongs':
            return [
                {
                    name: 'All Play Alongs',
                    short_name: 'ALL',
                    value: [''],
                }
            ];

        case 'routines':
            return [
                {
                    name: 'All Routines',
                    short_name: 'ALL ROUTINES',
                    value: [''],
                }
            ];

        case 'spotlight':
            return [
                {
                    name: 'All Spotlights',
                    short_name: 'ALL',
                    value: [''],
                }
            ];

        case 'rudiments':
            return [
                {
                    name: 'All',
                    short_name: 'ALL',
                    value: [''],
                },
                {
                    name: 'Drags',
                    short_name: 'DRAGS',
                    is_required_field: true,
                    value: ['topic,drags,string,='],
                },
                {
                    name: 'Flams',
                    short_name: 'FLAMS',
                    is_required_field: true,
                    value: ['topic,flams,string,='],
                },
                {
                    name: 'Paradiddles',
                    short_name: 'PARADIDDLES',
                    is_required_field: true,
                    value: ['topic,paradiddles,string,='],
                },
                {
                    name: 'Rolls',
                    short_name: 'ROLLS',
                    is_required_field: true,
                    value: ['topic,rolls,string,='],
                },
            ];

        case 'archives':
        case 'boot-camps':
        case 'challenges':
        case 'gear-guides':
        case 'performances':
        case 'question-and-answer':
        case 'quick-tips':
        case 'student-focus':
        case 'song-tutorials':
        case 'solos':
            return [
                {
                    name: 'Lessons',
                    short_name: 'LESSONS',
                    value: [''],
                },
                {
                    name: 'Instructors',
                    short_name: 'INSTRUCTORS',
                    is_group_by: true,
                    value: ['instructor'],
                },
                {
                    name: 'Genres',
                    short_name: 'Genres',
                    is_group_by: true,
                    value: ['style'],
                },
            ];
            break;
    }
}

