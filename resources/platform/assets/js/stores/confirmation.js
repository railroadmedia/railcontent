import { defineStore } from 'pinia'

export const useConfirmationStore = defineStore({
  id: 'Confirmation',
  state: () => ({
    title: null,
    subtitle: null,
    submitLabel: 'Yes',
    hideCancel: false,
    callbacks: {
      submit: () => { },
      cancel: () => { },
    },
  }),

  actions: {
    update({
      title,
      subtitle,
      submitLabel,
      hideCancel,
      callbacks: {
        submit,
        cancel,
      }
    }) {
      this.$patch({
        title,
        subtitle,
        submitLabel,
        hideCancel,
        callbacks: {
          submit: submit ? submit : () => {},
          cancel: cancel ? cancel : () => {},
        },
      });
    },
    reset() {
      this.$patch({
        title: null,
        subtitle: null,
        submitLabel: 'Yes',
        hideCancel: false,
        callbacks: {
          submit: () => { },
          cancel: () => { },
        }
      });
    },
  },
})
