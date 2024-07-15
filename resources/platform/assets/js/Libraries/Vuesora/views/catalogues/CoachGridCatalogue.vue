<template>
    <div class="flex flex-row align-v-top test-coach" :class="[noWrap ? 'overflow' : 'flex-wrap']">
        <CatalogueListElement v-if="displayInline" v-for="item in content" :key="'coach-list' + item.id" :item="item"
            :content-type="item.type"  :lock-unowned="lockUnowned"
            :content-type-override="contentTypeOverride" :show-my-list-action="showMyListAction"
            @addToList="emitAddToList" />
        <CatalogueCard v-else v-for="item in content" :key="'coach-grid' + item.id" :item="item"
            :content-type="item.type" :lock-unowned="lockUnowned"
            :content-type-override="contentTypeOverride" :show-my-list-action="showMyListAction"
            @addToList="emitAddToList" />
    </div>
</template>
<script>
import CatalogueCard from '../../../../Components/Catalogue/CatalogueCard.vue';
import CatalogueListElement from '../../../../Components/Catalogue/CatalogueListElement.vue';
import UserCatalogueEvents from '../../mixins/UserCatalogueEvents';

export default {
    name: 'CoachGridCatalogue',
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
../../../../Components/Catalogue/CatalogueCard.vue../../../../Components/Catalogue/CatalogueListElement.vue