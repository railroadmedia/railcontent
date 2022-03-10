<script>
const appRoot = document.getElementById('app')
const modalRoot = document.getElementById('modal-container')

export default {
  name: 'Modal',
  props: ['close'],
  emits: ['close'],
  setup(props, context) {
    const onClose = () => {
      context.emit('close', true)
    }
    const onOverlayClick = (event) => {
      if (event.target.id === 'modal-overlay') {
        context.emit('close', true)
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
      class="tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center tw-bg-[#081825] tw-opacity-90"
      v-on:click="onOverlayClick"
      style="
         {
          backdropfilter: 'blur(64px)';
        }
      "
    >
      <slot></slot>
    </div>
  </teleport>
</template>
