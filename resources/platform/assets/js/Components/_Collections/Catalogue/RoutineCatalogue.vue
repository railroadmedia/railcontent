<template>
    <div class="tw-flex tw-flex-row tw-flex-wrap -tw-mx-[10px]">
        <SkeletonRoutineCard v-if="isLoading" v-for="i in 5" :key="`Routine Card ${i}`" />
        <template v-else>
            <div v-if="state.soundSliceSlug" id="practiceOverlay" class="bg-white">
                <SoundSlice :key="`soundslice-${state.routineId}-${state.soundSliceSlug}`"
                    :user-id="userId" :theme-color="themeColor" :soundslice-slug="state.soundSliceSlug"
                    :contentId="state.routineId">
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls :title="`${state.routineTitle}`" :disable-next="true" :disable-prev="true"
                            @onClose="soundSliceClosed" />
                    </template>
                </SoundSlice>
            </div>
            <RoutineCard v-for="(item, i) in content" :key="'grid' + item.id" :item="item" @addToList="addToList"
                @showRoutineSoundSlice="showRoutineSoundSlice" />
        </template>
    </div>
</template>
<script setup>
import { reactive } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import useUserCatalogueEvents from "@hooks/useUserCatalogueEvents";

import RoutineCard from './RoutineCard'
import SoundSlice from '@collections/SoundSlice/SoundSlice';
import SoundSliceControls from '@collections/SoundSlice/SoundSliceControls';
import SkeletonRoutineCard from '@collections/SkeletonLoader/SkeletonRoutineCard';

const props = defineProps({
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
})

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const state = reactive({
    routineId: '',
    routineTitle: '',
    soundSliceSlug: '',
})

const showRoutineSoundSlice = ({ soundSliceSlug, title, routineId }) => {
    state.soundSliceSlug = soundSliceSlug;
    state.routineTitle = title;
    state.routineId = routineId;
}

const soundSliceClosed = () => {
    state.soundSliceSlug = '';
    state.routineTitle = '';
    state.routineId = '';
}

const { addToList } = useUserCatalogueEvents({ ...props });
</script>
