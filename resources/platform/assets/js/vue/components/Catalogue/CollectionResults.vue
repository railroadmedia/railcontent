<template>
    <div>
        <slot v-if="!loading"></slot>

        <transition name="show-from-bottom">
            <div
                v-show="loading "
                id="loadingDialog"
                class="flex flex-row align-center"
            >
                <div
                    class="loading-spinner corners-10 shadow pa flex-center"
                    :class="`bg-${brand}`"
                >
                    <i class="fas fa-spinner fa-spin text-white"></i>
                    <p class="tw-text-xs text-white">Loading Please Wait...</p>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
    import { onMounted, onUnmounted } from "vue";
    import { useCollectionStore } from "../../../stores/collection";

    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo',
        },
        currentPage: {
            type: Number,
            default: 1,
        },
        loading: {
            type: Boolean,
            default: false,
        },
        totalPages: {
            type: Number,
            default: 1,
        },
    });

    const emit = defineEmits(['onLoadMore'])

    const collectionStore = useCollectionStore();

    const infiniteScrollEventHandler = () => {
        let scrollEl = document.querySelector('#content-container');
        const scroll_position = scrollEl.scrollTop + scrollEl.offsetHeight;
        const scroll_buffer = scrollEl.scrollHeight * 0.9;

        if (scroll_position >= scroll_buffer && props.currentPage < props.totalPages) {
            emit('onLoadMore');
        }
    }

    onMounted(()=>{
        document.querySelector('#content-container').addEventListener("scroll", infiniteScrollEventHandler);
    })

    onUnmounted(()=>{
        document.querySelector('#content-container').removeEventListener("scroll", infiniteScrollEventHandler);
    })
</script>
