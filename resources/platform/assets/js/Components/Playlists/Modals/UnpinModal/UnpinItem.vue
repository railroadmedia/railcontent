<script setup>
    import { onBeforeMount, inject, computed, reactive } from 'vue';
    import MusoraIcon from '../../../MusoraIcons/MusoraIcon.vue';
    import PlaylistThumbnail from '../../PlaylistThumbnail.vue';
    import PlaylistService from '../../../../Services/playlists';
    import { usePlaylistsStore } from '../../../../Stores/playlists';

    //Inject
    const token = inject('csrf_token');
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //Emits
    const emit = defineEmits(['onUnpin']);

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        list: {
            type: Object,
            default: {}
        }
    });

    //-----------Computed Props-----------//
    const duration_formated = computed(()=> {
        return props.list.duration_formated.replace(/^0(?:0:0?)?/, '');;
    })

    //-----------Reactive Data-----------//
    const state = reactive({ 
            isPinned: true,
        });
    
    //-----------Methods-----------//
    const handleUnpin = () => {
        state.isPinned = !state.isPinned;
        //emit event with list id
        emit('onUnpin', props.list.id)
    }
</script>
<template>
    <div class="tw-relative tw-h-[52px] tw-flex tw-flex-row tw-w-full tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#F9F9F9] dark:even:tw-bg-[#00101D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10 tw-rounded tw-cursor-pointer"
         @click.prevent="handleUnpin()"
    >
        <!-- Playlist thumbnail -->
        <PlaylistThumbnail 
            :list="list"
            :brand="brand"
        />       

        <!-- PLAYLIST INFO: clickable link -->
        <div  class="tw-flex tw-items-center tw-w-full tw-text-[#0D0D0D] dark:tw-text-white">
            <div class="tw-flex tw-w-full tw-items-center">
                <!--name-->
                <p class="tw-font-bold tw-capitalize tw-truncate tw-pl-2 md:tw-pl-[19px] tw-pr-2 tw-w-full"
                >
                    {{ list.name }} 
                </p>
                <!--category / duration -->
                <div class="tw-ml-auto tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm tw-flex tw-w-full tw-pl-2 md:tw-pl-0 md:tw-text-base"
                >
                    <div class="md:tw-w-1/2 tw-inline-flex tw-items-center tw-justify-center">
                        <span v-if="list.category">
                            {{ list.category }}
                        </span>   
                    </div> 
                    <div class="md:tw-w-1/2 tw-text-center">
                        {{ duration_formated || "0:00" }}
                    </div>
                </div>
            </div>
            <!-- Pinned Icon -->
            <button class="tw-inline-flex tw-items-center tw-transition-colors tw-px-4 xl:tw-px-8" 
                    :class="state.isPinned ? `tw-text-${brand}` : 'dark:tw-text-[#7E9AB1] tw-text-[#445F74]/50'"
                    title="Unpin Playlist"
            >
                <musora-icon icon-name="tack" class="tw-w-[24px] tw-h-[24px] tw-mx-auto tw-hidden md:tw-flex" />
            </button>
        </div>
    </div>
</template>../../../../Services/playlists