<template>
    <div
        class="tw-block tw-overflow-x-auto lg:tw-overflow-x-hidden tw-no-scrollbar"
    >
        <div class="tw-flex tw-flex-nowrap lg:tw-auto-rows-[0] lg:tw-grid-rows-1 lg:tw-overflow-hidden lg:tw-grid lg:tw-grid-cols-4 2xl:tw-grid-cols-5 4xl:tw-grid-cols-6 tw-gap-[8px] xl:tw-gap-[12px] 3xl:tw-gap-[18px] tw-snap-x">
            <catalogue-card
                v-for="item in content"
                :key="'grid' + item.id"
                :item="item"
                :content-type="item.type"
                :brand="brand"
                :theme-color="themeColor"
                :use-theme-color="useThemeColor"
                :user-id="userId"
                :is-admin="isAdmin"
                :lock-unowned="lockUnowned"
                :force-wide-thumbs="forceWideThumbs"
                :content-type-override="contentTypeOverride"
                :six-wide="sixWide"
                :five-wide="fiveWide"
                :show-my-list-action="showMyListAction"
                :force-list-view="displayInline"
                @addToList="emitAddToList"
            />
        </div>
    </div>
</template>
<script>
// In order for the horizontal scroll to work, you need to make parent container a block.
import CatalogueCard from '../../../components/Catalogue/CatalogueCard.vue';
import UserCatalogueEvents from '../../mixins/UserCatalogueEvents';

export default {
    name: 'GridCatalogue',
    components: {
        'catalogue-card': CatalogueCard,
    },
    mixins: [UserCatalogueEvents],
    props: {
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
    },
};
</script>
