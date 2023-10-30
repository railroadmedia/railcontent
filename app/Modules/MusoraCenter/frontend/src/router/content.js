import ContentIndex from '../views/content/ContentIndex';
import ContentEdit from '../views/content/ContentEdit';
import ContentStatistics from '../views/content/ContentStatistics';

export default [
    {
        path: '/content/statistics',
        name: 'content.statistics',
        component: ContentStatistics,
        query: {},
    },
    {
        path: '/content/:brand',
        name: 'content',
        component: ContentIndex,
        query: {},
    },
    {
        path: '/content/:brand/:id',
        name: 'content.edit',
        component: ContentEdit,
    },
];
