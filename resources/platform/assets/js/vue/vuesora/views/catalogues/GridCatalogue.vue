<template>
    <div
        class="tw-flex"
        :class="[noWrap ? 'overflow' : 'flex-wrap', {'tw-flex-col': displayInline }, { 'md:tw-grid md:tw-grid-cols-3 lg:tw-grid-cols-4 2xl:tw-grid-cols-5 md:tw-gap-3': !isSingleItem && !displayInline }]"
    >
        <catalogue-card
            v-for="item in content"
            :key="'grid' + item.id"
            :item="item"
            :content-type="item.type"
            :brand="brand"
            :user-id="userId"
            :is-admin="isAdmin"
            :lock-unowned="lockUnowned"
            :content-type-override="contentTypeOverride"
            :show-my-list-action="showMyListAction"
            :force-list-view="displayInline"
            :add-dark-mode-color="addDarkModeColor"
            :is-single-item="isSingleItem"
            :full-width-on-Mobile="fullWidthOnMobile"
            @addToList="emitAddToList"
        />
    </div>
</template>
<script>
import CatalogueCard from '../../../components/Catalogue/CatalogueCard.vue';
import UserCatalogueEvents from '../../mixins/UserCatalogueEvents';

export default {
    name: 'GridCatalogue',
    components: {
        'catalogue-card': CatalogueCard,
    },
    mixins: [UserCatalogueEvents],
    props: {
        addDarkModeColor: {
            type: Boolean,
            default: () => true,
        },
        content: {
            type: Array,
            default: () => [],
        },
        themeColor: {
            type: String,
            default: () => 'drumeo',
        },
        useThemeColor: {
            type: Boolean,
            default: () => true,
        },
        userId: {
            type: String,
            default: () => '',
        },
        isAdmin: {
            type: Boolean,
            default: () => false,
        },
        brand: {
            type: String,
            default: () => 'drumeo',
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
        isSingleItem: {
            type: Boolean,
            default: () => false,
        },
        fullWidthOnMobile: {
            type: Boolean,
            default: () => false,
        },
    },
};
</script>
