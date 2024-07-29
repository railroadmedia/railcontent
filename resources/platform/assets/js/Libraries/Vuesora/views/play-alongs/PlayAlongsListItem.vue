<template>
    <div
        class="content-table-row flex flex-row tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]
         no-decoration pv-1 pointer relative hover:tw-bg-[#E7EFF6] dark:hover:tw-bg-[#002039]"
        :class="stateClasses"
    >
        <div class="tw-flex tw-flex-1"  @click="$emit('updateTrack', item)">
            <!-- THUMBNAIL COLUMN -->
            <div
                class="tw-flex flex-column align-v-center tw-w-[104px] sm:tw-w-[142px]"
                :class="themeColor"
                >
                <div class="thumb-wrap corners-10">
                    <div
                        class="thumb-img corners-10 bg-grey-2 dark:tw-bg-[#081825]"
                        :class="thumbnailType"
                        :style="'background-image:url( https://www.musora.com/musora-cdn/image/width=300,quality=95/' + mappedData.thumbnail + ' );'"
                    >
                        <div class="lesson-progress overflow">
	                        <span
	                            class="progress"
	                            :class="themeBgClass"
	                            :style="'width:' + progress_percent + '%'"
	                        ></span>
                    	</div>

	                    <!-- Lock Icon -->
	                    <div v-if="noAccess" class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-[rgba(0,12,23,0.85)] tw-z-20 tw-flex tw-justify-center tw-items-center">
	                        <musora-icon class="tw-w-[30px]" icon-name="lock-icon"></musora-icon>
	                    </div>

	                    <span v-else class="thumb-hover flex-center">
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
                    class="tw-text-[11px] sm:tw-text-sm font-compressed uppercase text-truncate dark:tw-text-[#9EC0DC]"
                    :class="themeTextClass"
                >
                    {{ mappedData.color_title }}
                </p>

                <p class="tw-text-[13px] sm:tw-text-base font-compressed tw-text-[#00101D] dark:tw-text-white font-bold item-title">
                    {{ mappedData.black_title }}
                </p>

                <p
                    class="tw-text-[11px] sm:tw-text-sm text-truncate tw-uppercase tw-flex lg:tw-hidden tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"
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
                    <DifficultyLabel v-if="mappedData.difficulty" class="basic-col tw-text-center tw-text-[11px] sm:tw-text-xs tw-ml-2 dark:tw-text-white" :difficultyValue="mappedData.difficulty" textCase="uppercase" />
                </p>
            </div>
        </div>

        <DifficultyLabel v-if="mappedData.difficulty" class="tw-hidden xl:tw-flex basic-col tw-justify-center tw-text-center tw-text-xs dark:tw-text-white" :difficultyValue="mappedData.difficulty" textCase="uppercase" />

        <!-- SHOW ALL OF THE DATA COLUMNS FROM THE DATA MAPPER -->
        <div
            v-for="(item) in mappedData.column_data"
            :key="item"
            class="flex flex-column uppercase align-center basic-col text-center tw-text-sm font-compressed hide-sm-down tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"
        >
            {{ item }}
        </div>

        <div v-if="showUserActions" class="tw-flex sm:tw-hidden tw-items-center tw-justify-center tw-relative">
            <button class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-z-20" @click="toggleDropdown">
                <svg width="21" height="21" viewBox="0 0 25 25" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                    </path>
                </svg>
            </button>

            <ul
                v-if="showDropdown"
                class="tw-absolute tw-w-[200px] tw-top-10 tw-right-0 tw-drop-shadow-lg tw-rounded tw-text-black dark:tw-text-white tw-bg-white dark:tw-bg-[#081825] tw-z-50 sm:tw-hidden"
                v-click-outside="closeDropdown"
            >
                <li class="tw-group tw-relative">
                    <a
                        :href="item.url"
                        class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm"
                        @click.stop=""
                    >
                        <svg width="25" height="25" class="tw-h-7 tw-w-7 tw-mr-2" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.875 14.5833L28.5145 11.2636C29.4841 10.7788 30.625 11.4839 30.625 12.568V22.432C30.625 23.5161 29.4841 24.2212 28.5145 23.7364L21.875 20.4167M7.29167 26.25H18.9583C20.5692 26.25 21.875 24.9442 21.875 23.3333V11.6667C21.875 10.0558 20.5692 8.75 18.9583 8.75H7.29167C5.68084 8.75 4.375 10.0558 4.375 11.6667V23.3333C4.375 24.9442 5.68084 26.25 7.29167 26.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>View Video</span>
                    </a>
                </li>
                <li class="tw-group tw-relative">
                    <button
                        class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm"
                        @click.stop.prevent="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.color_title, description: mappedData.black_title, thumbnail_url: mappedData.thumbnail })"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Add To Playlist</span>
                    </button>
                </li>
                <li class="tw-group tw-relative">
                    <button
                        class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm"
                        @click.stop.prevent="markAsComplete"
                    >
                        <i
                            class="fa-check-circle tw-text-lg tw-mr-2"
                            :class="markedAsCompletedClasses"
                            :title="isCompleted ? 'Restart Progress' : 'Mark as Complete'"
                        ></i>
                        <span>{{ isCompleted ? 'Incomplete' : 'Complete' }}</span>
                    </button>
                </li>
            </ul>
        </div>

        <!-- ADD TO FAVORITES -->
        <div
            v-if="showUserActions"
            class="tw-hidden sm:tw-flex flex-column icon-col tw-items-center"
        >
            <button
                class="add-to-list tw-inline-flex tw-rounded-full tw-p-0.5 tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB] tw-h-full tw-items-center"
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

        <template v-if="noAccess">
            <div class="tw-hidden sm:tw-flex flex-column icon-col align-v-center">
                <i class="fas fa-lock tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"></i>
            </div>
        </template>
        <template v-else-if="showUserActions">
            <!-- VIEW LESSON VIDEO -->
            <div class="tw-hidden sm:tw-flex flex-column icon-col tw-items-center">
                <a
                    :href="item.url"
                    class="body tw-inline-flex no-decoration tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB] tw-h-full tw-items-center"
                    title="Watch Lesson Video"
                    @click.stop
                >
                    <svg width="35" height="35" class="tw-h-9 tw-w-9" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.875 14.5833L28.5145 11.2636C29.4841 10.7788 30.625 11.4839 30.625 12.568V22.432C30.625 23.5161 29.4841 24.2212 28.5145 23.7364L21.875 20.4167M7.29167 26.25H18.9583C20.5692 26.25 21.875 24.9442 21.875 23.3333V11.6667C21.875 10.0558 20.5692 8.75 18.9583 8.75H7.29167C5.68084 8.75 4.375 10.0558 4.375 11.6667V23.3333C4.375 24.9442 5.68084 26.25 7.29167 26.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <!-- MARK AS COMPLETE -->
            <div class="tw-hidden sm:tw-flex flex-column icon-col align-v-center">
                <div
                    class="body tw-h-full tw-items-center tw-inline-flex"
                    @click.stop.prevent="markAsComplete"
                >
                    <i
                        class="add-to-list fa-check-circle flex-center tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-[#0B76DB]"
                        :class="markedAsCompletedClasses"
                        :title="isCompleted ? 'Restart Progress' : 'Mark as Complete'"
                    ></i>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import CatalogueMixin from '../catalogues/_mixin';
import ThemeClasses from '../../mixins/ThemeClasses';
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel';

export default {
    name: 'PlayAlongsListItem',
    mixins: [ThemeClasses, CatalogueMixin],
    props: {
        showUserActions: {
            type: Boolean,
            default: () => false,
        },
        showDropdownID: {
            type: Number,
            default: () => null,
        }
    },
    components: {
        DifficultyLabel,
    },
    data() {
        return {
            showDropdown: false,
        };
    },
    computed: {
        mappedData() {
            let difficultyValue = 'all';
            if(this.contentModel.post.fields) difficultyValue = this.contentModel.post.fields.find(field => field.key === 'difficulty').value

            const contentModel = JSON.parse(JSON.stringify(this.contentModel)) //Create a deep copy to not update reactive prop

            if (Number.isFinite(Number(difficultyValue))) {
                contentModel.list.difficulty = difficultyValue;
            }
            else {
                contentModel.list.difficulty = 'all';
            }

            const excludeWords = ['novice', 'beginner', 'intermediate', 'advanced', 'expert', 'all'];
            const filteredColumnData = contentModel.list.column_data.filter(item => item && !excludeWords.some(word => item.toLowerCase().includes(word)));
            contentModel.list.column_data = filteredColumnData
            return contentModel.list;
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
            this.closeDropdown();
            this.$emit('markAsComplete', this.item.id);
        },
        toggleDropdown(){
            this.showDropdown = !this.showDropdown;
        },
        closeDropdown(){
            this.showDropdown = false;
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
