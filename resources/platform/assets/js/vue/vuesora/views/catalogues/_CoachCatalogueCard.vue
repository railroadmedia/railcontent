<template>
    <div
        class="flex flex-column pa-1 catalogue-card"
        :class="class_object"
    >
        <div class="flex"
           :class="displayInline ? 'flex-row' : 'flex-column'"
        >
            <!-- Thumbnail Section -->
            <a :href="renderLink ? item.url : false"
               class="no-decoration flex flex-column"
               :class="[
                    {'thumbnail-col': displayInline}, 
                    item.type + '-thumbnail'
                ]"
            >
                <div class="card-media bg-grey-2 active corners-10 dark:tw-bg-[#081825]"
                     :class="[thumbnailType]"
                >
                    <!-- Coach Thumbnail -->
                    <img
                        :src="mappedData.thumbnail"
                        alt="thumbnail"
                        class="tw-transition-opacity tw-duration-500"
                        loading="lazy"
                        :class="mappedData.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                        @load="mappedData.imageLoaded = true"
                    />


                    <div class="lesson-progress overflow">
                        <span
                            class="progress"
                            :class="themeBgClass"
                            :style="'width:' + progress_percent + '%'"
                        ></span>
                    </div>
                    <span v-if="showTrophy"
                          class="bundle-complete flex-center"
                    >
                        <i class="fas fa-trophy"></i>
                    </span>
                    <span v-else
                          class="thumb-hover flex-center"
                    >
                        <i class="fas"
                           :class="thumbnailIcon"
                        ></i>
                        <p v-if="!isReleased"
                           class="tiny text-white font-bold"
                        >
                            {{ releaseDate }}
                        </p>
                    </span>
                </div>
            </a>

            <!-- Description Section -->
            <div class="tw-flex tw-w-full">
                <a :href="renderLink ? item.url : false" 
                   class="card-info flex flex-column tw-p-1 tw-rounded-lg"
                   :class="displayInline ? 'align-v-center' : 'tw-py-2'"
                >
                    <!-- Coach Title -->
                    <h5 class="tw-text-xs tw-font-normal tw-leading-none text-grey-4 tw-mb-1 tw-uppercase dark:tw-text-[#9EC0DC]"
                        v-if="!isGuitareoChordAndScale" v-html="mappedData.color_title">
                    </h5>
                    <!-- Video Title -->
                    <h4 class="tw-text-sm tw-leading-snug tw-text-[#00101D] font-compressed tw-font-bold tw-capitalize tw-mb-1 dark:tw-text-white"
                        :class="{'text-center': isGuitareoChordAndScale}"
                    >
                        {{ mappedData.black_title }}
                    </h4>
                    <!-- Video Description -->
                    <p v-if="mappedData.show_description"
                       class="tw-text-xs font-compressed text-grey-4 dark:tw-text-[#9EC0DC] pb-1 tw-mb-1 item-description always-truncate"
                    >
                        {{ mappedData.description.replace(/<[^>]+>/g, '') }}
                    </p>
                    <!-- Content -->
                    <h6 class="tw-text-xs tw-font-normal text-grey-3 tw-capitalize dark:tw-text-[#9EC0DC]"
                        :class="{'text-center': isGuitareoChordAndScale}"
                    >
                        <span v-html="mappedData.content_type"></span>
                        <span v-if="mappedData.grey_title && mappedData.grey_title !== ''">
                            - {{ mappedData.grey_title }}
                        </span>
                        &nbsp;
                    </h6>
                </a>
                <!-- Add to My List -->
                <div class="tw-inline-flex tw-items-start tw-p-1">
                    <button v-if="item.type !== 'pack-bundle' && showMyListAction"
                        class="add-to-list tw-inline-flex tw-rounded-full tw-p-0.5"
                        :class="is_added ? 'is-added ' + themeTextClass : 'tw-text-[#00101D] dark:tw-text-white'"
                        :title="is_added ? 'Remove from My List' : 'Add to My List'"
                        :data-content-id="item.id"
                        :data-content-type="item.type"
                        @click.stop.prevent="addToList"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Mixin from './_mixin';
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'CoachCatalogueCard',
    mixins: [Mixin, ThemeClasses],
    props: {
        sixWide: {
            type: Boolean,
            default: () => false,
        },
        fiveWide: {
            type: Boolean,
            default: () => false,
        },
        displayInline: {
            type: Boolean,
            default: () => false,
        },
        showMyListAction: {
            type: Boolean,
            default: () => true,
        },
    },
    computed: {
        mappedData: {
            get() {
                return this.contentModel.card;
            },
            set(value) {
                this.contentModel.card = value;
            }
        },
        class_object() {
            return {
                'no-access': this.noAccess,
                completed: this.item.completed,
                'six-wide': this.sixWide,
                'five-wide': this.fiveWide,
                'bb-grey-1-1': this.displayInline,
                'display-inline': this.displayInline,
            };
        },
        is_added: {
            cache: false,
            get() {
                return this.item.is_added_to_primary_playlist;
            },
        },
        showTrophy() {
            return this.item.type === 'pack-bundle' && this.item.completed === true;
        },
        isGuitareoChordAndScale() {
            return this.brand === 'guitareo' && this.item.type === 'chord-and-scale';
        },
    },
    beforeDestroy() {
        this.mappedData = null;
    },
};
</script>
