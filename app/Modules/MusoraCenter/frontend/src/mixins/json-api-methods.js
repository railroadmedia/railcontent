export default {
    props: {
        includedData: {
            type: Array,
            default: () => [],
        },
    },

    methods: {

        getRelatedAttributesByTypeAndId({ id, type }, includedData = this.includedData) {
            const data = includedData.find(data => data.id === id && data.type === type);

            return data || { id: 'N/A', attributes: {} };
        },

        getRelatedDataByType(type, includedData = this.includedData) {
            return includedData.filter(data => data.type === type);
        },
    },
};
