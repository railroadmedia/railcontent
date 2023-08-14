export default {

    /**
     * Check if the user has permission to access the given section
     *
     * @param {object} instance - the component instance for the view you're trying to access
     * @param {string} section - the section/route name
     */
    admin(instance, section) {
        // Todo: remove this or figure out issue
        if (!instance.auth.currentUser) return;
        if (instance.auth.currentUser.permission_level !== 'super_administrator') {
            if (instance.auth.currentUser.permissions.indexOf(section) === -1) {
                instance.$router.push({name: '401'});
            }
        }
    },
};
