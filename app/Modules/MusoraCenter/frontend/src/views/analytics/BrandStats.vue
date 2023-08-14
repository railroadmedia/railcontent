<template>
    <v-container>
        <v-row
            
            align="center"
        >
            <v-card
                width="100%"
                style="background:none;"
                flat
            >
                <v-toolbar
                    :color="brandColor"
                    dark
                    tabs
                >
                    <v-tabs
                        v-model="brandIndex"
                        grow
                        color="transparent"
                        @input="handleTabChange"
                    >
                        <v-tabs-slider color="white"></v-tabs-slider>

                        <v-tab
                            v-for="brand in brands"
                            :key="brand"
                        >
                            {{ brand }}
                        </v-tab>
                    </v-tabs>
                </v-toolbar>

                <v-tabs-items v-model="brandIndex">
                    <v-tab-item
                        v-for="brand in brands"
                        :key="brand"
                    >
                        <v-row
                            
                            
                            align="center"
                        >
                            <v-col
                                v-if="isBrand(['drumeo', 'guitareo', 'pianote'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>New Users</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['userCount'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>

                            <v-col
                                v-if="isBrand(['drumeo', 'guitareo', 'pianote'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>Active Users</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['totalActiveUsers'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>

                            <v-col
                                v-if="isBrand(['drumeo'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>Engagement Score</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['engagementScore'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>

                            <v-col
                                v-if="isBrand(['drumeo', 'guitareo', 'pianote'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>Comments</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['comments'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>

                            <v-col
                                v-if="isBrand(['drumeo', 'guitareo', 'pianote'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>Lesson Starts</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['lessonStarts'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>

                            <v-col
                                v-if="isBrand(['drumeo', 'guitareo', 'pianote'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>Lesson Completes</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['lessonCompletes'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>

                            <v-col
                                v-if="isBrand(['drumeo', 'pianote'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>Page Views</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['membersAreaPageViews'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>

                            <v-col
                                v-if="isBrand(['drumeo', 'pianote'])"
                                sm="4"
                                class="pa-2"
                            >
                                <v-card class="pa-4 text-center">
                                    <h2>Seconds Watched</h2>
                                    <h4
                                        class="display-3"
                                        :class="brandTextColor"
                                    >
                                        {{ state.stats[state.brand]['secondsWatched'].toLocaleString() }}
                                    </h4>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-tab-item>
                </v-tabs-items>
            </v-card>
        </v-row>
    </v-container>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../api/mixins.js';

export default {
    name: 'BrandStats',
    mixins: [brandColors],
    data() {
        return {
            tab: null,
            brandIndex: 0,
            brands: ['drumeo', 'pianote', 'guitareo'],
            statsInterval: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.analytics,
        }),
    },
    methods: {
        ...mapActions('analytics', [
            'getStats',
            'setBrand',
            'setProgress',
        ]),

        handleTabChange(event) {
            this.brandIndex = event;
            this.setBrand(this.brands[event]);
            this.getStats(this.state.brand);
        },

        isBrand(brands_to_check) {
            return brands_to_check.indexOf(this.state.brand) !== -1;
        },
    },
    mounted() {
        this.getStats(this.state.brand);

        this.statsInterval = setInterval(() => {
            if (this.brandIndex < 2) {
                this.brandIndex += 1;
            } else {
                this.brandIndex = 0;
            }

            this.setBrand(this.brands[this.brandIndex]);

            this.getStats(this.state.brand);
        }, 10000);
    },
    beforeDestroy() {
        clearInterval(this.statsInterval);
    },
};
</script>
