// hooks/useOverviewPageData.js
import { ref } from 'vue';
import { fetchCompletedState, fetchMethod, fetchMethodChildren, fetchFoundation } from 'musora-content-services';
import { useUserStore } from "@stores/user";

export async function useOverviewPageData(contentType) {
    const userStore = useUserStore();

    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);
    const progressPercent = getProgressPercent();

    try {
        //Method Levels
        if(contentType === "learning-path-level") {
            console.log('hello')
            const result = await fetchMethod(userStore.brand, `${userStore.brand}-method`);
            if (result) {   
                //Add Method Level Position
                result.levels = result.levels.map((level, index) => ({
                    ...level,
                    position: index + 1 
                }));
                data.value = result;

                //Header
                data.value.header = {
                    type: contentType,
                    title: result.title,
                    description: result.description,
                    id: result.contentId,
                    progress: progressPercent,
                };
            } else {
                throw new Error('Failed to fetch method');
            }
        }
        //Foundations....
        else if (contentType === "unit") {
            const result = await fetchFoundation('foundations-2019');
            if(result) {
                //Add Method Level Position
                result.units = result.units.map((unit, index) => ({
                    ...unit,
                    position: index + 1 
                }));
                data.value = result;
            }
        }
        //Method Level Courses
        else {
            //console.log('childId', childContentId())
            const result = await fetchMethodChildren(childContentId());
            if (result) {   
                //console.log('result', result[0])
                data.value = result[0];
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
const childContentId = () => {
    //Get content id for url
    const pathname = window.location.pathname;
    // Use a regular expression to match the last number in the path
    const match = pathname.match(/\/(\d+)\/?$/);
    if (match) {
        // The last number will be in match[1]
        const lastNumber = match[1];
        //console.log(lastNumber)
        return lastNumber; // Output: 241248 (example)
    } else {
        console.log('No number found');
    }
}

const buildHeader = (contentType, result) => {
    let header = {
        type: contentType,
        title: result.title,
        description: result.description,
        // infoData: [
        //     `${result.child_count} ${contentType === 'pack-bundle' ? 'Packs' : 'Lessons'}`,
        //     `${result.total_xp} XP`
        // ],
        thumbnail: result.thumbnail,
        image: result.image,
        darkLogo: result.light_logo,
        lightLogo: result.dark_logo,
        ctas: buildHeaderCTA(result),
        progress: progressPercent, 
    }

    return header;
}

// Helper function to build CTA buttons based on progress
const buildHeaderCTA = (method) => {
    const progressPercent = getProgressPercent();

    const ctas = [];

    // const primaryButton = {
    //     type: "PageHeaderPrimaryCta",
    //     props: {
    //         faIconClass: "fa-play",
    //         isPrimary: true,
    //         text: progressPercent === 0 ? "Start" :
    //               progressPercent === 100 ? "Restart" : "Continue",
    //         url: method.web_url_path
    //     }
    // };
    // ctas.push(primaryButton);

    if(contentType === "learning-path-level") {
        const previewLessonCta = {
            castTitle: "The Drumeo Method",
            contentId: method.id,
            nextLessonUrl: "https://dev.musora.com:8443/drumeo/method/drumeo-method/241247/getting-started-on-the-drums/241248/gear/241249/the-gear-in-front-of-you/241250",
            poster: "https://i.vimeocdn.com/video/843279057-358419152f59d5352707c1c85a75724753c93c76973108da1181f0038ca10b7d-d_1280x720?r=pad",
            //sources: [{…}, {…}, {…}, {…}, {…}, {…}, {…}],
            videoId: "382231267"
        }
    }

    //Reset Button
    if(contentType !== "learning-path-level" || contentType !== "unit"){
        if(progressPercent !== 0) {
            const resetButton = {
                type: "ResetProgressCta",
                props: {
                    contentId: method.id,
                    progress: progressPercent
                }
            };
            ctas.push(resetButton); 
        }
    }


    //Resource Buttons
    if(method.resources) {
        const resourceButton = {
            type: "DownloadResourcesCta",
            props: {
                resources: method.resources,
            }
        };
        ctas.push(resourceButton);
    }
    return ctas;
}

// Helper function to get content ID from URL
const getContentId = () => {
    const pathname = window.location.pathname;
    const match = pathname.match(/\/(\d+)\/?$/);
    return match ? match[1] : null;
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