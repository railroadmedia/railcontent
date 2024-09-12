// hooks/useHomePageData.js
import { ref } from 'vue';
import { fetchWorkouts, fetchNewReleases, fetchUpcomingEvents } from 'musora-content-services';

export async function useHomePageData(brand) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    const [workoutsResponse, newReleasesResponse, upcomingEventsResponse] = await Promise.all([
      fetchWorkouts(brand),
      fetchNewReleases(brand),
      fetchUpcomingEvents(brand),
    ]);
  
    data.value = {
      workouts: workoutsResponse || [],
      newReleases: newReleasesResponse || [],
      upcomingEvents: upcomingEventsResponse || [],
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
