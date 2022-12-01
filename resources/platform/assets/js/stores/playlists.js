import { defineStore } from 'pinia'

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => ({
    playlists: [], // [{ id: '', title: '', isPinned: false}]
    modalOpen: {
      modalType: null,
    },
  }),

  actions: {
    update({ playlists }) {
      this.$patch({
        playlists,
      });
    },
    openModal(modalOpen) {
      this.$patch({
        modalOpen,
      });
    },
    modalReset() {
      console.log('reset called');
      this.$patch({
        modalType: null,
      });
    }
  },
});
