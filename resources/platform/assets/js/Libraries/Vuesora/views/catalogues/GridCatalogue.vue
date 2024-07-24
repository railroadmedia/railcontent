<template>
    <div :class="[
        noWrap ? 'overflow' : 'flex-wrap',
        { 'tw-flex-col': displayInline },
        { 'tw-flex': !isSingleItem },
        { 'tw-block tw-w-full': isSingleItem },
        { 'md:tw-grid md:tw-grid-cols-3 lg:tw-grid-cols-4 2xl:tw-grid-cols-5 md:tw-gap-3': !isSingleItem && !displayInline }
    ]">
        <CatalogueListElement v-if="displayInline" v-for="item in content" :key="'coach-list' + item.id" :item="item"
            :content-type="item.type" :lock-unowned="lockUnowned" :content-type-override="contentTypeOverride"
            :show-my-list-action="showMyListAction" @addToList="emitAddToList"
            :wrapperClassOverride="elementClassOverride" />
        <CatalogueCard v-else v-for="item in content" :key="'coach-grid' + item.id" :item="item"
            :content-type="item.type" :lock-unowned="lockUnowned" :content-type-override="contentTypeOverride"
            :show-my-list-action="showMyListAction" @addToList="emitAddToList"
            :wrapperClassOverride="elementClassOverride" />
    </div>
</template>
<script>
import CatalogueCard from '@collections/Catalogue/CatalogueCard.vue';
import CatalogueListElement from '@collections/Catalogue/CatalogueListElement.vue';
import UserCatalogueEvents from '../../mixins/UserCatalogueEvents';

export default {
    name: 'GridCatalogue',
    components: {
        CatalogueCard,
        CatalogueListElement
    },
    mixins: [UserCatalogueEvents],
    props: {
        content: {
            type: Array,
            default: () => [],
        },
        noWrap: {
            type: Boolean,
            default: () => false,
        },
        forceWideThumbs: {
            type: Boolean,
            default: () => false,
        },
        contentTypeOverride: {
            type: String,
            default: () => '',
        },
        lockUnowned: {
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
        isSingleItem: {
            type: Boolean,
            default: () => false,
        },
        fullWidthOnMobile: {
            type: Boolean,
            default: () => false,
        },
    },
    computed: {
        elementClassOverride() {
            if (this.isSingleItem) {
                return '!tw-w-full !tw-px-2 sm:!mb-4 lg:!tw-w-full';
            } else if (this.fullWidthOnMobile) {
                return '!tw-w-full md:!tw-w-auto !tw-mb-4 md:!tw-mb-0';
            } else {
                return '';
            }
        },
    },
};
</script>