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
            style="
                 {
                    backdropfilter: 'blur(64px)';
                }
            "
        ></div>
        <div id="slot-wrapper" @click="onWrapperClick"
            class="tw-absolute tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center"
        >
            <slot></slot>
        </div>
    </teleport>
</template>
