<script>
const appRoot = document.getElementById('app')
const modalRoot = document.getElementById('modal-container')
import { XIcon } from "@heroicons/vue/solid";

export default {
    name: 'ModalRenderer',
    emits: ['onClose'],
    props: {
        blackBackground: {
            type: Boolean,
            default: false
        },
        showXIcon: {
            type: Boolean,
            default: false,
        }
    },
    components: {
        XIcon
    },
    setup(props, context) {
        const onClose = () => {
            context.emit('onClose', true)
        }
        const onWrapperClick = (event) => {
            if (event.target.id === 'slot-wrapper') {
                context.emit('onClose', true)
            }
        }
        return {
            onClose,
            onWrapperClick
        }
    },
    mounted() {
        modalRoot.classList.add('tw-fixed')
        modalRoot.classList.remove('tw-hidden')
        appRoot.classList.add('tw-overflow-hidden')
    },
    unmounted() {
        modalRoot.classList.remove('tw-fixed')
        modalRoot.classList.add('tw-hidden')
        appRoot.classList.remove('tw-overflow-hidden')
    }
}
</script>

<template>
    <teleport to="#modal-container">
        <div
            @click="onClose"
            id="modal-overlay"
            class="tw-absolute tw-h-full tw-w-full tw-bg-opacity-90"
            :class="blackBackground ? 'tw-bg-black/85' : ''"
            :style="!blackBackground ? {
                backdropFilter: 'blur(1.5px)',
                background: 'linear-gradient(180deg, rgba(0, 12, 23, 0.69) 0%, #000C17 100%)',
            } : ''"
        ></div>
        <div id="slot-wrapper" @click="onWrapperClick"
            class="tw-absolute tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center"
        >
            <button v-if="showXIcon" class="tw-absolute tw-top-4 tw-right-4 tw-text-white" @click="onClose">
                <XIcon class="tw-h-[28px] md:tw-h-[36px] tw-w-[28px] md:tw-w-[36px]" />
            </button>
            <slot></slot>
        </div>
    </teleport>
</template>
