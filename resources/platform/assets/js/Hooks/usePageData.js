// hooks/usePageData.js
import { ref } from 'vue';
import { useSongPageData } from './pages/useSongPageData';

export async function usePageData(props, brand, userId, token) {
  const data = ref(null);
  const error = ref(null);
  const isLoading = ref(true);

  if (props.page === 'song') {
    const { data: songData, error: songError, isLoading: songLoading } = await useSongPageData(props.contentId, brand, userId, token);

    data.value = songData.value;
    error.value = songError.value;
    isLoading.value = songLoading.value;
  } else {
    // Add logic for other pages here if needed
    isLoading.value = false;
  }

  //console.log('Page data:', data.value);

  return { data, error, isLoading };
}
