import { ref } from 'vue';
import { fetchNewReleases, fetchContentInProgress, fetchByRailContentIds, fetchCarouselCardData, fetchAll } from 'musora-content-services';

export async function useHomePageData(brand, isPackOrChallengeOnly) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    // Only pack or challenge users
    if(isPackOrChallengeOnly){
        const [challenges, packs, carousels] = await Promise.all([
            fetchAll(brand.value, 'challenge', {
                limit: 30,
            }),
            fetchAll(brand.value, 'pack', {
                limit: 30,
            }),
            fetchCarouselCardData(brand),
        ]);

        data.value = {
            challenges: challenges.entity,
            packs: packs.entity,
            carousels: carousels || [],
        }
    } else {
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
    }

  } catch (err) {
    console.error('Error fetching data:', err);
    error.value = err;
  } finally {
    isLoading.value = false;
  }

  // Return the data object and other states
  return { data, error, isLoading };
}
