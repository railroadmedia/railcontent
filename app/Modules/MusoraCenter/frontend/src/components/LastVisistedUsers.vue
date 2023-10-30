<template>
    <div>
        <v-btn v-for="user in users" :key="user.id" class="recent-user-button" :to="getUserLink(user)">
            {{ user.attributes.email }}
        </v-btn>
    </div>
</template>


<script>
export default {
    name: 'LastVisitedUsers',
    computed: {
        users() {
            return JSON.parse(localStorage.getItem('saved_users')) || [];
        }
    },
    methods: {
        getUserLink(user) {
            return { name: 'users.edit', params: { id: user.id }};
        }
    }
};
</script>
