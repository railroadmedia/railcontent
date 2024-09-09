export const getTabData = () => {
    return [
        {
            value: 'Songs',
            groupByView: false,
            key: '',
        },
        {
            value: 'Artists',
            groupByView: true,
            key: ['artist'],
        },
        {
            value: 'Genres',
            groupByView: true,
            key: ['genre'],
        },
    ];
}
