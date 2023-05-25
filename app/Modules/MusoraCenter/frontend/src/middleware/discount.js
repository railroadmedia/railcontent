import discountsAPI from '../api/ecommerce/discounts';

export default {

    /**
     * Check if the discount to be edited is cached in store
     * if not load from server or show not found page
     *
     * @param {object} instance - the component instance for the accessed view
     */
    discountEdit(instance) {
        instance.$root.$emit('pageLoading');

        discountsAPI.getDiscountById(instance.$route.params.id)
            .then((response) => {
                if (response) {
                    instance.setCurrentDiscount(response.data.data);
                    instance.setIncludedData(response.data.included);
                } else {
                    instance.$router.push({ name: '404' });
                }

                instance.$root.$emit('pageLoaded');
            });
    },
};
