import api from '../api/ecommerce/orders';

export default {
    /**
     * Check if the user you are trying to edit actually exists
     *
     * @param {object} instance - the component instance for the view you're trying to access
     */
    orderEdit(instance) {
        instance.$root.$emit('pageLoading');

        api.getOrderById(instance.orderId)
            .then((response) => {
                instance.$root.$emit('pageLoaded');

                if (response) {
                    instance.currentOrder = response.data.data;
                    instance.currentOrderIncludedData = response.data.included;

                    if (response.data.data.relationships.user) {
                        instance.getUser(response.data.data.relationships.user.data.id);
                    }

                    if (response.data.data.relationships.customer) {
                        instance.getCustomer(response.data.data.relationships.customer.data.id);
                    }
                } else {
                    instance.$router.push({ name: '404' });
                }
            });
    },
};
