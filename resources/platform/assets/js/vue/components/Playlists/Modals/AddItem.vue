<script setup>
/*
TODO: Open Create Playlist and on close open the addItem again with the right props
*/
import { ref, onMounted, inject, computed, reactive } from 'vue';
import PlaylistService from '../../../../services/playlists';
import Toggle from '../../Toggle/Toggle.vue';
import Table from '../../Table/Table.vue';
import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
import { PlusCircleIcon, PlusIcon, CheckCircleIcon } from '@heroicons/vue/outline';
import { XIcon } from "@heroicons/vue/solid";
import LoadingSpinner from '../../LoadingSpinner/LoadingSpinner.vue';
import AddDuplicate from './AddDuplicate.vue';

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

const state = reactive({
    searchTerm: '',
    formattedTable: [],
})

const emit = defineEmits(['onCancel']);
const token = inject('csrf_token');
const importAll = ref(false);
const formattedRows = ref([]);
const additionalItems = ref(0);
const pageNumber = ref(1);
const isLoadingPlaylists = ref(false);
const isLoadingAssignments = ref(false);
const selectedPlaylists = ref([]);
const showSongToggle = ref(false);
const showVocalRoutineToggles = ref(false);
const addFullSongToggle = ref(false);
const addInstrumentlessToggle = ref(false);
const includeHighRoutine = ref(true);
const includeLowRoutine = ref(true);
const preventReFetch = ref(false);
const duplicatedIDs = ref([]);
const duplicateProps = ref({ show: false, id: null });
const duplicatedItemIdNameMap = ref({});

const handleOnToggleAssignments = (val) => {
    importAll.value = val;
};

//Handle Instrument Toggles
const handleOnToggleFullSong = (val) => {
    addFullSongToggle.value = val;
};
const handleOnToggleInstrumentlessSong = (val) => {
    addInstrumentlessToggle.value = val;
};

//Handle Routine Toggles
const handleLowRoutine = (val) => {
    includeLowRoutine.value = val;
}
const handleHighRoutine = (val) => {
    includeHighRoutine.value = val;
}

//Instrument Value
const instrumentless = computed(() => {
    return {
        drumeo: 'drumless',
        guitareo: 'guitarless',
        singeo: 'voiceless',
        pianote: 'pianoless'
    }[props.brand];
});

//Content Title
const title = computed(() => {
    return props.content.title || props.content.name;
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
    const duplicateIndex = duplicatedIDs.value.indexOf(String(payload));
    const selectedIndex = selectedPlaylists.value.indexOf(String(payload));
    if (duplicateIndex !== -1 && selectedIndex === -1) {
        duplicateProps.value = { id: payload, show: true, title: props.content.name };
    } else {
        addRemovePlaylistSelection(payload);
    }
};

const handleCancel = () => {
    emit('onCancel');
};

const searchPlaylists = () => {
    isLoadingPlaylists.value = true;
    pageNumber.value = 1;
    getUserPlaylists();
}

const clearSearch = () => {
    state.searchTerm = '';
    state.formattedTable = [];
    pageNumber.value = 1;
    getUserPlaylists();
}

const saveData = (playlistId) => {
    if(showVocalRoutineToggles.value) {
        return PlaylistService.addToPlaylist({
            brand: props.brand,
            contentId: props.content.content_id,
            playlistIds: playlistId ? [playlistId] : selectedPlaylists.value,
            addLowRoutine: includeLowRoutine.value,
            addHighRoutine: includeHighRoutine.value,
            token,
        })
    } else {
        return PlaylistService.addToPlaylist({
            brand: props.brand,
            contentId: props.content.content_id,
            importAssignments: importAll.value,
            playlistIds: playlistId ? [playlistId] : selectedPlaylists.value,
            addFull: addFullSongToggle.value,
            addInstrumentless: addInstrumentlessToggle.value,
            token,
        })
    }
};

const handleSaveItem = () => {
    if (selectedPlaylists.value.length) {
        isLoadingPlaylists.value = true;
        return saveData().then(() => {
            window.shownotification({ icon: 'check', text: `${title.value} has been successfuly added to your playlist(s).`, duration: 2000 });
        }).catch(() => {
            window.shownotification({ icon: 'error', text: 'An error ocurred while saving your changes, please try again later.' });
        }).finally(() => {
            isLoadingPlaylists.value = false;
            handleCancel();
        });
    } else {
        handleCancel();
    }
};

const handleCreate = () => {
    emit('onCancel');
    window.openplaylistmodal({
        modalType: 'create',
        data: { ...props.content, brand: props.brand, hasAddItemCallback: true, additionalItems: additionalItems.value, importAssignments: importAll.value },
    });
    window.addItemCallback = function (playlistId) {
        console.log('callback called')
        saveData(playlistId);
        window.addItemCallback = null;
    }
}

const handleScroll = (e) => {
    if ((e.target.scrollHeight - e.target.scrollTop - e.target.clientHeight < 1) && !preventReFetch.value) {
        pageNumber.value = pageNumber.value + 1;
        e.target.scrollTop = e.target.scrollTop / pageNumber.value;
        getUserPlaylists();
    }
}

const handleDuplicateConfirm = () => {
    addRemovePlaylistSelection(duplicateProps.value.id);
    handleDuplicateCancel();
};

const handleDuplicateCancel = () => {
    duplicateProps.value = { id: null, show: false, title: '' };
};

const getUserPlaylists = () => {
    PlaylistService.getCurrentUserPlaylists({
        brand: props.brand,
        page: pageNumber.value,
        limit: 10,
        term: state.searchTerm,
        content_id: props.content.content_id
    }, token).then(r => {
        isLoadingPlaylists.value = false;
        const duplicatedItemIDs = [];
        const { data: { data } } = r;
        if (data.length) {
            const formattedTable = data.map((item) => {
                const { name, thumbnail_url, duration_formated, id, created_at, user_playlist_item_id, is_added_to_playlist } = item;
                const dateCreated = new Date(created_at);
                const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                const month = months[dateCreated.getMonth()];
                const formattedDate = `${month} ${dateCreated.getDate()}, ${dateCreated.getFullYear()}`;

                if (is_added_to_playlist) {
                    duplicatedItemIDs.push(String(id));
                    duplicatedItemIdNameMap.value = {
                        ...duplicatedItemIdNameMap.value,
                        [id]: name,
                    };
                }
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
            duplicatedIDs.value = duplicatedItemIDs;
            if(state.searchTerm.length) {
                state.formattedTable = [...formattedTable]
            } else {
                state.formattedTable = [...state.formattedTable, ...formattedTable]
            }
        } else {
            preventReFetch.value = true;
        }
    }).catch(() => {
        window.shownotification({ icon: 'error', text: 'An error ocurred while fetching your data, please try again later.' });
    });
}

onMounted(() => {
    isLoadingPlaylists.value = true;

    if (props.content.type === 'song') {
        showSongToggle.value = true;
        addFullSongToggle.value = true;
    }

    //If Adding a Routine
    showVocalRoutineToggles.value = props.content.type === 'routine' ? true : false ;

    if (props.content.type !== 'Assignments') {
        isLoadingAssignments.value = true;
        PlaylistService.getAssignmentsForContent({ token, contentId: props.content.content_id, brand: props.brand }).then((r) => {
            const { data: { soundslice_assignments_count } } = r;
            additionalItems.value = soundslice_assignments_count;
            isLoadingAssignments.value = false;
        }).catch(() => {
            window.shownotification({ icon: 'error', text: 'An error ocurred while fetching your data, please try again later.' });
        });
    }
    getUserPlaylists();
});
</script>

<template>
    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">

        <AddDuplicate v-if="duplicateProps.show" :title="duplicateProps.title" :brand="brand"
            @onConfirm="() => handleDuplicateConfirm(duplicateProps.id)" @onClose="handleDuplicateCancel"  />

        <div v-if="isLoadingAssignments || isLoadingPlaylists"
            class="tw-z-40 tw-flex tw-w-full tw-h-full tw-text-white tw-absolute tw-top-0 tw-left-0 tw-items-center tw-justify-center tw-bg-black/40">
            <LoadingSpinner class="tw-w-[40px] tw-h-[40px] tw-text-white" />
        </div>

        <div class="tw-relative tw-w-full">
            <h2 class="tw-text-[24px] tw-font-bold tw-w-full tw-text-center">Add Item to Playlist</h2>
        </div>

        <div class="tw-flex tw-w-full tw-justify-center tw-flex-col tw-mt-2 lg:tw-mt-4" v-if="additionalItems > 0 && content.type !== 'song'">
            <p class="tw-text-center tw-text-[14px] tw-mb-1 lg:tw-mb-3">
                Your selected video(s) also contain(s) {{
                    additionalItems
                }} additional
                assignment items. Would you like to import them into your playlist?
            </p>
            <div class="tw-flex tw-w-full">
                <fieldset class="tw-flex tw-flex-row tw-items-center tw-justify-between tw-w-full">
                    <b class="tw-uppercase tw-text-sm">Additional Playlist Items</b>
                    <Toggle :initialValue="addFullSongToggle"
                            id="import-all-toggle"
                            @onToggle="handleOnToggleAssignments"
                    />
                </fieldset>
            </div>
        </div>

        <div class="sm:tw-hidden tw-mt-4">
            <button @click="handleCreate"
                    class="tw-btn-secondary tw-btn-small tw-uppercase tw-text-[#3F3F46] dark:tw-text-white">
                <PlusIcon class="tw-w-[15px] tw-h-[15px]" />
                <span class="tw-pl-[6px]">CREATE PLAYLIST</span>
            </button>
        </div>

        <!-- Song Instrument Toggles -->
        <div class="tw-flex tw-w-full tw-justify-center tw-flex-col tw-pt-[18px]" v-if="showSongToggle">
            <p class="tw-text-[16px] tw-text-center tw-w-full tw-pb-[20px]">This song contains both full and {{
                instrumentless }} tracks. Choose which tracks you want to add.</p>
            <div class="tw-flex tw-justify-center tw-w-full">
                <fieldset class="tw-flex tw-flex-row tw-items-center tw-mx-4">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]">
                        <strong class="tw-uppercase">FULL TRACK</strong>
                    </p>
                    <Toggle
                        :initialValue="addFullSongToggle"
                        :brand="brand"
                        id="toggle-full-song"
                        @onToggle="handleOnToggleFullSong"
                    />
                </fieldset>
                <fieldset v-if="additionalItems > 1" class="tw-flex tw-flex-row tw-items-center tw-mx-4">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]">
                        <strong class="tw-uppercase">{{ instrumentless }} TRACK</strong>
                    </p>
                    <Toggle
                        :initialValue="addInstrumentlessToggle"
                        :brand="brand"
                        id="toggle-instrumentless-song"
                        @onToggle="handleOnToggleInstrumentlessSong"
                    />
                </fieldset>
            </div>
        </div>

        <!-- Vocal Routine Toggles -->
        <div class="tw-flex tw-w-full tw-justify-center tw-flex-col tw-pt-[18px]" v-if="showVocalRoutineToggles">
            <p class="tw-text-[16px] tw-text-center tw-w-full tw-pb-[20px]">
                This routine contains variants for high and low voices. <br>
                Choose which variant(s) you want to import.
            </p>
            <div class="tw-flex tw-justify-center tw-w-full">
                <fieldset class="tw-flex tw-flex-row tw-items-center tw-mx-4">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]"><strong class="tw-uppercase">High</strong></p>
                    <Toggle
                        id="toggle-high-voice"
                        :brand="brand"
                        :initialValue="includeHighRoutine"
                        @onToggle="handleHighRoutine"
                    />
                </fieldset>
                <fieldset class="tw-flex tw-flex-row tw-items-center tw-mx-4">
                    <p class="tw-text-center tw-text-[14px] tw-pr-[16px]"><strong class="tw-uppercase">Low</strong></p>
                    <Toggle
                        id="toggle-low-voice"
                        :brand="brand"
                        :initialValue="includeLowRoutine"
                        @onToggle="handleLowRoutine"
                    />
                </fieldset>
            </div>
        </div>

        <!-- Search -->
        <div v-if="state.formattedTable.length" class="tw-relative tw-w-full tw-mt-5 tw-pb-[24px]">
            <MusoraIcon
                icon-name="search"
                class="tw-absolute tw-top-5 tw-left-[26px] dark:tw-text-[#9EC0DC] tw-z-0"
            />
            <input type="text"
                   class="tw-px-[50px] tw-w-full tw-h-[50px] focus:tw-ring-0 tw-text-[#00101D] dark:tw-text-white dark:focus:tw-bg-[#00101D] dark:placeholder:tw-text-[#9EC0DC] dark:tw-border-[#445F74] tw-bg-white dark:tw-bg-transparent tw-rounded-full focus:tw-ring-0 focus:tw-outline-none tw-text-[#00101D] dark:tw-text-white tw-border tw-border-[#D4D4D8]"
                   placeholder="Search"
                   v-model="state.searchTerm"
                   @keyup.enter="searchPlaylists"
            >
            <button v-if="state.searchTerm.length"
                    class="tw-absolute tw-top-4 tw-w-[18px] tw-right-[22px] dark:tw-text-white tw-z-0"
                    @click="clearSearch"
            >
                <XIcon class="" />
            </button>
        </div>

        <Table @onActionClick="handleActionClick"
            @onScroll="handleScroll"
            :classOverride="`tw-max-h-[150px] sm:tw-max-h-[260px] lg:tw-max-h-[350px] ${ state.formattedTable.length < 4 && 'lg:tw-overflow-y-hidden'}`"
            :stickyHeader="true"
            :rows="state.formattedTable"
        >
            <template v-slot:actionContent="slotProps">
                <PlusCircleIcon v-if="!selectedPlaylists.includes(String(slotProps.actionPayload))"
                    class="tw-w-[30px] tw-h-[30px] tw-text-[#3F3F46] dark:tw-text-white" />
                <CheckCircleIcon v-if="selectedPlaylists.includes(String(slotProps.actionPayload))"
                    :class="`tw-w-[30px] tw-h-[30px] tw-text-[#4ADE80]`" />
            </template>
        </Table>
        <div class="tw-w-full tw-flex tw-flex-col sm:tw-flex-row sm:tw-justify-between tw-pt-[25px] tw-max-w-xs sm:tw-max-w-none tw-mx-auto">
            <button @click="handleCreate"
                class="tw-btn-secondary tw-uppercase tw-text-[#00101D] dark:tw-text-white tw-min-w-[167px] tw-h-[35px] tw-hidden sm:tw-inline-flex tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D] disabled:tw-opacity-40"
                :disabled="props.content.type === 'song' && (addInstrumentlessToggle === false && addFullSongToggle === false) || (includeHighRoutine === false && includeLowRoutine === false)"
            >
                <PlusIcon class="tw-w-[15px] tw-h-[15px]" />
                <span class="tw-pl-[6px]">CREATE PLAYLIST</span>
            </button>
            <!--Save Buttons -->
            <button v-if="props.content.type === 'song'"
                    @click="handleSaveItem"
                    :class="`tw-btn-primary tw-uppercase tw-text-white dark:tw-text-[#00101D] disabled:tw-bg-[#B2B2B5] disabled:tw-text-[#65656B] dark:disabled:tw-bg-[#081F37] dark:disabled:tw-text-[#445F74] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white tw-h-[35px]`"
                    :disabled="selectedPlaylists.length === 0 || (addInstrumentlessToggle === false && addFullSongToggle === false) "
            >
                SAVE
            </button>
            <button v-else-if="props.content.type === 'routine'"
                    @click="handleSaveItem"
                    :class="`tw-btn-primary tw-uppercase tw-text-white dark:tw-text-[#00101D] disabled:tw-bg-[#B2B2B5] disabled:tw-text-[#65656B] dark:disabled:tw-bg-[#081F37] dark:disabled:tw-text-[#445F74] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white tw-h-[35px]`"
                    :disabled="selectedPlaylists.length === 0 || (includeHighRoutine === false && includeLowRoutine === false)"
            >
                SAVE
            </button>
            <button v-else
                    @click="handleSaveItem"
                    :class="`tw-btn-primary tw-uppercase tw-text-white dark:tw-text-[#00101D] disabled:tw-bg-[#B2B2B5] disabled:tw-text-[#65656B] dark:disabled:tw-bg-[#081F37] dark:disabled:tw-text-[#445F74] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white tw-h-[35px]`"
                    :disabled="selectedPlaylists.length === 0"
            >
                SAVE
            </button>

        </div>
    </div>
</template>
