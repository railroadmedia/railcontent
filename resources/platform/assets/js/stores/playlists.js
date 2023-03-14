import { defineStore } from 'pinia';
import PlaylistService from '../services/playlists';

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => {
    return {
      playlists: [], // For Collection Page
      lessons: [], // For Detail Page
      pinnedPlaylists: [], // [{ id: '', title: '', isPinned: false}]
      activePlaylist: {}, //playlist a user is a currently viewing 
      modalOpen: {
        modalType: null,
      },
      pageHasPlaylistCatalog: false, 
      loadingPlaylists: false,
      loadingLessons: false,
      sortingPlaylist: false,
      loadingPinnedPlaylists: false,
      playlistsQuantity: 0,
      resultsPage: 1
    }
  },
  getters: {
    pinnedQuantity: (state) => state.pinnedPlaylists.length,
  },
  actions: {
    update({ pinnedPlaylists }) {
      this.$patch({
        pinnedPlaylists,
      })
    },

    updatePlaylists({ playlists }) {
      this.$patch({
        playlists,
      })
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
    async getPlaylists(payload, token) {
      const response = await PlaylistService.getCurrentUserPlaylists(payload, token);
      try {
        this.loadingPlaylists = false;
        this.playlists = await response.data.data;
        this.playlistsQuantity = await response.data.meta.totalResults;
      } catch {
        console.log('there was an error with your request');
        //hard reload?
      }
    },
    async getPlaylistLessons(payload, token) {
      const response = await PlaylistService.getPlaylistLessons(payload, token);
      try {
        this.loadingLoading = false;
        this.lessons.concat(response.data.data);
      } catch {
        console.log('there was an error with your request');
        //hard reload?
      }
    },

    //Static Updates
    deletePlaylist(playlist) {
      this.playlists = this.playlists.filter(p => {
        return p.id !== playlist.id;
      })
      this.playlistsQuantity--;
    },
    deletePlaylistItem(item, index) {
      this.lessons = this.lessons.filter((l,i) => {
        return l.user_playlist_item_id !== item.user_playlist_item_id;
      })
    },
    //Set/Update Playlist Data for Playlist page
    setActivePlaylist(list) {  
      this.activePlaylist = list;
    },
    updateActivePlaylist(list) {  
      this.activePlaylist.thumbnail_url = list.thumbnail_url,
      this.activePlaylist.name = list.name,
      this.activePlaylist.description = list.description
    },
    //Pin/Unpin
    pinPlaylist(list) {
      //Pin in Catalog IF Playlist Collection Page
      if( window.location.href.indexOf("/playlists") > -1 ) {     
        let playlist = this.playlists.find(p => p === list);
        playlist.pinned = true;
      }
      //Pin in Sidebar
      this.pinnedPlaylists.push(list)
    },
    unpinPlaylist(id) {
      //Unpin from Playlist Detail Page
      if (window.location.href.indexOf("/playlist/") > -1 ) {
        this.activePlaylist.pinned = false;
      } else {
        //Unpin from Catalog (wherever there's a catalog)
        let playlist = this.playlists.find(p => p.id === id)
        playlist.pinned = false;
      }
      
      //Unpin from Sidebar
      this.pinnedPlaylists = this.pinnedPlaylists.filter(p => {
        return p.id !== id;
      })
    },
    updatePinnedItem(id, name){
      if(this.pinnedPlaylists.length) {
        let pinnedList = this.pinnedPlaylists.find(l => l.id === id);
        pinnedList.name = name;
      }
    },
    //Update Set/Time
    updatePlaylistItem(data) {
      let lesson = this.lessons.find(l => l.user_playlist_item_id === data.user_playlist_item_id);
      lesson.start_second = data.start;
      lesson.end_second = data.end
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
