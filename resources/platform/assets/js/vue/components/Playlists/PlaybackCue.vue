<script setup>
    import { onBeforeMount, onMounted, inject, ref, reactive, computed } from 'vue';
    import PlaylistService from '../../../services/playlists.js';
    import PlaylistCard from './Playlist/PlaylistCard.vue';
    import { usePlaylistsStore } from '../../../stores/playlists';
    import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //Emits
    const emit = defineEmits(['closeDropdown', 'pinItem', 'makePublic']);

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        playlistName: {
            type: String,
            default: "Playlist"
        },
        playlistUrl: {
            type: String,
            default: ""
        },
        playlistItemId: {
            type: String,
            default: ""
        },
        playlistItemPosition: {
            type: String,
            default: "1"
        },
        lessons: {
            type: Object,
            default: {}
        },
        duration: {
            type: String,
            default: "0"
        },
        inifiteScroll: {
            type: Boolean, 
            default: true,
        }
    })

    //-----------Computed Props-----------//
    const activeItem = computed(()=>{
        //Get index of playlist item 
        //TODO: may have to replace this with a request from BE later
        console.log('item id ', props.playlistItemId)
        console.log('lessons', props.lessons.data)
       // let item = props.lessons.data.find((item) => { item.user_playlist_item_id === props.playlistItemId })
        return props.playlistItemPosition
    })

    //-----------Refs-----------//
    const pageNumber = ref(1);
    const preventReFetch = ref(false);

    //-----------Reactive Data-----------//

    const state = reactive({
        isAutoPlay: false,
        isRepeat: false,
    })

    //-----------Static Data-----------//

    const scrollContainer = document.querySelector('#cue-scroll-container');

    //-----------Methods-----------//
    

    //-----------Lifecycle Hooks -----------//
    
    onMounted(()=> {
        //Handle infinite Scroll
        if(props.infiniteScroll) {
            scrollContainer.onscroll = () => {
                if ( (scrollContainer.scrollHeight - scrollContainer.scrollTop - scrollContainer.clientHeight < 1) && !preventReFetch.value ) {
                    pageNumber.value = pageNumber.value + 1;
                    //Payload
                    const payload = {
                        page: pageNumber.value,
                        limit: props.limit,
                        playlist_id: playlistsStore.activePlaylist.id,
                    };
                    //Get Lessons
                    playlistsStore.loadingLessons = true;
                    PlaylistService.getPlaylistLessons(payload, token).then(response => {
                        playlistsStore.loadingLessons = false;
                        if (response.data.results.length) {
                            playlistsStore.lessons = playlistsStore.lessons.concat(response.data.results);
                        } else {
                            preventReFetch.value = true;
                        }
                    }).catch(() => {
                        window.shownotification({ icon: 'error', text: 'An error ocurred while fetching your data, please try again later.' });
                    });
                }
            }
        }
    });

    onBeforeMount(()=> {
        // console.log(props.lessons)
        console.log('Active Item', activeItem)
        playlistsStore.lessons = props.lessons.data;
    })
</script>
<template>
    <section class="tw-z-10 tw-border dark:tw-border-[#002039] tw-border-[#e5e7ea] dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-mb-4">
        <!-- Header -->
        <div class="tw-flex tw-flex-col dark:tw-bg-[#002039] tw-bg-[#e5e7ea] tw-py-[17px] tw-px-[10px]">
            <a :href="playlistUrl" class="tw-inline-flex tw-mr-auto tw-pb-1 tw-large tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent hover:tw-border-current">
                {{ playlistName }}
            </a>
            <!-- Cue Data -->
            <p class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-mb-1">
                <span>{{ activeItem }}/{{ playlistsStore.lessons.length }}</span>
                <span class="tw-mx-1">•</span>
                <span>{{ Math.floor(duration / 60) }} min</span>
            </p>
            <!-- CTAs -->
            <div class="tw-flex">
                <button class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white tw-transition-colors tw-mr-3" @click.prevent="state.isAutoPlay = !state.isAutoPlay" title="Autoplay">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.7447 14.5602L17.1993 12.5479C17.1129 12.5048 17.0174 12.4823 16.9205 12.4823C16.8236 12.4823 16.728 12.5048 16.6417 12.5479C16.4632 12.6353 16.3518 12.8324 16.3518 13.0291V14.4945H14.3225C13.7555 14.4966 13.1995 14.3418 12.7183 14.0478C12.2371 13.7537 11.8504 13.3324 11.6026 12.8324L9.1283 7.99896C8.41297 6.59965 6.98573 5.747 5.40259 5.747H1.50027C1.35244 5.747 1.21066 5.80459 1.10612 5.90711C1.00158 6.00963 0.942856 6.14868 0.942856 6.29366C0.942856 6.43865 1.00158 6.57769 1.10612 6.68021C1.21066 6.78273 1.35244 6.84033 1.50027 6.84033H5.4028C5.96966 6.83821 6.52563 6.99306 7.00675 7.28705C7.48788 7.58105 7.87462 8.00225 8.12249 8.50223L10.5978 13.3356C11.3115 14.7363 12.7387 15.5882 14.3219 15.5882H16.3518V17.0532C16.3518 17.2505 16.4632 17.4251 16.6417 17.5344C16.732 17.5776 16.8311 17.6001 16.9316 17.6001C17.0321 17.6001 17.1313 17.5776 17.2216 17.5344L20.7673 15.5221C20.9457 15.4347 21.0571 15.2378 21.0571 15.0411C21.0571 14.8444 20.9008 14.6694 20.7447 14.5602Z" fill="currentColor"/>
                        <path d="M20.7457 5.83795L17.2106 3.83667C17.1244 3.79382 17.0292 3.77148 16.9326 3.77148C16.8359 3.77148 16.7407 3.79382 16.6546 3.83667C16.4767 3.92359 16.3655 4.1196 16.3655 4.31521V5.77301H14.3422C13.5801 5.77269 12.8326 5.97756 12.1817 6.36517C11.5307 6.75277 11.0014 7.30816 10.6516 7.97049L10.6293 8.01385C10.496 8.2748 10.6073 8.62208 10.874 8.75334C10.9629 8.7969 11.0297 8.81868 11.1185 8.81868C11.2214 8.81946 11.3223 8.79113 11.4091 8.73711C11.4959 8.68308 11.5649 8.60566 11.6077 8.51417L11.63 8.49239C11.8821 8.00045 12.2696 7.58712 12.7488 7.29893C13.2281 7.01073 13.78 6.85912 14.3426 6.86115H16.3655V8.31836C16.3655 8.51456 16.4767 8.6882 16.6546 8.7969C16.7446 8.83988 16.8435 8.86222 16.9437 8.86222C17.0439 8.86222 17.1428 8.83988 17.2328 8.7969L20.7681 6.79562C20.9458 6.7087 21.0571 6.5127 21.0571 6.31708C21.0571 6.12147 20.9013 5.94665 20.7457 5.83795Z" fill="currentColor"/>
                        <path d="M1.49152 15.5486H5.40569C6.99375 15.5486 8.40285 14.7145 9.1181 13.3669C9.25227 13.1103 9.14049 12.7892 8.87215 12.6397C8.60381 12.5114 8.26828 12.6183 8.11171 12.8749C7.85814 13.3586 7.4684 13.7651 6.98637 14.0485C6.50433 14.3319 5.94914 14.481 5.38329 14.4791H1.49152C1.34505 14.4817 1.20552 14.5392 1.10293 14.6392C1.00033 14.7392 0.942856 14.8737 0.942856 15.0138C0.942856 15.1539 1.00033 15.2884 1.10293 15.3884C1.20552 15.4884 1.34505 15.5459 1.49152 15.5486Z" fill="currentColor"/>
                        <path d="M11.1182 8.86868C11.2304 8.86953 11.3407 8.83862 11.4355 8.77955C11.5278 8.72213 11.6018 8.64044 11.649 8.54373L11.665 8.52813L11.6708 8.52244L11.6745 8.51519C11.9223 8.03166 12.3033 7.62523 12.7746 7.34178C13.2459 7.05832 13.7889 6.90915 14.3424 6.91115H14.3426H16.3155V8.31836C16.3155 8.53487 16.4384 8.7234 16.6285 8.83957L16.6284 8.83979L16.633 8.84202C16.7298 8.88823 16.8361 8.91222 16.9437 8.91222C17.0513 8.91222 17.1575 8.88823 17.2544 8.84202L17.2544 8.84213L17.2574 8.84041L20.7915 6.83986C20.9871 6.74346 21.1071 6.52951 21.1071 6.31708C21.1071 6.09606 20.9336 5.9082 20.7743 5.79696L20.7744 5.79677L20.7703 5.79444L17.2352 3.79316L17.2352 3.7931L17.2328 3.79191C17.1398 3.7456 17.0369 3.72148 16.9326 3.72148C16.8282 3.72148 16.7254 3.7456 16.6323 3.79191L16.6546 3.83667M11.1182 8.86868L11.1185 8.81868M11.1182 8.86868C11.1183 8.86868 11.1184 8.86868 11.1185 8.86868V8.81868M11.1182 8.86868C11.0191 8.86861 10.9446 8.84361 10.852 8.79824L10.852 8.7982C10.5598 8.65446 10.4389 8.27656 10.5848 7.99109L10.5849 7.99101L10.6071 7.94765L10.6074 7.94714C10.9615 7.27659 11.4973 6.71446 12.1561 6.32221C12.8148 5.92997 13.5711 5.72269 14.3422 5.72301C14.3422 5.72301 14.3422 5.72301 14.3422 5.72301H16.3155V4.31521C16.3155 4.10232 16.436 3.88782 16.6326 3.79175L16.6546 3.83667M11.1185 8.81868C11.0297 8.81868 10.9629 8.7969 10.874 8.75334L11.6077 8.51417C11.5649 8.60566 11.4959 8.68308 11.4091 8.73711C11.3223 8.79113 11.2214 8.81946 11.1185 8.81868ZM16.6546 3.83667C16.7407 3.79382 16.8359 3.77148 16.9326 3.77148C17.0292 3.77148 17.1244 3.79382 17.2106 3.83667L16.3655 5.72301V4.31521C16.3655 4.1196 16.4767 3.92359 16.6546 3.83667ZM16.6546 8.7969C16.4767 8.6882 16.3655 8.51456 16.3655 8.31836V6.91115L16.6546 8.7969ZM16.6546 8.7969C16.7446 8.83988 16.8435 8.86222 16.9437 8.86222C17.0439 8.86222 17.1428 8.83988 17.2328 8.7969L20.7681 6.79562C20.9458 6.7087 21.0571 6.5127 21.0571 6.31708C21.0571 6.12147 20.9013 5.94665 20.7457 5.83795L16.6546 8.7969ZM20.7734 14.5192L20.7735 14.519L20.7694 14.5167L17.224 12.5044L17.224 12.5043L17.2216 12.5031C17.1283 12.4566 17.0251 12.4323 16.9205 12.4323C16.816 12.4323 16.7129 12.4565 16.6197 12.503C16.4225 12.5996 16.3018 12.8151 16.3018 13.0291V14.4445H14.3225L14.3223 14.4445C13.7646 14.4466 13.2176 14.2943 12.7444 14.0051C12.2712 13.7159 11.891 13.3017 11.6474 12.8102L11.6471 12.8096L9.17282 7.97621C8.4487 6.55969 7.00397 5.697 5.40259 5.697H1.50027C1.33949 5.697 1.18509 5.75963 1.07111 5.87141C0.957093 5.98323 0.892856 6.1351 0.892856 6.29366C0.892856 6.45223 0.957093 6.60409 1.07111 6.71591C1.18509 6.8277 1.33949 6.89033 1.50027 6.89033L5.4028 6.89033L5.40298 6.89033C5.96064 6.88825 6.50751 7.04058 6.98068 7.32972C7.45385 7.61885 7.83405 8.033 8.0777 8.52444L8.07769 8.52444L8.07799 8.52502L10.5532 13.3583C11.2757 14.7763 12.7205 15.6382 14.3219 15.6382H16.3018V17.0532C16.3018 17.2707 16.4249 17.4602 16.6155 17.577L16.6154 17.5772L16.6201 17.5795C16.7172 17.6259 16.8237 17.6501 16.9316 17.6501C17.0396 17.6501 17.1461 17.6259 17.2432 17.5795L17.2432 17.5796L17.2463 17.5779L20.7907 15.5663C20.987 15.4694 21.1071 15.2545 21.1071 15.0411C21.1071 14.819 20.9331 14.631 20.7734 14.5192ZM16.3155 6.86115H14.3426H16.3155ZM1.49061 15.5986L1.49061 15.5986H1.49152H5.40569C7.01153 15.5986 8.43801 14.7549 9.16226 13.3903L9.16241 13.3901C9.31076 13.1063 9.18531 12.7569 8.89649 12.596L8.89654 12.5959L8.89372 12.5946C8.60111 12.4547 8.23829 12.5714 8.06903 12.8488L8.06894 12.8488L8.06743 12.8517C7.8183 13.327 7.43522 13.7266 6.96103 14.0054C6.48682 14.2842 5.94046 14.431 5.38347 14.4291H5.38329L1.49152 14.429L1.49061 14.4291C1.33174 14.4319 1.17996 14.4943 1.06803 14.6034C0.956023 14.7126 0.892856 14.8599 0.892856 15.0138C0.892856 15.1677 0.956023 15.315 1.06803 15.4242C1.17996 15.5333 1.33174 15.5957 1.49061 15.5986Z" stroke="#9EC0DC" stroke-width="0.1"/>
                    </svg>
                </button>
                <button class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white tw-transition-colors" @click.prevent="state.isRepeat = !state.isRepeat" title="Repeat">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.77143 11V8.38092C3.77143 7.6863 4.04737 7.02014 4.53853 6.52897C5.0297 6.0378 5.69586 5.76187 6.39048 5.76187H17.7397M17.7397 5.76187L15.1206 3.14282M17.7397 5.76187L15.1206 8.38092M17.7397 11V13.619C17.7397 14.3136 17.4637 14.9798 16.9726 15.471C16.4814 15.9621 15.8153 16.2381 15.1206 16.2381H3.77143M3.77143 16.2381L6.39048 18.8571M3.77143 16.2381L6.39048 13.619" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Items -->
        <div v-if="playlistsStore.lessons.length" 
             id="cue-scroll-container"
             class="tw-w-full tw-flex tw-flex-col tw-max-h-[540px] tw-overflow-y-auto"
        >
            <!-- Print Each Card -->
            <playlist-card 
                v-for="(lesson,i) in playlistsStore.lessons" 
                :key="i" 
                :index="i"
                :lesson="lesson"
                :token="token"
                :brand="brand"
                :cue-version="true"
            /> 
            <!-- Skeleton Loader For Infinite Scroll -->
            <div v-if="playlistsStore.loadingLessons && infiniteScroll" 
                 class="tw-w-full tw-animate-pulse tw-flex tw-flex-col"
            >   
                <div v-for="n in limit" 
                    :key="n" 
                    class="tw-flex tw-w-full tw-h-[90px] tw-flex-row tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#E6E7E9] dark:even:tw-bg-[#081825]"
                >
                </div>
            </div> 
        </div>
    </section>
</template>
