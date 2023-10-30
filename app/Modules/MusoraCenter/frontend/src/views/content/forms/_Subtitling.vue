<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Subtitling</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <span>Status: _______________</span>

            <v-form
                v-if="contentModel"
                ref="editForm"
            >
                <v-btn
                        text
                        class="mr-1"
                        @click="newDialog = false"
                >
                    Submit Request For Subtitling
                </v-btn>
            </v-form>
        </v-col>
    </v-card>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import ContentStore from '../../../mixins/content-store';
import brandColors from '../../../api/mixins.js';

export default {
    name: 'Subtitling',
    mixins: [brandColors, ContentStore],
    computed: {
        ...mapState({
            state: state => state.content,
        }),
    }
}
</script>
