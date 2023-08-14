import UsersIndex from '../views/users/UsersIndex.vue';
import UserEdit from '../views/users/UserEdit.vue';
import CustomersIndex from '../views/customers/CustomersIndex.vue';
import CustomerEdit from '../views/customers/CustomerEdit.vue';

export default [
    {
        path: '/users',
        name: 'users',
        component: UsersIndex,
    },
    {
        path: '/users/:id',
        name: 'users.edit',
        component: UserEdit,
    },
    {
        path: '/customers',
        name: 'customers',
        component: CustomersIndex,
    },
    {
        path: '/customers/:id',
        name: 'customers.edit',
        component: CustomerEdit,
    },
];
