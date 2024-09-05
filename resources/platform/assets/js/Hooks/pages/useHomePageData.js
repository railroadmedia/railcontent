// hooks/useHomePageData.js
import { ref } from 'vue';
import { fetchWorkouts, fetchNewReleases, fetchUpcomingEvents} from 'musora-content-services';

export async function useHomePageData(brand) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    //TODO: Add lessons in progress /content/in_progress/397822?brand=drumeo&content_type=all ??
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
    error.value = err;
  } finally {
    isLoading.value = false;
  }

  console.log(data.value)

  return { data, error, isLoading };
}