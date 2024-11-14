import { ref } from 'vue';
import { fetchSongById, fetchRelatedSongs } from 'musora-content-services';

export async function useSongPageData(contentId, brand) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    const results = await Promise.allSettled([
      fetchSongById(contentId),
      fetchRelatedSongs(brand, contentId)
    ]);

    const songResponse = results[0].status === "fulfilled" ? results[0].value : null;
    const relatedSongsResponse = results[1].status === "fulfilled" ? results[1].value : null;

    data.value = songResponse;
    console.log('songResponse', songResponse)

    if (relatedSongsResponse) {
      console.log('relatedSongs', relatedSongsResponse);
      data.value.relatedLessons = relatedSongsResponse.entity;
    }


  } catch (err) {
    error.value = err;
  } finally {
    isLoading.value = false;
  }

  return { data, error, isLoading };
}
