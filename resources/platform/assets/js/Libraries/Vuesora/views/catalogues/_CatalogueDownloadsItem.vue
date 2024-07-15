<template>
    <div
        class="downloads-item flex flex-row no-decoration relative text-grey-3 pv-1 tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457] hover:tw-bg-[#E7EFF6] dark:hover:tw-bg-[#002039]"
    >
        <!-- THUMBNAIL COLUMN -->
        <div
            class="flex flex-column align-v-center downloads-item-thumb"
            :class="[themeColor]"
        >
            <div class="thumb-wrap corners-10">
                <div class="thumb-img corners-10 square bg-grey-2 dark:tw-bg-[#081825]">
                    <!-- Catalog Item Thumbnail -->
                    <img :src="mappedData.thumbnail"
                         loading="lazy"
                         alt="Lesson Thumbnail"
                         class="tw-transition-opacity tw-duration-500"
                         :class="contentModel.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                         @load="contentModel.imageLoaded = true"
                    >
                </div>
            </div>
        </div>

        <div class="item-details flex flex-row pl-2">
            <!-- ARTIST & SONGS -->
            <div
                class="flex flex-column align-v-center title-column overflow"
            >
                <h3
                    class="item-artist font-regular uppercase"
                    :class="[themeTextClass]"
                >{{ contentModel.artist }}</h3>
                <h3
                    class="item-title font-bold tw-text-[#00101D] dark:tw-text-white"
                >{{ contentModel.title }}</h3>
            </div>

            <div class="item-actions flex flex-row align-h-right">
                <!-- DOWNLOADS -->
                <div
                    class="item-action flex flex-column uppercase align-center basic-col text-center"
                >
                    <a
                        :href="contentModel.pdf_in_g"
                        class="tw-btn-secondary tw-text-[#8c9698] dark:tw-text-white"
                    >
                        <span class="">key of g</span>
                        <i class="fas fa-file-pdf ml-1 hide-xs-only"></i>
                    </a>
                </div>
                <div
                    class="item-action flex flex-column uppercase align-center basic-col text-center ml-1"
                >
                    <a
                        :href="contentModel.pdf"
                        class="tw-btn-secondary tw-text-[#8c9698] dark:tw-text-white"
                    >
                        <span class="">original key</span>
                        <i class="fas fa-file-pdf ml-1 hide-xs-only"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Mixin from './_mixin';
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'CatalogueListItem',
    mixins: [Mixin, ThemeClasses],
    computed: {
        mappedData() {
            return this.contentModel.list;
        },
    },
    beforeDestroy() {
        this.contentModel = null;
    },
};
</script>
