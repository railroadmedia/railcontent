/**
 * Toasts
 * Methods for handling all success/error/dialog notifications with nicely styled prompts and dialogs.
 */

export default {

    /**
     * TODO: DELETE
     * 
     * DISCLAIMER: THIS FILE SHOULD BE DELETED AT SOME POINT AND MIGRATE EVERYTHING TO VUE
     * ONCE ALL CALLS COME FROM WITHIN THE VUE CONTEXT
     * 
     * Display a notification
     *
     * @param {String} icon - the icon to use ('happy', 'doh', 'astonished', 'mad', 'sad', 'xp')
     * @param {String} title - the colored title to display
     * @param {String} message - the bolded black message
     * @param {String} themeColor - the vuesora theme color for the title
     * @param {Number|Boolean} timeout - duration in milliseconds before it disappears (false to remove)
     */
    push({
        icon,
        title,
        message,
        hideCancel,
    }) {
        const iconMap = {
            happy: 'check',
            doh: 'warning',
            astonished: 'warning',
            mad: 'error',
            sad: 'error',
            xp: 'xp',
        };

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
        }

        if (typeof window.shownotification === 'function') {
            window.shownotification({
                icon: iconMap[icon],
                text: `${capitalizeFirstLetter(title)} ${capitalizeFirstLetter(message)}`
            })
        }
    },

    /**TODO: DELETE
     * 
     * DISCLAIMER: THIS FILE SHOULD BE DELETED AT SOME POINT AND MIGRATE EVERYTHING TO VUE
     * ONCE ALL CALLS COME FROM WITHIN THE VUE CONTEXT
     * Display a confirmation dialog
     *
     * @param {String} title - the text to display in the confirmation box
     * @param {String} subtitle - the smaller text to display below the title
     * @param {String} themeColor - the vuesora theme color for the title
     * @param {Object} submitButton - object with a text and callback property
     * @param {Object} cancelButton - object with a text and callback property
     */
    confirm({
        title,
        subtitle = 'This cannot be undone',
        hideCancel,
        submitLabel,
        submitButton = {
            callback: null,
        },
        cancelButton = {
            callback: null,
        },
    }) {
        window.showconfirmationmodal({
            title,
            subtitle,
            hideCancel,
            submitLabel,
            callbacks: {
                submit: submitButton.callback,
                cancel: cancelButton.callback
            },
        });
    },
};
