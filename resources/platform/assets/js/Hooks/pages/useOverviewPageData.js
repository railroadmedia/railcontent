// hooks/useOverviewPageData.js
import { ref } from 'vue';
import { fetchMethod, fetchMethodChildren, fetchFoundation } from 'musora-content-services';
import { useUserStore } from "@stores/user";

export async function useOverviewPageData(contentType) {
    const userStore = useUserStore();

    const data = ref(null);
    const error = ref(null);
    const isLoading = ref(true);

    try {
        //Method Levels
        if(contentType === "learning-path-level") {
            const result = await fetchMethod(userStore.brand, `${userStore.brand}-method`);
            if (result) {   
                //Add Method Level Position
                result.levels = result.levels.map((level, index) => ({
                    ...level,
                    position: index + 1 
                }));
                data.value = result;
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
        else if(contentType === "learning-path-course" || contentType === "learning-path-lesson") {
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