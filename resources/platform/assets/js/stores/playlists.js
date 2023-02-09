import { defineStore } from 'pinia'

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => {
    return {
      playlists: [], // [{ id: '', title: '', isPinned: false}]
      modalOpen: {
        modalType: null,
      },
    }
  },

  actions: {
    update({ playlists }) {
      this.$patch({
        playlists,
      });
    },
    pinItem(id) {

    },
    unpinItem(id) {

    },
    openModal(modalOpen) {
      this.$patch({
        modalOpen,
      });
    },
    modalReset() {
      this.$patch({
        modalType: null,
      });
    }
  },
});
