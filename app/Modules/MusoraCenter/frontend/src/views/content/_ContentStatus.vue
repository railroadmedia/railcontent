<template>
    <div>
        <v-tooltip top>
            <template v-slot:activator="{ on }">
                <v-icon
                    :color="status_map.color"
                    v-on="on"
                >
                    {{ status_map.icon }}
                </v-icon>
            </template>

            <span style="text-transform:capitalize;">{{ status }}</span>
        </v-tooltip>
    </div>
</template>
<script>

export default {
    name: 'ContentStatus',
    props: {
        status: {
            type: String,
            default: () => 'draft',
        },
    },
    computed: {
        status_map() {
            const status_map = {
                published: {
                    icon: 'check',
                    color: 'success',
                },
                scheduled: {
                    icon: 'calendar_today',
                    color: 'blue lighten-3',
                },
                draft: {
                    icon: 'drafts',
                    color: 'grey lighten-2',
                },
                archived: {
                    icon: 'archive',
                    color: 'error',
                },
            };

            return status_map[this.status];
        },
    },
};
</script>
