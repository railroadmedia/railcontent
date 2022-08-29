<template>
    <div
        class="content-table-row flex flex-row tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]
         no-decoration pv-1 pointer relative hover:tw-bg-[#E7EFF6] dark:hover:tw-bg-[#002039]"
        :class="stateClasses"
    >
        <!-- THUMBNAIL COLUMN -->
        <div
            class="flex flex-column align-v-center thumbnail-col hide-xs-only"
            :class="themeColor"        
            >
            <div class="thumb-wrap corners-10">
                <div
                    class="thumb-img corners-10 bg-grey-2 dark:tw-bg-[#081825]"
                    :class="thumbnailType"
                    :style="'background-image:url( ' + mappedData.thumbnail + ' );'"
                >
                    <div class="lesson-progress overflow">
                        <span
                            class="progress"
                            :class="themeBgClass"
                            :style="'width:' + progress_percent + '%'"
                        ></span>
                    </div>

                    <span class="thumb-hover flex-center">
                        <i
                            class="fas fa-play"
                        ></i>
                    </span>
                </div>
            </div>
        </div>

        <!-- TITLES AND COLUMN DATA (on mobile) -->
        <div class="flex flex-column align-v-center ph-1 title-column overflow">
            <p
                class="tw-text-sm font-compressed uppercase text-truncate dark:tw-text-[#9EC0DC]"
                :class="themeTextClass"
            >
                {{ mappedData.color_title }}
            </p>

            <p class="tw-text-base font-compressed tw-text-[#00101D] dark:tw-text-white font-bold item-title">
                {{ mappedData.black_title }}
            </p>

            <p
                class="tw-text-sm font-compressed text-truncate uppercase hide-md-up tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"
            >
                <span
                    v-for="(item, i) in mappedData.column_data"
                    :key="item"
                >
                    <span
                        v-if="i > 0"
                        class="bullet"
                    >-</span>
                    {{ item }}
                </span>
            </p>
        </div>

        <!-- SHOW ALL OF THE DATA COLUMNS FROM THE DATA MAPPER -->
        <div
            v-for="(item) in mappedData.column_data"
            :key="item"
            class="flex flex-column uppercase align-center basic-col text-center tw-text-sm font-compressed hide-sm-down tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"
        >
            {{ item }}
        </div>

        <!-- VIEW LESSON VIDEO -->
        <div
            v-if="showUserActions"
            class="flex flex-column icon-col align-v-center"
        >
            <a
                :href="item.url"
                class="body no-decoration"
                @click.stop
            >
                <i
                    class="fas fa-video flex-center tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB]"
                    title="Watch Lesson Video"
                ></i>
            </a>
        </div>

        <!-- ADD TO FAVORITES -->
        <div
            v-if="showUserActions"
            class="flex flex-column icon-col align-v-center"
        >
            <div
                class="body"
                @click.stop.prevent="addToList"
            >
                <i
                    class="add-to-list fa-star flex-center tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB]"
                    :class="addedToListClasses"
                    :title="is_added ? 'Remove from Favorites' : 'Add to Favorites'"
                ></i>
            </div>
        </div>

        <!-- MARK AS COMPLETE -->
        <div
            v-if="showUserActions"
            class="flex flex-column icon-col align-v-center"
        >
            <div
                class="body"
                @click.stop.prevent="markAsComplete"
            >
                <i
                    class="add-to-list fa-check-circle flex-center tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB]"
                    :class="markedAsCompletedClasses"
                    :title="isCompleted ? 'Restart Progress' : 'Mark as Complete'"
                ></i>
            </div>
        </div>
    </div>
</template>

<script>
import CatalogueMixin from '../catalogues/_mixin';
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'PlayAlongsListItem',
    mixins: [ThemeClasses, CatalogueMixin],
    props: {
        showUserActions: {
            type: Boolean,
            default: () => false,
        },
    },
    computed: {
        mappedData() {
            return this.contentModel.list;
        },

        isCompleted() {
            return this.item.completed === true;
        },

        stateClasses() {
            return {
                active: this.active,
                'tw-bg-[#E7EFF6] dark:tw-bg-[#002039]': this.active,
            };
        },

        addedToListClasses() {
            if (this.is_added) {
                return [this.themeTextClass, this.themeHoverTextClass, 'fas'];
            }

            return [this.themeHoverTextClass, 'text-grey-2', 'far'];
        },

        markedAsCompletedClasses() {
            if (this.isCompleted) {
                return [this.themeTextClass, this.themeHoverTextClass, 'fas'];
            }

            return [this.themeHoverTextClass, 'text-grey-2', 'far'];
        },
    },
    methods: {
        markAsComplete() {
            this.$emit('markAsComplete', this.item.id);
        },
    },
};
</script>
<style>
    /* Add Scroll Margin Top for Scroll Into View and Fixed Header */
    .content-table-row {
        scroll-margin-top: 68px ;
        scroll-snap-margin-top: 68px ; /* For Safari */
    }
</style>
