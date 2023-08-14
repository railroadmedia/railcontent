<template>
    <v-list dense>
        <v-subheader>Last 10 Users Visited</v-subheader>
        <v-list-item
            v-for="user in savedUsers"
            :key="user.id"
            :to="{ name: 'users.edit', params: { id: user.id } }"
        >
            <v-list-item-avatar>
                <img
                    :src="user.attributes.profile_picture_url ||
                        'https://dmmior4id2ysr.cloudfront.net/assets/images/avatar.svg'"
                >
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title v-html="user.attributes.display_name"></v-list-item-title>
                <v-list-item-subtitle v-html="user.attributes.email"></v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="!savedUsers.length">
            No Users visited yet..
        </v-list-item>
    </v-list>
</template>
<script>
import brandColors from '../../api/mixins.js';

export default {
    name: 'UserHistory',
    mixins: [brandColors],
    computed: {
        savedUsers() {
            return JSON.parse(localStorage.getItem('saved_users')) || [];
        },
    },
};
</script>
