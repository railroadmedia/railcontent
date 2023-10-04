<template>
    <v-menu
        bottom
        left
    >
        <template v-slot:activator="{ on }">
            <v-btn
                slot="activator"
                text
                icon
                v-on="on"
            >
                <v-icon>more_vert</v-icon>
            </v-btn>
        </template>

        <v-list dense>
            <v-list-item
                v-if="menuIndex !== 0"
                @click.stop.prevent="moveUp(menuItem)"
            >
                <v-list-item-content>Move Up</v-list-item-content>
                <v-list-item-action>
                    <v-icon>keyboard_arrow_up</v-icon>
                </v-list-item-action>
            </v-list-item>
            <v-list-item
                v-if="menuIndex !== (length - 1)"
                @click.stop.prevent="moveDown(menuItem)"
            >
                <v-list-item-content>Move Down</v-list-item-content>
                <v-list-item-action>
                    <v-icon>keyboard_arrow_down</v-icon>
                </v-list-item-action>
            </v-list-item>
            <v-list-item
                v-if="editButton"
                @click.stop.prevent="editItem(menuItem)"
            >
                <v-list-item-content>Edit</v-list-item-content>
                <v-list-item-action>
                    <v-icon>edit</v-icon>
                </v-list-item-action>
            </v-list-item>
            <v-list-item
                v-if="deleteButton"
                @click.stop.prevent="deleteItem(menuItem)"
            >
                <v-list-item-content>Delete</v-list-item-content>
                <v-list-item-action>
                    <v-icon color="error">
                        delete
                    </v-icon>
                </v-list-item-action>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script>
export default {
    name: 'VCustomOptionsMenu',
    props: {
        active: {
            type: Boolean,
            default: false,
        },
        editButton: {
            type: Boolean,
            default: () => false,
        },
        deleteButton: {
            type: Boolean,
            default: () => false,
        },
        menuItem: {
            type: Object,
        },
        menuIndex: {
            type: Number,
            default: () => 0,
        },
        length: {
            type: Number,
            default: () => 0,
        },
    },
    methods: {
        moveUp(item) {
            this.$emit('movedUp', item);
        },

        moveDown(item) {
            this.$emit('movedDown', item);
        },

        editItem(item) {
            this.$emit('editItem', item);
        },

        deleteItem(item) {
            this.$emit('deleteItem', item);
        },
    },
};
</script>
