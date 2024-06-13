<template>
    <div class="tw-flex tw-flex-row tw-flex-wrap -tw-mx-[10px]">
        <div v-if="state.soundSliceSlug" class="tw-absolute tw-w-full tw-h-full" v-teleport-first="'#page-container'" :style="{ zIndex: '1000'}">
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
    </div>
</template>
<script setup>
import { reactive } from "vue";
import RoutineCard from './RoutineCard'
import SoundSlice from '../SoundSlice/SoundSlice';
import SoundSliceControls from '../SoundSlice/SoundSliceControls';

import useUserCatalogueEvents from "../../hooks/useUserCatalogueEvents";

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

const state = reactive({
    routineId: '',
    routineTitle: '',
    soundSliceSlug: '',
})

const showRoutineSoundSlice = ({ soundSliceSlug, title, routineId }) => {
    state.soundSliceSlug = soundSliceSlug;
    state.routineTitle = title;
    state.routineId = routineId;
    console.log('open')
}

const soundSliceClosed = () => {
    state.soundSliceSlug = '';
    state.routineTitle = '';
    state.routineId = '';
}

const { addToList } = useUserCatalogueEvents({ ...props });
</script>
