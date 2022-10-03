import { defineStore } from 'pinia'

export const useConfirmationStore = defineStore({
  id: 'Confirmation',
  state: () => ({
    title: null,
    subtitle: null,
    callbacks: {
      submit: () => { },
      cancel: () => { },
    },
  }),

  actions: {
    update({
      title,
      subtitle,
      callbacks: {
        submit,
        cancel,
      }
    }) {
      this.$patch({
        title,
        subtitle,
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
        callbacks: {
          submit: () => { },
          cancel: () => { },
        }
      });
    },
  },
})
