<script>
import Mixin from './_mixin';
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'CatalogueRoutineCard',
    mixins: [Mixin, ThemeClasses],
    computed: {
        mappedData() {
            return this.contentModel.card;
        },

        class_object() {
            return {
                'no-access': this.noAccess,
                completed: this.item.completed,
            };
        },
    },
    beforeDestroy() {
        this.mappedData = null;
    },
    methods: {
        showRoutineSoundSlice(type) {
            let soundSliceSlug = this.contentModel[`${type}_soundslice_slug`];

            this.$emit('showRoutineSoundSlice', { soundSliceSlug, title: this.contentModel.title, routineId: this.contentModel.id });
        },
    },
};
</script>
<template>
    <div
        class="tw-flex tw-flex-col pa-1 tw-border-box tw-w-full tw-mb-4 md:tw-mb-0"
        :class="class_object"
    >
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full">
            <div
                class="tw-flex tw-flex-col tw-rounded-lg tw-overflow-hidden tw-w-full tw-aspect-square tw-relative md:tw-h-[280px] md:tw-w-[280px] tw-mb-4 md:tw-mb-0 tw-flex-shrink-0"
                :class="[item.type + '-thumbnail']"
                style="aspect-ratio: 1 / 1" 
            >
                <div
                    class="bg-grey-2 active corners-10 dark:tw-bg-[#081825] tw-h-full tw-w-full tw-relative"
                >
                    <img
                        :src="mappedData.thumbnail"
                        alt="thumbnail"
                        class="tw-transition-opacity tw-duration-500 tw-absolute tw-object-cover tw-object-left tw-h-full tw-w-full"
                        loading="lazy"
                        :class="mappedData.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                        @load="mappedData.imageLoaded = true"
                    />
                </div>
            </div>

            <div class="tw-flex tw-w-full">
                <!-- Card Info -->
                <div class="card-info tw-flex tw-flex-col tw-px-4 tw-justify-center">
                    <h2 class="dark:tw-text-white tw-text-[#00101D] tw-text-xl tw-font-bold">{{ mappedData.black_title }}</h2>
                    <p class="tw-text-sm dark:tw-text-white tw-text-[#00101D] tw-mb-4 tw-mt-3">{{ mappedData.description }}</p>
                    
                    <div class="tw-flex tw-flex-col md:tw-flex-row tw-flex-wrap">
                        <button
                            class="tw-btn-primary tw-bg-singeo routine-high tw-w-full md:tw-w-auto tw-mb-4 md:tw-mb-2 md:tw-mr-4"
                            dusk="routine-high"
                            @click.stop.prevent="showRoutineSoundSlice('high')"
                        >   
                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-w-5">
                                <path d="M24.9702 17.68C24.3902 16.74 23.5202 15.97 22.4602 15.46C21.4702 14.99 20.3402 14.76 19.2102 14.81V12.77C20.3402 12.42 21.4202 11.94 22.4302 11.35C23.3302 10.83 24.0702 10.09 24.5402 9.23C25.0202 8.37 25.2302 7.41 25.1402 6.45C24.8702 4.42 23.1702 3 21.0902 3H21.0202C19.8702 3.02 18.7702 3.41 17.9502 4.12C17.1202 4.83 16.6302 5.8 16.5902 6.82V11.17C13.3602 12.31 9.7502 14.22 9.1002 18.33C8.7402 20.44 9.3602 22.58 10.8002 24.29H10.8102C12.1902 25.85 14.2002 26.88 16.4202 27.16H16.4502C16.4502 27.16 16.5302 27.16 16.5902 27.17V28.82C16.5902 29.25 16.3302 29.67 15.8702 29.9C15.4202 30.13 14.8502 30.13 14.3902 29.9C13.9402 29.67 13.6702 29.25 13.6702 28.82C13.6702 28.39 13.4102 28 13.0102 27.8C12.6102 27.6 12.1202 27.6 11.7202 27.8C11.3202 28 11.0602 28.39 11.0602 28.82C11.0602 30.11 11.8502 31.29 13.1102 31.93C14.3602 32.56 15.9102 32.56 17.1602 31.93C18.4202 31.29 19.2102 30.11 19.2102 28.82V27.1C21.1202 26.81 22.8602 25.95 24.1302 24.66C25.0402 23.7 25.6002 22.52 25.7502 21.28C25.9002 20.03 25.6302 18.78 24.9702 17.68ZM19.2102 6.82C19.2402 6.43 19.4402 6.06 19.7802 5.78C20.1202 5.5 20.5702 5.34 21.0502 5.34H21.0902C21.9602 5.34 22.4402 5.99 22.5502 6.7C22.5902 7.24 22.4702 7.76 22.2002 8.24C21.9302 8.72 21.5102 9.13 20.9902 9.43H20.9802C20.4402 9.76 19.8602 10.05 19.2502 10.28L19.2102 6.83V6.82ZM16.5902 15.47C15.5802 15.96 14.7102 16.64 14.0302 17.45C13.8102 17.71 13.7002 18.02 13.7502 18.35C13.8002 18.67 13.9902 18.96 14.2802 19.14C14.5602 19.33 14.9202 19.4 15.2602 19.35C15.6102 19.3 15.9102 19.13 16.1102 18.87H16.1202C16.2702 18.69 16.4302 18.52 16.6002 18.38V24.8C15.1302 24.57 13.8002 23.87 12.8902 22.83C11.8702 21.61 11.4502 20.12 11.6902 18.65H11.7002C12.0402 16.5 13.4902 14.96 16.6002 13.7V15.47H16.5902ZM23.1502 21C23.0602 21.77 22.7102 22.51 22.1502 23.11C21.3702 23.9 20.3302 24.46 19.1702 24.7L19.2102 17.15C19.8802 17.09 20.5502 17.19 21.1502 17.46C21.8102 17.75 22.3402 18.21 22.6802 18.76H22.6702C23.0802 19.45 23.2402 20.23 23.1502 21Z" fill="currentColor"/>
                            </svg>
                            <span class="text-white" :class="themeBgClass">high</span>
                        </button>
                        <button
                            class="tw-btn-primary tw-bg-singeo routine-low md:tw-mb-2 tw-w-full md:tw-w-auto"
                            dusk="routine-low"
                            @click.stop.prevent="showRoutineSoundSlice('low')"
                        >
                            <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.5083 9.14974C17.1112 9.14974 17.6 8.6909 17.6 8.12489C17.6 7.55889 17.1112 7.10005 16.5083 7.10005C15.9053 7.10005 15.4165 7.55889 15.4165 8.12489C15.4165 8.6909 15.9053 9.14974 16.5083 9.14974Z" fill="white"/>
                                <path d="M16.4861 12.9103C17.0749 12.9245 17.5646 12.488 17.5798 11.9352C17.595 11.3824 17.1299 10.9227 16.541 10.9085C15.9522 10.8942 15.4625 11.3308 15.4473 11.8836C15.4321 12.4364 15.8972 12.896 16.4861 12.9103Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.77142 7.64149C3.77142 5.72291 5.53993 3.6839 8.39435 3.6839C9.93892 3.6839 11.3566 4.36479 12.3862 5.60081C13.4017 6.82015 13.9609 8.51622 13.9609 10.3771C13.9609 12.9972 12.9793 15.3665 11.197 17.0482C9.61441 18.5418 7.52503 19.3982 5.46459 19.3982V17.6521C7.05521 17.6521 8.74556 16.9532 9.98632 15.7825C10.9976 14.8281 12.203 13.116 12.203 10.3771C12.203 7.51039 10.6012 5.43 8.39435 5.43C6.77874 5.43 5.88206 6.39914 5.76963 7.42165C6.14506 7.21714 6.58126 7.10005 7.04661 7.10005C8.45349 7.10005 9.59398 8.1706 9.59398 9.49135C9.59398 10.8121 8.45349 11.8827 7.04661 11.8827C6.10826 11.8827 5.28841 11.4061 4.84642 10.6972C4.7975 10.6187 4.74612 10.5414 4.68586 10.4702L4.43551 10.1746C3.94223 9.41329 3.77142 8.59561 3.77142 7.64149ZM7.04661 10.5162C7.64956 10.5162 8.13834 10.0574 8.13834 9.49135C8.13834 8.92535 7.64956 8.46651 7.04661 8.46651C6.44367 8.46651 5.95488 8.92535 5.95488 9.49135C5.95488 10.0574 6.44367 10.5162 7.04661 10.5162Z" fill="white"/>
                            </svg>
                            <span class="text-white" :class="themeBgClass">low</span>
                        </button>
                    </div>
                </div>

                <!-- Add to Playlist -->
                <div class="tw-inline-flex md:tw-items-center tw-p-1 tw-ml-auto">
                    <button 
                        class="tw-inline-flex tw-rounded-full tw-p-0.5 tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                        title="Add to Playlist"
                        :data-content-id="item.id"
                        :data-content-type="item.type"
                        @click.stop.prevent="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.black_title, description: mappedData.description, thumbnail_url: mappedData.thumbnail })"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-8 tw-w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>

