import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useUserStore } from "@stores/user";
import { getAllStarted, getAllCompleted, fetchAll } from 'musora-content-services';

export function useLessonHistoryPageData() {
  const data = ref(null);
  const ids = ref([]);
  const userStore = useUserStore();
  const { brand } = storeToRefs(userStore);

  const fetchLessonData = async (key, { page = 1, limit = 10, sort = '', searchTerm = '' } = {}) => {
    try {
      // Get IDs based on the key
      ids.value = await (key === 'inProgress' ? getAllStarted() : getAllCompleted());
  
      // Fetch lesson data using the retrieved IDs
      const lessonsData = await fetchAll(brand.value, '', {
        page,
        limit,
        sort,
        searchTerm,
        includedFields: [`railcontent_id in [${ids.value.join(',')}]`],
      });
      
      data.value = lessonsData;
    } catch (error) {
      console.error(`Error fetching lesson data for key "${key}":`, error);
      data.value = null; // Reset data on error
    }
  };

  return {
    data,
    fetchLessonData,
  };
}
