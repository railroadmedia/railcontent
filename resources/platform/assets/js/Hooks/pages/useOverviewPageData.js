// hooks/useOverviewPageData.js
import { ref } from 'vue';
import { fetchMethod, fetchMethodChildren, fetchFoundation, fetchCompletedState, getProgressPercentage, fetchUserChallengeProgress } from 'musora-content-services';

import { useUserStore } from "@stores/user";
import { useBuildHeader } from '@hooks/useBuildHeader';

export async function useOverviewPageData(contentType, parentType) {
    const userStore = useUserStore();

    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);

    const contentId = getContentId();
    const progressPercent = await getProgressPercentage(contentId); // Await the progress percent

    // Initialize the buildHeader hook
    const { buildHeader } = useBuildHeader(progressPercent);

    try {
    	if (parentType === 'challenges'){
            const result = await fetchUserChallengeProgress(contentId);
            if(result){
                data.value = {
                    children: result.lessons,
                    header: buildHeader('challenges', result.lesson, progressPercent),
                    is_unlocked: result.user_data.is_unlocked,
                    lesson: result.lesson,
                };
            }
        } else {
		if (contentType === "learning-path-level") {
	            const result = await fetchMethod(userStore.brand, `${userStore.brand}-method`);
	            if (result) {
	                result.levels = result.levels.map((level, index) => ({
	                    ...level,
	                    position: index + 1
	                }));
	                data.value = result;
	                data.value.header = buildHeader(contentType, result, progressPercent);
	                data.value.children = result.levels;
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
	                data.value.children = result.units;
	            } else {
	                throw new Error('Failed to fetch foundation');
	            }
	        } else {
	            //console.log(contentType);
	            const result = await fetchMethodChildren(contentId);
	            if (result) {
	                data.value = result[0];
	                data.value.header = buildHeader(contentType, result[0], progressPercent);
	            } else {
	                throw new Error('Failed to fetch method children');
	            }
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

