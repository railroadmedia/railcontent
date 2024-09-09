export const getTabData = (type, title) => {
    switch(type){
        case 'courses':
            return [
                {
                    value: 'Courses',
                    groupByView: false,
                    key: '',
                },
                {
                    value: 'Instructors',
                    groupByView: true,
                    key: ['instructor'],
                },
                {
                    value: 'Genres',
                    groupByView: true,
                    key: ['genre'],
                },
            ];

        case 'play-alongs':
            return [
                {
                    value: 'All Play Alongs',
                    groupByView: false,
                    key: '',
                }
            ];

        case 'routines':
            return [
                {
                    value: 'All Routines',
                    groupByView: false,
                    key: '',
                }
            ];

        case 'spotlight':
            return [
                {
                    value: 'All Spotlights',
                    groupByView: false,
                    key: '',
                }
            ];

        case 'rudiments':
            return [
                {
                    value: 'All',
                    groupByView: false,
                    key: '',
                },
                {
                    value: 'Drags',
                    groupByView: false,
                    is_required_field: true,
                    key: ['topic[0]->name,Drags'],
                },
                {
                    value: 'Flams',
                    groupByView: false,
                    is_required_field: true,
                    key: ['topic[0]->name,Flams'],
                },
                {
                    value: 'Paradiddles',
                    groupByView: false,
                    is_required_field: true,
                    key: ['topic[0]->name,Paradiddles'],
                },
                {
                    value: 'Rolls',
                    groupByView: false,
                    is_required_field: true,
                    key: ['topic[0]->name,Rolls'],
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
                    value: 'Lessons',
                    groupByView: false,
                    key: '',
                },
                {
                    value: 'Instructors',
                    groupByView: true,
                    key: ['instructor'],
                },
                {
                    value: 'Genres',
                    groupByView: true,
                    key: ['genre'],
                },
            ];
            break;

        default:
            return [
                { key: ``, value: `All ${title}` }
            ]
    }
}

