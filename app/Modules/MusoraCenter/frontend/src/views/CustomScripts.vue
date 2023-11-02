<template>
    <v-container
        fluid
        class="pa-0"
    >
        <v-row>
            <v-container class="px-6">
                <v-row
                    align="center"
                >
                    <v-col class="px-2 mb-2">
                        <v-card class="pa-4">
                            <v-container class="pa-2 no-position">
                                <h4>Fix Play Alongs Style Fields</h4>
                                <v-btn
                                    small
                                    class="white--text"
                                    :color="brandColor"
                                    @click="fixPlayAlongFieldsByKey('style')"
                                >
                                    Run
                                </v-btn>
                            </v-container>

                            <v-container class="pa-2 no-position">
                                <h4>Fix Play Alongs BPM Fields</h4>
                                <v-btn
                                    small
                                    class="white--text"
                                    :color="brandColor"
                                    @click="fixPlayAlongFieldsByKey('bpm')"
                                >
                                    Run
                                </v-btn>
                            </v-container>

                            <v-container class="pa-2 no-position">
                                <h4>Find Course Videos</h4>
                                <v-btn
                                    small
                                    class="white--text"
                                    :color="brandColor"
                                    @click="getGuitarSystemChildren"
                                >
                                    Run
                                </v-btn>
                            </v-container>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col class="px-2 mb-2">
                        <v-card class="pa-4">
                            <v-container class="pa-2 no-position">
                                <h1>Log</h1>
                                <ul>
                                    <li
                                        v-for="(message, i) in log"
                                        :key="`logMessage${i}`"
                                    >
                                        {{ message }}
                                    </li>
                                </ul>

                                <v-data-table
                                    v-show="videos.length > 0"
                                    :headers="headers"
                                    :items="videos"
                                    no-results-text="No Results Found"
                                    hide-default-footer
                                    :items-per-page="1000"
                                    class="elevation-1"
                                >
                                    <template v-slot:item="{ item }">
                                        <tr>
                                            <td>{{ item.contentId }}</td>
                                            <td>{{ item.link }}</td>
                                        </tr>
                                    </template>
                                </v-data-table>
                            </v-container>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-row>
    </v-container>
</template>

<script>
import brandColors from '../api/mixins';
import api from '../api/content';

export default {
    mixins: [brandColors],
    data() {
        return {
            lightMode: localStorage.getItem('lightMode') === 'true',
            log: [],
            videos: [],
            headers: [
                {
                    text: 'Content ID',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'URL',
                    align: 'left',
                    sortable: false,
                },
            ],
        };
    },
    methods: {
        getAllPlayAlongs() {
            return api.getContent({
                included_types: ['play-along'],
                limit: 1000,
            })
                .then(response => response);
        },

        getFieldsWithCommasByKey(response, key) {
            const playAlongs = response.data.data;

            return playAlongs
                .map(playAlong => playAlong.fields.filter(field => field.key === key))
                .filter(styleFields => styleFields.length === 1)
                .map(item => item[0])
                .filter(field => field.value.indexOf(',') !== -1);
        },

        async fixPlayAlongFieldsByKey(key) {
            const playAlongs = await this.getAllPlayAlongs();
            const fields = this.getFieldsWithCommasByKey(playAlongs, key);

            this.log = [];
            this.log.push(`Found ${fields.length} ${key} fields with comma delimited strings`);

            this.deleteFieldAndCreateNewFields(fields, key);
        },

        deleteFieldAndCreateNewFields(fields, key) {
            return fields.reduce((accumulatorPromise, nextField) => accumulatorPromise.then(() => {
                this.log.push(`Removing ${key} field ${nextField.id} for content id ${nextField.content_id}`);
                return api.setContentField({
                    field_id: nextField.id,
                    deleted: true,
                })
                    .then((response) => {
                        if (response) {
                            return this.createNewFields(
                                nextField.value.split(', '),
                                nextField.content_id,
                                key,
                            );
                        }
                    });
            }), Promise.resolve());
        },

        createNewFields(values, content_id, key) {
            values.reduce((accumulatorPromise, nextValue) => accumulatorPromise.then(() => api.setContentField({
                content_id,
                key,
                value: nextValue,
                type: key === 'bpm' ? 'integer' : 'string',
            })
                .then((resolved) => {
                    if (resolved) {
                        this.log.push(`Created ${key} field ${nextValue} for
                                                content id ${content_id}`);
                    } else {
                        this.log.push(`Something failed trying to create
                                                ${key} field ${nextValue} for content id ${content_id}`);
                    }
                })), Promise.resolve());
        },

        findVideosWithCaptionsByAllContentTypes() {
            [
                'pack-bundle-lesson',
            ].reduce((accumulatorPromise, nextValue) => accumulatorPromise.then(() => this.findVideosWithCaptions(nextValue)), Promise.resolve());
        },

        getGuitarSystemChildren() {
            api.getContentChildren('237579')
                .then(response => {
                    const childIds = response.data.data.map(item => item.id);

                    childIds.reduce((accumulatorPromise, nextValue) => accumulatorPromise.then(() => this.getPackLessons(nextValue)), Promise.resolve())
                });
        },

        getPackLessons(id) {
            api.getContentChildren(id)
                .then((response) => {
                    const vimeoIds = response.data.data.map(data => this.getVimeoVideoId(data));

                    vimeoIds.reduce((accumulatorPromise, nextValue) => accumulatorPromise.then(() => this.getVimeoVideoById(nextValue)), Promise.resolve());
                });
        },

        getVimeoVideoId(item) {
            const videoField = item.fields.find(field => field.key === 'video');
            const vimeoId = videoField
                ? videoField.value.fields.find(field => field.key === 'vimeo_video_id')
                : null;

            return {
                contentId: item.id,
                vimeoId: vimeoId ? vimeoId.value : null,
            };
        },

        getVimeoVideoById({ vimeoId, contentId }) {
            return new Promise((resolve) => {
                if (vimeoId) {
                    this.videos.push({
                        contentId,
                        link: `https://vimeo.com/manage/${vimeoId}/general`,
                    });
                    resolve();
                } else {
                    resolve();
                }
            });
        },
    },
};
</script>
