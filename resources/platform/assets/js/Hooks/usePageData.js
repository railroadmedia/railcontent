// hooks/usePageData.js
import { ref } from 'vue';

export function usePageData(page) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  const fetchPageData = async () => {
    try {
      const response = await fetch(`https://api.example.com/pages/${page}`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      data.value = await response.json();
    } catch (err) {
      error.value = err;
    } finally {
      isLoading.value = false;
    }
  };

  fetchPageData();

  return { data, error, isLoading };
}
