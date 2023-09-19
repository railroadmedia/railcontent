<template>
    <v-col>
        <v-row
            v-for="(item, i) in items"
            v-if="!loading"
            :key="item.position"
        >
            <v-col>
                <v-custom-file-input
                    v-model="item.value"
                    label="Sheet Music Image"
                    input-key="sheet_music_image_url"
                    :color="brandColor"
                    :loading="contentModel.sheet_music_image_url.loading"
                    :base-file-name="thisPost.id + '-sheet-image'"
                    upload-endpoint="/railcontent/remote"
                    class="mb-2"
                ></v-custom-file-input>
            </v-col>
            <v-col
                align-self="center"
                class="mb-2"
                style="max-width:56px;"
            >
                <v-custom-options-menu
                    :menu-item="thisPost.sheet_music_image_url[i]"
                    :menu-index="i"
                    :length="thisPost.sheet_music_image_url.length"
                    :delete-button="true"
                    @movedUp="handleMoveUp"
                    @movedDown="handleMoveDown"
                    @deleteItem="handleItemDelete"
                ></v-custom-options-menu>
            </v-col>
        </v-row>
    </v-col>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../../api/mixins.js';
import ContentStore from '../../../mixins/content-store';
import CustomFileInput from '../../../components/CustomFileInput';
import api from '../../../api/content';
import OptionsMenu from '../../../components/CustomOptionsMenu';

export default {
    name: 'ContentSheetMusic',
    components: {
        'v-custom-options-menu': OptionsMenu,
        'v-custom-file-input': CustomFileInput,
    },
    mixins: [brandColors, ContentStore],
    props: {
        items: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            loading: false, // Have to use this for force a refresh for some reason
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        $_sheet_music_image_url() {
            return this.thisPost.sheet_music_image_url;
        },
    },
    methods: {
        handleMoveUp(payload) {
            this.loading = true;
            this.setDatum({
                datum_id: payload.id,
                content_id: this.post_id,
                key: 'sheet_music_image_url',
                position: payload.position - 1,
                child: this.isChild,
            })
                .then((response) => {
                    this.handleResponse(response, 'moved');
                });
        },

        handleMoveDown(payload) {
            this.loading = true;
            this.setDatum({
                datum_id: payload.id,
                content_id: this.post_id,
                key: 'sheet_music_image_url',
                position: payload.position + 1,
                child: this.isChild,
            })
                .then((response) => {
                    this.handleResponse(response, 'moved');
                });
        },

        handleItemDelete(payload) {
            const confirmation = confirm('Are you sure you wish to delete this image?');

            if (confirmation) {
                this.setDatum({
                    datum_id: payload.id,
                    content_id: this.post_id,
                    key: 'sheet_music_image_url',
                    deleted: true,
                    child: this.isChild,
                })
                    .then((response) => {
                        this.handleResponse(response, 'deleted');
                    });
            }
        },

        handleResponse(response, action) {
            this.loading = false;

            if (response) {
                this.$root.$emit('displayMessage', {
                    color: 'success',
                    text: `Sheet Music Image successfully ${action}!`,
                });
            } else {
                this.$root.$emit('displayMessage', {
                    color: 'success',
                    text: `Something went wrong, Sheet Music Image likely not ${action}.`,
                });
            }
        },
    },
};
</script>
