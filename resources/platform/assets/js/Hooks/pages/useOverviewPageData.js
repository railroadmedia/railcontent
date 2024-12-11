import { ref } from 'vue';
import {
    fetchMethod,
    fetchMethodChildren,
    fetchFoundation,
    jumpToContinueContent,
    getProgressPercentage,
    fetchUserChallengeProgress
} from 'musora-content-services';

import { useUserStore } from "@stores/user";
import { useBuildHeader } from '@hooks/useBuildHeader';

export async function useOverviewPageData(contentType, parentType) {
    const userStore = useUserStore();

    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);

    const contentId = getContentId();
    const progressPercent = await getProgressPercentage(contentId);

    // Initialize the buildHeader hook
    const { buildHeader } = useBuildHeader(progressPercent);

    // Helper to populate data
    const populateData = async (result, type, childrenKey = 'children') => {
        if (result) {
            result[childrenKey] = result[childrenKey]?.map((item, index) => ({
                ...item,
                position: index + 1,
            }));

            data.value = result;
            data.value.header = buildHeader(type, result, progressPercent);
            data.value.next_lesson = [];

            try {
                const nextLesson = await jumpToContinueContent(result.id);
                if (nextLesson?.next) {
                    data.value.next_lesson.push(nextLesson.next);
                }
            } catch (nextLessonError) {
                console.error('Error fetching next lesson:', nextLessonError);
            }
        } else {
            throw new Error(`Failed to fetch data for type: ${type}`);
        }
    };

    try {
        if (parentType === 'challenge') {
            const result = await fetchUserChallengeProgress(contentId);
            if (result) {
                data.value = {
                    children: result.lessons,
                    header: buildHeader('challenge', result.lesson, result.user_data.is_active ? result.user_data.completion_percent : progressPercent),
                    is_unlocked: result.user_data.is_unlocked,
                    lesson: result.lesson,
                    user_data: result.user_data,
                    next_lesson: result.next_lesson,
                    previous_lesson: result.previous_lesson,
                };
            }
        } else if (contentType === 'learning-path-level') {
            const result = await fetchMethod(userStore.brand, `${userStore.brand}-method`);
            await populateData(result, contentType, 'levels');
        } else if (contentType === 'unit') {
            const result = await fetchFoundation('foundations-2019');
            await populateData(result, contentType, 'units');
        } else {
            const result = await fetchMethodChildren(contentId);
            if (result && result[0]) {
                await populateData(result[0], contentType);
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
};
