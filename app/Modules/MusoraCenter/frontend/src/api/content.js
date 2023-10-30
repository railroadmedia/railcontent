import axios from 'axios';
import ErrorHandler from './error-handler';

export default {

    getFieldFiltersValues() {
        return axios
            .get('/railcontent/content-statistics/field-filters-values')
            .then(response => response.data)
            .catch(ErrorHandler.push);
    },

    getCancelToken() {
        return axios.CancelToken.source();
    },

    /**
     * Get content statistics
     *
     * @param {datetime|string} small_date_time
     * @param {datetime|string} big_date_time
     * @param {datetime|string} published_on_small_date_time
     * @param {datetime|string} published_on_big_date_time
     * @param {string} brand
     * @param {array} content_types
     * @param {string} sort_by
     * @param {string} sort_dir
     * @param {number} stats_epoch
     * @param {Promise} cancel_token
     * @param {array} difficulty_fields
     * @param {array} instructor_fields
     * @param {array} style_fields
     * @param {array} tag_fields
     * @param {array} topic_fields
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getContentStatistics({
        small_date_time,
        big_date_time,
        published_on_small_date_time,
        published_on_big_date_time,
        brand,
        content_types,
        sort_by,
        sort_dir,
        stats_epoch,
        cancel_token,
        difficulty_fields,
        instructor_fields,
        style_fields,
        tag_fields,
        topic_fields
    }) {
        return axios
            .get(`/railcontent/content-statistics`, {
                cancelToken: cancel_token,
                params: {
                    small_date_time,
                    big_date_time,
                    published_on_small_date_time,
                    published_on_big_date_time,
                    brand,
                    content_types,
                    sort_by,
                    sort_dir,
                    stats_epoch,
                    difficulty_fields,
                    instructor_fields,
                    style_fields,
                    tag_fields,
                    topic_fields
                },
            })
            .then(response => response.data)
            .catch(ErrorHandler.push);
    },

    /**
     * Get individual content statistics
     *
     * @param {number} content_id
     * @param {datetime|string} small_date_time
     * @param {datetime|string} big_date_time
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getIndividualContentStatistics({
        content_id,
        small_date_time,
        big_date_time
    }) {
        return axios
            .get(`/railcontent/content-statistics/individual/${content_id}`, {
                params: {
                    small_date_time,
                    big_date_time
                },
            })
            .then(response => response.data)
            .catch(error => {
                ErrorHandler.push(error);
                throw error;
            });
    },

    /**
     * Get a list of content from full text search api
     *
     * @param {string} brand
     * @param {number|string} limit
     * @param {array} statuses - Accepted values ('published', 'scheduled', 'draft', 'archived')
     * @param {string} sort
     * @param {string} term
     * @param {array} included_types
     * @param {number|string} page
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getSearchedContent({
        brand = 'drumeo',
        limit = '20',
        statuses = ['published', 'scheduled', 'draft'],
        sort = '-score',
        term,
        included_types,
        page = '1',
    }) {
        return axios
            .get('/railcontent/search', {
                params: {
                    brand,
                    limit,
                    statuses,
                    sort,
                    term,
                    included_types,
                    page,
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a list of content
     *
     * @param {string} brand
     * @param {number|string} limit
     * @param {array} statuses - Accepted values ('published', 'scheduled', 'draft', 'archived')
     * @param {string} sort
     * @param {string} term
     * @param {array} included_types
     * @param {array} included_fields
     * @param required_fields
     * @param {number|string} page
     * @returns {Promise} - resolved promise with the response object
     */
    getContent({
        brand = 'drumeo',
        limit = '20',
        statuses = ['published', 'scheduled', 'draft'],
        sort = '-created_on',
        term,
        included_types,
        included_fields,
        required_fields,
        page = '1',
    }) {
        return axios
            .get('/railcontent/content', {
                params: {
                    brand,
                    limit,
                    statuses,
                    sort,
                    term,
                    included_types,
                    included_fields,
                    required_fields,
                    page,
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Create a content item
     *
     * @param {string} brand
     * @param {string} title
     * @param {string} status
     * @param {string} type
     * @param {string|number} parent_id
     * @param {datetime} published_on
     * @returns {Promise} - resolved promise with the response object
     */
    setContent({
        brand,
        title,
        status = 'draft',
        type,
        parent_id,
        published_on,
    }) {
        const slug = title.toLowerCase()
            .replace(/[.,\/#!$%&;:{}=_`~()]/g, '')
            .replace(/ /g, '-');

        return axios.put('/railcontent/content', {
            brand,
            slug,
            type,
            status,
            parent_id,
            published_on,
        })
            .then(response => response);
    },

    /**
     * Get a specific content post by ID
     *
     * @param {string|number} id
     * @returns {Promise} - resolved promise with the response object
     */
    getContentById(id) {
        return axios
            .get(`/railcontent/content/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },


    /**
     * Get content children by a specific ID
     *
     * @param {string|number} id
     * @returns {Promise} - resolved promise with the response object
     */
    getContentChildren(id) {
        return axios.get(`/railcontent/content/parent/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get content parent by a specific ID and type
     *
     * @param {string|number} id
     * @param {string} type
     * @returns {Promise} - resolved promise with the response object
     */
    getContentParent(id, type) {
        return axios.get(`/railcontent/content/child/${id}/${type}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a content hierarchy
     *
     * @param {string|number} parent_id
     * @param {string|number} child_id
     * @param {string|number} child_position
     * @returns {Promise} - resolved promise with the response object
     */
    setContentHierarchy({
        parent_id,
        child_id,
        child_position,
    }) {
        return axios.put('/railcontent/content/hierarchy', {
            parent_id,
            child_id,
            child_position,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete a content heirarchy by parent and child id
     *
     * @param {string|number} parent_id
     * @param {string|number} child_id
     * @returns {Promise} - resolved promise with the response object
     */
    deleteContentHierarchy({
        parent_id,
        child_id,
    }) {
        return axios.delete(`/railcontent/content/hierarchy/${parent_id}/${child_id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a content property by content id
     *
     * @param content_id {string|number}
     * @param slug {string}
     * @param type {string}
     * @param status {string}
     * @param sort {number|string}
     * @param brand {string}
     * @param published_on {datetime|string}
     * @param cancelToken
     * @param instrument
     * @param instrumentless
     * @returns {Promise} - resolved promise with the response object
     */
    setContentProperty({
        content_id,
        slug,
        type,
        status,
        sort,
        brand,
        published_on,
        cancelToken,
        instrument,
        instrumentless,
    }) {
        return axios.patch(`/railcontent/content/${content_id}`, {
            slug,
            type,
            status,
            brand,
            sort,
            published_on,
            cancelToken,
            instrument,
            instrumentless,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a content field by content id and key value pair with position
     *
     * @param field_id {string|number}
     * @param content_id {string|number}
     * @param key {string}
     * @param value {string|number}
     * @param position {string|number}
     * @param type {string}
     * @param deleted {boolean}
     * @param cancelToken
     * @returns {Promise} - resolved promise with the response object
     */
    setContentField({
        field_id,
        content_id,
        key,
        value,
        position,
        type,
        deleted = false,
        cancelToken,
    }) {
        const url = field_id
            ? `/railcontent/content/field/${field_id}`
            : '/railcontent/content/field';
        const method = deleted ? 'DELETE' : (field_id ? 'PATCH' : 'PUT');

        return axios({
            method,
            url,
            data: {
                id: field_id,
                content_id,
                key,
                value,
                position,
                type,
                cancelToken,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a content datum by content id and key value pair with position
     *
     * @param datum_id {string|number}
     * @param content_id {string|number}
     * @param key {string}
     * @param value {string|number}
     * @param position {string|number}
     * @param type {string}
     * @param deleted {boolean}
     * @param cancelToken
     * @returns {Promise} - resolved promise with the response object
     */
    setContentDatum({
        datum_id,
        content_id,
        key,
        value,
        position,
        type,
        deleted = false,
        cancelToken,
    }) {
        const url = datum_id
            ? `/railcontent/content/datum/${datum_id}`
            : '/railcontent/content/datum';

        const method = deleted ? 'DELETE' : (datum_id ? 'PATCH' : 'PUT');

        return axios({
            method,
            url,
            data: {
                id: datum_id,
                content_id,
                key,
                value,
                position,
                type,
                cancelToken,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Assign a permission to content
     *
     * @param content_id {string|number}
     * @param permission_id {string|number}
     * @param deleted {boolean}
     * @returns {Promise} - resolved promise with the response object
     */
    setContentPermission({
        content_id,
        permission_id,
        brand,
        deleted = false,
    }) {
        const url = deleted
            ? '/railcontent/permission/dissociate'
            : '/railcontent/permission/assign';

        return axios({
            url,
            method: deleted ? 'PATCH' : 'PUT',
            data: {
                content_id,
                permission_id,
                brand,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Create a soundslice
     *
     * @param {string} name
     * @param {string} brand
     * @returns {Promise} - resolved promise with the response object
     */
    createSoundslice({
        name,
        brand = 'drumeo',
    }) {
        const folders = {
            drumeo: '5205',
            guitareo: '5206',
            pianote: '5207',
        };

        return axios.put('/soundslice/create', {
            name,
            'embed-white-list-only': true,
            'folder-id': folders[brand] || '5205',
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a soundslice score to a specific url
     *
     * @param {string} slug
     * @param {string} asset_url
     * @returns {Promise} - resolved promise with the response object
     */
    setSoundsliceScore({
        slug,
        asset_url,
    }) {
        return axios.put('/soundslice/notation', {
            slug,
            'asset-url': asset_url,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get the internal content id for a vimeo our youtube video
     *
     * @param {string} brand
     * @param {string} type - video type (vimeo or youtube)
     * @param {string|number} id
     * @returns {string|number} - The internal id
     */
    getInternalVideoId({
        brand = 'drumeo',
        type,
        id,
    }) {
        const includedField = `${type},${id}`;

        return this.getContent({
            brand,
            included_fields: [includedField],
        })
            .then(response => response);
    },

    /**
     * Callbacks to handle the changing of an array of items
     *
     * @param newArray {array}
     * @param oldArray {array}
     * @param onCreated {function} - callback when an item is added
     * @param onDeleted {function} - callback when an item is deleted
     * @param onNoChange {function} - callback when the length is the same
     */
    handleArrayChange({
        newArray,
        oldArray,
        onCreated = () => console.log('An item was added'),
        onDeleted = () => console.log('An item was deleted'),
        onNoChange = () => console.warn('No change in the length of the array'),
    }) {
        if (newArray.length > oldArray.length) {
            onCreated();
        } else if (newArray.length < oldArray.length) {
            onDeleted();
        } else {
            onNoChange();
        }
    },

    /**
     * Parse the content rules object for the current content type and brand
     *
     * @param rules - The ContentModel constructor with the current type
     * @param brand - The brand to parse the rules for
     * @returns {object} - the content rules object
     */
    parseContentModelForTypeAndBrand(rules, brand) {
        const contentModel = {};

        Object.keys(rules).forEach((rule) => {
            if (rules[rule] != null) {
                if (rules[rule].brands.indexOf(brand) !== -1) {
                    contentModel[rule] = rules[rule];
                }
            }
        });

        return contentModel;
    },

    /**
     * Get a vimeo video url by vimeo video ID
     *
     * @param vimeoId {String|Number}
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    getVimeoUrlByVimeoId(vimeoId) {
        return axios.get(`/railcontent/vimeo-video/${vimeoId}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Get the rev caption status for a content id.
     *
     * @param lessonContentId {String|Number}
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    getRevCaptionsStatus(lessonContentId) {
        return axios.get(`/caption-order/${lessonContentId}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Submit a new order for the content.
     *
     * @param lessonContentId {String|Number}
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    orderRevCaptions(lessonContentId) {
        return axios.post(`/caption-order/order/${lessonContentId}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Cancel any pending orders for the content.
     *
     * @param lessonContentId {String|Number}
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    cancelRevCaptions(lessonContentId) {
        return axios.post(`/caption-order/cancel/${lessonContentId}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Get a list of all searchable content types
     *
     * @returns {array}
     */
    searchableContentTypes() {
        return [
            {
                type: 'coach-stream',
                label: 'Coach Stream',
                icon: 'icon-student-focus',
                brands: ['drumeo', 'singeo'],
            },
            {
                type: 'recording',
                label: 'Recording',
                icon: 'icon-library',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'course',
                label: 'Course',
                icon: 'icon-courses',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'course-part',
                label: 'Course Part',
                icon: 'icon-library',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'play-along',
                label: 'Play-Along',
                icon: 'icon-play-alongs',
                brands: ['drumeo', 'guitareo', 'pianote'],
            },
            {
                type: 'song',
                label: 'Song',
                icon: 'icon-songs',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'song-tutorial',
                label: 'Song Tutorial',
                icon: 'icon-songs',
                brands: ['pianote'],
            },
            {
                type: 'student-focus',
                label: 'Student Focus',
                icon: 'icon-student-focus',
                brands: ['drumeo', 'singeo'],
            },
            {
                type: 'learning-path',
                label: 'Learning Path',
                icon: 'icon-learning-paths',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'instructor',
                label: 'Instructor',
                icon: 'wc',
                brands: ['drumeo', 'pianote', 'guitareo', 'recordeo'],
            },
            {
                type: 'pack',
                label: 'Pack',
                icon: 'icon-packs',
                brands: ['drumeo', 'pianote', 'guitareo', 'singeo'],
            },
            {
                type: 'pack-bundle',
                label: 'Pack Bundle',
                icon: 'icon-shows',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'pack-bundle-lesson',
                label: 'Pack Bundle Lesson',
                icon: 'icon-shows',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'live',
                label: 'Live',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'question-and-answer',
                label: 'Q&A',
                icon: 'icon-shows',
                brands: ['drumeo', 'pianote', 'singeo'],
            },
            {
                type: 'student-collaborations',
                label: 'Student Collaborations',
                icon: 'icon-shows',
                brands: ['drumeo', 'pianote'],
            },
            {
                type: 'student-review',
                label: 'Student Review',
                icon: 'icon-shows',
                brands: ['drumeo', 'pianote'],
            },
            {
                type: 'gear-guides',
                label: 'Gear Guides',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'rudiment',
                label: 'Rudiment',
                icon: 'icon-shows',
                brands: ['rudiment'],
            },
            {
                type: 'challenges',
                label: 'Challenges',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'boot-camps',
                label: 'Boot Camps',
                icon: 'icon-shows',
                brands: ['drumeo', 'pianote', 'singeo'],
            },
            {
                type: 'quick-tips',
                label: 'Quick Tips',
                icon: 'icon-shows',
                brands: ['drumeo', 'pianote', 'singeo'],
            },
            {
                type: 'podcasts',
                label: 'Podcasts',
                icon: 'icon-shows',
                brands: ['drumeo', 'pianote', 'singeo'],
            },
            {
                type: 'on-the-road',
                label: 'On the road',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'behind-the-scenes',
                label: 'Behind the Scenes',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'study-the-greats',
                label: 'Study the Greats',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'diy-drum-experiments',
                label: 'DIY Drum Experiments',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'solos',
                label: 'Solos',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'performances',
                label: 'Performances',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'exploring-beats',
                label: 'Exploring Beats',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'independence-made-easy',
                label: 'Independence Made Easy',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'sonor-drums',
                label: 'Sonor Drums',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: '25-days-of-christmas',
                label: '25 Days of Christmas',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'camp-drumeo-ah',
                label: 'Camp Drumeo-Ah',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'rhythms-from-another-planet',
                label: 'Rhythms from Another Planet',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'the-history-of-electronic-drums',
                label: 'The History Of Electronic Drums',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'backstage-secrets',
                label: 'Backstage Secrets',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'spotlight',
                label: 'Spotlight',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'paiste-cymbals',
                label: 'Paiste Cymbals',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'entertainment',
                label: 'Entertainment',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'namm-2019',
                label: 'NAMM 2019',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'tama-drums',
                label: 'Tama Drums',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'collaboration',
                label: 'Collaboration',
                icon: 'icon-shows',
                brands: ['drumeo'],
            },
            {
                type: 'learning-path-lesson',
                label: 'Learning Path Lesson',
                icon: 'icon-learning-paths',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'learning-path-course',
                label: 'Learning Path Course',
                icon: 'icon-learning-paths',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
            {
                type: 'learning-path-level',
                label: 'Learning Path Level',
                icon: 'icon-learning-paths',
                brands: ['drumeo', 'guitareo', 'pianote', 'recordeo', 'singeo'],
            },
        ];
    },

    /**
     * Get a list of searchable content types by brand
     *
     * @param {string} brand
     * @returns {array}
     */
    getBrandSearchableContentTypes(brand) {
        return this.searchableContentTypes().filter(type =>
            type.brands.indexOf(brand) !== -1
        );
    },
};
