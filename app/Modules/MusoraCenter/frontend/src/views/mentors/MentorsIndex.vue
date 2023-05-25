<template>
    <v-container>
        <v-row
            align="center"
        >
            <v-col
                class="column"
                cols="12"
            >
                <v-custom-breadcrumbs
                    :breadcrumbs="breadcrumbs"
                ></v-custom-breadcrumbs>
            </v-col>

            <v-col
                class="column"
                cols="12"
            >
                <last-visited-users></last-visited-users>
            </v-col>

            <v-col
                class="column"
                cols="12"
            >


                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        Mentors
                    </v-toolbar-title>
                    <v-spacer class="hidden-xs-only"></v-spacer>
                    <v-col>
                        <v-text-field
                            v-model="searchTerm"
                            label="Search"
                            color="white"
                            append-icon="search"
                            :loading="loading"
                            single-line
                            clearable
                            hide-details
                            @keyup.enter="fetchData()"
                        ></v-text-field>
                    </v-col>
                    <v-btn light @click="fetchData()">Search</v-btn>
                </v-toolbar>

                <v-data-table
                    :headers="headers"
                    :items="mentors"
                    :loading="loading"
                    :items-per-page="15"
                    :sort-by.sync="$_order_by_column"
                    :sort-desc.sync="$_order_by_direction"
                    class="elevation-1"
                    no-results-text="No Results Found"
                    hide-default-footer
                    :multi-sort="false"
                    :must-sort="true"
                >
                    <template v-slot:item="{ item }">
                        <tr
                            style="cursor:pointer;"
                        >
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                                class="text-center user-data-td"
                            >
                                <v-avatar size="36px">
                                    <img :src="getUserAvatar(item)">
                                </v-avatar>
                            </linkable-td>
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                            >
                                {{ item.user_id }}
                            </linkable-td>
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                            >
                                {{ item.email }}
                            </linkable-td>
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                            >
                                {{ item.display_name }}
                            </linkable-td>
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                            >
                                {{ item.supported_brands }}
                            </linkable-td>
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                                class="text-center">
                                {{ item.total_student_count }}
                            </linkable-td>
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                                class="text-center">
                                {{ item.active_student_count }}
                            </linkable-td>
                            <linkable-td
                                :to="{ name: 'users.edit', params: { id: item.user_id }}"
                                class="text-center">
                                {{ item.active_student_max_count }}
                            </linkable-td>
                        </tr>
                    </template>
                </v-data-table>
                <div class="text-center mb-2">
                    <v-pagination
                        v-model="$_page"
                        :length="totalPages"
                        :color="brandColor"
                        :total-visible="9"
                    ></v-pagination>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import {mapState, mapActions} from 'vuex';
import brandColors from '../../api/mixins.js';
import MentorAPI from '../../api/mentors.js';
import Middleware from '../../middleware/auth';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import JsonApiMethods from '../../mixins/json-api-methods';
import JsonApiCollectionMethods from '../../mixins/json-api-collection-methods';
import LinkableTD from '../../components/LinkableTD.vue';

export default {
    name: 'Mentors',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'last-visited-users': LastVisistedUsers,
        'linkable-td': LinkableTD,
    },
    mixins: [brandColors, JsonApiMethods, JsonApiCollectionMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => {
            Middleware.admin(vm, 'mentors');
        });
    },
    data() {
        return {
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: {name: 'home'},
                },
                {
                    text: 'Mentors',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Avatar',
                    align: 'center',
                    sortable: false,
                    value: 'profile_picture_image_url',
                    width: 60,
                },
                {
                    text: 'User Id',
                    sortable: false,
                    value: 'user_id',
                    width: 50,
                },
                {
                    text: 'Email',
                    sortable: false,
                    value: 'email',
                    width: 250,
                },
                {
                    text: 'Display Name',
                    sortable: false,
                    value: 'display_name',
                    width: 250,
                },
                {
                    text: 'Supported Brands',
                    sortable: false,
                    value: 'supported_brands',
                },
                {
                    text: 'Total Student Count',
                    align: 'center',
                    sortable: false,
                    value: 'total_student_count',
                    width: 100,
                }, {
                    text: 'Active Student Count',
                    align: 'center',
                    sortable: false,
                    value: 'active_student_count',
                    width: 100,
                },
                {
                    text: 'Max Student Count',
                    align: 'center',
                    sortable: false,
                    value: 'active_student_max_count',
                    width: 100,
                },
            ],
            loading: false,
            dialog: false,
            searchTerm: '',
            mentors: [],
        };
    },
    computed: {
        ...mapState({
            state: state => state.shipping,
            auth: state => state.auth,
        }),
    },
    methods: {
        fetchData() {
            this.loading = true;
            MentorAPI.getMentorsPaged(this.page, this.searchTerm)
                .then((response) => {
                    if (response) {
                        this.mentors = response.data.data;
                        this.page = response.data.current_page;
                        this.totalPages = response.data.last_page;
                    }
                    this.loading = false;
                });
        },
        getUserAvatar(mentor) {
            if (!mentor.display_name) return;
            const displayName = mentor.display_name.replace(/ /, '+');

            return mentor.profile_picture_url
                || `https://ui-avatars.com/api/?name=${displayName}&size=100&bold=true&background=00b0ff&color=FFFFFF`;
        },
    },
    mounted() {
        this.page = this.$route.query.page ? Number(this.$route.query.page) : 1;
        this.fetchData();
    },
};
</script>
