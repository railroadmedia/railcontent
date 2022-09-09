import { defineStore } from 'pinia'

export const useConfirmationStore = defineStore({
  id: 'Confirmation',
  state: () => ({
    title: null,
    subtitle: null,
    submit: () => { },
    cancel: () => { },
  }),

  actions: {
    update({
      title,
      subtitle,
      submit,
      cancel,
    }) {
      this.$patch({
        title,
        subtitle,
        submit,
        cancel,
      });
    },
  },
})
