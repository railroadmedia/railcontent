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
        }
    });

    //--------Refs--------//

    const itemName = ref(props.content.playlist_item_name);
    const nameKey = ref(props.content.playlist_item_name);

    //--------Computed--------//

    const authors = computed(() => {
        if (props.content.artist && props.content.artist.length) {
            return props.content.artist;
        }

        let authors = [];
        if (props.content.instructors) {
            props.content.instructors.forEach((instructor) => {
                authors.push(instructor);
            });
        }
        return authors.join(', ');
    });

    //-----------Methods-----------//

    const handleConfirm = () => {
        PlaylistService.updatePlaylistItem({
            user_playlist_item_id: props.content.user_playlist_item_id,
            playlist_item_name: itemName.value,
        }, token)
            .then(() => {
                window.shownotification({
                    icon: 'edit',
                    text: 'Playlist item name has been successfully edited.'
                });
                playlistsStore.updatePlaylistItem({
                    ...props.content,
                    playlist_item_name: itemName.value,
                });
                emit('onCloseModal');
            })
            .catch(() => {
                window.shownotification({
                    icon: 'error',
                    text: 'There was an error saving your changes, try again later.'
                });    
            });
    };

    const handleReset = () => {
        const name = itemName.value;
        itemName.value = props.content.playlist_item_name;
        nameKey.value = name;
    };

    const handleNameChange = val => {
        itemName.value = val;
    };
</script>
<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">Rename Playlist Item</h2>
        <div class="tw-flex tw-mt-[20px] tw-pb-4 tw-h-[80px] tw-items-center tw-justify-center">
            <img :src="content.thumbnail_url" class="tw-h-[80px] tw-min-w-[145px]" />
            <div class="tw-ml-[15px] tw-h-full tw-flex tw-flex-col tw-justify-around">
                <h3 class="tw-text-black dark:tw-text-white tw-text-[16px] tw-font-bold tw-font-open-sans">
                    {{ content.playlist_item_name }}
                </h3>
                <p class="tw-text-black dark:tw-text-[#9EC0DC]">{{ authors }}</p>
            </div>
        </div>
        <div class="tw-flex tw-mt-[16px]">
            <InputLabel
                :initialValue="itemName"
                :key="nameKey"
                inputOverride="tw-w-full tw-h-[42px] tw-text-[#00101D]"
                :brand="brand"
                inputType="text"
                id="newItemName"
                inputName="newItemName"
                labelValue="New Name"
                placeholder="Enter a name for your item..."
                :inputErrors="[]"
                @onChange="handleNameChange"
            />
            <div class="tw-flex tw-flex-col tw-justify-end">
                <button @click.prevent="handleReset" class="tw-flex tw-items-center tw-justify-center tw-rounded-full tw-ml-[8px] tw-bg-white tw-text-black tw-h-[42px] tw-w-[42px]">
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.2713 3.14273C4.2713 2.79558 3.98986 2.51416 3.64273 2.51416C3.29561 2.51416 3.01416 2.79558 3.01416 3.14273V7.72607C3.01416 8.07321 3.29561 8.35463 3.64273 8.35463H8.22604C8.57324 8.35463 8.85461 8.07321 8.85461 7.72607C8.85461 7.37891 8.57324 7.0975 8.22604 7.0975H5.27401C6.48703 5.10324 8.68082 3.7713 11.1856 3.7713C15.0042 3.7713 18.0999 6.86693 18.0999 10.6856C18.0999 14.5042 15.0042 17.5999 11.1856 17.5999C8.64184 17.5999 6.4189 16.2262 5.21815 14.1802C5.09354 13.9678 4.87033 13.8284 4.62411 13.8284C4.15621 13.8284 3.84215 14.3044 4.07303 14.7114C5.47719 17.1868 8.13634 18.857 11.1856 18.857C15.6985 18.857 19.357 15.1985 19.357 10.6856C19.357 6.17263 15.6985 2.51416 11.1856 2.51416C8.2743 2.51416 5.71866 4.03661 4.2713 6.32876V3.14273Z" fill="#18181B"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="tw-pt-[25px] tw-flex tw-justify-end tw-w-full">
            <!-- Close Modal -->
            <button @click="() => emit('onCloseModal')"
                    class="tw-btn-secondary tw-text-[#002039] dark:tw-text-white tw-mr-4 tw-w-[218px]">
                    CANCEL
            </button>
            <!-- Delete Lesson -->
            <button :class="`tw-mb-2 tw-ml-auto tw-btn-primary dark:tw-bg-white dark:tw-text-black tw-text-white tw-bg-black tw-px-[30px] tw-w-[218px]`"
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
