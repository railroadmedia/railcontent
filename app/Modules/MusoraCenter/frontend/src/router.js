import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';
import Error404 from './views/errors/404.vue';
import Error401 from './views/errors/401.vue';
import Content from './router/content';
import Users from './router/users';
import Products from './router/products';
import Discounts from './router/discounts';
import CommentsIndex from './views/comments/CommentsIndex.vue';
import BrandStats from './views/analytics/BrandStats.vue';
import OrdersIndex from './views/orders/OrdersIndex.vue';
import FailedBillingIndex from './views/failed-billing/FailedBillingIndex.vue';
import ShippingIndex from './views/shipping/ShippingIndex.vue';
import ShippingFulfillmentIndex from './views/shipping-fulfillment/ShippingFulfillmentIndex.vue';
import MentorsIndex from './views/mentors/MentorsIndex.vue';
import OrderEdit from './views/orders/OrderEdit.vue';
import AccessCodesIndex from './views/access-codes/AccessCodesIndex.vue';
import DailyStats from './views/daily-stats/DailyStats.vue';
import CustomScripts from './views/CustomScripts.vue';
import Changelog from './views/changelog/Changelog.vue';
import AccountingReportingIndex from './views/accounting-reporting/AccountingReportingIndex.vue';
import MembershipStats from './views/membership-stats/MembershipStats.vue';
import RetentionStats from './views/retention-stats/RetentionStats.vue';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/404',
            name: '404',
            component: Error404,
        },
        {
            path: '/401',
            name: '401',
            component: Error401,
        },
        {
            path: '/analytics',
            name: 'analytics',
            component: BrandStats,
        },
        {
            path: '/comments/:brand',
            name: 'comments',
            component: CommentsIndex,
        },
        ...Content,
        ...Users,
        ...Discounts,
        ...Products,
        {
            path: '/daily-stats',
            name: 'daily-stats',
            component: DailyStats,
        },
        {
            path: '/orders',
            name: 'orders',
            component: OrdersIndex,
        },
        {
            path: '/orders/:id',
            name: 'orders.edit',
            component: OrderEdit,
        },
        {
            path: '/failed-billing',
            name: 'failed-billing',
            component: FailedBillingIndex,
        },
        {
            path: '/shipping',
            name: 'shipping',
            component: ShippingIndex,
        },
        {
            path: '/shipping-fulfillment',
            name: 'shipping-fulfillment',
            component: ShippingFulfillmentIndex,
        },
        {
            path: '/mentors',
            name: 'mentors',
            component: MentorsIndex,
        },
        {
            path: '/access-codes',
            name: 'access-codes',
            component: AccessCodesIndex,
        },
        {
            path: '/changelog',
            name: 'changelog',
            component: Changelog,
        },
        {
            path: '/scripts',
            name: 'scripts',
            component: CustomScripts,
        },
        {
            path: '/accounting-reporting',
            name: 'accounting-reporting',
            component: AccountingReportingIndex,
        },
        {
            path: '/membership-stats',
            name: 'membership-stats',
            component: MembershipStats,
        },
        {
            path: '/retention-stats',
            name: 'retention-stats',
            component: RetentionStats,
        },
    ],
});
