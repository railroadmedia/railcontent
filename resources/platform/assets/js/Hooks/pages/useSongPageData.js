// hooks/useSongPageData.js
import { ref } from 'vue';
import { fetchSongById, fetchRelatedSongs } from 'musora-content-services';
import { fetchCompletedState, fetchAllCompletedStates } from 'musora-content-services';

export async function useSongPageData(contentId, brand, userId, token) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    const [songResponse, relatedSongsResponse, currentSongCompleteResponse] = await Promise.all([
      fetchSongById(contentId),
      fetchRelatedSongs(brand, contentId),
      fetchCompletedState(contentId)
    ]);

    data.value = songResponse;

    if (relatedSongsResponse) {
      data.value.relatedLessons = relatedSongsResponse.entity;
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
