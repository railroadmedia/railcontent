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
                    :style="'background-image:url( https://www.musora.com/musora-cdn/image/width=300/' + mappedData.thumbnail + ' );'"
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
                <DifficultyLabel v-if="mappedData.difficulty" class="basic-col tw-justify-center tw-text-center tw-text-xs tw-ml-2" :difficultyValue="mappedData.difficulty" textCase="uppercase" />
            </p>
        </div>

        <DifficultyLabel v-if="mappedData.difficulty" class="tw-hidden xl:tw-flex basic-col tw-justify-center tw-text-center tw-text-xs" :difficultyValue="mappedData.difficulty" textCase="uppercase" />

        <!-- SHOW ALL OF THE DATA COLUMNS FROM THE DATA MAPPER -->
        <div
            v-for="(item) in mappedData.column_data"
            :key="item"
            class="flex flex-column uppercase align-center basic-col text-center tw-text-sm font-compressed hide-sm-down tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"
        >
            {{ item }}
        </div>
        
        <!-- ADD TO FAVORITES -->
        <div
            v-if="showUserActions"
            class="flex flex-column icon-col tw-items-center"
        >
            <button 
                class="add-to-list tw-inline-flex tw-rounded-full tw-p-0.5 tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB]"
                :class="is_added ? 'is-added' + themeTextClass : 'tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB]'"
                :title="is_added ? 'Remove from Playlist' : 'Add to Playlist'"
                :data-content-id="item.id"
                :data-content-type="item.type"
                @click.stop.prevent="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.color_title, description: mappedData.black_title, thumbnail_url: mappedData.thumbnail })"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>

        <!-- VIEW LESSON VIDEO -->
        <div
            v-if="showUserActions"
            class="flex flex-column icon-col tw-items-center"
        >
            <a
                :href="item.url"
                class="body no-decoration tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB]"
                title="Watch Lesson Video"
                @click.stop
            >
                <svg width="35" height="35" class="tw-h-9 tw-w-9" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.875 14.5833L28.5145 11.2636C29.4841 10.7788 30.625 11.4839 30.625 12.568V22.432C30.625 23.5161 29.4841 24.2212 28.5145 23.7364L21.875 20.4167M7.29167 26.25H18.9583C20.5692 26.25 21.875 24.9442 21.875 23.3333V11.6667C21.875 10.0558 20.5692 8.75 18.9583 8.75H7.29167C5.68084 8.75 4.375 10.0558 4.375 11.6667V23.3333C4.375 24.9442 5.68084 26.25 7.29167 26.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
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
import DifficultyLabel from '../../../../vue/components/DifficultyLabel/DifficultyLabel'

export default {
    name: 'PlayAlongsListItem',
    mixins: [ThemeClasses, CatalogueMixin],
    props: {
        showUserActions: {
            type: Boolean,
            default: () => false,
        },
    },
    components: {
        DifficultyLabel,
    },
    computed: {
        mappedData() {
            const difficultyValue = this.contentModel.post.fields.find(field => field.key === 'difficulty').value
            if (Number.isFinite(Number(difficultyValue))) {
                this.contentModel.list.difficulty = difficultyValue;
            }
            else {
                this.contentModel.list.difficulty = 'all';
            }

            const excludeWords = ['novice', 'beginner', 'intermediate', 'advanced', 'expert', 'all'];
            const filteredColumnData = this.contentModel.list.column_data.filter(item => item && !excludeWords.some(word => item.toLowerCase().includes(word)));
            this.contentModel.list.column_data = filteredColumnData
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
