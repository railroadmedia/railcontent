<script setup>
/*
TODO: Open Create Playlist and on close open the addItem again with the right props
*/
import { ref, onMounted, inject, computed, onUpdated } from 'vue';
import PlaylistService from '../../../../services/playlists';
import Toggle from '../../Toggle/Toggle.vue'
import Table from '../../Table/Table.vue'
import { PlusCircleIcon, PlusIcon, CheckCircleIcon } from '@heroicons/vue/outline';
import LoadingSpinner from '../../LoadingSpinner/LoadingSpinner.vue';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    content: {
        type: Object,
        default: {}
    },
});

const emit = defineEmits(['onCancel']);
const token = inject('csrf_token');
const importAll = ref(false);
const formattedRows = ref([]);
const additionalItems = ref(0);
const isLoadingPlaylists = ref(false);
const isLoadingAssignments = ref(false);
const selectedPlaylists = ref([]);
const showSongToggle = ref(false);
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
});

const addRemovePlaylistSelection = (payload) => {
    const index = selectedPlaylists.value.indexOf(String(payload));
    if (index !== -1) {
        const selectionCopy = [...selectedPlaylists.value];
        selectionCopy[index] = null;
        const newSelection = selectionCopy.filter(n => n);
        selectedPlaylists.value = newSelection;
    } else {
        selectedPlaylists.value = [...selectedPlaylists.value, String(payload)];
    }
}

const handleActionClick = (payload) => {
    addRemovePlaylistSelection(payload);
    handleSaveItem(payload)
        .then(() => {})
        .catch(() => {
            addRemovePlaylistSelection(payload);
        });
};

const handleCancel = () => {
    emit('onCancel');
};

const handleSaveItem = (playlistId) => {
    isLoadingPlaylists.value = true;
    return PlaylistService.addToPlaylist({
        brand: props.brand,
        contentId: props.content.content_id,
        importAssignments: importAll.value,
        playlistIds: [String(playlistId)],
        addFull: addFullSongToggle.value,
        addInstrumentless: addInstrumentlessToggle.value,
        token,
    }).then(() => {
        window.shownotification({ icon: 'check', text: 'The items were added to your selected playlist.' });
    }).catch(() => {
        window.shownotification({ icon: 'error', text: 'An error ocurred while saving your changes, please try again later.' });
    }).finally(() => {
        isLoadingPlaylists.value = false;
    });
};
const handleCreate = () => {
    emit('onCancel');
    window.openplaylistmodal({
        modalType: 'create',
        data: { ...props.content, hasAddItemCallback: true, additionalItems: additionalItems.value },
    });
    window.addItemCallback = function (playlistId) {
        handleSaveItem(playlistId);
        window.addItemCallback = null;
    }
}
onMounted(() => {
    console.log('add to list content ', props.content)
    isLoadingPlaylists.value = true;
    if (props.content.type === 'song') {
        showSongToggle.value = true
    } else if (props.content.type === 'Assignments') {
        addFullSongToggle.value = true;
    } else {
        isLoadingAssignments.value = true;
        PlaylistService.getAssignmentsForContent({ token, contentId: props.content.content_id, brand: props.brand }).then((r) => {
            const { data: { soundslice_assignments_count } } = r;
            additionalItems.value = soundslice_assignments_count;
            isLoadingAssignments.value = false;
        }).catch(() => {
            window.shownotification({ icon: 'error', text: 'An error ocurred while fetching your data, please try again later.' });
        });
    }
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
    }).catch(() => {
        window.shownotification({ icon: 'error', text: 'An error ocurred while fetching your data, please try again later.' });
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

        <div class="tw-flex tw-w-full tw-justify-center tw-flex-col tw-mt-4" v-if="additionalItems > 0">
            <h4 class="tw-text-[16px] tw-text-left tw-w-full">Additional Playlist Items</h4>
            <div class="tw-flex tw-w-full">
                <fieldset class="tw-flex tw-flex-row tw-items-center tw-w-full">
                    <p class="tw-text-left tw-text-[14px] tw-pr-[16px]">Your selected videos contain {{
                        additionalItems
                    }} additional
                        assignment items. Would you like to also import them into your playlist?</p>
                    <Toggle id="import-all-toggle" @onToggle="handleOnToggleAssignments" />
                </fieldset>
            </div>
        </div>

        <div class="tw-flex tw-w-full tw-justify-center tw-flex-col tw-pt-[18px]" v-if="showSongToggle">
            <p class="tw-text-[16px] tw-text-center tw-w-full tw-pb-[20px]">This song contains both full and {{
                instrumentless }} tracks. Choose which tracks you want to Import into your Playlist.</p>
            <div class="tw-flex tw-justify-around tw-w-full">
                <fieldset class="tw-flex tw-flex-row tw-items-center">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]"><strong class="tw-uppercase">FULL TRACK</strong>
                    </p>
                    <Toggle id="toggle-full-song" @onToggle="handleOnToggleFullSong" />
                </fieldset>
                <fieldset class="tw-flex tw-flex-row tw-items-center">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]"><strong class="tw-uppercase">{{ instrumentless }}
                            TRACK</strong></p>
                    <Toggle id="toggle-instrumentless-song" @onToggle="handleOnToggleInstrumentlessSong" />
                </fieldset>
            </div>
        </div>
        <Table v-if="formattedRows.length" @onActionClick="handleActionClick"
            classOverride="tw-mt-[24px] tw-max-h-[350px] tw-overflow-scroll" :rows="formattedRows">
            <template v-slot:actionContent="slotProps">
                <PlusCircleIcon v-if="!selectedPlaylists.includes(String(slotProps.actionPayload))"
                    class="tw-w-[30px] tw-h-[30px] tw-text-[#3F3F46] dark:tw-text-[#7E9AB1]" />
                <CheckCircleIcon v-if="selectedPlaylists.includes(String(slotProps.actionPayload))"
                    :class="`tw-w-[30px] tw-h-[30px] tw-text-[#4ADE80]`" />
            </template>
        </Table>
        <div class="tw-w-full tw-flex tw-justify-between tw-pt-[25px]">
            <button @click="handleCreate"
                class="tw-btn-secondary tw-uppercase tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-min-w-[167px] tw-h-[35px]">
                <PlusIcon class="tw-w-[15px] tw-h-[15px]" />
                <span class="tw-pl-[6px]">ADD TO NEW PLAYLIST</span>
            </button>
            <div class="tw-flex">
                <button @click="handleCancel"
                    :class="`tw-btn-primary tw-uppercase tw-text-white tw-bg-${brand} tw-h-[35px]`">DONE</button>
            </div>
        </div>
    </div>
</template>
