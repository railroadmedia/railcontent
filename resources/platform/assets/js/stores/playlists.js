import { defineStore } from 'pinia';
import PlaylistService from '../services/playlists';

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => {
    return {
      pinnedPlaylists: [], // [{ id: '', title: '', isPinned: false}]
      loadedPlaylists: [],
      modalOpen: {
        modalType: null,
      },
      loadingPinnedPlaylists: false,
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
    //Dynamic Updates
    async getPinnedPlaylists(brand, token) {
      this.loadingPinnedPlaylists = true;
      PlaylistService.getPinnedPlaylists(brand, token)
        .then((response) => {
          if(response.status === 200) {    
            this.pinnedPlaylists = response.data;
            this.loadingPinnedPlaylists = false;
          } else {
            console.log('there was an error with getPinnedPlaylist')
          }
        })
    },
    //Static Updates
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
