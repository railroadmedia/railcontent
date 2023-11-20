import axios from 'axios';
import ErrorHandler from './error-handler';

export default {
    /**
     * Upload an image to the remote S3 server and get the cloudfront CDN url back
     *
     * @static
     * @param {string} url - Sometimes we organize our files in different buckets so a different url might be needed
     * @param {object} form_data - The FormData object containing the file information
     * @returns {Promise} - resolved promise with the response object
     */
    uploadImageToRemoteServer({
        url = '/product/upload',
        form_data,
        csrf_token,
    }) {
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                processData: false,
                contentType: false,
                'X-CSRFToken': csrf_token,
            },
        };

        return axios.post(url, form_data, config)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Find differing object keys in an array of objects
     *
     * @returns {Array} - An Array of all the different objects between the 2 arrays
     */
    getDifferingArrayKeys(originalArray, newArray) {
        function comparer(otherArray) {
            return function (current) {
                return otherArray.filter(other => other.value === current.value && other.id === current.id).length === 0;
            };
        }

        const onlyInOriginal = originalArray.filter(comparer(newArray));
        const onlyInNew = newArray.filter(comparer(originalArray));

        return onlyInOriginal.concat(onlyInNew);
    },

    /**
     * Find item in an object with a specific ID
     *
     * @returns {Number} - Index of the item in the array (0 based), -1 if it doesn't exist
     */
    findUserIndexById(users, id) {
        const userIds = users.map(user => user.id);

        return userIds.indexOf(id);
    },

    /**
     * Create a copy of an object rather than a reference
     *
     * @returns {Object}
     */
    createObjectCopy(object) {
        return JSON.parse(JSON.stringify(object));
    },

    /**
     * Sort an array of objects by key
     *
     * @param array {array}
     * @param key {string|number}
     * @returns {Array}
     */
    dynamicSort(array, key) {
        return array.sort((a, b) => {
            if (typeof a[key] === 'string') {
                const aKey = a[key].toLowerCase();
                const bKey = b[key].toLowerCase();

                return aKey > bKey ? 1 : (aKey === bKey ? 0 : -1);
            }
            
            return a[key] - b[key];
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

    /**
     * Check if an object is empty
     *
     * @returns {Boolean}
     */
    isEmpty(obj) {
        return Object.keys(obj).length === 0 && obj.constructor === Object;
    },


    /**
     * Return an array of integers between a specific range
     *
     * @param {number} length - the length of the array
     * @param {number} start - the number to start at
     * @returns {Array}
     */
    range(length, start = 0) {
        return [...Array(length).keys()].map(i => i + start);
    },

    /**
     * Get a list of all supported currencies
     *
     * @returns {Array}
     */
    currencies() {
        return [
            'CAD',
            'USD',
            'GBP',
            'EUR',
        ];
    },

    /**
     * Take a string and return it in capital case
     *
     * @returns {String}
     */
    toCapitalCase(string) {
        return string.replace(/\b\w/g, l => l.toUpperCase());
    },

    /**
     * Get a list of all canada provinces
     *
     * @returns {Array}
     */
    provinces() {
        return [
            'Alberta',
            'British Columbia',
            'Manitoba',
            'New Brunswick',
            'Newfoundland And Labrador',
            'Northwest Territories',
            'Nova Scotia',
            'Nunavut',
            'Ontario',
            'Prince Edward Island',
            'Quebec',
            'Saskatchewan',
            'Yukon',
        ];
    },

};
