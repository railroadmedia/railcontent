<script setup>
/*

TODO: Open Create Playlist and on close open the addItem again with the right props

*/
import { ref, onMounted } from 'vue';
import PlaylistService from '../../../services/playlists';
import Toggle from '../Toggle/Toggle.vue'
import Table from '../Table/Table.vue'
import { PlusCircleIcon, PlusIcon } from '@heroicons/vue/outline';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    contentId: {
        type: String,
        default: null
    }
});


const importAll = ref(false);
const formattedRows = ref([]);
const additionalItems = ref(0);

const handleOnToggle = (val) => {
    importAll.value = val;
};

const handleActionClick = (payload) => {
    console.log(payload);
};

onMounted(() => {
    PlaylistService.getAssignmentsForContent({ token: props.csrf_token, contentId: props.contentId, brand: props.brand }).then((r) => {
        console.log(r)
    });
    PlaylistService.getCurrentUserPlaylists({ token: props.csrf_token }).then(r => {
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
    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-white tw-text-center">
        <h2 class="tw-text-[24px] tw-font-bold tw-w-full tw-text-center">Add Item to Playlist</h2>
        <h4 class="tw-text-[16px] tw-text-left tw-w-full">Additional Playlist Items</h4>
        <div class="tw-flex tw-w-full">
            <fieldset class="tw-flex tw-flex-row tw-items-center tw-w-full">
                <p class="tw-text-left tw-text-[14px] tw-pr-[16px]">Your selected videos contain 7 additional assignment items. Would you like to also import them into your playlist?</p>
                <Toggle @onToggle="handleOnToggle" />
            </fieldset>
        </div>
        <Table @onActionClick="handleActionClick" classOverride="tw-mt-[24px]" :rows="formattedRows">
            <template v-slot:actionContent>
                <PlusCircleIcon class="tw-w-[23px] tw-h-[23px] tw-text-[#7E9AB1]"  />
            </template>
        </Table>
        <div class="tw-w-full tw-flex tw-justify-between tw-pt-[25px]">
            <button class="tw-btn-secondary tw-uppercase tw-text-[#9EC0DC] tw-min-w-[167px] tw-h-[35px]">
                <PlusIcon class="tw-w-[12px] tw-h-[12px]" />
                <span class="tw-pl-[6px]">CREATE NEW LIST</span>
            </button>
            <div class="tw-flex">
                <button class="tw-btn-primary tw-uppercase tw-text-white tw-h-[35px]">CANCEL</button>
                <button :class="`tw-btn-primary tw-uppercase tw-text-white tw-bg-${brand} tw-h-[35px]`">CONFIRM</button>
            </div>
        </div>
    </div>
</template>