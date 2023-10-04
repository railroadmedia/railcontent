<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Staff Pick Ratings</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                    >
                        <v-icon>help</v-icon>
                    </v-btn>
                </template>

                <span>These inputs control the order this content appears in the staff<br>picks section on either the catalogue or the home page.</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form ref="editForm">
                <v-select
                    v-model="$_staff_pick_rating"
                    label="Staff Pick Rating"
                    :items="range(13)"
                    :color="brandColor"
                ></v-select>

                <v-select
                    v-model="$_home_staff_pick_rating"
                    label="Home Page Staff Pick Rating"
                    :items="range(13)"
                    :color="brandColor"
                ></v-select>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import ContentStore from '../../../mixins/content-store';

export default {
    name: 'StaffPicks',
    mixins: [brandColors, ContentStore],
    props: {
        staffPickRating: {
            type: Object,
        },
        homeStaffPickRating: {
            type: Object,
        },
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        $_staff_pick_rating: {
            get() {
                return Number(this.thisPost.staff_pick_rating.value);
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'staff_pick_rating',
                    val,
                    deleted: val === 0,
                    child: this.isChild,
                });
            },
        },

        $_home_staff_pick_rating: {
            get() {
                return Number(this.thisPost.home_staff_pick_rating.value);
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'home_staff_pick_rating',
                    val,
                    deleted: val === 0,
                    child: this.isChild,
                });
            },
        },
    },
    methods: {
        range: (length, start = 0) => Utils.range(length, start),

        appendNewResource(event) {
            this.$emit('appendNewResource', event);
        },
    },
};
</script>
