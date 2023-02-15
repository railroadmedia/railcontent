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
  getters: {
    pinnedQuantity: (state) => state.playlists.length
  },
  actions: {
    update({ playlists }) {
      this.$patch({
        playlists,
      });
    },
    pinPlaylist(playlist) {
      this.playlists.push(playlist)
    },
    unpinPlaylist(playlist) {
      this.playlists = this.playlists.filter(p => {
        return p.id !== playlist.id;
      })
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
