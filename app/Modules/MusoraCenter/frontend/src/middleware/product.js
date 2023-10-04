import api from '../api/ecommerce/products';

export default {
    productEdit(instance) {
        instance.loading = true;
        instance.$root.$emit('pageLoading');

        api.getProductById(instance.$route.params.id)
            .then((response) => {
                if (response) {
                    instance.setCurrentProduct(response.data.data);
                } else {
                    instance.$router.push({ name: '404' });
                }

                instance.$root.$emit('pageLoaded');
            });
    },
};
