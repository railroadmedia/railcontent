<script setup>
/*

TODO: Open Create Playlist and on close open the addItem again with the right props

*/
import { ref, onMounted, inject, computed } from 'vue';
import PlaylistService from '../../../services/playlists';
import Toggle from '../Toggle/Toggle.vue'
import Table from '../Table/Table.vue'
import { PlusCircleIcon, PlusIcon, CheckCircleIcon } from '@heroicons/vue/outline';
import LoadingSpinner from '../LoadingSpinner/LoadingSpinner.vue';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    contentId: {
        type: String,
        default: null
    },
    type: {
        default: String,
        default: null,
    }
});

const emit = defineEmits(['onCancel']);

const token = inject('csrf_token');

const importAll = ref(false);
const formattedRows = ref([]);
const additionalItems = ref(0);
const isLoadingPlaylists = ref(false);
const isLoadingAssignments = ref(false);
const selectedPlaylists = ref([]);
const showSongToggle = ref(true);
const addFullSongToggle = ref(false);
const addInstrumentlessToggle = ref(false);

const handleOnToggleAssignments = (val) => {
    importAll.value = val;
};

const handleOnToggleFullSong = (val) => {
    addFullSongToggle.value = val;
};

const handleOnToggleInstrumentlessSong = (val) => {
    addInstrumentlessToggle.value = val;
};

const instrumentless = computed(() => {
    return {
        drumeo: 'drumless',
        guitareo: 'guitarless',
        singeo: 'voiceless',
        pianote: 'pianoless'
    }[props.brand];
})

const handleActionClick = (payload) => {
    const index = selectedPlaylists.value.indexOf(String(payload));
    if (index !== -1) {
        const selectionCopy = [...selectedPlaylists.value];
        selectionCopy[index] = null;
        const newSelection = selectionCopy.filter(n=>n);
        selectedPlaylists.value = newSelection;
    } else {
        selectedPlaylists.value = [...selectedPlaylists.value, String(payload)];
    }
};

const handleCancel = () => {
    emit('onCancel');
};

const handleConfirm = () => {
    isLoadingPlaylists.value = true;
    PlaylistService.addToPlaylist({
        brand: props.brand,
        contentId: props.contentId,
        importAssignments: importAll.value,
        playlistIds: selectedPlaylists.value,
        token,
    }).then(() => {
        isLoadingPlaylists.value = false;
        emit('onCancel');
    });
};

const handleCreate = () => {
    emit('onCancel');
    window.openplaylistmodal({ modalType: 'create', nextModal: { modalType: 'addItem', contentId: props.contentId } });
}

onMounted(() => {
    isLoadingAssignments.value = true;
    isLoadingPlaylists.value = true;

    if (props.type === 'song') {
        // Add logic code here
        // ex: showSongToggle.value = true
    }

    PlaylistService.getAssignmentsForContent({ token, contentId: props.contentId, brand: props.brand }).then((r) => {
        const { data: { soundslice_assignments_count } } = r;
        additionalItems.value = soundslice_assignments_count;
        isLoadingAssignments.value = false;
    });

    PlaylistService.getCurrentUserPlaylists({ token }).then(r => {
        isLoadingPlaylists.value = false;
        const { data: { data } } = r;
        const formattedTable = data.map((item) => {
            const { name, thumbnail_url, duration_formated, id, created_at } = item;
            const dateCreated = new Date(created_at);
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const month = months[dateCreated.getMonth()];
            const formattedDate = `${month} ${dateCreated.getDate()}, ${dateCreated.getFullYear()}`;

            return ([
                {
                    thumb: thumbnail_url,
                    content: name
                },
                {
                    content: formattedDate
                },
                {
                    content: duration_formated
                },
                {
                    showActionSlot: true,
                    actionPayload: id
                }
            ])
        });

        formattedRows.value = formattedTable;
    });
});
</script>

<template>
    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">
        <div v-if="isLoadingAssignments || isLoadingPlaylists"
            class="tw-z-40 tw-flex tw-w-full tw-h-full tw-text-white tw-absolute tw-items-center tw-justify-center tw-bg-black/40">
            <LoadingSpinner class="tw-w-[40px] tw-h-[40px] tw-text-white" />
        </div>
        <h2 class="tw-text-[24px] tw-font-bold tw-w-full tw-text-center">Add Item to Playlist</h2>
        <div class="tw-flex tw-w-full tw-justify-center tw-flex-col" v-if="additionalItems > 0">
            <h4 class="tw-text-[16px] tw-text-left tw-w-full">Additional Playlist Items</h4>
            <div class="tw-flex tw-w-full">
                <fieldset class="tw-flex tw-flex-row tw-items-center tw-w-full">
                    <p class="tw-text-left tw-text-[14px] tw-pr-[16px]">Your selected videos contain {{
                        additionalItems
                    }} additional
                        assignment items. Would you like to also import them into your playlist?</p>
                    <Toggle @onToggle="handleOnToggleAssignments" />
                </fieldset>
            </div>
        </div>

        <div class="tw-flex tw-w-full tw-justify-center tw-flex-col" v-if="showSongToggle">
            <p class="tw-text-[16px] tw-text-center tw-w-full">This song contains both full and {{ instrumentless }} tracks. Choose which tracks you want to Import into your Playlist.</p>
            <div class="tw-flex tw-justify-around tw-w-full">
                <fieldset class="tw-flex tw-flex-row tw-items-center">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]"><strong class="tw-uppercase">FULL TRACK</strong></p>
                    <Toggle @onToggle="handleOnToggleFullSong" />
                </fieldset>
                <fieldset class="tw-flex tw-flex-row tw-items-center">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]"><strong class="tw-uppercase">{{ instrumentless }} TRACK</strong></p>
                    <Toggle @onToggle="handleOnToggleInstrumentlessSong" />
                </fieldset>
            </div>
        </div>
        <Table @onActionClick="handleActionClick" classOverride="tw-mt-[24px] tw-max-h-[350px] tw-overflow-scroll" :rows="formattedRows">
            <template v-slot:actionContent="slotProps">
                <PlusCircleIcon v-if="!selectedPlaylists.includes(String(slotProps.actionPayload))" class="tw-w-[23px] tw-h-[23px] tw-text-[#7E9AB1]" />
                <CheckCircleIcon v-if="selectedPlaylists.includes(String(slotProps.actionPayload))" :class="`tw-w-[23px] tw-h-[23px] tw-text-[${brand}]`" />
            </template>
        </Table>
        <div class="tw-w-full tw-flex tw-justify-between tw-pt-[25px]">
            <button @click="handleCreate" class="tw-btn-secondary tw-uppercase tw-text-[#9EC0DC] tw-min-w-[167px] tw-h-[35px]">
                <PlusIcon class="tw-w-[12px] tw-h-[12px]" />
                <span class="tw-pl-[6px]">CREATE NEW LIST</span>
            </button>
            <div class="tw-flex">
                <button @click="handleCancel"
                    class="tw-btn-primary tw-uppercase dark:tw-text-white tw-h-[35px] tw-text-[#0D0D0D]">CANCEL</button>
                <button @click="handleConfirm"
                    :class="`tw-btn-primary tw-uppercase tw-text-white tw-bg-${brand} tw-h-[35px]`">CONFIRM</button>
            </div>
        </div>
    </div>
</template>
