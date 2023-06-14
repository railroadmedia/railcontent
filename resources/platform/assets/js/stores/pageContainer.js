import { defineStore } from 'pinia';

export const usePageContainerStore = defineStore({
  id: 'PageContainer',
  state: () => {
    return {
        isSidebarHidden: false,
        isSidebarCollapsed: false,
        isPlaylistModalOpen: false,
    }
  },
  actions: {
    
  }
});
