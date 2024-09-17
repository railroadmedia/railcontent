// hooks/useHomePageData.js
import { ref } from 'vue';
import { fetchNewReleases } from 'musora-content-services';

export async function useHomePageData(brand) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    const [newReleasesResponse] = await Promise.all([
      fetchNewReleases(brand),
    ]);
  
    data.value = {
      newReleases: newReleasesResponse || [],
    };
  } catch (err) {
    console.error('Error fetching data:', err);
    error.value = err;
  } finally {
    isLoading.value = false;
    // Log data.value to ensure it's set
    // console.log('data.value in finally:', data.value);
  }

  // Return the data object and other states
  return { data, error, isLoading };
}
