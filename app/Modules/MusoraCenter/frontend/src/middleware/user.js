import Utils from '../api/utils';
import usersAPI from '../api/users';

export default {

    userIndex(instance) {
        if (instance.auth.currentUser.permission_level !== 'super_administrator') {
            if (instance.auth.currentUser.permissions.indexOf('users') === -1) {
                instance.$router.push({ name: '401' });
            }
        }
    },

    /**
     * Check if the user you are trying to edit actually exists
     *
     * @param {object} instance - the component instance for the view you're trying to access
     * @param userId
     */
    userEdit(instance, userId) {
        instance.getCurrentUser({ id: 0, attributes: {} });
        instance.$root.$emit('pageLoading');

        usersAPI.getUserById(userId)
            .then((response) => {
                instance.$root.$emit('pageLoaded');

                // If we get a user add it to the state and stay on the page
                // Otherwise redirect to the 404 page
                if (!Utils.isEmpty(response.data)) {
                    instance.getCurrentUser(response.data.data);

                    this.addUserToLocalStorage(response.data.data);
                } else {
                    instance.$router.push({ name: '404' });
                }
            });
    },

    /**
     * Add user to the local storage object for ease of access
     */
    addUserToLocalStorage(user) {
        let savedUsers = JSON.parse(localStorage.getItem('saved_users')) || [];
        const tenSavedUsers = savedUsers.length === 10 ? 1 : 0;

        savedUsers = savedUsers.filter(savedUser => savedUser.id !== user.id);

        savedUsers.splice(0, tenSavedUsers, user);

        localStorage.setItem('saved_users', JSON.stringify(savedUsers));
    },
};
