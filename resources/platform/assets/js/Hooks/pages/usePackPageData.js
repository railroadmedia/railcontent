// hooks/usePackPageData.js
import { ref } from 'vue';
import { fetchCompletedState, fetchByRailContentId } from 'musora-content-services';
import { useUserStore } from "@stores/user";
import { useBuildHeader } from '@hooks/useBuildHeader';

export async function usePackPageData(contentType) {
    const userStore = useUserStore();

    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);

    const getContentId = () => {
        const pathname = window.location.pathname;
        const match = pathname.match(/\/(\d+)\/?$/);
        return match ? match[1] : null;
    }

    const getProgressPercent = async () => {
        const id = getContentId();
        if (!id) return 0;

        try {
            const completedState = await fetchCompletedState(id);
            return completedState ? completedState.percent : 0;
        } catch (error) {
            console.error('Error fetching completed state:', error);
            return 0;
        }
    }

    const contentId = getContentId();
    const progressPercent = await getProgressPercent();

    // Initialize the buildHeader hook
    const { buildHeader } = useBuildHeader(progressPercent);

    try {
        const result = await fetchByRailContentId(contentId, "pack-bundle");
        if (result) {
            data.value = result;
            data.value.header = buildHeader("pack-bundle", result, progressPercent); // Use the hook to build header
        }
    } catch (err) {
        error.value = err;
    } finally {
        isLoading.value = false;
    }

    return { data, error, isLoading };
}
