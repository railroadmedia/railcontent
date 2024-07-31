// hooks/usePageData.js
import { ref } from 'vue';
import { fetchSongById, fetchRelatedSongs, fetchCurrentSongComplete, fetchAllCompletedStates } from '@services/songService';

export function usePageData(props, brand, userId, token) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);
  const contentId = props.contentId;

  // Methods
  const fetchPageData = async () => {
    try {
      // Fetch the main song data, related songs, and current song completion status in parallel
      const [songResponse, relatedSongsResponse, currentSongCompleteResponse] = await Promise.all([
        fetchSongById(contentId),
        fetchRelatedSongs(brand, contentId),
        fetchCurrentSongComplete(userId, contentId, token)
      ]);

      // Combine the responses
      data.value = songResponse;
      if (relatedSongsResponse) {
        data.value.relatedLessons = relatedSongsResponse.data;
      }
      if (currentSongCompleteResponse) {
        const firstContentId = Object.keys(currentSongCompleteResponse)[0];
        if (firstContentId) {
          data.value.completed = currentSongCompleteResponse[firstContentId].state !== "not started";
          data.value.lesson_progress = currentSongCompleteResponse[firstContentId].percent.toString(); // For Song Player Section
        }
      }

      // Fetch completion states for related lessons
      if (data.value.relatedLessons) {
        console.log('relatedLessons', data.value.relatedLessons)
        const relatedLessonIds = data.value.relatedLessons.map(lesson => lesson._id);
        const relatedLessonsCompletionStates = await fetchAllCompletedStates(userId, relatedLessonIds, token);
        if (relatedLessonsCompletionStates) {
          data.value.relatedLessons = data.value.relatedLessons.map(lesson => {
            const lessonCompletionState = relatedLessonsCompletionStates[lesson._id];
            if (lessonCompletionState) {
              return {
                ...lesson,
                completed: lessonCompletionState.state !== "not started",
                lesson_progress: lessonCompletionState.percent.toString()
              };
            }
            return lesson;
          });
        } else {
            console.log('no related lessons')
        }
      }

      console.log(data.value);
    } catch (err) {
      error.value = err;
    } finally {
      isLoading.value = false;
    }
  };

  fetchPageData();

  return { data, error, isLoading };
}
