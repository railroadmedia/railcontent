<template>
    <div
        class="flex flex-row align-v-top test-coach"
        :class="[noWrap ? 'overflow' : 'flex-wrap']"
    >
        <catalogue-card
            v-for="item in content"
            :key="'coach-grid' + item.id"
            :item="item"
            :content-type="item.type"
            :user-id="userId"
            :is-admin="isAdmin"
            :lock-unowned="lockUnowned"
            :content-type-override="contentTypeOverride"
            :show-my-list-action="showMyListAction"
            :force-list-view="displayInline"
            @addToList="emitAddToList"
        ></catalogue-card>
    </div>
</template>
<script>
import CatalogueCard from '../../../components/Catalogue/CatalogueCard.vue';
import UserCatalogueEvents from '../../mixins/UserCatalogueEvents';

export default {
    name: 'CoachGridCatalogue',
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
