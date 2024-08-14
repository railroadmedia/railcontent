// hooks/useHomePageData.js
import { ref } from 'vue';
import { fetchWorkouts, fetchNewReleases, fetchUpcomingEvents, fetchLiveEvent } from 'musora-content-services';

export async function useHomePageData(brand, userId, token) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    //TODO: Add lessons in progress /content/in_progress/397822?brand=drumeo&content_type=all ??
    const [workoutsResponse, newReleasesResponse, upcomingEventsResponse, liveEventResponse] = await Promise.all([
      fetchWorkouts(brand),
      fetchNewReleases(brand),
      fetchUpcomingEvents(brand),
      fetchLiveEvent(brand)
    ]);

    data.value = {
      workouts: workoutsResponse || [],
      newReleases: newReleasesResponse || [],
      upcomingEvents: upcomingEventsResponse || [],
      liveEvent: liveEventResponse || [],
    };

  } catch (err) {
    error.value = err;
  } finally {
    isLoading.value = false;
  }

  return { data, error, isLoading };
}