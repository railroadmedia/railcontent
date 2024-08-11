// hooks/useSongPageData.js
import { ref } from 'vue';
import { fetchSongById, fetchRelatedSongs } from 'musora-content-services';
import { fetchCurrentSongComplete, fetchAllCompletedStates } from '@services/userService';
import { usePlatformStore } from '@stores/platform';

//Pinia Stores
const platformStore = usePlatformStore();

export async function useSongPageData(contentId, brand, userId, token) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    const [songResponse, relatedSongsResponse, currentSongCompleteResponse] = await Promise.all([
      fetchSongById(platformStore.sanityConfig, contentId),
      fetchRelatedSongs(platformStore.sanityConfig, brand, contentId),
      fetchCurrentSongComplete(userId, contentId, token)
    ]);

    data.value = songResponse;

    if (relatedSongsResponse) {
      data.value.relatedLessons = relatedSongsResponse.data;
    }

    if (currentSongCompleteResponse) {
      data.value.completed = currentSongCompleteResponse.state !== "not started";
      data.value.progress_percent = currentSongCompleteResponse.percent.toString();
    }

    if (data.value.relatedLessons) {
      const relatedLessonIds = data.value.relatedLessons.map(lesson => lesson.id);
      const relatedLessonsCompletionStates = await fetchAllCompletedStates(userId, relatedLessonIds, token);
      if (relatedLessonsCompletionStates) {
        data.value.relatedLessons = data.value.relatedLessons.map(lesson => {
          const lessonCompletionState = relatedLessonsCompletionStates[lesson.id];
          if (lessonCompletionState) {
            return {
              ...lesson,
              completed: lessonCompletionState.state !== "not started",
              lesson_progress: lessonCompletionState.percent.toString()
            };
          }
          return lesson;
        });
      }
    }
  } catch (err) {
    error.value = err;
  } finally {
    isLoading.value = false;
  }

  //console.log('Song data:', data.value);
  return { data, error, isLoading };
}
