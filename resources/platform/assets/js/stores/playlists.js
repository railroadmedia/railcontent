import { defineStore } from 'pinia'

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => ({
    playlists: [], // [{ id: '', title: '', isPinned: false}]
    modalOpen: null,
  }),

  actions: {
    update({ playlists }) {
      this.$patch({
        playlists,
      });
    },
    openModal({ modalType }) {
      this.$patch({
        modalOpen: modalType,
      });
    }
  },
});
