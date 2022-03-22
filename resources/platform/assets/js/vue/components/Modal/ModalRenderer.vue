<script>
const appRoot = document.getElementById('app')
const modalRoot = document.getElementById('modal-container')

export default {
    name: 'ModalRenderer',
    emits: ['onClose'],
    setup(props, context) {
        const onClose = () => {
            context.emit('onClose', true)
        }
        const onOverlayClick = (event) => {
            if (event.target.id === 'modal-overlay') {
                context.emit('onClose', true)
            }
        }
        return {
            onClose,
            onOverlayClick
        }
    },
    mounted() {
        modalRoot.classList.add('tw-fixed')
        modalRoot.classList.remove('tw-hidden')
        appRoot.classList.add('tw-blur-sm')
        appRoot.classList.add('tw-overflow-hidden')
    },
    unmounted() {
        modalRoot.classList.remove('tw-fixed')
        modalRoot.classList.add('tw-hidden')
        appRoot.classList.remove('tw-blur-sm')
        appRoot.classList.remove('tw-overflow-hidden')
    }
}
</script>

<template>
    <teleport to="#modal-container">
        <div
            id="modal-overlay"
            class="tw-absolute tw-h-full tw-w-full tw-bg-[#081825] tw-bg-opacity-90"
            v-on:click="onOverlayClick"
            style="
                 {
                    backdropfilter: 'blur(64px)';
                }
            "
        ></div>
        <div
            class="tw-absolute tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center"
        >
            <slot></slot>
        </div>
    </teleport>
</template>
