// hooks/useArtistPageData.js
import { ref } from 'vue';
import { fetchArtists } from 'musora-content-services';

export async function useArtistPageData(brand) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  try {
    const result = await fetchArtists(brand);
    if (result) {
      data.value = result;
    } else {
      throw new Error('Failed to fetch artists');
    }
  } catch (err) {
    error.value = err;
  } finally {
    isLoading.value = false;
  }

  //console.log('Artist data:', data.value);
  return { data, error, isLoading };
}
