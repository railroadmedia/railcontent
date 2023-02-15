import { defineStore } from 'pinia'

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => {
    return {
      pinnedPlaylists: [], // [{ id: '', title: '', isPinned: false}]
      loadedPlaylists: [],
      modalOpen: {
        modalType: null,
      },
    }
  },
  getters: {
    pinnedQuantity: (state) => state.pinnedPlaylists.length
  },
  actions: {
    update({ pinnedPlaylists }) {
      this.$patch({
        pinnedPlaylists,
      });
    },
    pinPlaylist(playlist) {
      this.pinnedPlaylists.push(playlist)
    },
    unpinPlaylist(playlist) {
      this.pinnedPlaylists = this.pinnedPlaylists.filter(p => {
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
