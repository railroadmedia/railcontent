<template>
    <div class="flex flex-row align-v-top flex-wrap -tw-mx-[10px]">
        <catalogue-routine-card
            v-for="(item, i) in content"
            :key="'grid' + item.id"
            :item="item"
            @addToList="emitAddToList"
            @showRoutineSoundSlice="showRoutineSoundSlice"
        ></catalogue-routine-card>
        <sound-slice
            :sound-slice-slug="soundSliceSlug"
            :theme-color="themeColor"
            :title="routineTitle"
            :content-id="routineId"
            :user-id="userId"
            @soundSliceClosed="soundSliceClosed"
        ></sound-slice>
    </div>
</template>
<script>
import CatalogueRoutineCard from './_CatalogueRoutineCard.vue';
import SoundSlice from '../../components/SoundSlice/SoundSlice.vue';
import UserCatalogueEvents from '../../mixins/UserCatalogueEvents';

export default {
    name: 'RoutinesCatalogue',
    components: {
        'catalogue-routine-card': CatalogueRoutineCard,
        'sound-slice': SoundSlice,
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
        userId: {
            type: String,
            default: () => '',
        },
    },
    data() {
        return {
            routineId: '',
            routineTitle: '',
            soundSliceSlug: '',
        };
    },
    methods: {
        showRoutineSoundSlice({ soundSliceSlug, title, routineId }) {
            this.soundSliceSlug = soundSliceSlug;
            this.routineTitle = title;
            this.routineId = routineId;
        },

        soundSliceClosed() {
            this.soundSliceSlug = '';
            this.routineTitle = '';
            this.routineId = '';
        },
    },
};
</script>
