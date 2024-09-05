// hooks/useOverviewPageData.js
import { ref } from 'vue';
import { fetchCompletedState, fetchByRailContentId } from 'musora-content-services';
import { useUserStore } from "@stores/user";

export async function usePackPageData(contentType) {
    const userStore = useUserStore();

    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);
    const progressPercent = getProgressPercent();

    try {
        const result = await fetchByRailContentId(getContentId(), "pack-children");
        if (result) {   
            console.log('result',result)
            data.value = result;
            //Create Header Data
            data.value.header = {
                type: 'pack',
                title: result.title,
                description: result.description,
                infoData: [
                    `${result.child_count} ${contentType === 'pack-bundle' ? 'Packs' : 'Lessons'}`,
                    `${result.total_xp} XP`
                ],
                thumbnail: result.thumbnail,
                image: result.image,
                darkLogo: result.light_logo,
                lightLogo: result.dark_logo,
                ctas: buildHeaderCTA(result),
                progress: progressPercent, 
            }
        }
    } catch (err) {
        error.value = err;
    } finally {
        isLoading.value = false;
    }
    return { data, error, isLoading };
}

//Methods

// Helper function to get content ID from URL
const getContentId = () => {
    const pathname = window.location.pathname;
    const match = pathname.match(/\/(\d+)\/?$/);
    return match ? match[1] : null;
}

// Helper function to build CTA buttons based on progress
const buildHeaderCTA = (pack) => {
    const progressPercent = getProgressPercent();

    const ctas = [];
    const primaryButton = {
        type: "PageHeaderPrimaryCta",
        props: {
            faIconClass: "fa-play",
            isPrimary: true,
            text: progressPercent === 0 ? "Start" :
                  progressPercent === 100 ? "Restart" : "Continue",
            url: pack.web_url_path
        }
    };
    ctas.push(primaryButton);

    //Reset Button
    if(progressPercent !== 0) {
        const resetButton = {
            type: "ResetProgressCta",
            props: {
                contentId: pack.id,
                progress: progressPercent
            }
        };
        ctas.push(resetButton); 
    }

    //Resource Buttons
    if(pack.resources) {
        const resourceButton = {
            type: "DownloadResourcesCta",
            props: {
                resources: pack.resources,
            }
        };
        ctas.push(resourceButton);
    }

    return ctas;
}

// Function to fetch progress percent and update state
const getProgressPercent = () => {
    const id = getContentId();

    fetchCompletedState(id)
        .then(completedState => {
            if (completedState) {
                return completedState.percent;
            }
        })
        .catch(error => {
            // Handle any errors that occurred during the fetch
            console.error('Error fetching completed state:', error);
        });
        return 0;
}