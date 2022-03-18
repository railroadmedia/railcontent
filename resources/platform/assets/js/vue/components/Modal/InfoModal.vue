<script>
import { XIcon } from '@heroicons/vue/solid'
export default {
    name: 'InfoModal',
    props: ['modalId', 'title'],
    components: { XIcon },
    emits: ['onClose'],
    setup(props, context) {
        const onClose = () => {
            context.emit('onClose', true)
        }
        const onOverlayClick = (event) => {
            console.log(event.target.id)
            if (event.target.id === `${props.modalId}-overlay`) {
                console.log('onOverlayClick')
                context.emit('onClose', true)
            }
        }
        return {
            onClose,
            onOverlayClick
        }
    },
    beforeMount() {
        let modalContainer = document.createElement("div");
        modalContainer.setAttribute('id', this.modalId);
        document.body.appendChild(modalContainer);
    },
    unmounted() {
        document.getElementById(this.modalId).remove();
    }
}
</script>

<template>
    <teleport to="#modal-container">
        <div
            :id="`${modalId}-overlay`"
            class="tw-absolute tw-h-full tw-w-full tw-bg-[#000000] tw-bg-opacity-80 tw-z-20"
            @click="onOverlayClick"
        ></div>
        <div
            class="tw-absolute tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center"
        >
            <div class="tw-w-[750px] tw-bg-[#081825] tw-rounded-[8px] tw-z-30 tw-py-[24px] tw-flex tw-flex-col">
                <div class="tw-flex tw-flex-row tw-justify-between tw-text-white tw-mb-[24px] tw-px-[40px]">
                    <h3>{{ title }}</h3><button @click="onClose" class="tw-self-end"><XIcon class="tw-text-[#E5E5E5] tw-h-[30px] tw-w-[30px]" /></button>
                </div>
                <slot></slot>
            </div>
        </div>
    </teleport>
</template>
