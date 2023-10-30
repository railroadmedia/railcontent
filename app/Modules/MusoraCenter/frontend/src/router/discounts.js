import DiscountsIndex from '../views/discounts/DiscountsIndex.vue';
import DiscountEdit from '../views/discounts/DiscountEdit.vue';

export default [
    {
        path: '/discounts',
        name: 'discounts',
        component: DiscountsIndex,
    },
    {
        path: '/discounts/:id',
        name: 'discounts.edit',
        component: DiscountEdit,
    },
];
