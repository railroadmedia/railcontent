// hooks/usePageData.js
import { ref } from 'vue';
import { fetchSongById } from '@services/songService.js';

export function usePageData(props) {
    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);
    const contentId = props.contentId;

    //Fields
    const fields = [
        '_id',
        'title',
        '"thumbnail_url": thumbnail.asset->url', 
        'style',
        'artist',
        'album',
        'like_count',
        'is_liked_by_current_user',
        'is_added_to_primary_playlist',
        'instrumentless',
        '"soundslice_slug": assignments[0].soundsliceSlug',
        'resources[]{resource_url, resource_name}',
    ];

    //Methods
    const fetchPageData = async () => {
        try {
            const response = await fetchSongById(contentId, fields);
            data.value = await response;
            console.log(data.value)
        } catch (err) {
            error.value = err;
        } finally {
            isLoading.value = false;
        }
    };

    const fetchRelatedSongData = async () => {

    };

    fetchPageData();

    return { data, error, isLoading };
}
