export default {
    data() {
        return {
            page: 1,
            totalPages: 0,
            perPage: 25,
            order_by_column: 'created_at',
            order_by_direction: 'desc',
        }
    },

    computed: {
        $_page: {
            get() {
                return this.page;
            },
            set(value) {
                this.page = value;

                this.fetchData();
            },
        },

        $_order_by_column: {
            get() {
                return this.order_by_column;
            },
            set(value) {

                // dont forget to set datatable :must-sort="true"

                this.order_by_column = Array.isArray(value) ? value[0] : value;

                this.fetchData();
            },
        },

        $_order_by_direction: {
            get() {
                return this.order_by_direction.toLowerCase() == 'desc';
            },
            set(value) {
                this.order_by_direction = value ? 'desc' : 'asc';

                this.fetchData();
            },
        },
    },

    methods: {

        fetchData() {
            // no-op, when using mixin for data tabels, override this method to pull data from server
        },
    },
};
