<script setup>
    import platformHeader from "../../PlatformHeader/platform-header.vue";
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue'
    import { onBeforeMount, ref, inject, reactive } from 'vue';

    //Props
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        playlist: {
            type: Object,
            default: {}
        }
    })
    //Methods
    
    //Lifecycle Hooks
    onBeforeMount(() => {
        console.log(props.playlist)
    })
</script>
<template>
    <platform-header
        :backgroundImage="playlist.thumbnail_url"
    >
        <template v-slot:content> 
            <div class="tw-flex">
                <!-- Thumbnail -->
                <div class="tw-w-[198px] tw-h-[198px] tw-relative tw-rounded tw-shrink-0 tw-mr-[20px] tw-overflow-hidden">
                    <img :src="playlist.thumbnail_url" alt="Playlist Thumbnail" class="tw-object-cover tw-h-full tw-w-full">
                </div>
                <!-- Content -->
                <div class="tw-flex-col">
                    <!-- Avatar -->
                    <div class="tw-flex tw-items-center tw-mb-2">
                        <div class="tw-h-[40px] tw-w-[40px] tw-rounded-full tw-overflow-hidden tw-mr-[9px]">
                            <img :src="playlist.user['fields.profile_picture_image_url']" alt="">
                        </div>
                        <p class="tw-font-bebas-neue tw-text-white tw-text-xl">{{ playlist.user.display_name }}</p>
                    </div>
                    <div class="tw-text-white tw-flex tw-flex-col tw-mb-3">
                        <h1 class="tw-capitalize tw-leading-none tw-mb-1">{{ playlist.name }}</h1>
                        <p>{{ playlist.description }}</p>
                    </div>
                    <a href="" class="tw-w-[50px] tw-inline-flex" :class="`tw-text-${brand}`" :title="`Go To Player`">
                        <i class="tw-text-[50px] fas fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </template>
        <template v-slot:ctas> 

        </template>
    </platform-header>
</template>