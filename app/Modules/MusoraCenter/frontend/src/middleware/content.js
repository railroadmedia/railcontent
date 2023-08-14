import { Content as ContentHelpers } from '@musora/helper-functions';
import api from '../api/content';

export default {

    /**
     * Check if the content you are trying to edit actually exists
     *
     * @param {object} instance - the component instance for the view you're trying to access
     * @param {string|number} newId - whether or not to reload the component
     */
    contentEdit(instance, newId) {
        instance.getCurrentPost({});
        instance.loading = true;
        instance.$root.$emit('pageLoading');

        instance.getBrand({
            router: instance.$route,
        });

        api.getContentById(newId || instance.post_id)
            .then((response) => {
                instance.loading = false;
                instance.$root.$emit('pageLoaded');

                if (response) {
                    const currentPost = ContentHelpers.flattenContent(response.data.data)[0];
                    instance.getContentModel({ type: currentPost.type });

                    instance.getCurrentPost({ currentPost });

                    instance.getInstructors({ brand: instance.state.brand, contentType: currentPost.type });
                } else {
                    instance.$router.push({ name: '404' });
                }
            });
    },
};
