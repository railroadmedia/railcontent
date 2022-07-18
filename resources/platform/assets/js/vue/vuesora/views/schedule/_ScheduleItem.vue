<template>
    <div
        class="flex flex-row tw-items-center scheduled tw-px-0 pa-1 tw-border-t tw-border-[#E4E4E7] dark:tw-border-[#223457]"
        :class="month"
    >
            <!-- <div class="month-col body bg-grey-2 dark:tw-text-white tw-text-black">
                {{ month }}
            </div> -->

            <div class="tw-flex tw-flex-col tw-justify-center tw-w-[116px] md:tw-w-[143px] tw-shrink-0">
                <div class="thumb-wrap corners-10">
                    <div
                        class="thumb-img corners-10 widescreen text-center"
                        :style="`background-image: url( ${ item.original_thumbnail_url } )`"
                    >
                        <div class="release-day tw-bg-black/70 tw-h-full tw-flex tw-flex-col tw-items-center tw-justify-center">
                            <p class="tw-text-xs text-white font-bold">
                                {{ day }}
                            </p>
                            <p class="tw-text-xs  text-white">
                                {{ time }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tw-mr-auto tw-flex tw-w-full tw-flex-col xl:tw-flex-row xl:tw-justify-center">
                <!-- Schedule Item Title -->
                <div class="tw-flex tw-flex-col tw-justify-center ph-1 title-column overflow tw-mr-auto tw-mb-1 xl:tw-mb-0">
                    <p class="tw-text-sm uppercase text-truncate tw-text-[#52525A] dark:tw-text-[#9EC0DC]">
                        {{ mappedData.color_title }}
                    </p>
                    <p class="tw-text-sm tw-text-black dark:tw-text-white tw-font-bold item-title">
                        {{ mappedData.black_title }}
                    </p>
                </div>
                <!-- Schedule Item Data -->
                <div class="tw-flex ph-1">
                    <div class="tw-flex tw-flex-col uppercase tw-justify-center tw-pr-2 sm:tw-w-[116px] md:tw-w-[143px] tw-text-[#52525A] dark:tw-text-[#9EC0DC] tw-text-xs hide-sm-down xl:tw-text-center">
                        {{ releaseType }}
                    </div>
                    <div v-for="(item, i) in mappedData.column_data"
                        :key="i"
                        class="tw-flex tw-flex-col uppercase tw-justify-center tw-pr-2 sm:tw-w-[116px] md:tw-w-[143px] tw-text-[#52525A] dark:tw-text-[#9EC0DC] tw-text-xs hide-sm-down xl:tw-text-center"
                    >
                        {{ item }}
                    </div>
                </div>
            </div>

        <!-- ADD TO LIST OR RESET PROGRESS BUTTONS -->
        <div class="tw-hidden md:tw-flex tw-flex-col icon-col tw-justify-center hide-xs-only">
            <div class="body">
                <i
                    class="add-to-list fas fa-plus flex-center pointer"
                    :class="is_added ? 'is-added ' + themeTextClass : 'tw-text-[#52525A] dark:tw-text-[#9EC0DC]'"
                    :title="is_added ? 'Remove from My List' : 'Add to My List'"
                    @click.stop.prevent="addToList"
                ></i>
            </div>
        </div>

        <div
            class="tw-flex tw-flex-col icon-col tw-justify-center"
            style="position:relative;"
        >
            <div
                class="body pointer add-to"
                title="Add to Calendar"
                data-open-modal="scheduleAddToCalendarModal"
                @click="addEvent"
            >
                <i class="fas fa-calendar-plus flex-center tw-text-[#52525A] dark:tw-text-[#9EC0DC] rounded"></i>
            </div>
        </div>
    </div>
</template>
<script>
import ContentHelpers from "../../assets/js/helper-functions/content.js";
import { DateTime } from 'luxon';
import ContentModel from '../../assets/js/models/_model.js';
import UserCatalogueEvents from '../../mixins/UserCatalogueEvents';
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'ScheduleItem',
    mixins: [UserCatalogueEvents, ThemeClasses],
    props: {
        item: {
            type: Object,
        },
        timezone: {
            type: String,
        },
    },
    data() {
        return {
            mappedData: this.getContentModel(),
        };
    },
    computed: {

        time_to_display() {
            // Just pull the default published on
            return this.item.published_on;
        },

        month() {
            return DateTime.fromSQL(this.time_to_display).toFormat('LLL').toLowerCase();
        },

        day() {
            return DateTime.fromSQL(this.time_to_display).toFormat('ccc d');
        },

        time() {
            return DateTime.fromSQL(this.time_to_display).toFormat('h:mm a');
        },

        releaseType() {
            if (this.item.status === 'scheduled') {
                return 'Live Broadcast';
            }

            return 'Lesson Release';
        },

        is_added() {
            return this.item.is_added_to_primary_playlist;
        },
    },
    beforeDestroy() {
        this.mappedData = null;
    },
    methods: {

        getContentModel() {
            const shows = ContentHelpers.shows();
            let type = this.contentTypeOverride || this.item.type;

            if (shows.indexOf(type) !== -1) {
                type = 'show';
            }

            const model = new ContentModel(type, {
                brand: this.brand,
                post: this.item,
            });

            return model.schedule;
        },
    },
};
</script>
