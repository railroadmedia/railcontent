import ProductsIndex from '../views/products/ProductsIndex';
import ProductsEdit from '../views/products/ProductEdit.vue';

export default [
    {
        path: '/products',
        name: 'products',
        component: ProductsIndex,
    },
    {
        path: '/products/:id',
        name: 'products.edit',
        component: ProductsEdit,
    },
];
