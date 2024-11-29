import { ref } from 'vue';
import { fetchNewReleases, fetchContentInProgress, fetchByRailContentIds, fetchCarouselCardData } from 'musora-content-services';

export async function useHomePageData(brand) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    // Fetch IDs for started content
    const [startedIds, newReleasesResponse, carousels] = await Promise.all([
      fetchContentInProgress('all', brand),
      fetchNewReleases(brand),
      fetchCarouselCardData(brand),
    ]);

    // Fetch content by RailContent IDs for started lessons only
    const lessons = await fetchByRailContentIds(startedIds.started);

    // Filter lessons based on IDs
    const started = lessons.filter(lesson => startedIds.started.includes(lesson.id));

    // Set the data
    data.value = {
      newReleases: newReleasesResponse || [],
      continueSection: started || [],
      carousels: carousels || [],
    };
  } catch (err) {
    console.error('Error fetching data:', err);
    error.value = err;
  } finally {
    isLoading.value = false;
    // Log data.value to ensure it's set
    console.log('data.value in finally:', data.value);
  }

  // Return the data object and other states
  return { data, error, isLoading };
}
