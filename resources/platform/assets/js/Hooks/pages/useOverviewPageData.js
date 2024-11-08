// hooks/useOverviewPageData.js
import { ref } from 'vue';
import axios from 'axios';
import { fetchCompletedState, fetchMethod, fetchCourseOverview, fetchMethodChildren, fetchFoundation, getProgressPercentageByIds, fetchUserChallengeProgress } from 'musora-content-services';
import { useUserStore } from "@stores/user";
import { useBuildHeader } from '@hooks/useBuildHeader';

export async function useOverviewPageData(contentType, parentType) {
    const userStore = useUserStore();

    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);

    const contentId = getContentId();
    const progressPercent = await getContentProgressPercent(contentId); // Await the progress percent

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

    const progressData = await addLessonsProgress(data.value.children);
    data.value.children = progressData;

    return { data, error, isLoading };
}

// Helper function to get content ID from URL
const getContentId = () => {
    const pathname = window.location.pathname;
    const match = pathname.match(/\/(\d+)\/?$/);
    return match ? match[1] : null;
}

// Function to fetch progress percent and update state
const getContentProgressPercent = async (id) => {
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

const addLessonsProgress = async (data) => {
    const ids = [];
    data.forEach((item) => {
        ids.push(item.id);
    });

    const progress = await getProgressPercentageByIds(ids);

    const addedProgress = data.map((item) => ({
        ...item,
        ...(progress[item.id] && { progress_percent: progress[item.id] }),
    }))

    return addedProgress;
}
