// hooks/useOverviewPageData.js
import { ref } from 'vue';
import { fetchCompletedState, fetchMethod, fetchCourseOverview, fetchMethodChildren, fetchFoundation } from 'musora-content-services';
import { useUserStore } from "@stores/user";
import { useBuildHeader } from '@hooks/useBuildHeader';

export async function useOverviewPageData(contentType) {
    const userStore = useUserStore();
    
    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);

    const contentId = getContentId();
    const progressPercent = await getProgressPercent(contentId); // Await the progress percent

    // Initialize the buildHeader hook
    const { buildHeader } = useBuildHeader(progressPercent);

    try {
        if (contentType === "learning-path-level") {
            const result = await fetchMethod(userStore.brand, `${userStore.brand}-method`);
            if (result) {
                result.levels = result.levels.map((level, index) => ({
                    ...level,
                    position: index + 1 
                }));
                data.value = result;
                data.value.header = buildHeader(contentType, result, progressPercent);
            } else {
                throw new Error('Failed to fetch method');
            }
        } else if (contentType === "unit") {
            const result = await fetchFoundation('foundations-2019');
            if (result) {
                result.units = result.units.map((unit, index) => ({
                    ...unit,
                    position: index + 1 
                }));
                data.value = result;
                data.value.header = buildHeader(contentType, result, progressPercent);
            } else {
                throw new Error('Failed to fetch foundation');
            }
        } else {
            const result = await fetchMethodChildren(contentId);
            if (result) {
                data.value = result[0];
                data.value.header = buildHeader(contentType, result[0], progressPercent);
            } else {
                throw new Error('Failed to fetch method children');
            }
        }        
    } catch (err) {
        error.value = err;
    } finally {
        isLoading.value = false;
    }

    return { data, error, isLoading };
}

// Helper function to get content ID from URL
const getContentId = () => {
    const pathname = window.location.pathname;
    const match = pathname.match(/\/(\d+)\/?$/);
    return match ? match[1] : null;
}

// Function to fetch progress percent and update state
const getProgressPercent = async (id) => {
    if (!id) return 0; // Return 0 if no ID is found

    try {
        const completedState = await fetchCompletedState(id);
        console.log(completedState)
        return completedState ? completedState.percent : 0;
    } catch (error) {
        console.error('Error fetching completed state:', error);
        return 0;
    }
}
