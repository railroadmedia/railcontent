<script setup>
    import { inject, onBeforeMount, computed, ref } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import InputLabel from '../../InputLabel/InputLabel.vue';

    //Emits
    const emit = defineEmits(['onCloseModal']);

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo'
        },
        content: {
            type: Object,
            default: {}
        },
        index: {
            type: Number,
            default: null
        }
    });

    //--------Refs--------//

    const itemName = ref(null);

    //-----------Methods-----------//

    const handleConfirm = () => {

    };

    const handleNameChange = () => {
        itemName.value = val;
    };

    //----------Lifecycle Hooks----------//
    onBeforeMount(()=> {

    })

</script>
<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">Rename Playlist Item</h2>
        <div class="tw-flex tw-pt-[29px] tw-pb-4 tw-h-[80px] tw-items-center tw-justify-center">
            <img :src="content.thumbnail_url" class="tw-max-h-[80px]" />
            <div class="tw-h-full tw-flex tw-flex-col tw-justify-around">
                <h3 class="tw-text-black dark:tw-text-white tw-text-[16px] tw-font-bold tw-font-open-sans">
                    Create a Practice Plan
                </h3>
                <p class="tw-text-black dark:tw-text-[#9EC0DC]">{{ content.artist_name }}</p>
            </div>
        </div>
        <div class="">
            <InputLabel
                :initialValue="content.name"
                inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
                :brand="brand"
                inputType="text"
                id="newItemName"
                inputName="newItemName"
                labelValue="New Name"
                placeholder="Enter a name for your item..."
                :inputErrors="[]"
                @onChange="handleNameChange"
            />
        </div>
        <div class="tw-pt-[30px] tw-flex tw-justify-end tw-w-full">
            <!-- Close Modal -->
            <button @click="() => emit('onCloseModal')"
                    class="tw-btn-secondary tw-text-[#002039] dark:tw-text-white tw-mr-4 tw-w-[218px]">
                    CANCEL
            </button>
            <!-- Delete Lesson -->
            <button :class="`tw-mb-2 tw-ml-auto tw-btn-primary tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                    @click.prevent="handleConfirm()"
            >
                RENAME ITEM
            </button>
        </div>
    </div>
</template>
<style>
    input[type=range]::-webkit-slider-thumb {
        z-index: 2;
        position: relative;
    }
</style>
